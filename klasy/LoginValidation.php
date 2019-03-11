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
        if(preg_match('/^[a-zA-Z0-9_\.]+$/', ($this -> text))) {
            return true; 
        } else {
            return false;
        }
    }
}