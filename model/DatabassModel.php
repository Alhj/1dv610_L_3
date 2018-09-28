<?php

class DataBass {

    private $host = "localhost";

    private $username = "root";
    
    private $password = "";
    
    private $dbName = "users";

    function checkIfUserExist($userName, $password) {
        /*
        $correctInformation = false;

        $dataBass = mysqli_connect($this->host,$this->username,$this->password, $this->dbName);
        
        $getFrom = "SELECT userName, Password FROM user";
    
        $date = mysqli_query($dataBass, $getFrom);
    
        if(!$date){
            echo "hello world";
            exit;
        }
        if ($date->num_rows > 0) {
            while($row = $date->fetch_assoc()){
                
                if($row["userName"] === $userName) {
                    
                    if($row["Password"] === $password) {  
                        $correctInformation = true;
                        break;
                    }
                }
            }
        }
        return $correctInformation;
    }
}