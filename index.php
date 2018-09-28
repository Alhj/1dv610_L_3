<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');


if(!isset($_SESSION)) {
    session_start();
    }

    $cookieUserName = "cookieUserName";
    $cookiePassword = "cookiePassword";

    $cookieWrong = "test";

    if(isset($_POST["LoginView::KeepMeLoggedIn"])){
        if(isset($_COOKIE[$cookieUserName]) and isset($_COOKIE["$cookiePassword"])){
        }else{
           if(isset($_POST["LoginView::UserName"]) and !empty($_POST["LoginView::UserName"])){
                 if (isset($_POST["LoginView::Password"]) and !empty($_POST["LoginView::Password"])){
     
                     setcookie("cookieUserName",$_POST["LoginView::UserName"], time() + 60 * 60 * 24 * 30, "/");
                     setcookie("cookiePassword",$_POST["LoginView::Password"], time() + 60 * 60 * 24 * 30, "/");

                 }
           }
        }
     }

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
//require_once('model/DatabassModel.php');
require_once('model/loggout.php');
require_once('model/CheckLoginInformation.php');
require_once('model/CheckNewUserRegModel.php');

//CREATE OBJECTS OF THE VIEWS

$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();
//$dataBass = new DataBass();
$loggOut = new LoggOutModel();
$logginCheck = new logginCheck();
$checkNewUser = new checNewUserInfo();

if(isset($_COOKIE[$cookieUserName]) and isset($_COOKIE[$cookiePassword])){

    if(!isset($_SESSION["loggin"])){


        $cookieRight = $logginCheck->checkLogginInformation($_COOKIE[$cookieUserName], $_COOKIE[$cookiePassword]);

        if($cookieRight === true){
            $v->getLoggin('Welcome back with cookie');
    
        $lv->render(true, $v, $dtv);
        exit();
    }



    }   else {
        setcookie("cookieUserName", '', time() - 3600, "/");
        setcookie("cookiePassword",'' , time() - 3600, "/");
        
            unset($_COOKIE[$cookieUserName]);
            unset($_COOKIE[$cookiePassword]);

        $v->getLoggin('Wrong information in cookies');
    
            $_SESSION["loggin"] = "loggout";
    
            $lv->render(false, $v, $dtv);
            exit();
    }
  }


if($cookieWrong === true){
    $_SESSION["loggin"] = "loggin";
                
                $v->getLoggin('Welcome back with cookie');
        
                $lv->render(true, $v, $dtv);
                exit();
}


$userLoggin = false;

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

                
                $v->getLoggin("");
                $lv->render(true, $v, $dtv);
                exit();

            }
        
        }
    if(isset($_POST["LoginView::Login"])) {
    getLogginInformation($v,$logginCheck); 
    }
    }

    if(isset($_POST["Register"])) {
       $registerProblem = $checkNewUser->userInfoSet();
       if(strlen($registerProblem) > 0) {
        $v->getLoggin($registerProblem);
       }
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
                        $view->getLoggin('Welcome and you will be remembered');    
                    }else {
                    $view->getLoggin('Welcome');
                    }
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