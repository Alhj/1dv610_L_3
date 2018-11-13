<?php

namespace view;

class removeCodeSnippView
{

    private $removeSpot = "removeSnippView::removeSpot";
    private $dealteSnip = "removeSnippView::dealteSnipt";
    private $message = "removeSnippView::message";
    
    private $theMessage = ""; 
    
    private $jsonInfo;

    public function renderDealte($jsonInfo)
    {
        return '
        <a href="index.php"> go back</a>
            '. $this->userSnips() .'
        ';
    }

    private function userSnips()
    {
        $spot = 0;
        $string = '
        <h2>Remove snipp</h2>
        <h4 id ="' . $this->message . '">' . $this->theMessage . '</h4>
        ';
        foreach($this->jsonInfo as $snipp)
        {
            $string .= '
                <form method = "post">
                    <h2> title: ' . $snipp->title . '</h2>
                    <p>
                    ' . 'snipp: ' . $snipp->CodeSnipp . '
                    </p>
                    <input name="'. $this->removeSpot . '" type="hidden" value="'. $spot .'">

                    <input name="'. $this->dealteSnip . '" type="submit" value="dealte">
                </form>
                <br>
            ';
            $spot += 1;
        }
        return $string;
    }
    public function doYouWhantToDelate()
    {
        return isset($_POST[$this->dealteSnip]);
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