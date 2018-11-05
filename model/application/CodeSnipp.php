<?php

namespace model;

class CodeSnipp
{
    public $title;

    public $CodeSnipp;

    public function __construct($title, $CodeSnipp)
    {
        $this->title = $this->doTitleHaveInput($title);
        $this->CodeSnipp = $this->doCodeSnippHaveInput($CodeSnipp);
    }

    private function doTitleHaveInput($title)
    {
        if (!empty($title)) {
            return $title;
        } else {
            throw new \titleMissingInput();
        }
    }
    private function doCodeSnippHaveInput($CodeSnipp)
    {
        if (!empty($CodeSnipp)) {
            return $CodeSnipp;
        } else  {
            throw new \snipMissingInput();
        }
    }
}