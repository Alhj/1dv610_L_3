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

        $allUsersSnips = $this->getUserSnips($Username);

        unset($allUsersSnips[$spot]);
        
        $this->newSnippsArray($allUsersSnips, $Username);
    }

    public function getUserSnips($userName)
    {
        $userSnips = [];

        $allSnipps = $this->getInfomrationFromJsonFile();

        foreach ($allSnipps as $snipp) {
            if ($snipp->{"CreateName"} == $userName) {
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
            if($snips->{"CreateName"} !== $Username)
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

    public function addSnipps(CodeSnipp $Codesnipp)
    {
        $jsonFile = $this->getInfomrationFromJsonFile();

        var_dump($jsonFile);
        $test = array('title' => "hej", 'CodeSnipp' => "då", 'CreateName' => "batman");
        

        $jsonOfNewSnipp = json_encode($test);

        var_dump($jsonOfNewSnipp);

        array_push($jsonFile, $jsonOfNewSnipp);

        $this->saveJsonFile($jsonFile);
    }
    private function saveJsonFile(array $jsonFile)
    {

        $newJsonInfo = json_encode($jsonFile);

        file_put_contents('./' . $this->getInfo->getFileName() . '', $newJsonInfo);


    }

}