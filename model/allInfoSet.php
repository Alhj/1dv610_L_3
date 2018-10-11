<?php 

class allInfoSet
{


    public function isLogginInfoSet($UserName, $Password)
    {

        if (!$this->isItEmpty($UserName)) {
            if (!$this->isItEmpty($Password)) {
                return true;
            } else {
                throw new Exception("password is missing");
            }
        } else {
            throw new exception("username is missing");
        }
    }

    private function isItEmpty($input)
    {
        return empty($input);
    }
}