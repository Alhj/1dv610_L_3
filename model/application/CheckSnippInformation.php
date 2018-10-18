<?php

class checkSnippInformation
{
    public function isSnippInfoSet($snipp, $title)
    {
        if (!empty($snipp)) {
            if (!empty($title)) {
                return true;
            } else {
                throw new Exception("no title set");
            }
        } else {
            throw new Exception("no snipp information set");
        }
    }
}