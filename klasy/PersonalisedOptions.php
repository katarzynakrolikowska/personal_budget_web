<?php

class PersonalisedOptions
{
    private $myDB = null;
    private $userId = null;

    public function __construct($dbo, $id)
    {
        $this -> myDB = new MyDB($dbo);
        $this -> userId = $id;
    }

    public function getIncomeCategoriesAssignedToUser()
    {
        if (isset($_SESSION['incomeCategories'])) {
            return $_SESSION['incomeCategories'];
        } else {
            return null;
        }
    }

    public function setIncomeCategoriesAssignedToUser()
    {
        $query = 'SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id=:id';

        $parametersToBind = array(':id' => $this -> userId);

        $_SESSION['incomeCategories'] = $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function getPaymentMethodsAssignedToUser()
    {
        if (isset($_SESSION['paymentMethods'])) {
            return $_SESSION['paymentMethods'];
        } else {
            return null;
        }
    }

    public function getExpenseCategoriesAssignedToUser()
    {
        if (isset($_SESSION['expenseCategories'])) {
            return $_SESSION['expenseCategories'];
        } else {
            return null;
        }
    }
    public function setExpenseCategoriesAssignedToUser()
    {
        $query = 'SELECT id, name FROM expenses_category_assigned_to_users WHERE user_id=:id';

        $parametersToBind = array(':id' => $this -> userId);

        $_SESSION['expenseCategories'] = $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function setPaymentMethodsAssignedToUser()
    {
        $query = 'SELECT id, name FROM payment_methods_assigned_to_users WHERE user_id=:id';

        $parametersToBind = array(':id' => $this -> userId);

        $_SESSION['paymentMethods'] = $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

}