<?php 

class logginCheck
{


    public function checkLogginInformation($userName, $password)
    {

        if ($userName === getenv("userName")) {

            if (password_verify($password, getenv("passWord"))) {
                $_SESSION["loggin"] = $userName;
            } else {
                throw new LogginField();
            }
        } else {
            throw new LogginField();
        }
    }
}
