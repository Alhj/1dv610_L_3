<?php

class logginAndLoggoutModel
{

    private $loggin = "loggin";

    public function setSeasion()
    {

        $_SESSION[$this->loggin] = $this->loggin;
    }

    public function removeSeasion()
    {
        unset($_SESSION[$this->loggin]);
    }

    public function isUserLoggin()
    {
        return isset($_SESSION[$this->loggin]);
    }
}