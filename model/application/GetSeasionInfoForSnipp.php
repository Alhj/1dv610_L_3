<?php

class getSeasionInfoForSnipp
{
    private $getUserName = "loggin";
    private $message = "message";

    public function setMessage()
    {
        $_SESSION[$this->message] = "code snipp create";
    }

    public function getUserName()
    {
        if (isset($_SESSION[$this->getUserName])) {
            return $_SESSION[$this->getUserName];
        } else {
            return "";
        }
    }
    public function getMessage()
    {
        if (isset($_SESSION[$this->message])) {
            $theMessage = $_SESSION[$this->message];
            
            $this->removeMessage();
            
            return $theMessage;
        } else {
            return "";
        }
    }

    private function removeMessage()
    {
        unset($_SESSION[$this->message]);
    }
}