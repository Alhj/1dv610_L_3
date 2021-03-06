<?php

namespace view;

class removeCodeSnippetView
{

    private $removeSpot = "removeSnippView::removeSpot";
    private $dealteCodeSnipet = "removeSnippView::dealteSnipt";
    private $message = "removeSnippView::message";
    
    private $theMessage = ""; 
    
    private $jsonInfo;

    public function renderDealte($jsonInfo)
    {
        return '
        <a href="index.php"> go back</a>
            '. $this->genereateUserCodeSnipetstHTML() .'
        ';
    }

    private function genereateUserCodeSnipetstHTML()
    {
        $spot = 0;
        $string = '
        <h2>Remove snipp</h2>
        <h4 id ="' . $this->message . '">' . $this->theMessage . '</h4>
        ';
        foreach($this->jsonInfo as $snippet)
        {
            $string .= '
                <form method = "post">
                    <h2> title: ' . $snippet->title . '</h2>
                    <p>
                    ' . 'snipp: ' . $snippet->CodeSnippet . '
                    </p>
                    <input name="'. $this->removeSpot . '" type="hidden" value="'. $spot .'">

                    <input name="'. $this->dealteCodeSnipet . '" type="submit" value="dealte">
                </form>
                <br>
            ';
            $spot += 1;
        }
        return $string;
    }
    public function doYouWhantToDelate()
    {
        return isset($_POST[$this->dealteCodeSnipet]);
    }

    public function GetSpot()
    {
        if(isset($_POST[$this->removeSpot]))
        {
            return $_POST[$this->removeSpot];
        } else {
            return "";
        }
    }
    public function setRemoveMessage($message)
    {
        $this->theMessage = $message;
    }
    public function setJsonInfo($jsonInfo)
    {
        $this->jsonInfo = $jsonInfo;
    }
}