<?php

require_once('./model/application/JsonFileHandler.php');
require_once('./model/allInfoSet.php');
require_once('./model/application/CheckSnippInformation.php');
require_once('./model/application/GetSeasionInfoForSnipp.php');

class SnippController
{

    private $jsonModel;
    private $snippCheck;
    private $SeasionInfoModel;

    private $view;

    public function __construct(SnippsView $snippsView)
    {
        $this->jsonModel = new JsonFileHandler();
        $this->snippCheck = new checkSnippInformation();
        $this->SeasionInfoModel = new getSeasionInfoForSnipp();

        $this->view = $snippsView;
    }

    public function checkWhatToDo()
    {
        $this->view->setMessage($this->SeasionInfoModel->getMessage());
        if ($this->view->whantToAddSnipp()) {
            try {
                
                $title = $this->view->getTitle();
                $snipp = $this->view->getSnipp();

                $this->snippCheck->isSnippInfoSet($snipp, $title);

                $this->jsonModel->addSnipps($title, $snipp);
                
                $this->SeasionInfoModel->setMessage();
                header("location: index.php?addsnipp");

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