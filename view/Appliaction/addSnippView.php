<?php

namespace view;

class addSnippView
{
    private Static $Codesnipp = "addSnippView::snipp";
    private Static $title = "addSnippView::title";
    private Static $message = "addSnippView::message";
    private Static $submitSnip = "addSnippView::submitSnip";

    private $UserTitle = "";
    private $CodeSnipp = "";

    private $theMessage = "";

    public function render()
    {
        return $this->addSnippView();
    }

    private function addSnippView()
    {
        return
            '
            <a href="index.php"> go back</a>
            <h2>Add snipp</h2>
            <h4 id ="' . self::$message . '">' . $this->theMessage . '</h4>
            <form method = "post">
                <fieldset>
                    <label for = "' . self::$title . '">title</label>
                    <input id = "' . self::$title . '" name = "' . self::$title . '" type = "text" value = "' . $this->UserTitle . '">
                    <br>
                    <label for = "' . self::$Codesnipp . '">Code snipp</label>
                    <textarea name = "' . self::$Codesnipp . '" rows="4" cols="40">' . $this->CodeSnipp . '</textarea>
                    <br>
                    <br>
                    <switch>
                    </switch>
                    <br>
                    <input name="' . self::$submitSnip . '" type ="submit" value ="submit">
                </fieldset>
            </form>
        ';
    }
    public function errorMessage($errorType)
    {
        switch ($errorType) {
            case "snipMissingInput":
                $this->setMessage("code snipp is missing input");
                break;
            case "titleMissingInput":
                $this->setMessage("title is missing input");
                break;

        }
    }
    public function doUserWhantToAddSnipp()
    {
        return isset($_POST[self::$submitSnip]);
    }
    public function getTitleOfCodeSnipp()
    {
        if (isset($_POST[self::$title])) {
            return $_POST[self::$title];
        } else {
            return "";
        }
    }

    public function getCodeSnipp()
    {
        if (isset($_POST[self::$Codesnipp])) {
            return htmlspecialchars($_POST[self::$Codesnipp]);
        } else {
            return "";
        }
    }

    public function setMessage($message)
    {
        $this->theMessage = $message;
    }

    public function setTitle($title)
    {
        $this->UserTitle = $title;
    }
    public function setCodeSnipp($codeSnipp)
    {
        $this->CodeSnipp = $codeSnipp;
    }
}