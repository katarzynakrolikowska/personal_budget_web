<?php

class User
{
    private $id = null;
    private $name = null;
    private $login = null;

    public function __construct($id, $name, $login)
    {
        $this -> id = $id;
        $this -> name = $name;
        $this -> login = $login;
    }

    public function getName()
    {
        return $this -> name;
    }
    
}