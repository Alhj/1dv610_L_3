<?php

namespace view;

class SnippsView
{
    private $jsonInfo;

    private $removeSnippView;
    private $addCodeSnippView;
    private $showAllCodeSnipps;

    private $addSnipp = "addsnipp";
    private $viewSnipp = "ShowSnipps";
    private $removeSnipp = "removeSnipp";

    public function __construct()
    {
        $this->removeSnippView = new \view\removeSnippView();
        $this->addCodeSnippView = new \view\addSnippView();
        $this->showAllCodeSnipps = new \view\ShowAllCodeSnipps();
    }

    public function whantToDoWithSnipp()
    {
        $whatToDo = false;

        if (isset($_GET[$this->addSnipp])) {
            $whatToDo = true;
        }
        if (isset($_GET[$this->viewSnipp])) {
            $whatToDo = true;
        }
        if (isset($_GET[$this->removeSnipp])) {
            $whatToDo = true;
        }

        return $whatToDo;
    }

    public function response($userLoggin)
    {
        if (isset($_GET[$this->addSnipp])) {
            return '
            ' . $this->NewSnipps() . '
            ';
        }
        if (isset($_GET[$this->removeSnipp])) {
            return '
            ' . $this->removeSnippView->renderDealte($this->jsonInfo) . '
            ';
        }
        if (isset($_GET[$this->viewSnipp])) {
            return '
            ' . $this->showAllCodeSnipps->render() . '
            ';
        }
    }

    public function setErrorMessageAddSnippView($errorType)
    {
        $this->addCodeSnippView->errorMessage($errorType);
    }

    public function whantToDealte()
    {
        return $this->removeSnippView->doYouWhantToDelate();
    }

    public function getSpot()
    {
        return $this->removeSnippView->GetSpot();
    }

    private function NewSnipps()
    {
       return $this->addCodeSnippView->render();
    }

    private function removeSnippRender()
    {
        $this->removeSnipp->renderDelate($this->jsonInfo);
    }

    public function setJsonInfoForViewAllCodeSnipps($jsonInfomration)
    {
        $this->showAllCodeSnipps->setJsonInfo($jsonInfomration);
    }
    public function setJsonInfoForViewRemoveSnipp($jsonInfomration)
    {
        $this->removeSnippView->setJsonInfo($jsonInfomration);
    }

    public function setMessageForAddCodeSnipp($sendMessage)
    {
        $this->addCodeSnippView->setMessage($sendMessage);
    }
    public function setMessageViewRemoveSnipp($message)
    {
        $this->removeSnippView->setRemoveMessage($message);
    }

    public function whantToAddSnipp()
    {
        return $this->addCodeSnippView->doUserWhantToAddSnipp();
    }
    public function getTitle()
    {
        return $this->addCodeSnippView->getTitleOfCodeSnipp();
    }
    public function getCodeSnipp()
    {
         return $this->addCodeSnippView->getCodeSnipp();
    }

    public function seeSnipps()
    {
        return isset($_GET[$this->viewSnipp]);
    }

    public function toRemove()
    {
        return isset($_GET[$this->removeSnipp]);
    }

    public function setTitle($title)
    {
        $this->addCodeSnippView->setTitle($title);
    }
    public function setCodeSnipp($codeSnipp)
    {
        $this->addCodeSnippView->setCodeSnipp($codeSnipp);
    }
}