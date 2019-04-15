<?php

class PaymentMethodQueryGenerator extends QueryGenerator
{
    public function getPaymentMethodsAssignedToUser()
    {
        $query = 'SELECT id, name FROM payment_methods_assigned_to_users WHERE user_id=:id';

        $parametersToBind = array(':id' => $this -> user -> getId());
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function editOptionInDatabase($optionId, $newOptionName)
    {
        $query = 'UPDATE payment_methods_assigned_to_users SET name = :newName WHERE user_id = :userId AND id = :methodId';

        $parametersToBind = array(':newName' => $newOptionName,
                            ':userId' => $this -> user -> getId(),
                            ':methodId' => $optionId);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function addOptionInDatabase($newOptionName)
    {
        $query = 'INSERT INTO payment_methods_assigned_to_users VALUES(NULL, :userId, :newName)';

        $parametersToBind = array(':userId' => $this -> user -> getId(),
                                ':newName' => $newOptionName);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function removeOptionFromDatabase($optionId)
    {
        $query = 'DELETE FROM payment_methods_assigned_to_users WHERE user_id = :userId AND id = :methodId';
        $parametersToBind = array(':userId' => $this -> user -> getId(),
                            ':methodId' => $optionId);
    
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function getDataAssignedToOption($optionId)
    {
        $query = 'SELECT id FROM expenses WHERE user_id = :userId AND payment_method_assigned_to_user_id = :methodId';
        $parametersToBind = array(':userId' => $this -> user -> getId(),
                            ':methodId' => $optionId);
    
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }
}