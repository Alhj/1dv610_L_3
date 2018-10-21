<?php

namespace view;

class removeSnippView
{

    private $removeSpot = "removeSpot";
    private $dealteSnip = "dealteSnipt";
    private $message = "message";
    
    private $theMessage = ""; 

    public function renderDealte($jsonInfo)
    {
        return '
        <a href="index.php"> go back</a>
            '. $this->userSnips($jsonInfo) .'
        ';
    }

    private function userSnips($jsonInfo)
    {
        $spot = 0;
        $string = '
        <h2>Remove snipp</h2>
        <h4 id ="' . $this->message . '">' . $this->theMessage . '</h4>
        ';
        foreach($jsonInfo as $snipp)
        {
            $string .= '
                <br>
                <form method = "post">
                    <h2> title: ' . $snipp->{"title"} . '</h2>
                    <h4> author: ' . $snipp->{"Createname"} . '</h4>
                    <p>
                    ' . 'snipp: ' . $snipp->{"snipp"} . '
                    </p>
                    <input name="'. $this->removeSpot . '" type="hidden" value="'. $spot .'">

                    <input name="'. $this->dealteSnip . '" type="submit" value="dealte">
                </form>
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
        $this->message = $message;
    }
}