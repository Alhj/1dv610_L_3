<?php 

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

      unset($allUsersSnips[$removeSpot - 1]);

      $this->saveJsonFile($allUsersSnips);
    }

    public function getUserSnips()
    {
        $userSnips = [];

        $allSnipps = $this->getInfomrationFromJsonFile();

        foreach($allSnipps as $snipp)
        {
            if($snipp->{"Createname"} == "admin")
            {
                array_push($userSnips, $snipp);
            }
        }
        return $userSnips;
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