<?php 

class logginCheck
{


    public function checkLogginInformation($userName, $password)
    {

        $hash = '$2y$10$Z/DCVZpx9581g5bjn3JeuuaHBuud0Dn4fkPVdGdObOkGNqmNf6z1m';

        if ($userName === "Admin") {

            if (password_verify($password, $hash)) {
                $allCorrect = "welcome";
                $_SESSION["loggin"] = "loggin";
            } else {
                throw new Exception("wrong username or password");
            }
        } else {
            throw new Exception("wrong username or password");
        }
    }
}
