<?php

class PasswordValidation extends DataValidation
{
    public function isValidPassword()
    {
        if ($this -> isValidLength(MIN_LENGTH_PASSWORD, MAX_LENGTH_PASSWORD)) {
            return true;
         } else {
             return false;
         }
    }

    
}