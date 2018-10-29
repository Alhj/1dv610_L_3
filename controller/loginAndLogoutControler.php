<?php

namespace controler;
require_once('./model/Loggin/CheckLoginInformation.php');
require_once('./model/Loggin/allInfoSet.php');

class logginAndLoggoutControler
{

    private $logginCheck;
    private $allInfoSet;
    private $logginHandler;
    private $seasionMessage;

    private $v;

    private $loggin = "loggin";
    private $loggout = "loggout";


    public function __construct(\view\LoginView $view)
    {
        $this->logginCheck = new \model\logginCheck();
        $this->allInfoSet = new \model\allInfoSet();
        $this->logginHandler = new \model\logginHandler();
        $this->seasionMessage = new \model\getSeasionInfoForSnipp();

        $this->v = $view;
    }


    public function WhatToDo()
    {
        $this->v->setMessage($this->seasionMessage->userNotLogginMessage());
        
        $withPost = $this->v->withPost();

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
        $postUserName = $this->v->getUserName();
        $postPassword = $this->v->getPassword();
        try {
            $this->allInfoSet->isInputInfoSet($postUserName, $postPassword);

            $this->logginCheck->checkLogginInformation($postUserName, $postPassword);
            if ($this->v->doWeSetCookie()) {
                $this->v->logginMessage(true);
                $this->v->setcookie();
            } else {
                $this->v->logginMessage(false);
            }
        } catch (\userNameMissing $e) {
            $this->fieldSetUsername();
            $this->v->errorMessange('userName');
        } catch (\PasswordMissing $e) {
            $this->fieldSetUsername();
            $this->v->errorMessange('password');
        } catch (\LogginField $e) {
            $this->fieldSetUsername();
            $this->v->errorMessange('fildLoggin');
        }
    }

    private function fieldSetUsername()
    {
        $this->v->setUsername($this->v->getUsername());
    }

    private function loggout()
    {
        $this->v->setMessage("Bye bye!");
        $this->v->removeCookies();
        $this->logginHandler->removeSeasion();
    }

    public function isUserLogin()
    {
        return $this->logginHandler->isUserLoggin();
    }
}