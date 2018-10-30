<?php

namespace controler;

require_once('./model/application/JsonFileHandler.php');
require_once('./model/application/CheckSnippInformation.php');
require_once('./model/application/SeasionInfoModel.php');

class SnippHandlerController
{

    private $jsonModel;
    private $snippCheck;
    private $SeasionInfoModel;
    private $logginHandler;

    private $view;

    public function __construct(\view\SnippsView $snippsView)
    {
        $this->jsonModel = new \model\JsonFileHandler();
        $this->snippCheck = new \model\checkSnippInformation();
        $this->SeasionInfoModel = new \model\SesionInfoModel();
        $this->logginHandler = new \model\logginModel();

        $this->view = $snippsView;
    }

    public function checkWhatToDo()
    {
        if ($this->logginHandler->isUserLoggin()) {


            $this->view->setMessage($this->SeasionInfoModel->getMessage());

            if ($this->view->whantToAddSnipp()) {
                try {

                    $title = $this->view->getTitle();
                    $snipp = $this->view->getSnipp();
                    $userName = $this->SeasionInfoModel->getUserName();

                    $this->snippCheck->isSnippInfoSet($snipp, $title);

                    $this->jsonModel->addSnipps($title, $snipp, $userName);

                    $this->SeasionInfoModel->setMessage("code snipp create");
                    header("location: index.php?addsnipp");

                } catch (\snipMissingInput $e) {
                    
                    $this->view->errorMessage("snipMissingInput");

                    $title = $this->view->getTitle();

                    $this->view->setTitle($title);
                } catch (\titleMissingInput $e) {
                    $this->view->errorMessage("titleMissingInput");

                    $codeSnipp = $this->view->getSnipp();

                    $this->view->setCodeSnipp($codeSnipp);
                }
            }

            if ($this->view->seeSnipps()) {
                $userName = $this->SeasionInfoModel->getUserName();

                $jsonInfo = $this->jsonModel->getInfomrationFromJsonFile($userName);

                $this->view->setJsonInfo($jsonInfo);
            }

            if ($this->view->toRemove()) {
                $userName = $this->SeasionInfoModel->getUserName();

                $jsonInfo = $this->jsonModel->getUserSnips($userName);

                $this->view->setJsonInfo($jsonInfo);
            }
            if ($this->view->whantToDealte()) {
                $spot = $this->view->getSpot();
                $userName = $this->SeasionInfoModel->getUserName();

                $this->jsonModel->removeSnipps($spot, $userName);

                $this->SeasionInfoModel->setMessage("snipp remove");
                header("location: index.php?removeSnipp");
            }
        } else {
            $this->SeasionInfoModel->setMessageUserNotLoggin();
            header("location: index.php");
        }
    }
}