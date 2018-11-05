<?php

namespace model;

class CodeSnipp
{
    public $title;

    public $CodeSnipp;

    public function __construct($title, $CodeSnipp)
    {
        $this->title = $title;
        $this->CodeSnipp = $CodeSnipp;
    }
}