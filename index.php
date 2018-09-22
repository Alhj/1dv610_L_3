<?php
if(!isset($_SESSION)) {
session_start();
}

if(isset($_SESSION["setCookie"])){
    if(!isset($_Cookie["setCookie"]))
    {
        setcookie("setCookie", "true", time() + (86400 * 30), "/");
    }
}

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/DatabassModel.php');
require_once('model/loggout.php');
require_once('model/CheckLoginInformation.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER

error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS

$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();
//$dataBass = new DataBass();
$loggOut = new LoggOutModel();
$logginCheck = new logginCheck();

$userLoggin = false;

if(isset($_COOKIE["keepMeLoggidIn"])){
    $_SESSION["loggin"] = "loggin";
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST["LoginView::Logout"])){
         
         if(isset($_SESSION["loggin"])) {
            if($_SESSION["loggin"] === "loggout"){
                $_SESSION["loggin"] = "";
                 $lv->render($userLoggin, $v, $dtv);
                exit();
            }
         }
        $v->getLoggin("Bye bye!");
        $_SESSION["loggin"] = "loggout";
    } else {
        if(isset($_SESSION["loggin"])) {
            if($_SESSION["loggin"] === "loggin"){
                $lv->render(true, $v, $dtv);
                exit();
            }
        
        }
    getLogginInformation($v,$logginCheck); 
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
              
                $checkWithUser = $dataBass->checkLogginInformation($_POST["LoginView::UserName"],$_POST["LoginView::Password"]);

                if($checkWithUser === true)
                {
                    if(isset($_POST["LoginView::KeepMeLoggedIn"])){
                        echo "works";
                        $_SESSION["setCookie"] = "true";
                    }

                    if(isset($_Cookie["setCookie"]){
                        echo "funkar";
                    }

                    $view->getLoggin('Welcome');
                    $_SESSION["loggin"] = "loggin";
                    
                }else {
                $view->getLoggin("Wrong name or password");
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

if(isset($_SESSION["loggin"])) {
    if($_SESSION["loggin"] === "loggin" ){
    $userLoggin = true;
    }
}

$lv->render($userLoggin, $v, $dtv);