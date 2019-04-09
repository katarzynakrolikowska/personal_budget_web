<?php

class UserDataQueryGenerator extends QueryGenerator
{
    public function updateUserNameInDatabase($newName)
    {
        $query = 'UPDATE users SET username = :name WHERE id = :id';

        $parametersToBind = array(':name' => $newName,
                            ':id' => $this -> user -> getId());
        
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function updateLoginInDatabase($newLogin)
    {
        $query = 'UPDATE users SET login = :login WHERE id = :id';

        $parametersToBind = array(':login' => $newLogin,
                            ':id' => $this -> user -> getId());
        
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function getUserDataAssignedToLogin($login)
    {
        $query = 'SELECT id, username FROM users WHERE login = :login';
       
        $parametersToBind = array(':login' => $login);
        
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function gePasswordAssignedToLogin($login)
    {
        $query = 'SELECT password FROM users WHERE login = :login';
       
        $parametersToBind = array(':login' => $login);
        
        $results = $this -> myDB -> getQueryResult($query, $parametersToBind);
        return $results[0]['password'];
    }

    public function updatePasswordInDatabase($newPassword)
    {
        $query = 'UPDATE users SET password = :password WHERE id = :id';

        $parametersToBind = array(':password' => $newPassword,
                            ':id' => $this -> user -> getId());
        
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }


    public function getPasswordAssignedToLogInUser()
    {
        $query = 'SELECT password FROM users WHERE id = :id';
        $parametersToBind = array(':id' => $this -> user -> getId());
        
        $results = $this -> myDB -> getQueryResult($query, $parametersToBind);
        return $results[0]['password'];
    }
}