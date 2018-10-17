<?php 

class ReadJsonFile
{

    public function addSnipps($title, $jsonInfo)
    {
        $jsonFile = $this->getInfomrationFromJsonFile();

        $newSnipp = (object)[];

        $newSnipp->Createname = "admin";

        $newSnipp->snipp = $jsonInfo;

        $newSnipp->title = $title;

        $jsonOfNewSnipp = json_encode($newSnipp);

        array_push($jsonFile, $newSnipp);

        $this->saveJsonFile($jsonFile);
    }

    public function getInfomrationFromJsonFile()
    {
        $jsonFile = file_get_contents("./snips.json", 'w');

        $jsonInfo = json_decode($jsonFile);

        return $jsonInfo;
    }

    private function saveJsonFile(array $jsonFile)
    {
        var_dump($jsonFile);
    }
}