<?php

class IncomeCategoryQueryGenerator extends QueryGenerator
{
    public function getIncomeCategoriesAssignedToUser()
    {
        $query = 'SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id=:id';

        $parametersToBind = array(':id' => $this -> user -> getId());

        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function editOptionInDatabase($optionId, $newOptionName)
    {
        $query = 'UPDATE incomes_category_assigned_to_users SET name = :newName WHERE user_id = :userId AND id = :categoryId';

        $parametersToBind = array(':newName' => $newOptionName,
                            ':userId' => $this -> user -> getId(),
                            ':categoryId' => $optionId);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function addOptionInDatabase($newOptionName)
    {
        $query = 'INSERT INTO incomes_category_assigned_to_users VALUES(NULL, :userId, :newName)';

        $parametersToBind = array(':userId' => $this -> user -> getId(),
                                ':newName' => $newOptionName);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function removeOptionFromDatabase($optionId)
    {
        $query = 'DELETE FROM incomes_category_assigned_to_users WHERE user_id = :userId AND id = :categoryId';
        $parametersToBind = array(':userId' => $this -> user -> getId(),
                            ':categoryId' => $optionId);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function getDataAssignedToOption($optionId)
    {
        $query = 'SELECT id FROM incomes WHERE user_id = :userId AND income_category_assigned_to_user_id = :categoryId';
        $parametersToBind = array(':userId' => $this -> user -> getId(),
                            ':categoryId' => $optionId);
    
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }    
}