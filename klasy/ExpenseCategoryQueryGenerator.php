<?php

class ExpenseCategoryQueryGenerator extends QueryGenerator
{
    public function __construct($dbo, $user)
    {
        parent:: __construct($dbo, $user);
    }

    public function editOptionInDatabase($optionId, $newOptionName)
    {
        $query = 'UPDATE expenses_category_assigned_to_users SET name = :newName WHERE user_id = :userId AND id = :categoryId';

        $parametersToBind = array(':newName' => $newOptionName,
                            ':userId' => $this -> user -> getId(),
                            ':categoryId' => $optionId);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function addOptionInDatabase($newOptionName)
    {
        $query = 'INSERT INTO expenses_category_assigned_to_users VALUES(NULL, :userId, :newName)';

        $parametersToBind = array(':userId' => $this -> user -> getId(),
                                ':newName' => $newOptionName);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function removeOptionFromDatabase($optionId)
    {
        $query = 'DELETE FROM expenses_category_assigned_to_users WHERE user_id = :userId AND id = :categoryId';
        $parametersToBind = array(':userId' => $this -> user -> getId(),
                            ':categoryId' => $optionId);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function getDataAssignedToOption($optionId)
    {
        $query = 'SELECT id FROM expenses WHERE user_id = :userId AND expense_category_assigned_to_user_id = :categoryId';
        $parametersToBind = array(':userId' => $this -> user -> getId(),
                            ':categoryId' => $optionId);
    
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }
}