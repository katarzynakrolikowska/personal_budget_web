<?php

class PasswordValidation extends DataValidation
{
    public function isValid()
    {
        if ($this -> isValidLength(MIN_LENGTH_PASSWORD, MAX_LENGTH_PASSWORD)) {
            return true;
         } else {
             return false;
         }
    }

    public function isPasswordMatched($passwordToCompare)
    {
        if ($this -> data === $passwordToCompare) {
            return true;
        } else {
            return false;
        }
    }

    public function isPasswordAssignedToLogInUser($userDataQueryGenerator)
    {
        $passwordFromDatabase = $userDataQueryGenerator -> getPasswordAssignedToLogInUser();
        if ($this -> isPasswordAssignedToUser($passwordFromDatabase)) {
            return true;
        } else {
            return false;
        }
    }

    public function isPasswordAssignedToUser($passwordToCompare)
    {
        if (password_verify($this -> data, $passwordToCompare)) {
            return true;
        } else {
            return false;
        }
    }
}