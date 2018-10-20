<?php

namespace controler;
require_once('./model/application/JsonFileHandler.php');
require_once('./model/application/CheckSnippInformation.php');
require_once('./model/application/GetSeasionInfoForSnipp.php');

class SnippController
{

    private $jsonModel;
    private $snippCheck;
    private $SeasionInfoModel;

    private $view;

    public function __construct(\view\SnippsView $snippsView)
    {
        $this->jsonModel = new \model\JsonFileHandler();
        $this->snippCheck = new \model\checkSnippInformation();
        $this->SeasionInfoModel = new \model\getSeasionInfoForSnipp();

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

            } catch (snipMissingInput $e) {
                $this->view->errorMessage("snipMissingInput");
            } catch (titleMissingInput $e)
            {
                $this->view->errorMessage("titleMissingInput");
            }
        }

        if ($this->view->seeSnipps()) {
            $jsonInfo = $this->jsonModel->getInfomrationFromJsonFile();
            $this->view->setJsonInfo($jsonInfo);
        }

        if($this->view->toRemove())
        {
            $jsonInfo = $this->jsonModel->getUserSnips();
            $this->view->setJsonInfo($jsonInfo);
        }
        if($this->view->whantToDealte())
        {
          $spot = $this->view->getSpot();

          $this->jsonModel->removeSnipps($spot);

          header("location: index.php?removeSnipp");
        }
    }
}