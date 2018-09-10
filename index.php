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


$userName = $_POST['LoginView::UserName'];
$passWord = $_POST['LoginView::Password'];
$loggin = $_POST['LoginView::KeepMeLoggedIn'];

echo "$userName <br>";
echo "$passWord";
echo "$loggin";