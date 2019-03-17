<?php

class LogOperation
{
    private $dbo =null;
    private $userDataFromDatabase = null;

    public function __construct($dbo)
    {
        $this -> dbo = $dbo;
    }

    public function logIn()
    {
        if ($this -> isAllRequiredDataMissing()) {
            return FORM_DATA_MISSING;
        }

        //$dataValidation = new DataValidation($_POST['login']);

        if (!$this -> isUserExists()) {
            return INVALID_DATA;
        }

        $_SESSION = array();
        $this -> setLoggedInUserData();
        return ACTION_OK;
    }

    private function isAllRequiredDataMissing()
    {
        $dataArrayValidation = new DataArrayValidation($_POST, LOGIN_FORM_FIELDS);
        if ($dataArrayValidation -> isRequiredFieldsFromFormMissing()) {
            return true;
        } else {
            return false;
        }
    }

    private function isUserExists()
    {
        $query = 'SELECT id, username, password FROM users WHERE login = ?';
        $myDB = new MyDB($this -> dbo);
        $parametersToBind = array($_POST['login'] => PDO::PARAM_STR);
        
        $results = $myDB -> getQueryResult($query, $parametersToBind);

        if (sizeof($results) === 1 && $this -> isCorrectPassword($results[0]['password'])) {
            $this -> userDataFromDatabase = $results[0];
            return true;
        } else {
            $_SESSION['errorLogin'] = true;
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