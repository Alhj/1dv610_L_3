<?php

require_once('controller/mainControler.php');

if (!isset($_SESSION)) {
    session_start();
}

$controller = new \controler\mainController();

$controller->render();