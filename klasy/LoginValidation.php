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

    public function isLoginAlreadyExistsInDatabase($userDataQueryGenerator)
    {
        $userDataFromDatabase = $this -> getUserDataAssignedToLogin($userDataQueryGenerator);
        $count = count($userDataFromDatabase);
        //$_SESSION['test1'] ='<br /> ilość: '.$count;
        if ($count > 0) {
            //$_SESSION['test1'] .='<br /> imię: '.$userDataFromDatabase[0]['username'].'<br />'.$this -> data;
            //$_SESSION['test'] .= 'login istnieje';
            return true;
        } else {
            //$_SESSION['test'] .= 'login  nie istnieje';
            return false;
            
        }
    }

    public function getUserDataAssignedToLogin($userDataQueryGenerator)
    {
        return $userDataQueryGenerator -> getUserDataAssignedToLogin($this -> data);
    }
}