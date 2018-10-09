<?php

//INCLUDE THE FILES NEEDED...
require_once('./view/LoginView.php');
require_once('./view/DateTimeView.php');
require_once('./view/LayoutView.php');
require_once('./model/CheckLoginInformation.php');
require_once('./model/CheckNewUserRegModel.php');
require_once('./model/allInfoSet.php');
require_once('./model/logginAndLoggoutModel.php');


class Controller
{

    private $cookieUserName = "cookieUserName";
    private $cookiePassword = "cookiePassword";

    private $v;
    private $dtv;
    private $lv;
    private $loggOut;
    private $logginCheck;
    private $checkNewUser;
    private $allInfoSet;
    private $loginAndOutCheck;

    public function __construct()
    {
        $this->v = new LoginView();
        $this->dtv = new DateTimeView();
        $this->lv = new LayoutView();
        $this->logginCheck = new logginCheck();
        $this->checkNewUser = new checNewUserInfo();
        $this->allInfoSet = new allInfoSet();
        $this->logginAndOutCheck = new loggInAndOutCheck();
    }

    public function render()
    {
        $this->checkWhatToDo();
        $this->lv->render($this->logginAndOutCheck->isUserLoggin(), $this->v, $this->dtv);
    }


    private function checkWhatToDo()
    {
        $withPost = $this->v->withPost();
        switch ($withPost) {
            case "loggin":
                if ($this->logginAndOutCheck->isUserLoggin()) {
                } else {
                    $this->getLogginInformation();
                }
                break;

            case "loggout":
                if ($this->logginAndOutCheck->isUserLoggin()) {
                        $this->v->setMessage("Bye bye!");
                        $this->logginAndOutCheck->removeSeasion();
                    }
                break;

            case "addUser": 
            $registerProblem = $this->checkNewUser->userInfoSet();
            if (strlen($registerProblem) > 0) {
                $this->v->setMessage($registerProblem);

                $this->v->setUsername($_POST["RegisterView::UserName"]);
            }
            break;
        }
    }


    private function getLogginInformation()
    {

        $postUserName = $this->v->getUserName();
        $postPassword = $this->v->getPassword();
        try {
            $this->allInfoSet->isLogginInfoSet($postUserName, $postPassword);

            $this->logginCheck->checkLogginInformation($postUserName, $postPassword);

            $this->v->setMessage('welcome');

            $this->logginAndOutCheck->setSeasion();
        } catch (Exception $e) {
            $this->v->setMessage($e->getMessage());
        }
    }


    private function setcookie()
    {
        if (isset($_POST["LoginView::KeepMeLoggedIn"])) {
            if (isset($_COOKIE[$cookieUserName]) and isset($_COOKIE["$cookiePassword"])) {
            } else {
                if (isset($_POST["LoginView::UserName"]) and !empty($_POST["LoginView::UserName"])) {
                    if (isset($_POST["LoginView::Password"]) and !empty($_POST["LoginView::Password"])) {

                        setcookie("cookieUserName", $_POST["LoginView::UserName"], time() + 60 * 60 * 24 * 30, "/");
                        setcookie("cookiePassword", $_POST["LoginView::Password"], time() + 60 * 60 * 24 * 30, "/");

                    }
                }
            }
        }
    }

    private function checkCookieInfomration()
    {
        if (isset($_COOKIE[$cookieUserName]) and isset($_COOKIE[$cookiePassword])) {

            if (!isset($_SESSION["loggin"])) {


                $cookieRight = $this->logginCheck->checkLogginInformation($_COOKIE[$cookieUserName], $_COOKIE[$cookiePassword]);

                if ($cookieRight === true) {
                    $this->v->getLoggin('Welcome back with cookie');
                    $_SESSION["loggin"] = "loggin";
                    $this->lv->render(true, $v, $dtv);
                    exit();
                } else {
                    setcookie("cookieUserName", '', time() - 3600, "/");
                    setcookie("cookiePassword", '', time() - 3600, "/");

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