<?php

namespace model;

class SnippValidator
{
    public function isSnippInformationSet($snipp, $title)
    {
        if (!empty($snipp)) {
            if (!empty($title)) {
                return true;
            } else {
                throw new \titleMissingInput();
            }
        } else {
            throw new \snipMissingInput();
        }
    }
}