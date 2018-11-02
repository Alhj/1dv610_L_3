<?php

namespace view;

class SnippsView
{
    private $jsonInfo;

    private $removeSnippView;
    private $addSnippView;
    private $showAllCodeSnipps;

    private $addSnipp = "addsnipp";
    private $viewSnipp = "ShowSnipps";
    private $removeSnipp = "removeSnipp";

    private $theMessage;
    private $UserTitle = "";
    private $UserCodeSnipp = "";

    public function __construct()
    {
        $this->removeSnippView = new \view\removeSnippView();
        $this->addSnippView = new \view\addSnippView();
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
        $this->addSnippView->errorMessage($errorType);
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
       return $this->addSnippView->render();
    }

    private function removeSnippRender()
    {
        $this->removeSnipp->renderDelate($this->jsonInfo);
    }

    public function setJsonInfoForViewAllCodeSnipps($jsonInfomration)
    {
        $this->showAllCodeSnipps->setJsonInfo($jsonInfomration);
    }

    public function setMessage($sendMessage)
    {
        $this->theMessage = $sendMessage;
    }

    public function whantToAddSnipp()
    {
        return $this->addSnippView->doUserWhantToAddSnipp();
    }
    public function getTitle()
    {
        return $this->addSnippView->getTitleOfCodeSnipp();
    }
    public function getCodeSnipp()
    {
         return $this->addSnippView->getCodeSnipp();
    }

    public function seeSnipps()
    {
        return isset($_GET[$this->viewSnipp]);
    }

    public function toRemove()
    {
        return isset($_GET[$this->removeSnipp]);
    }

    public function getAddSnippCodeSnippTitle()
    {
        return $this->addSnippView->doUserWhantToAddSnipp();
    }

    public function setTitle($title)
    {
        $this->addSnippView->setTitle($title);
    }
    public function setCodeSnipp($codeSnipp)
    {
        $this->addSnippView->setCodeSnipp($codeSnipp);
    }
}