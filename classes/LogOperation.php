<?php

class LogOperation
{
    private $userDataAssignedToLogin = null;
    private $userDataQueryGenerator = null;
    private $loginFormValidation = null;

    public function __construct($dbo)
    {
        $this -> userDataQueryGenerator = new UserDataQueryGenerator($dbo);
        $this -> loginFormValidation = new LogInFormValidation($_POST, LOGIN_FORM_FIELDS);
    }

    public function logIn()
    {
        $message = $this -> loginFormValidation -> getMessageOfFormValidation($this -> userDataQueryGenerator);
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

    public function getValidFields()
    {
        return $this -> loginFormValidation -> getValidFields();
    }

    public function getInputValues()
    {
        return $this -> loginFormValidation -> getInputValues();
    }
}