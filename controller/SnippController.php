<?php

require_once('./model/readJSonFile.php');

class SnippController
{

    private $jsonModel;

    public function __construct()
    {
        $this->jsonModel = new ReadJsonFile();
    }

    public function checkWhatToDo()
    {
       $this->jsonModel->addSnipps('admin', 'något');
    }
}