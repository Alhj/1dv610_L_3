<?php

namespace controler;

require_once('./view/Loggin/LoginView.php');
require_once('./view/Layout/DateTimeView.php');
require_once('./view/Layout/LayoutView.php');
require_once('./view/Loggin/RegisterView.php');
require_once('./view/Appliaction/snippesView.php');
require_once('./view/Appliaction/RemoveSnippView.php');


require_once('./model/Loggin/CheckNewUserRegModel.php');
require_once('./model/Loggin/LogginHandler.php');
require_once('./model/customException.php');
require_once('./model/application/CodeSnipp.php');
require_once('env.php');



require_once('./controller/loginControler.php');
require_once('./controller/SnippController.php');

class Controller
{

    private $logginView;
    private $dtv;
    private $lv;
    private $registerView;
    private $snippsView;

    private $checkNewUser;
    private $logginAndOutCheck;

    private $LogginController;
    private $SnippHandlerController;

    public function __construct()
    {
        $this->logginView = new \view\LoginView();
        $this->dtv = new \view\DateTimeView();
        $this->lv = new \view\LayoutView();
        $this->registerView = new \view\RegisterView();
        $this->snippsView = new \view\SnippsView();

        $this->checkNewUser = new \model\newUserModel();

        $this->LogginController = new \controler\logginControler($this->logginView);
        $this->SnippHandlerController = new \controler\SnippHandlerController($this->snippsView);
    }

    public function render()
    {
        $this->checkWhatToDo();

        if ($this->lv->RegisterViewOrNot()) {
            $this->lv->render($this->LogginController->isUserLogin(), $this->registerView, $this->dtv);
        } elseif ($this->snippsView->whantToDoWithSnipp()) {
            
            $this->SnippHandlerController->checkWhatToDo();

            $this->lv->render($this->LogginController->isUserLogin(), $this->snippsView, $this->dtv);
        } else {
            $this->lv->render($this->LogginController->isUserLogin(), $this->logginView, $this->dtv);
        }
    }


    private function checkWhatToDo()
    {
        $this->LogginController->WhatToDo();

        if ($this->registerView->haveYouPost()) {
            $userName = $this->registerView->getUserName();

            $password = $this->registerView->getPassword();

            $registerProblem = $this->checkNewUser->userInfoSet($userName, $password);

            if (isset($registerProblem)) {
                $this->registerView->setMessage($registerProblem);
                $this->registerView->setUsername($userName);
            }
        }
    }
}