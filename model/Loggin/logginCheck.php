<?php 

namespace model;

class userInformation
{

   private $getInfo;
   private $loggin = "loggin";

    public function __construct()
    {
        $this->getInfo = new env();
    }


    public function checkLogginInformation($userName, $password)
    {

        if ($userName === $this->getInfo->getUsername()) {

            if (password_verify($password, $this->getInfo->getPassword())) {
                $_SESSION[$this->loggin] = $userName;
            } else {
                throw new \LogginField();
            }
        } else {
            throw new \LogginField();
        }
    }
}
