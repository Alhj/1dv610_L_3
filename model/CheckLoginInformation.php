<?php 

class logginCheck {


    public function checkLogginInformation ($userName,$password) {
            $allCorrect = false;

            if($userName === "") {

                if($password === "") {
                    $allCorrect = true;
                }
            }
            return $allCorrect;
        }
}
