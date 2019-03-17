<?php

class LoginValidation extends DataValidation
{
    public function isValidLogin()
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
        $query = 'SELECT id, username, password FROM users WHERE login = ?';
        $myDB = new MyDB($dbo);
        $parametersToBind = array($this -> data => PDO::PARAM_STR);
        
        $results = $myDB -> getQueryResult($query, $parametersToBind);
        if (sizeof($results) > 0) {
            $_SESSION['errorLogin'] = true;
            return true;
        } else {
            return false;
        }
    }
}