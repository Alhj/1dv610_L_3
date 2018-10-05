<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER

require_once('controller/controler.php');


$controller = new Controller();

$controller->setNewClasses();
 $controller->render();