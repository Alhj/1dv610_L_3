<?php 

namespace model;

class JsonFileHandler
{

    private $getInfo;

    public function __construct()
    {
        $this->getInfo = new env();
    }

    public function removeSnipps($spot, $Username)
    {
        $removeSpot = intval($spot);

        $allUsersSnips = $this->getUserSnips($Username);

        unset($allUsersSnips[$spot]);
        
        $this->newSnippsArray($allUsersSnips, $Username);
    }

    public function getUserSnips($userName)
    {
        $userSnips = [];

        $allSnipps = $this->getInfomrationFromJsonFile();

        foreach ($allSnipps as $snipp) {
            if ($snipp->{"Createname"} == $userName) {
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
            if($snips->{"Createname"} !== $Username)
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

    public function addSnipps($title, $jsonInfo, $Username)
    {
        $jsonFile = $this->getInfomrationFromJsonFile();

        $newSnipp = (object)[];

        $newSnipp->Createname = $Username;

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