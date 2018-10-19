<?php 

class logginCheck
{


    public function checkLogginInformation($userName, $password)
    {

        $hash = '$2y$10$Z/DCVZpx9581g5bjn3JeuuaHBuud0Dn4fkPVdGdObOkGNqmNf6z1m';

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
