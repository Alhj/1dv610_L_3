<?php

class loggInAndOut {

    private $loggin = "loggin";

    private $loggout = "loggout";

    public function setSeasion(){

        $_SESSION[$loggin] = $loggin;
    }

    public function removeSeasion (){
        unset($_SESSION[$loggin]);
    }
}