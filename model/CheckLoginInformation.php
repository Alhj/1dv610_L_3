<?php 

class logginCheck {


    public function checkLogginInformation ($userName,$password) {
            $allCorrect = false;

            if($userName === "Admin") {

                if($password === "Password") {
                    $allCorrect = true;
                }
            }
            return $allCorrect;
        }
}
