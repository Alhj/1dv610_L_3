<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER

require_once('controller/controler.php');
require_once('env.php');

if (!isset($_SESSION)) {
    session_start();
}

$envInfo = new env();
$controller = new Controller();

$envInfo->setEnvData();
$controller->render();