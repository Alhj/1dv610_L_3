<?php 

namespace model;

class JsonFile
{

    private $getInfo;

    public function __construct()
    {
        $this->getInfo = new env();
    }

    public function removeUserSnipps($spot, $Username)
    {
        $allUsers = $this->getInfomrationFromJsonFile();

        foreach ($allUsers as $user) {
            if ($user->User === $Username) {
                unset($user->CodeSnipps[$spot]);
                $newArray = $this->newUserArray($user);
                $user->CodeSnipps = $newArray;
            }
        }

        $this->saveJsonFile($allUsers);
    }

    private function newUserArray($user)
    {
        $newArray = [];

        $userCodeSnipps = count($user->CodeSnipps) - 1;
        for ($number = 0; $number <= $userCodeSnipps; $number++) {
                array_push($newArray,$user->CodeSnipps[$number]);
        }
        return $newArray;
    }

    public function doUserExist($userName)
    {
        $users = $this->getInfomrationFromJsonFile();

        $userExist = false;

        foreach ($users as $user) {
            if ($user->User == $userName) {
                $userExist = true;
            }
        }

        return $userExist;
    }

    public function getUser($userName)
    {
        $userSnips;

        $allSnipps = $this->getInfomrationFromJsonFile();

        foreach ($allSnipps as $snipp) {
            if ($snipp->User == $userName) {
                $userSnips = $snipp;
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

    public function addCodeSnipps($user)
    {
        $jsonFile = $this->getInfomrationFromJsonFile();

        $allUser = [];

        foreach ($jsonFile as $theUser) {
            if ($theUser->User !== $user->User) {
                array_push($allUser, $theUser);
            }
        }

        array_push($allUser, $user);

        $this->saveJsonFile($allUser);
    }
    private function saveJsonFile(array $jsonFile)
    {

        $newJsonInfo = json_encode($jsonFile);

        file_put_contents('./' . $this->getInfo->getFileName() . '', $newJsonInfo);


    }

}