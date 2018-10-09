<?php
    
//INCLUDE THE FILES NEEDED...
require_once('./view/LoginView.php');
require_once('./view/DateTimeView.php');
require_once('./view/LayoutView.php');
require_once('./model/CheckLoginInformation.php');
require_once('./model/CheckNewUserRegModel.php');
require_once('./model/allInfoSet.php');
require_once('./model/logginAndLoggoutModel.php');


  class Controller {

   private $cookieUserName = "cookieUserName";
   private $cookiePassword = "cookiePassword";

    private $v;
    private $dtv;
    private $lv;
    private $loggOut;
    private $logginCheck;
    private $checkNewUser;
    private $allInfoSet;

    public function __construct()
    {
        $this->v = new LoginView();
        $this->dtv = new DateTimeView();
        $this->lv = new LayoutView();
        $this ->logginCheck = new logginCheck();
        $this->checkNewUser = new checNewUserInfo();
        $this->allInfoSet = new allInfoSet();  
    }

    public function render () {
        $this->checkWhatToDo();
        $this->v->withPost();
        $this->lv->render(false, $this->v, $this->dtv);  
        }


    private function checkWhatToDo () {
        if(isset($_POST["LoginView::Logout"])){
         
         if(isset($_SESSION["loggin"])) {
            $this->v->setMessage("Bye bye!");
         }
    } else {
        if(isset($_SESSION["loggin"])) {
            if($_SESSION["loggin"] === "loggin"){
                
                $this->v->setMessage("");
                $this->lv->render(true, $this->v, $this->dtv);
                exit();

            }
        
        }
    if(isset($_POST["LoginView::Login"])) {
        $this->getLogginInformation(); 
    }
    }

    if(isset($_POST["RegisterView::Register"])) {
       $registerProblem = $checkNewUser->userInfoSet();
       if(strlen($registerProblem) > 0) {
        $this->v->setMessage($registerProblem);

        $this->v->setUsername($_POST["RegisterView::UserName"]);
       }
    }
}


  private function getLogginInformation () {

    $postUserName = $this->v->getUserName();
    $postPassword = $this->v->getPassword();
    try{
        $this->allInfoSet->isLogginInfoSet($postUserName, $postPassword);

        $this->logginCheck->checkLogginInformation($postUserName, $postPassword);

        $this->v->setMessage('welcome');
    }catch (Exception $e){
        $this->v->setMessage($e->getMessage());
    }
}


private function setcookie(){
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
    }

    private function checkCookieInfomration () {
        if(isset($_COOKIE[$cookieUserName]) and isset($_COOKIE[$cookiePassword])){
        
            if(!isset($_SESSION["loggin"])){
        
        
                $cookieRight = $this->logginCheck->checkLogginInformation($_COOKIE[$cookieUserName], $_COOKIE[$cookiePassword]);
        
                if($cookieRight === true){
                    $this->v->getLoggin('Welcome back with cookie');
                    $_SESSION["loggin"] = "loggin";
                    $this->lv->render(true, $v, $dtv);
                exit();
            } else {
                setcookie("cookieUserName", '', time() - 3600, "/");
                setcookie("cookiePassword",'' , time() - 3600, "/");
                
                    unset($_COOKIE[$cookieUserName]);
                    unset($_COOKIE[$cookiePassword]);
        
                    $this->v->setMessage('Wrong information in cookies');
            
                    $_SESSION["loggin"] = "loggout";
            
                    $this->lv->render(false, $v, $dtv);
                    exit();
            }
        
            }  
        }
         }
}