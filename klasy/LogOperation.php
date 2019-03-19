<?php

class LogOperation
{
    private $dbo =null;
    private $userDataFromDatabase = null;
    private $dataArrayValidation = null;

    public function __construct($dbo)
    {
        $this -> dbo = $dbo;
        $this -> dataArrayValidation = new DataArrayValidation($_POST, LOGIN_FORM_FIELDS);
    }

    public function logIn()
    {
        if ($this -> isAllRequiredDataMissing()) {
            return FORM_DATA_MISSING;
        }

        if (!$this -> isValidDataFromLoginForm()) {
            return INVALID_DATA;
        }

        $_SESSION = array();
        $this -> setLoggedInUserData();
        return ACTION_OK;
    }

    private function isAllRequiredDataMissing()
    {
        if ($this -> dataArrayValidation -> isRequiredFieldsFromFormMissing()) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidDataFromLoginForm()
    {
        $loginValidation = new LoginValidation($_POST['login']);
        $results = $loginValidation -> getUserDataAssignedToLogin($this -> dbo);

        if ($this -> isUserExists($results) && $this -> isCorrectPassword($results[0]['password'])) {
            $this -> userDataFromDatabase = $results[0];
            return true;
        } else {
           $this -> dataArrayValidation -> setSessionErrorForRequiredFields();
            return false;
        }
    }

    private function isUserExists($results)
    {
        if (sizeof($results) === 1 ) {
            return true;
        } else {
            return false;
        }
    }

    private function isCorrectPassword($passwordFromDatabase)
    {
        if (password_verify($_POST['password'], $passwordFromDatabase)) {
            return true;
        } else {
            return false;
        }
    }

    private function setLoggedInUserData()
    {
        $_SESSION['loggedInUser'] = new User($this -> userDataFromDatabase['id'], $this -> userDataFromDatabase['username'], $_SESSION['login']);
    }
}