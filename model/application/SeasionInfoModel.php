<?php

namespace model;

class SesionInfoModel
{
    private $message = "message";
    private $userNotLoggin = "userNotLoggin";
    private $removeCodeSnipp = "removeCodeSnipp";

    public function setMessage($message)
    {
        $_SESSION[$this->message] = $message;
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

    public function setMessageRemoveCodeSnipp($message)
    {
        $_SESSION[$this->removeCodeSnipp] = $message;
    }
    public function getMessageRemoveCodeSnipp()
    {
        $message = "";
        if (isset($_SESSION[$this->removeCodeSnipp])) {
            
            $message = $_SESSION[$this->removeCodeSnipp];

            $this->removeMessage($this->removeCodeSnipp);
            
        }
        return $message;
    }

    public function setMessageUserNotLoggin($theMessage)
    {
        $_SESSION[$this->userNotLoggin] = $theMessage;
    }
    public function getMessage()
    {
        if (isset($_SESSION[$this->message])) {
            $theMessage = $_SESSION[$this->message];

            $this->removeMessage($this->message);

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