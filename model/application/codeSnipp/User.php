<?php

namespace model;

class User
{
    public $User;
    public $CodeSnipps = [];

    public function __construct($name)
    {
        $this->User = $name;
    }
}