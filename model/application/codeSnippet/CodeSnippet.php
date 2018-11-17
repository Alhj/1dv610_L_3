<?php

namespace model;

class CodeSnipp
{
    public $title;

    public $CodeSnippet;

    public $codeType;

    public function __construct($title, $CodeSnippet, $codeType)
    {
        $this->title = $this->doTitleHaveInput($title);
        $this->CodeSnippet = $this->doCodeSnippHaveInput($CodeSnippet);
        $this->codeType = $this->doCodeTypeHaveInput($codeType);
    }

    private function doTitleHaveInput($title)
    {
        if (!empty($title)) {
            return $title;
        } else {
            throw new \titleMissingInput();
        }
    }
    private function doCodeSnippHaveInput($CodeSnippet)
    {
        if (!empty($CodeSnippet)) {
            return $CodeSnippet;
        } else  {
            throw new \codeSnipetMissingInput();
        }
    }
    private function doCodeTypeHaveInput($codeType)
    {
        if(!empty($codeType))
        {
            return $codeType;
        } else 
        {
            throw new \codeTypeMissing();
        }

    }
}