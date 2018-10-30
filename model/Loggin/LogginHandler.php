<?php

namespace model;

class logginModel
{

    private static $loggin = "LogginHandler::loggin";

    public function setSeasion()
    {

        $_SESSION[self::$loggin] = self::$loggin;
    }

    public function removeSeasion()
    {
        unset($_SESSION[self::$loggin]);
    }

    public function isUserLoggin()
    {
        return isset($_SESSION[self::$loggin]);
    }
}