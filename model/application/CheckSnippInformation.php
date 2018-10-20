<?php

namespace model;

class checkSnippInformation
{
    public function isSnippInfoSet($snipp, $title)
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