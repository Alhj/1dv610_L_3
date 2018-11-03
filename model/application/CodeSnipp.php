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
    public function toArray()
    {
        return array(
            'title' => $this->CodeSnipp,
            'CodeSnipp' => $this->title,
            'CreateName' => $this->CreateName
        );
    }
}