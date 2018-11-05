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
        $this->snippCheck = new \model\SnippValidator();
        $this->SeasionInfoModel = new \model\SesionInfoModel();
        $this->logginHandler = new \model\logginModel();

        $this->view = $snippsView;
    }

    public function checkWhatToDo()
    {

        if ($this->logginHandler->isUserLoggin()) {


            $this->view->setMessageForAddCodeSnipp($this->SeasionInfoModel->getMessage());

            $this->view->setMessageViewRemoveSnipp($this->SeasionInfoModel->getMessageRemoveCodeSnipp());

            if ($this->view->whantToAddSnipp()) {
                $this->userWhantToAddCodeSnipp();
            }

            if ($this->view->toRemove()) {
                $this->userWhantToRemoveCodeSnipp();
            }
            if ($this->view->whantToDealte()) {
                $this->UserWhantToDealteCodeSnipp();
            }
            if ($this->view->seeSnipps()) {
                $this->userWhantToSeeCodeSnipps();
            }
        } elseif ($this->view->seeSnipps()) {
            $this->userWhantToSeeCodeSnipps();
        } else {
            $this->SeasionInfoModel->setMessageUserNotLoggin();
            header("location: index.php");
        }
    }
    private function userWhantToAddCodeSnipp()
    {
        try {
            $title = $this->view->getTitle();
            $snipp = $this->view->getCodeSnipp();


            $this->snippCheck->isSnippInformationSet($snipp, $title);

            $codeSnipp = new \model\CodeSnipp($title, $snipp);

            if ($this->jsonModel->doUserExist($this->SeasionInfoModel->getUserName())) {
                $user = $this->jsonModel->getUserSnips($this->SeasionInfoModel->getUserName());
            } else {
                $user = new UserCodeSnipp($this->SeasionInfoModel->getUserName());   
            }

            array_push($user->CodeSnipps,$codeSnipp); 

            $this->jsonModel->addSnipps($user);

            $this->SeasionInfoModel->setMessage($this->view->addCodeSnippMessage());

            header("location: index.php?addsnipp");

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

        $this->jsonModel->removeSnipps($this->view->getSpot(), $this->SeasionInfoModel->getUserName());

        $this->SeasionInfoModel->setMessageRemoveCodeSnipp($this->view->removeCodeSnippMessage());
        header("location: index.php?removeSnipp");
    }

    private function userWhantToRemoveCodeSnipp()
    {
        $userName = $this->SeasionInfoModel->getUserName();

        $UserCodeSnipp = $this->jsonModel->getUserSnips($userName);

        $this->view->setJsonInfoForViewRemoveSnipp($UserCodeSnipp->CodeSnipps);
    }
}