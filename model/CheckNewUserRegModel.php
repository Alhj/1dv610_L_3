<?php 

class checNewUserInfo {

    private $wrongMessage = "";

    public function userInfoSet () {
        $this->checkData();
        return $this->wrongMessage;
}

    private function checkData() {

        if(isset($_POST["RegisterView::UserName"])) {
            if(strlen($_POST["RegisterView::UserName"]) >= 3) {
            } else {
                $this->userNameShort();
            }
        } else {
            $this->userNameShort();
        }
        if(isset($_POST["RegisterView::Password"])){
            if(strlen($_POST["RegisterView::Password"]) >= 6){
            } else {
                $this->passwordShort();
            }
        } else {
            $this->passwordShort();
        }
        if(isset($_POST["RegisterView::PasswordRepeat"])) {
        }
    }

    private function userNameShort () {
        $this->wrongMessage .= 'Username has too few characters, at least 3 characters. <br>';
    }

    private function passwordShort () {
        $this->wrongMessage .= 'Password has too few characters, at least 6 characters';
    }

}