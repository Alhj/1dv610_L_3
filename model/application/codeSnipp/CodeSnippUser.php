<?php

namespace model;

class UserCodeSnipp
{
    public $User;
    public $CodeSnipps = [];

    public function __construct($name)
    {
        $this->User = $name;
    }
}