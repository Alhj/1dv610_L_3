<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
/* 
error_reporting(E_ALL);
ini_set('display_errors', 'On');
*/
//CREATE OBJECTS OF THE VIEWS


$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();


readTextFile();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

getLogginInformation($v);

}

function isSetCheck ($userInput) {
    return isset($userInput);
}


    function getLogginInformation ($view) {
    $checkFildUserName = isset($_POST["LoginView::UserName"]);

    if(!empty($_POST["LoginView::UserName"])) {

        if($checkFildUserName === true){
            $checkIfPasswordIsFild = isset($_POST["LoginView::Password"]);
        
            if($checkIfPasswordIsFild === true && !empty($_POST["LoginView::Password"])) {
              
                $users = readTextFile();

                if($_POST["LoginView::UserName"] === ''.$users[0].'' && $_POST["LoginView::Password"] === $users[1]){
                }else {
                    $view->getLoggin("Wrong name or password");
                }
            } else {
                $view->getLoggin("Password is missing");
                $view->setUsername($_POST["LoginView::UserName"]);
            }
        }
    } else {
        $view->getLoggin("Username is missing");
    }
}



$lv->render(false, $v, $dtv);

function readTextFile() {

    $userArray = explode(" ", file_get_contents('user.txt'));

    echo $userArray[1];

    return $userArray;
}