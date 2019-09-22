<?php

class PersonalisedOptions
{
    private $dbo = null;
    private $user = null;

    public function __construct($dbo, $user)
    {
        $this -> dbo = $dbo;
        $this -> user = new User($user -> getId(), $user -> getName(), $user -> getLogin());
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
        $incomeCategoryQueryGenerator = new IncomeCategoryQueryGenerator($this -> dbo, $this -> user);

        $_SESSION['incomeCategories'] = $incomeCategoryQueryGenerator -> getIncomeCategoriesAssignedToUser();
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
        $expenseCategoryQueryGenerator = new ExpenseCategoryQueryGenerator($this -> dbo, $this -> user);

        $_SESSION['expenseCategories'] = $expenseCategoryQueryGenerator -> getExpenseCategoriesAssignedToUser();
    }

    public function setPaymentMethodsAssignedToUser()
    {
        $paymentMethodQueryGenerator = new PaymentMethodQueryGenerator($this -> dbo, $this -> user);

        $_SESSION['paymentMethods'] = $paymentMethodQueryGenerator -> getPaymentMethodsAssignedToUser();
    }
}