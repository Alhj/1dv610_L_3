<?php

namespace view;

class removeSnippView
{

    private $whantToRemov = "removeSnip";
    private $removeSpot = "removeSpot";
    private $dealteSnip = "dealteSnipt";

    public function doYouWhantToDelate()
    {
        return isset($_POST[$this->dealteSnip]);
    }

    public function GetSpot()
    {
        var_dump($_POST["number"]);
        if(isset($_POST[$this->removeSpot]))
        {
            return $_POST[$this->removeSpot];
        } else {
            return "";
        }
    }

    public function renderDealte($jsonInfo)
    {
        return '
            '. $this->userSnips($jsonInfo) .'
        ';
    }

    private function userSnips($jsonInfo)
    {
        $spot = 0;
        $string = "";
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
                    <input id = "number" name="number" type="text" value = "'. $spot .'>

                    <input name="'. $this->dealteSnip . '" type="submit" value="dealte">
                </form>
            ';
            $spot += 1;
        }
        return $string;
    }
}