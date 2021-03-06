<?php

namespace controler;

require_once('./view/Loggin/LoginView.php');
require_once('./view/Layout/DateTimeView.php');
require_once('./view/Layout/LayoutView.php');
require_once('./view/Loggin/RegisterView.php');
require_once('./view/Appliaction/mainCodeSnippetsView.php');
require_once('./view/Appliaction/RemoveCodeSnippetView.php');
require_once('./view/Appliaction/addCodeSnippetView.php');
require_once('./view/Appliaction/ShowAllCodeSnippets.php');


require_once('./model/Loggin/newUser.php');
require_once('./model/Loggin/Loggin.php');
require_once('./model/customException.php');
require_once('./model/application/codeSnippet/CodeSnippet.php');
require_once('./model/application/codeSnippet/User.php');
require_once('env.php');



require_once('./controller/loginControler.php');
require_once('./controller/codeSnippetController.php');
require_once('./controller/RegisterNewUserControler.php');

class mainController
{

    private $logginView;
    private $dateTimeView;
    private $layoutView;
    private $registerView;
    private $snippsView;

    private $logginAndOutCheck;

    private $LogginController;
    private $codeSnippetController;
    private $RegisterNewUserControler;

    public function __construct()
    {
        $this->logginView = new \view\LoginView();
        $this->dateTimeView = new \view\DateTimeView();
        $this->layoutView = new \view\LayoutView();
        $this->snippsView = new \view\mainCodeSnippetsView();
        $this->registerView = new \view\RegisterView();

        $this->LogginController = new \controler\logginControler($this->logginView);
        $this->SnippHandlerController = new \controler\codeSnippetController($this->snippsView);
        $this->RegisterNewUserControler = new \controler\RegisterNewUserControler($this->registerView);
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

        $this->RegisterNewUserControler->doUserWhantsToMakeNewUser();
    }
}