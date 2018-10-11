<?php 

class ReadJsonFile
{
    public function JsonFile()
    {
        $jsonFile = fopen("./snips.json", 'w');

        $Snipps = new RecursiveArrayIterator($jsonFile);
        
        return $Snipps;
    }
}