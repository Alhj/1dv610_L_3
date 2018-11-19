<?php

namespace controler;

require_once('./model/application/JsonFile.php');
require_once('./model/application/SeasionInfoModel.php');

class codeSnippetController
{

    private $jsonModel;
    private $snippCheck;
    private $SeasionInfoModel;
    private $logginHandler;

    private $view;

    public function __construct(\view\mainCodeSnippetsView $snippsView)
    {
        $this->jsonModel = new \model\JsonFile();
        $this->SeasionInfoModel = new \model\SesionInfoModel();
        $this->logginHandler = new \model\loggin();

        $this->view = $snippsView;
    }

    public function whatUserWhantsToDo()
    {

        if ($this->logginHandler->isUserLoggin()) {


            $this->view->setMessageForAddCodeSnippet($this->SeasionInfoModel->getMessage());

            $this->view->setMessageViewRemoveCodeSnippet($this->SeasionInfoModel->getMessageRemoveCodeSnipp());

            if ($this->view->whantToAddCodeSnippet()) {
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
            $message = $this->view->UserNotLoggin();
            $this->SeasionInfoModel->setMessageUserNotLoggin($message);

        }
    }
    private function userWhantToAddCodeSnipp()
    {
        try {
            $title = $this->view->getTitle();
            $snippet = $this->view->getCodeSnippet();
            $codeType = $this->view->getCodeType();

            $codeSnipp = new \model\CodeSnipp($title, $snippet, $codeType);

            if ($this->jsonModel->doUserExist($this->logginHandler->getLogginName())) {
                $user = $this->jsonModel->getUser($this->logginHandler->getLogginName());
            } else {
                $user = new \model\User($this->logginHandler->getLogginName());   
            }

            array_push($user->CodeSnipps,$codeSnipp); 

            $this->jsonModel->addCodeSnipps($user);

            $this->SeasionInfoModel->setMessage($this->view->addCodeSnippetMessage());

            $this->view->changeHeaderAfterAddCodeSnipp();

        } catch (\codesnipetMissingInput $e) {

            $this->view->setErrorMessageAddSnippetView($e);

            $title = $this->view->getTitle();

            $this->view->setTitle($title);
        } catch (\titleMissingInput $e) {
            $this->view->setErrorMessageAddCodeSnippetView($e);

            $codeSnipp = $this->view->getCodeSnippet();

            $this->view->setCodeSnippet($codeSnipp);
        }
    }

    private function userWhantToSeeCodeSnipps()
    {
        $jsonInfo = $this->jsonModel->getInfomrationFromJsonFile();
        $this->view->setJsonInfoForViewAllCodeSnipps($jsonInfo);
    }

    private function UserWhantToDealteCodeSnipp()
    {

        $this->jsonModel->removeUserSnipps($this->view->getSpot(), $this->logginHandler->getLogginName());

        $this->SeasionInfoModel->setMessageRemoveCodeSnipp($this->view->removeCodeSnippetMessage());
        $this->view->changeHeaderAfterRemoveCodeSnipp();
    }

    private function userWhantToRemoveCodeSnipp()
    {
        $userName = $this->logginHandler->getLogginName();

        $user = $this->jsonModel->getUser($userName);

        $this->view->setJsonInfoForViewRemoveSnipp($user->CodeSnipps);
    }
}