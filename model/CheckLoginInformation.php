<?php 

class logginCheck
{


    public function checkLogginInformation($userName, $password)
    {

        $hash = '$2y$10$Z/DCVZpx9581g5bjn3JeuuaHBuud0Dn4fkPVdGdObOkGNqmNf6z1m';

        if ($userName === "Admin") {

            if (password_verify($password, $hash)) {
                $_SESSION["loggin"] = "loggin";
            } else {
                throw new Exception("Wrong name or password");
            }
        } else {
            throw new Exception("Wrong name or password");
        }
    }
}
