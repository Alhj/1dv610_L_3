<?php 

class checNewUserInfo
{

    private $wrongMessage = "";

    public function userInfoSet($userName, $password)
    {
        $this->checkData($userName, $password);
        return $this->wrongMessage;
    }

    private function checkData($userName, $password)
    {


        if (strlen($_POST["RegisterView::UserName"]) >= 3) {
        } else {
            $this->userNameShort();
        }

        if (strlen($_POST["RegisterView::Password"]) >= 6) {
        } else {
            $this->passwordShort();
        }
    }

    private function userNameShort()
    {
        $this->wrongMessage .= 'Username has too few characters, at least 3 characters. <br>';
    }

    private function passwordShort()
    {
        $this->wrongMessage .= 'Password has too few characters, at least 6 characters.';
    }

}