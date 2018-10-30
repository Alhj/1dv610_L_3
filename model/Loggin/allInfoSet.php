<?php 

namespace model;

class checkLogginInfo
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