<?php

class LogOperation
{
    private $userDataAssignedToLogin = null;
    private $userDataQueryGenerator = null;

    public function __construct($dbo)
    {
        $this -> userDataQueryGenerator = new UserDataQueryGenerator($dbo);
    }

    public function logIn()
    {
        $loginFormValidation = new LoginFormValidation($_POST, LOGIN_FORM_FIELDS);

        $message = $loginFormValidation -> getMessageOfFormValidation($this -> userDataQueryGenerator);
        if ($message === ACTION_OK) {
            $_SESSION = array();
            $this -> setUserDataAssignedToLogin();
            $this -> setLoggedInUser();
        }
         return $message;
    }

    private function setUserDataAssignedToLogin()
    {
        $dataFromDatabase = $this -> userDataQueryGenerator -> getUserDataAssignedToLogin($_POST['login']);
        $this -> userDataAssignedToLogin = $dataFromDatabase[0];
    }

    private function setLoggedInUser()
    {
        $_SESSION['loggedInUser'] = new User($this -> userDataAssignedToLogin['id'], $this -> userDataAssignedToLogin['username'], $_POST['login']);
    }
}