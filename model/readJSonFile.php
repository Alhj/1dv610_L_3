<?php 

class ReadJsonFile
{
    public function getInfomrationFromJsonFile()
    {
        $jsonFile = file_get_contents("./snips.json", 'w');

        $jsonInfo = json_decode($jsonFile);

        return $jsonInfo;
    } 
}