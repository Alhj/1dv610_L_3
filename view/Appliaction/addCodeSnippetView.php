<?php

namespace view;

class addCodeSnippetView
{
    private Static $Codesnippet = "addSnippetView::snippet";
    private Static $title = "addSnippetView::title";
    private Static $message = "addSnippetView::message";
    private Static $submitSnip = "addSnippetView::submitCodeSnippet";
    private Static $deskriton = "addSnippetView::descriton";
    private static $CodeType = "addSnippetView::CodeType";

    private $UserTitle = "";
    private $CodeSnippet = "";
    private $codeSnippetDeskriton = "";

    private $theMessage = "";

    public function render()
    {
        return $this->generateAddCodeSnippetHTML();
    }

    private function generateAddCodeSnippetHTML()
    {
        return
            '
            <a href="index.php"> go back</a>
            <h2>Add snipp</h2>
            <p>write a title for you codeSnippet and the code for the code snipp here then you can also chose type <br>
            you can also cose the code type  where to code comming from
            </p>
            <h4 id ="' . self::$message . '">' . $this->theMessage . '</h4>
            <form method = "post">
                <fieldset>
                    <label for = "' . self::$title . '">title</label>
                    <input id = "' . self::$title . '" name = "' . self::$title . '" type = "text" value = "' . $this->UserTitle . '">
                    <br>
                    <label for = "' . self::$Codesnippet . '">Code</label>
                    <textarea name = "' . self::$Codesnippet . '" rows="4" cols="40">' . $this->CodeSnippet . '</textarea>
                    <br>
                    <br>
                    <label for = "'.self::$CodeType.'">code type</label>
                    <select name ="'.self::$CodeType.'">
                        <option value = "Other">Other</option>
                        <option value= "JavaScript">javaScript</option>
                        <option value = "C#">C#</option>
                        <option value = "PHP">PHP</option>
                        <option value = "Java">Java</option>
                        <option value = "Python">Python</option>
                    </select>
                    <br>
                    <input name="' . self::$submitSnip . '" type ="submit" value ="submit">
                </fieldset>
            </form>
        ';
    }
    public function errorMessage($errorType)
    {
        switch ($errorType) {
            case $errorType instanceof \codeSnipetMissingInput:
                $this->setMessage("code snipp is missing input");
                break;
            case $errorType instanceof \titleMissingInput:
                $this->setMessage("title is missing input");
                break;

        }
    }
    public function doUserWhantToAddCodeSnippet()
    {
        return isset($_POST[self::$submitSnip]);
    }
    public function getTitleOfCodeSnippet()
    {
        if (isset($_POST[self::$title])) {
            return $_POST[self::$title];
        } else {
            return "";
        }
    }

    public function getCodeSnippet()
    {
        if (isset($_POST[self::$Codesnippet])) {
            return htmlspecialchars($_POST[self::$Codesnippet],  ENT_QUOTES);
        } else {
            return "";
        }
    }

    public function getCodeType()
    {
        $codeType = "";
        if(isset($_POST[self::$CodeType]))
        {
            $codeType = $_POST[self::$CodeType];
        }
        return $codeType;
    }

    public function setMessage($message)
    {
        $this->theMessage = $message;
    }

    public function setTitle($title)
    {
        $this->UserTitle = $title;
    }
    public function setCodeSnippet($codeSnippet)
    {
        $this->CodeSnippet = $codeSnippet;
    }
}