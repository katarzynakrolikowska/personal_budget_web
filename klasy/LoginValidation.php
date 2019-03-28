<?php

class LoginValidation extends DataValidation
{
    public function isValid()
    {
        if ($this -> isValidLength(MIN_LENGTH_LOGIN, MAX_LENGTH_LOGIN) && $this -> isLoginIncludeValidChars()) {
            return true;
        } else {
            return false;
        }
    }

    private function isLoginIncludeValidChars()
    {
        if(preg_match('/^[a-zA-Z0-9_\.]+$/', ($this -> data))) {
            return true; 
        } else {
            return false;
        }
    }

    public function isLoginExists($dbo)
    {
        $results = $this -> getUserDataAssignedToLogin($dbo);

        if (sizeof($results) > 0) {
            $_SESSION['errorLogin'] = true;
            return true;
        } else {
            return false;
        }
    }

    public function getUserDataAssignedToLogin($dbo)
    {
        $query = 'SELECT id, username FROM users WHERE login = :login';
        $myDB = new MyDB($dbo);
        $parametersToBind = array(':login' => $this -> data);
        
        return $myDB -> getQueryResult($query, $parametersToBind);
    }

}