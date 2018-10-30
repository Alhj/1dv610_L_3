<?php

namespace controler;
require_once('./model/Loggin/CheckLoginInformation.php');
require_once('./model/Loggin/allInfoSet.php');

class logginControler
{

    private $logginCheck;
    private $CheckLogginInfo;
    private $logginHandler;
    private $seasionMessage;

    private $view;

    private $loggin = "loggin";
    private $loggout = "loggout";


    public function __construct(\view\LoginView $view)
    {
        $this->logginCheck = new \model\logginCheck();
        $this->CheckLogginInfo = new \model\checkLogginInfo();
        $this->logginHandler = new \model\logginModel();
        $this->seasionMessage = new \model\SesionInfoModel();

        $this->view = $view;
    }


    public function WhatToDo()
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
            $this->CheckLogginInfo->isInputInfoSet($postUserName, $postPassword);

            $this->logginCheck->checkLogginInformation($postUserName, $postPassword);

            $this->logginHandler->setSeasion();
            if ($this->view->doWeSetCookie()) {
               
                $this->view->logginMessage(true);
               
                $this->view->setcookie();
                
            } else {
                $this->view->logginMessage(false);
            }
        } catch (\userNameMissing $e) {
            $this->fieldSetUsername();

            $this->view->errorMessange('userName');
        } catch (\PasswordMissing $e) {
            $this->fieldSetUsername();

            $this->view->errorMessange('password');
        } catch (\LogginField $e) {
            $this->fieldSetUsername();
            
            $this->view->errorMessange('fildLoggin');
        }
    }

    private function fieldSetUsername()
    {
        $this->v->setUsername($this->v->getUsername());
    }

    private function loggout()
    {
        $this->view->byeMessage();
        $this->view->removeCookies();
        $this->logginHandler->removeSeasion();
    }

    public function isUserLogin()
    {
        return $this->logginHandler->isUserLoggin();
    }
}