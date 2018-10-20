<?php 

namespace model;

class JsonFileHandler
{

    private $getInfo;

    public function __construct()
    {
        $this->getInfo = new env();
    }

    public function removeSnipps($spot)
    {
        $removeSpot = intval($spot);

        $allUsersSnips = $this->getUserSnips();

        unset($allUsersSnips[$spot]);
        
        $this->newSnippsArray($allUsersSnips, "admin");
    }

    public function getUserSnips()
    {
        $userSnips = [];

        $allSnipps = $this->getInfomrationFromJsonFile();

        foreach ($allSnipps as $snipp) {
            if ($snipp->{"Createname"} == "admin") {
                array_push($userSnips, $snipp);
            }
        }
        return $userSnips;
    }
    private function newSnippsArray(array $allUsersSnips, $Username)
    {
        $newArray = [];
        $allSnips = $this->getInfomrationFromJsonFile();

        foreach($allSnips as $snips)
        {
            if($snips->{"Createname"} !== "admin")
            {
                array_push($newArray, $snips);
            }
        }

        foreach($allUsersSnips as $userSnips)
        {
            array_push($newArray, $userSnips);
        }
        $this->saveJsonFile($newArray);

    }

    public function getInfomrationFromJsonFile()
    {
        $jsonFile = file_get_contents('./' . $this->getInfo->getFileName() . '', 'w');

        $jsonInfo = json_decode($jsonFile);

        return $jsonInfo;
    }

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
    private function saveJsonFile(array $jsonFile)
    {

        $newJsonInfo = json_encode($jsonFile);

        file_put_contents('./' . $this->getInfo->getFileName() . '', $newJsonInfo);


    }

}