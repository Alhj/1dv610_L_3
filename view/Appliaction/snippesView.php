<?php

class SnippsView
{
    private $jsonInfo;

    private $snipp = "snipp";
    private $title = "title";
    private $message = "message";
    private $addSnipp = "addsnipp";

    private $theMessage;


    public function setJsonInfo($jsonInfomration)
    {
        $this->jsonInfo = $jsonInfomration;
    }

    public function setMessage($sendMessage)
    {
        $this->theMessage = $sendMessage;
    }

    public function response()
    {
        if ("" == "1") {
            return '
            ' . $this->NewSnipps() . '
            ';
        } else {
            return '
        ' . $this->allSnips() . '
        ';
        }
    }

    public function whantToAddSnipp()
    {
        return isset($_GET[$this->addSnipp]);
    }

    private function allSnips()
    {
        $string = '';
        foreach ($this->jsonInfo as $snipp) {
            $string .= '
                <fieldset>
                    <h2> title: ' . $snipp->{"title"} . '</h2>
                    <h4> author: ' . $snipp->{"Createname"} . '</h4>
                    <p>
                    ' . 'snipp:' . $snipp->{"snipp"} . '
                    </p>
                </fieldset>';
        }
        return $string;
    }

    private function NewSnipps()
    {
        return
            '
            <h4 id ="' . $this->message . '">' . $this->theMessage . '</h4>
            <form method = "post">
                <fieldset>
                    <label for = "' . $this->title . '">title</label>
                    <input type = "text">
                    <br>
                    <label for = "' . $this->snipp . '"> snipp</label>
                    <textarea id = "' . $this->snipp . '" rows="4" cols="40">
                    </textarea>
                    <br>
                    <br>
                    <button type ="submit">submit</button>
                </fieldset>
            </form>
        ';
    }
}