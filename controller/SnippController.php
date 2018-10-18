<?php

require_once('./model/application/readJSonFile.php');
require_once('./model/allInfoSet.php');
require_once('./model/application/CheckSnippInformation.php');

class SnippController
{

    private $jsonModel;
    private $snippCheck;

    private $view;

    public function __construct(SnippsView $view)
    {
        $this->jsonModel = new ReadJsonFile();
        $this->snippCheck = new checkSnippInformation();

        $this->view = $view;
    }

    public function checkWhatToDo()
    {
        if ($this->view->whantToAddSnipp()) {
            try {
                $title = $this->view->getTitle();
                $snipp = $this->view->getSnipp();
                var_dump($snipp);
                $this->snippCheck->isSnippInfoSet($snipp, $title);

                $this->jsonModel->addSnipps($snipp, $title);
            } catch (Exception $e) {
                $this->view->setMessage($e->getMessage());
            }

        }

        if ($this->view->seeSnipps()) {
            $jsonInfo = $this->jsonModel->getInfomrationFromJsonFile();
            $this->view->setJsonInfo($jsonInfo);
        }
    }
}