<?php

namespace controler;

class RegisterNewUserControler
{
    private $checkNewUser;

    private $view;

    public function __construct(\view\RegisterView $view)
    {

        $this->checkNewUser = new \model\newUser();

        $this->view = $view;
    }

    public function doUserWhantsToMakeNewUser()
    {
        if ($this->view->haveYouPost()) {
            try {
                $userName = $this->view->getUserName();

                $password = $this->view->getPassword();

                $registerProblem = $this->checkNewUser->userInfoSet($userName, $password);
            } catch (\noInputInRegister $e) {
                $this->view->errorMessage($e);
            } catch (\userNameMissing $e) {
                $this->view->errorMessage($e);
                $this->view->setUserName($this->view->getUserName());
            } catch (\PasswordMissing $e) {
                $this->view->errorMessage($e);
                $this->view->setUserName($this->view->getUserName());
            }
        }
    }
}