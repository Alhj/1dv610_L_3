<?php

namespace model;

class CodeSnipp
{
    public $title;

    public $CodeSnipp;

    public $codeType;

    public function __construct($title, $CodeSnipp, $codeType)
    {
        $this->title = $this->doTitleHaveInput($title);
        $this->CodeSnipp = $this->doCodeSnippHaveInput($CodeSnipp);
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
    private function doCodeSnippHaveInput($CodeSnipp)
    {
        if (!empty($CodeSnipp)) {
            return $CodeSnipp;
        } else  {
            throw new \snipMissingInput();
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