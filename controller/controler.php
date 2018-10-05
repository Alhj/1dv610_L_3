<?php
    
//INCLUDE THE FILES NEEDED...
require_once('./view/LoginView.php');
require_once('./view/DateTimeView.php');
require_once('./view/LayoutView.php');
//require_once('model/DatabassModel.php');
require_once('./model/loggout.php');
require_once('./model/CheckLoginInformation.php');
require_once('./model/CheckNewUserRegModel.php');


  class Controller {

   private $cookieUserName = "cookieUserName";
   private $cookiePassword = "cookiePassword";
   //CREATE OBJECTS OF THE VIEWS

    private $v;
    private $dtv;
    private $lv;
    private $loggOut;
    private $logginCheck;
    private $checkNewUser;

    public function setNewClasses ()
    {
      $this->v = new LoginView();
      $this->dtv = new DateTimeView();
      $this->lv = new LayoutView();
      $this->loggOut = new LoggOutModel();
      $this ->logginCheck = new logginCheck();
      $this->checkNewUser = new checNewUserInfo();
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

 private function one () {
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

private function två () {
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST["LoginView::Logout"])){
         
         if(isset($_SESSION["loggin"])) {
            if($_SESSION["loggin"] === "loggout"){
                $_SESSION["loggin"] = "";
                 $lv->render($userLoggin, $v, $dtv);
                exit();
            }
         }
         $this->v->setMessage("Bye bye!");
        $_SESSION["loggin"] = "loggout";
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

}
private function isSetCheck ($userInput) {
    return isset($userInput);
}


  private function getLogginInformation () {
    $checkFildUserName = isset($_POST["LoginView::UserName"]);

    if(!empty($_POST["LoginView::UserName"])) {

        if($checkFildUserName === true){
            $checkIfPasswordIsFild = isset($_POST["LoginView::Password"]);
        
            if($checkIfPasswordIsFild === true && !empty($_POST["LoginView::Password"])) {
              
                $checkWithUser = $this->logginCheck->checkLogginInformation($this->v->getUserName(),$this->v->getPassword());
                

                if($checkWithUser === true)
                {
                    if(isset($_POST["LoginView::KeepMeLoggedIn"])){
                        $this->v->setMessage('Welcome and you will be remembered');    
                    }else {
                        $this->v->setMessage('Welcome');
                    }
                    $_SESSION["loggin"] = "loggin";
                     
                }else {
                    $this->v->setMessage("Wrong name or password");
                    $this->v->setUsername($_POST["LoginView::UserName"]);
                }

            } else {
                $this->v->setMessage("Password is missing");
                $this->v->setUsername($_POST["LoginView::UserName"]);
            }
        }
    } else {
        $this->v->setMessage("Username is missing");
    }
}
public function render () {
$this->två();
$this->lv->render(false, $this->v, $this->dtv);  
}
}