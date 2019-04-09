<?php

class QueryGenerator
{
    protected $myDB = null;
    protected $user = null;

    public function __construct($dbo, $user = null)
    {
        $this -> myDB = new MyDB($dbo);
        $this -> initUser($user);
    }

    private function initUser($user)
    {
        if ($user) {
            return $this -> user = new User($user -> getId(), $user -> getName(), $user -> getLogin());
        }
    }

}