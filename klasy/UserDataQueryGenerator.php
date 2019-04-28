<?php

class UserDataQueryGenerator extends QueryGenerator
{
    public function insertDataOfNewUserIntoDatabase($name, $login, $password)
    {
        $query = 'INSERT INTO users VALUES(NULL, :username, :password, :login)';
        $parametersToBind = array(':username' => $name,
                            ':password' => $password,
                            ':login' => $login);
        
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function setDefaultOptionsForNewUser($login)
    {
        $parametersToBind = array(':login' => $login);

        $query = 'INSERT INTO expenses_category_assigned_to_users(user_id, name) 
                    SELECT (SELECT id FROM users WHERE login=:login), name 
                    FROM expenses_category_default as e_def 
                    ORDER BY e_def.id';
        $this -> myDB -> executeQuery($query, $parametersToBind);

        $query = 'INSERT INTO incomes_category_assigned_to_users(user_id, name) 
                    SELECT (SELECT id FROM users WHERE login=:login), name 
                    FROM incomes_category_default as i_def 
                    ORDER BY i_def.id';
        $this -> myDB -> executeQuery($query, $parametersToBind);

        $query = 'INSERT INTO payment_methods_assigned_to_users(user_id, name)
                    SELECT (SELECT id FROM users WHERE login=:login), name 
                    FROM payment_methods_default as pm_def 
                    ORDER BY pm_def.id';
        $this -> myDB -> executeQuery($query, $parametersToBind);

    }

    public function updateUsernameInDatabase($newName)
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

    public function getPasswordAssignedToLogin($login)
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