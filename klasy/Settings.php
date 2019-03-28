<?php

class Settings
{
    private $dbo = null;
    private $user = null;

    public function __construct($dbo, $user)
    {
        $this -> dbo = $dbo;
        $this -> user = new User($user -> getId(), $user -> getName(), $user -> getLogin());
    }

    public function editUserName()
    {
        $userDataEdition = new NameEdition($_POST['username'], $this -> user, $this -> dbo);

        return $userDataEdition -> editUserData();
    }

    public function editUserLogin()
    {
        $userDataEdition = new LoginEdition($_POST['login'], $this -> user, $this -> dbo);

        return $userDataEdition -> editUserData();
    }

    public function editUserPassword()
    {
        $userDataEdition = new PasswordEdition($_POST, $this -> user, $this -> dbo);

        return $userDataEdition -> editUserData();
    }
}