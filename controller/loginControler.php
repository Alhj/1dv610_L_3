<?php

namespace controler;
require_once('./model/Loggin/LogginInfo.php');

class logginControler
{

    private $CheckLogginInfo;
    private $logginHandler;
    private $seasionMessage;

    private $view;

    private $loggin = "loggin";
    private $loggout = "loggout";


    public function __construct(\view\LoginView $view)
    {
        $this->CheckLogginInfo = new \model\LogginInfo();
        $this->logginHandler = new \model\Loggin();
        $this->seasionMessage = new \model\SesionInfoModel();

        $this->view = $view;
    }


    public function whatUserWhantsToDo()
    {
        $this->view->setMessage($this->seasionMessage->userNotLogginMessage());
        
        $withPost = $this->view->withPost();

        switch ($withPost) {
            case $this->loggin:

                if (!$this->logginHandler->isUserLoggin()) {
                    $this->Loggin(); 
                }
                break;

            case $this->loggout:

                if ($this->logginHandler->isUserLoggin()) {
                    $this->loggout();
                }
                break;
        }
    }

    private function loggin()
    {
        $postUserName = $this->view->getUserName();
        $postPassword = $this->view->getPassword();
        try {
            $this->CheckLogginInfo->isLogginInfoSet($postUserName, $postPassword);

            $this->logginHandler->checkLogginInformation($postUserName, $postPassword);

            $this->logginHandler->setSeasion();
            if ($this->view->doWeSetCookie()) {
               
                $this->view->logginMessage(true);
               
                $this->view->setcookie();
                
            } else {
                $this->view->logginMessage(false);
            }
        } catch (\userNameMissing $e) {
            $this->fieldSetUsername();

            $this->view->errorMessange($e);
        } catch (\PasswordMissing $e) {
            $this->fieldSetUsername();

            $this->view->errorMessange($e);
        } catch (\LogginField $e) {
            $this->fieldSetUsername();
            
            $this->view->errorMessange($e);
        }
    }

    private function fieldSetUsername()
    {
        $this->view->setUsername($this->view->getUsername());
    }

    private function loggout()
    {
        $this->view->byeMessage();
        $this->view->removeCookies();
        $this->logginHandler->removeSeasion();
    }
}