<?php

namespace controler;

use model\CodeSnipp;


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
        $this->snippCheck = new \model\SnippValidator();
        $this->SeasionInfoModel = new \model\SesionInfoModel();
        $this->logginHandler = new \model\logginModel();

        $this->view = $snippsView;
    }

    public function checkWhatToDo()
    {

        if ($this->logginHandler->isUserLoggin()) {


            $this->view->setMessage($this->SeasionInfoModel->getMessage());

            if ($this->view->whantToAddSnipp()) {
                $this->userWhantToAddCodeSnipp();
            }

            if ($this->view->toRemove()) {
                $this->userWhantToRemoveCodeSnipp();
            }
            if ($this->view->whantToDealte()) {
                $this->UserWhantToDealteCodeSnipp();
            }
        } elseif ($this->view->seeSnipps())
        {
            if ($this->view->seeSnipps()) {
                $this->userWhantToSeeCodeSnipps();
            }
        } 
        else {
            $this->SeasionInfoModel->setMessageUserNotLoggin();
            header("location: index.php");
        }
    }
    private function userWhantToAddCodeSnipp()
    {
        try {

            $title = $this->view->getTitle();
            $snipp = $this->view->getCodeSnipp();
            $userName = $this->SeasionInfoModel->getUserName();

            $this->snippCheck->isSnippInformationSet($snipp, $title);

            $codeSnipp = new \model\CodeSnipp($snipp, $title, $userName);
            
            $this->jsonModel->addSnipps($codeSnipp);

            $this->SeasionInfoModel->setMessage("code snipp create");

        } catch (\snipMissingInput $e) {

            $this->view->setErrorMessageAddSnippView("snipMissingInput");

            $title = $this->view->getTitle();

            $this->view->setTitle($title);
        } catch (\titleMissingInput $e) {
            $this->view->setErrorMessageAddSnippView("titleMissingInput");

            $codeSnipp = $this->view->getCodeSnipp();

            $this->view->setCodeSnipp($codeSnipp);
        }
    }

    private function userWhantToSeeCodeSnipps()
    {
        $jsonInfo = $this->jsonModel->getInfomrationFromJsonFile();
        $this->view->setJsonInfoForViewAllCodeSnipps($jsonInfo);
    }
    
    private function UserWhantToDealteCodeSnipp()
    {
        $spot = $this->view->getSpot();
        $userName = $this->SeasionInfoModel->getUserName();

        $this->jsonModel->removeSnipps($spot, $userName);

        $this->SeasionInfoModel->setMessage("snipp remove");
        header("location: index.php?removeSnipp");
    }

    private function userWhantToRemoveCodeSnipp()
    {
        var_dump("hello world");
        $userName = $this->SeasionInfoModel->getUserName();

        $jsonInfo = $this->jsonModel->getUserSnips($userName);

        $this->view->setJsonInfo($jsonInfo);
    }
}