<?php 

namespace model;

class loggin
{

    private $getInfo;

    private static $loggin = "LogginHandler::loggin";

    public function __construct()
    {
        $this->getInfo = new env();
    }


    public function checkLogginInformation($userName, $password)
    {

        if ($userName === $this->getInfo->getUsername()) {

            if (password_verify($password, $this->getInfo->getPassword())) {
                $this->setSeasion($userName);
            } else {
                throw new \LogginField();
            }
        } else {
            throw new \LogginField();
        }
    }

    public function setSeasion($userName)
    {

        $_SESSION[self::$loggin] = $userName;
    }

    public function removeSeasion()
    {
        unset($_SESSION[self::$loggin]);
    }

    public function isUserLoggin()
    {
        return isset($_SESSION[self::$loggin]);
    }

    public function getLogginName()
    {
        $name = "";
        if (isset($_SESSION[self::$loggin])) {
            $name = $_SESSION[self::$loggin] ;
        }
        return $name;
    }
}
