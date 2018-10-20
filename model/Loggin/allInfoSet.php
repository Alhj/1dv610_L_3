<?php 

namespace model;

class allInfoSet
{


    public function isInputInfoSet($UserName, $Password)
    {
        if (!$this->isItEmpty($UserName)) {
            if (!$this->isItEmpty($Password)) {
                return true;
            } else {
                throw new \PasswordMissing();
            }
        } else {
            throw new \userNameMissing();
        }
    }

    private function isItEmpty($input)
    {
        return empty($input);
    }
}