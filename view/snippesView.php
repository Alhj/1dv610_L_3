<?php

class SnippsView
{

    public function response ()
    {
        return '
        '. $this->allSnips("hello world") . '
        ';
    }

    private function allSnips ($jsonRead)
    {
        return "$jsonRead";
    }
}