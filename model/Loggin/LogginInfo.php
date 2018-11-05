<?php 

namespace model;

class LogginInfo
{


    public function isLogginInfoSet($UserName, $Password)
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