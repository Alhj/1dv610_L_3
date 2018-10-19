<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER

require_once('controller/controler.php');

if (!isset($_SESSION)) {
    session_start();
}

$controller = new Controller();

$controller->render();