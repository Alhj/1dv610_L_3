<?php

require_once('./model/CheckLoginInformation.php');
require_once('./model/allInfoSet.php');
require_once('./model/logginAndLoggoutModel.php');

class logginAndLoggoutControler
{

    private $logginCheck;
    private $allInfoSet;
    private $logginAndOutCheck;
    private $v;


    public function __construct($view)
    {
        $this->logginCheck = new logginCheck();
        $this->allInfoSet = new allInfoSet();
        $this->logginAndOutCheck = new logginAndLoggoutModel();
        $this->v = $view;
    }


    public function WhatToDo()
    {
        $withPost = $this->v->withPost();

        switch ($withPost) {
            case "loggin":

                if ($this->logginAndOutCheck->isUserLoggin()) {

                } else {
                    $this->Loggin();
                }
                break;

            case "loggout":
                if ($this->logginAndOutCheck->isUserLoggin()) {
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
                $this->v->setMessage('Welcome and you will be remembered');
                $this->v->setcookie();
            } else {
                $this->v->setMessage('Welcome');
            }
        } catch (Exception $e) {
            $this->v->setUsername($this->v->getUserName());
            $this->v->setMessage($e->getMessage());
        }
    }

    private function loggout()
    {
        $this->v->setMessage("Bye bye!");
        $this->v->removeCookies();
        $this->logginAndOutCheck->removeSeasion();
    }

    public function isUserLogin()
    {
        return $this->logginAndOutCheck->isUserLoggin();
    }
}