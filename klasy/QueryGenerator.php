<?php

class QueryGenerator
{
    protected $myDB = null;
    protected $user = null;

    public function __construct($dbo, $user)
    {
        $this -> myDB = new MyDB($dbo);
        $this -> user = new User($user -> getId(), $user -> getName(), $user -> getLogin());
    }

}