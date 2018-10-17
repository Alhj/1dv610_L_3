<?php

require_once('./model/readJSonFile.php');

class SnippController
{

    private $jsonModel;
    private $view;

    public function __construct(SnippsView $view)
    {
        $this->jsonModel = new ReadJsonFile();
        $this->view = $view;
    }

    public function checkWhatToDo()
    {
        if ($this->view->whantToAddSnipp()) {
            $this->jsonModel->addSnipps('admin', 'något');
        }
        if ($this->view->seeSnipps()) {
            $jsonInfo = $this->jsonModel-> getInfomrationFromJsonFile();
            $this->view->setJsonInfo($jsonInfo);
        }
    }
}