<?php

class SnippsView
{
    private $jsonInfo;

    public function response()
    {
        return '
        ' . $this->allSnips() . '
        ';
    }

    private function allSnips()
    {
        $string = '';
        foreach($this->jsonInfo as $snipp)
        {
            $string .= '
            <fieldset>
            <h2> title: ' . $snipp->{"descriton"} . '</h2>
            <h4> author: '. $snipp->{"Createname"}.'</h4>
            <p>
            ' . 'snipp:' . $snipp->{"snipp"} . '
            </p>
            </fieldset>'
            ;
        }
        return $string;
    }

    private function NewSnipps()
    {
        return
        '
        ';
    }

    public function setJsonInfo($jsonInfomration)
    {
        $this->jsonInfo = $jsonInfomration;
    }
}