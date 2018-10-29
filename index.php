<?php

require_once('controller/controler.php');

if (!isset($_SESSION)) {
    session_start();
}

$controller = new \controler\Controller();

$controller->render();