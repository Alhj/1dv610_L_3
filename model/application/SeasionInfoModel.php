<?php

namespace model;

class SesionInfoModel
{
    private $getUserName = "loggin";
    private $message = "message";
    private $userNotLoggin = "userNotLoggin";

    public function setMessage($message)
    {
        $_SESSION[$this->message] = $message;
    }

    public function getUserName()
    {
        if (isset($_SESSION[$this->getUserName])) {
            return $_SESSION[$this->getUserName];
        } else {
            return "";
        }
    }
    public function userNotLogginMessage()
    {
        if (isset($_SESSION[$this->userNotLoggin])) {
            $notLogginMessage = $_SESSION[$this->userNotLoggin];

            $this->removeMessage($this->userNotLoggin);

            return $notLogginMessage;
        } else {
            return "";
        }
    }

    public function setMessageUserNotLoggin()
    {
        $_SESSION[$this->userNotLoggin] = "user not loggin" ;
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

    private function removeMessage($withMessageToUnset)
    {
        unset($_SESSION[$withMessageToUnset]);
    }
}