<?php

class UserDataEdition
{
    protected $user = null;
    protected $myDB = null;
    protected $dataFromForm = null;
    protected $dataArrayValidation = null;

    public function __construct($user, $dbo)
    {
        $this -> user = new User($user -> getId(), $user -> getName(), $user -> getLogin());
        $this -> myDB = new MyDB($dbo);
    }

}