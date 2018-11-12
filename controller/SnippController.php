<?php

namespace controler;

require_once('./model/application/JsonFile.php');
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
        $this->jsonModel = new \model\JsonFile();
        $this->SeasionInfoModel = new \model\SesionInfoModel();
        $this->logginHandler = new \model\loggin();

        $this->view = $snippsView;
    }

    public function whatUserWhantsToDo()
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
            $codeType = $this->view->getCodeType();

            $codeSnipp = new \model\CodeSnipp($title, $snipp, $codeType);

            if ($this->jsonModel->doUserExist($this->SeasionInfoModel->getUserName())) {
                $user = $this->jsonModel->getUser($this->SeasionInfoModel->getUserName());
            } else {
                $user = new \model\User($this->SeasionInfoModel->getUserName());   
            }

            array_push($user->CodeSnipps,$codeSnipp); 

            $this->jsonModel->addCodeSnipps($user);

            $this->SeasionInfoModel->setMessage($this->view->addCodeSnippMessage());

            $this->view->changeHeaderAfterAddCodeSnipp();

        } catch (\snipMissingInput $e) {

            $this->view->setErrorMessageAddSnippView($e);

            $title = $this->view->getTitle();

            $this->view->setTitle($title);
        } catch (\titleMissingInput $e) {
            $this->view->setErrorMessageAddSnippView($e);

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

        $this->jsonModel->removeUserSnipps($this->view->getSpot(), $this->SeasionInfoModel->getUserName());

        $this->SeasionInfoModel->setMessageRemoveCodeSnipp($this->view->removeCodeSnippMessage());
        $this->view->changeHeaderAfterRemoveCodeSnipp();
    }

    private function userWhantToRemoveCodeSnipp()
    {
        $userName = $this->SeasionInfoModel->getUserName();

        $user = $this->jsonModel->getUser($userName);

        $this->view->setJsonInfoForViewRemoveSnipp($user->CodeSnipps);
    }
}