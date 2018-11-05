<?php

namespace model;

class CodeSnipp
{
    public $title;

    public $CodeSnipp;

    public $CreateName;

    public function __construct($title, $CodeSnipp, $CreateName)
    {
        $this->title = $title;
        $this->CodeSnipp = $CodeSnipp;
        $this->CreateName = $CreateName;
    }
}