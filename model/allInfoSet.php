<?php 

class allInfoSet
{


    public function isLogginInfoSet($UserName, $Password)
    {

        if (!$this->isItEmpty($UserName)) {
            if (!$this->isItEmpty($Password)) {
                return true;
            } else {
                throw new Exception("Password is missing");
            }
        } else {
            throw new exception("Username is missing");
        }
    }

    private function isItEmpty($input)
    {
        return empty($input);
    }
}