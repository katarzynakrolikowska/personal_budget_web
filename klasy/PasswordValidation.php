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

    public function isCorrectPasswordAssignedToUser($userId, $myDB)
    {
        $passwordFromDatabase = $this -> getPasswordFromDatabase($userId, $myDB);
        if (password_verify($this -> data, $passwordFromDatabase)) {
            return true;
        } else {
            return false;
        }
    }

    private function getPasswordFromDatabase($userId, $myDB)
    {
        $query = 'SELECT password FROM users WHERE id = :id';
        $parametersToBind = array(':id' => $userId);
        
        $results = $myDB -> getQueryResult($query, $parametersToBind);
        return $results[0]['password'];
    }
    
}