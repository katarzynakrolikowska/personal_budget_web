<?php

class ExpenseCategoryQueryGenerator extends QueryGenerator
{
    public function getExpenseCategoriesAssignedToUser()
    {
        $query = 'SELECT id, name, monthly_limit 
                    FROM expenses_category_assigned_to_users 
                    WHERE user_id=:id';

        $parametersToBind = array(':id' => $this -> user -> getId());

        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function getLimitOfExpenseCategory($categoryId)
    {
        $query = 'SELECT monthly_limit 
                    FROM expenses_category_assigned_to_users 
                    WHERE id=:categoryId';

        $parametersToBind = array(':categoryId' => $categoryId);

        $result = $this -> myDB -> getQueryResult($query, $parametersToBind);
        return $result[0]['monthly_limit'];
    }

    public function getSumOfSelectedExpenseCategoryInSelectedMonth($categoryId, $inputDateOfExpense)
    {
        $dateModifier = new DateModifier($inputDateOfExpense);
        $startDate = $dateModifier -> getFirstDateOfSelectedMonthAsString();
        $endDate = $dateModifier -> getLastDateOfSelectedMonthAsString();

        $query = 'SELECT SUM(e.amount) as sumCategory 
                    FROM expenses as e, expenses_category_assigned_to_users as ecu 
                    WHERE ecu.id = e.expense_category_assigned_to_user_id 
                    AND e.expense_category_assigned_to_user_id=:categoryId 
                    AND e.date_of_expense>=:startDate 
                    AND e.date_of_expense<=:endDate';

        $parametersToBind = array(':categoryId' => $categoryId,
                                    ':startDate' => $startDate,
                                    ':endDate' => $endDate);
        
        $result =  $this -> myDB -> getQueryResult($query, $parametersToBind);
        return $result[0]['sumCategory'];
    }

    public function editOptionInDatabase($optionId, $newOptionName)
    {
        $query = 'UPDATE expenses_category_assigned_to_users 
                    SET name = :newName 
                    WHERE user_id = :userId 
                    AND id = :categoryId';

        $parametersToBind = array(':newName' => $newOptionName,
                            ':userId' => $this -> user -> getId(),
                            ':categoryId' => $optionId);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function addOptionInDatabase($newOptionName)
    {
        $query = 'INSERT INTO expenses_category_assigned_to_users VALUES(NULL, :userId, :newName, NULL)';

        $parametersToBind = array(':userId' => $this -> user -> getId(),
                                ':newName' => $newOptionName);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function removeOptionFromDatabase($optionId)
    {
        $query = 'DELETE FROM expenses_category_assigned_to_users 
                    WHERE user_id = :userId 
                    AND id = :categoryId';
        $parametersToBind = array(':userId' => $this -> user -> getId(),
                            ':categoryId' => $optionId);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function getDataAssignedToOption($optionId)
    {
        $query = 'SELECT id FROM expenses 
                    WHERE user_id = :userId 
                    AND expense_category_assigned_to_user_id = :categoryId';
        $parametersToBind = array(':userId' => $this -> user -> getId(),
                            ':categoryId' => $optionId);
    
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function  updateLimitOfCategoryInDatabase($limitAmount, $expenseCategoryId)
    {
        $query = 'UPDATE expenses_category_assigned_to_users 
                    SET monthly_limit = :limitCategory 
                    WHERE id = :expenseCategoryID';
        $parametersToBind = array(':limitCategory' => $limitAmount,
                                ':expenseCategoryID' => $expenseCategoryId);

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }
}