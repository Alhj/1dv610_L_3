<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();


$lv->render(false, $v, $dtv);

getLogginInformation();

function getLogginInformation () {

$doUsernameAndPasswordHaveInput = checkUserInfo();

    if($doUsernameAndPasswordHaveInput === true) {
        echo "loggin";
    }

}

function checkUserInfo () {
    if(isset($_POST['LoginView::UserName'])) {
         if(isset($_POST['LoginView::Password'])){
             return true;
         } else {
             return false;
         }
     } else {
         return false;
     }
}