<?php

//INCLUDE THE FILES NEEDED to View
require_once('./view/Loggin/LoginView.php');
require_once('./view/Layout/DateTimeView.php');
require_once('./view/Layout/LayoutView.php');
require_once('./view/Loggin/RegisterView.php');
require_once('./view/Appliaction/snippesView.php');

// INCLUDE THE FILES NEEDED to Model
require_once('./model/Loggin/CheckNewUserRegModel.php');
require_once('./model/Loggin/logginAndLoggoutModel.php');
require_once('./model/customException.php');
require_once('env.php');

// INCLUDE THE FILES NEEDED to Controller

require_once('./controller/loginAndLogoutControler.php');
require_once('./controller/SnippController.php');

class Controller
{

    private $cookieUserName = "cookieUserName";
    private $cookiePassword = "cookiePassword";

    private $v;
    private $dtv;
    private $lv;
    private $registerView;
    private $snippsView;

    private $checkNewUser;
    private $logginAndOutCheck;

    private $LogginandLoggoutController;
    private $SnippController;

    public function __construct()
    {
        $this->v = new LoginView();
        $this->dtv = new DateTimeView();
        $this->lv = new LayoutView();
        $this->registerView = new RegisterView();
        $this->snippsView = new SnippsView();

        $this->checkNewUser = new checNewUserInfo();

        $this->LogginandLoggoutController = new logginAndLoggoutControler($this->v);
        $this->SnippController = new SnippController($this->snippsView);
    }

    public function render()
    {
        $this->checkWhatToDo();

        if ($this->lv->RegisterViewOrNot()) {
            $this->lv->render($this->LogginandLoggoutController->isUserLogin(), $this->registerView, $this->dtv);
            exit();
        }
        if ($this->snippsView-> whantToDoWithSnipp()) {
            $this->SnippController->checkWhatToDo();
           
           $this->lv->render($this->LogginandLoggoutController->isUserLogin(), $this->snippsView, $this->dtv);
            exit();
        }
        $this->lv->render($this->LogginandLoggoutController->isUserLogin(), $this->v, $this->dtv);
    }


    private function checkWhatToDo()
    {
        $this->LogginandLoggoutController->WhatToDo();
        
        if ($this->registerView->haveYouPost()) {
            $userName = $this->registerView->getUserName();

            $password = $this->registerView->getPassword();

            $registerProblem = $this->checkNewUser->userInfoSet($userName, $password);

            if (strlen($registerProblem) > 0) {
                $this->registerView->setMessage($registerProblem);
                $this->registerView->setUsername($userName);
            }
        }
    }
}