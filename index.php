<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/DatabassModel.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
/* 
error_reporting(E_ALL);
ini_set('display_errors', 'On');
*/
//CREATE OBJECTS OF THE VIEWS

session_start();


$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();
$dataBass = new DataBass();


if($_SERVER['REQUEST_METHOD'] === 'POST'){

if(!isset($_SESSION["loggin"])) {

    getLogginInformation($v,$dataBass);
} else {
    echo "hello world";
}

}

function isSetCheck ($userInput) {
    return isset($userInput);
}


    function getLogginInformation ($view,$dataBass) {
    $checkFildUserName = isset($_POST["LoginView::UserName"]);

    if(!empty($_POST["LoginView::UserName"])) {

        if($checkFildUserName === true){
            $checkIfPasswordIsFild = isset($_POST["LoginView::Password"]);
        
            if($checkIfPasswordIsFild === true && !empty($_POST["LoginView::Password"])) {
              
                $checkWithUser = $dataBass->readTextFile($_POST["LoginView::UserName"],$_POST["LoginView::Password"]);

                if($checkWithUser === true)
                {
                    $view->getLoggin('Welcome ' . $_POST["LoginView::UserName"]);
                    $_SESSION["loggin"] = "loggin";
                }else {
                $view->getLoggin("Wrong username or password");
                $view->setUsername($_POST["LoginView::UserName"]);
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

