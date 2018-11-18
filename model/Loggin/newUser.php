<?php 

namespace model;

class newUser
{

    public function userInfoSet($userName, $password)
    {
        $this->checkData($userName, $password);
        return $this->wrongMessage;
    }

    private function checkData($userName, $password)
    {
        if (strlen($userName) < 3 and strlen($password) < 6)
        {
            throw new \noInputInRegister();
        }

        if (strlen($userName) < 3) {
            throw new \userNameMissing();
        } 

        if (strlen($password) < 6) {
            throw new \PasswordMissing();
        }
    }

}