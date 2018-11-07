<?php

namespace controler;

require_once('./view/Loggin/LoginView.php');
require_once('./view/Layout/DateTimeView.php');
require_once('./view/Layout/LayoutView.php');
require_once('./view/Loggin/RegisterView.php');
require_once('./view/Appliaction/snippesView.php');
require_once('./view/Appliaction/RemoveSnippView.php');
require_once('./view/Appliaction/addSnippView.php');
require_once('./view/Appliaction/ShowAllCodeSnipps.php');


require_once('./model/Loggin/newUser.php');
require_once('./model/Loggin/Loggin.php');
require_once('./model/customException.php');
require_once('./model/application/CodeSnipp.php');
require_once('./model/application/codeSnipp/User.php');
require_once('env.php');



require_once('./controller/loginControler.php');
require_once('./controller/SnippController.php');

class mainController
{

    private $logginView;
    private $dateTimeView;
    private $layoutView;
    private $registerView;
    private $snippsView;

    private $checkNewUser;
    private $logginAndOutCheck;

    private $LogginController;
    private $SnippHandlerController;

    public function __construct()
    {
        $this->logginView = new \view\LoginView();
        $this->dateTimeView = new \view\DateTimeView();
        $this->layoutView = new \view\LayoutView();
        $this->registerView = new \view\RegisterView();
        $this->snippsView = new \view\SnippsView();

        $this->checkNewUser = new \model\newUser();

        $this->LogginController = new \controler\logginControler($this->logginView);
        $this->SnippHandlerController = new \controler\SnippHandlerController($this->snippsView);
    }

    public function render()
    {
        $this->whatUserWhantsToDo();

        if ($this->layoutView->RegisterViewOrNot()) {
            $this->layoutView->render($this->registerView, $this->dateTimeView);
        } elseif ($this->snippsView->whantToDoWithSnipp()) {
            
            $this->SnippHandlerController->whatUserWhantsToDo();

            $this->layoutView->render($this->snippsView, $this->dateTimeView);
        } else {
            $this->layoutView->render($this->logginView, $this->dateTimeView);
        }
    }


    private function whatUserWhantsToDo()
    {
        $this->LogginController->whatUserWhantsToDo();

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