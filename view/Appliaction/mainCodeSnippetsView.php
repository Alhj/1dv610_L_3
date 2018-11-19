<?php

namespace view;

class mainCodeSnippetsView
{
    private $jsonInfo;

    private $removeCodeSnippetView;
    private $addCodeSnippetView;
    private $showAllCodeSnippets;

    private $addCodeSnippet = "addCodeSnippet";
    private $viewCodeSnippet = "ShowCodeSnippets";
    private $removeCodeSnippet = "removeCodeSnippet";

    public function __construct()
    {
        $this->removeCodeSnippetView = new \view\removeCodeSnippetView();
        $this->addCodeSnippetView = new \view\addCodeSnippetView();
        $this->showAllCodeSnipps = new \view\ShowAllCodeSnippets();
    }

    public function whantToDoWithSnipp()
    {
        $whatUserWhantsToDo = false;

        if (isset($_GET[$this->addCodeSnippet])) {
            $whatUserWhantsToDo = true;
        }
        if (isset($_GET[$this->viewCodeSnippet])) {
            $whatUserWhantsToDo = true;
        }
        if (isset($_GET[$this->removeCodeSnippet])) {
            $whatUserWhantsToDo = true;
        }

        return $whatUserWhantsToDo;
    }

    public function response($userLoggin)
    {
        if (isset($_GET[$this->addCodeSnippet])) {
            return '
            ' . $this->NewSnipps() . '
            ';
        }
        if (isset($_GET[$this->removeCodeSnippet])) {
            return '
            ' . $this->removeCodeSnippetView->renderDealte($this->jsonInfo) . '
            ';
        }
        if (isset($_GET[$this->viewCodeSnippet])) {
            return '
            ' . $this->showAllCodeSnipps->render() . '
            ';
        }
    }
    private function NewSnipps()
    {
        return $this->addCodeSnippetView->render();
    }

    public function setErrorMessageAddCodeSnippetView($errorType)
    {
        $this->addCodeSnippetView->errorMessage($errorType);
    }

    public function whantToDealte()
    {
        return $this->removeCodeSnippetView->doYouWhantToDelate();
    }

    public function getSpot()
    {
        return $this->removeCodeSnippetView->GetSpot();
    }

    public function setJsonInfoForViewAllCodeSnipps($jsonInfomration)
    {
        $this->showAllCodeSnipps->setJsonInfo($jsonInfomration);
    }
    public function setJsonInfoForViewRemoveSnipp($jsonInfomration)
    {
        $this->removeCodeSnippetView->setJsonInfo($jsonInfomration);
    }

    public function setMessageForAddCodeSnippet($sendMessage)
    {
        $this->addCodeSnippetView->setMessage($sendMessage);
    }
    public function setMessageViewRemoveCodeSnippet($message)
    {
        $this->removeCodeSnippetView->setRemoveMessage($message);
    }

    public function whantToAddCodeSnippet()
    {
        return $this->addCodeSnippetView->doUserWhantToAddCodeSnippet();
    }
    public function getTitle()
    {
        return $this->addCodeSnippetView->getTitleOfCodeSnippet();
    }
    public function getCodeSnippet()
    {
        return $this->addCodeSnippetView->getCodeSnippet();
    }
    public function getCodeType()
    {
        return $this->addCodeSnippetView->getCodeType();
    }

    public function seeSnipps()
    {
        return isset($_GET[$this->viewCodeSnippet]);
    }

    public function toRemove()
    {
        return isset($_GET[$this->removeCodeSnippet]);
    }

    public function setTitle($title)
    {
        $this->addCodeSnippetView->setTitle($title);
    }
    public function setCodeSnippet($codeSnipp)
    {
        $this->addCodeSnippetView->setCodeSnippet($codeSnipp);
    }
    public function addCodeSnippetMessage()
    {
        return "code snipp have been add";
    }
    public function removeCodeSnippetMessage()
    {
        return "code snipp have been remove";
    }
    public function UserNotLoggin()
    {
        return "user not loggin";
    }

    public function changeHeaderAfterAddCodeSnipp()
    {
        header('location: index.php?' . $this->addCodeSnippet . '');
    }
    public function changeHeaderAfterRemoveCodeSnipp()
    {
        header('location: index.php?' . $this->removeCodeSnippet . '');
    }
    public function changeHeaderIfUserIsNotLoggin()
    {
        header('location: index.php');
    }
}