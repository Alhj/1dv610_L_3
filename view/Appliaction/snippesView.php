<?php

class SnippsView
{
    private $jsonInfo;

    private $removeSnippView;

    private $snipp = "snipp";
    private $title = "title";
    private $message = "message";
    private $submitSnip = "submitSnip";


    private $addSnipp = "addsnipp";
    private $viewSnipp = "ShowSnipps";
    private $removeSnipp = "removeSnipp";

    private $theMessage;

    public function __construct()
    {
        $this->removeSnippView = new \view\removeSnippView();
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

    public function setJsonInfo($jsonInfomration)
    {
        $this->jsonInfo = $jsonInfomration;
    }

    public function setMessage($sendMessage)
    {
        $this->theMessage = $sendMessage;
    }

    public function whantToAddSnipp()
    {
        return isset($_POST[$this->submitSnip]);
    }

    public function seeSnipps()
    {
        return isset($_GET[$this->viewSnipp]);
    }

    public function toRemove()
    {
        return isset($_GET[$this->removeSnipp]);
    }

    public function getTitle()
    {
        if (isset($_POST[$this->title])) {
            return $_POST[$this->title];
        } else {
            return "";
        }
    }

    public function getSnipp()
    {
        if (isset($_POST[$this->snipp])) {
            return htmlspecialchars($_POST[$this->snipp]);
        } else {
            return "";
        }
    }

    public function getMessageFromURl()
    {
        if (isset($_GET[$this->message])) {
            return $_GET[$this->message];
        } else {
            return "";
        }
    }

    public function whantToDealte()
    {
        return $this->removeSnippView->doYouWhantToDelate();
    }

    public function getSpot()
    {
        return $this->removeSnippView->GetSpot();
    }

    public function response()
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
            ' . $this->allSnips() . '
            ';
        }
    }

    private function NewSnipps()
    {
        return
            '
            ' . $this->goBackLink() . '
            <h4 id ="' . $this->message . '">' . $this->theMessage . '</h4>
            <form method = "post">
                <fieldset>
                    <label for = "' . $this->title . '">title</label>
                    <input id = "' . $this->title . '" name = "' . $this->title . '" type = "text">
                    <br>
                    <label for = "' . $this->snipp . '"> snipp</label>
                    <textarea name = "' . $this->snipp . '" rows="4" cols="40"></textarea>
                    <br>
                    <br>
                    <switch>
                    </switch>
                    <br>
                    <input name="' . $this->submitSnip . '" type ="submit" value ="submit">
                </fieldset>
            </form>
        ';
    }

    private function allSnips()
    {
        $string = '
        ' . $this->goBackLink() . '
        ';
        foreach ($this->jsonInfo as $snipp) {
            $string .= '
            <br>
            <br>
                <fieldset>
                    <h2> title: ' . $snipp->{"title"} . '</h2>
                    <h4> author: ' . $snipp->{"Createname"} . '</h4>
                    <p>
                    ' . 'snipp: ' . $snipp->{"snipp"} . '
                    </p>
                </fieldset>';
        }
        return $string;
    }

    private function goBackLink()
    {
        return '<a href = "index.php"> go back</a>';
    }
    private function removeSnippRender()
    {
        $this->removeSnipp->renderDelate($this->jsonInfo);
    }
}