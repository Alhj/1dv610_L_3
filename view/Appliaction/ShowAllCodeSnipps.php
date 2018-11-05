<?php

namespace view;

class ShowAllCodeSnipps
{
    private $jsonInfo;

    public function render()
    {
        return $this->ShowAllCodeSnips();
    }

    private function ShowAllCodeSnips()
    {
        $string = '
        <a href="index.php">go back</a>
        <h2>View all Snips</h2>
        
        ';
        if (!empty($this->jsonInfo)) {
            foreach ($this->jsonInfo as $snipp) {
                $string .= '
            <br>
            <br>
                <fieldset>
                    <h2> title: ' . $snipp->title . '</h2>
                    <h4> author: ' . $snipp->CreateName . '</h4>
                    <p>
                    ' . 'snipp: ' . $snipp->CodeSnipp . '
                    </p>
                </fieldset>';
            }
        } else {
            $string .= '<p>no code snipps has been add yet</p>';
        }
        return $string;
    }

    public function setJsonInfo($jsonInfoFromation)
    {
        $this->jsonInfo = $jsonInfoFromation;
    }
}