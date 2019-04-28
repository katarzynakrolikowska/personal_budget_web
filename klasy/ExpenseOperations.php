<?php

class ExpenseOperations
{
    protected $expenseQueryGenerator = null;
    protected $personalisedOptions = null;
    protected $expenseFormValidation = null;

    public function __construct($dbo, $user)
    {
        $this -> expenseQueryGenerator = new ExpenseQueryGenerator($dbo, $user);
        $this -> personalisedOptions = new PersonalisedOptions($dbo, $user);
        $this -> expenseFormValidation = new ExpenseFormValidation($_POST, EXPENSE_FORM_FIELDS, $this -> personalisedOptions);
    }

    protected function updateExpensesGroupedByCategory()
    {
        $_SESSION['expenses'] = $this -> expenseQueryGenerator -> getExpensesGroupedByCategoryForSelectedPeriod($_SESSION['startDate'], $_SESSION['endDate']);
    }

    public function getValidFields()
    {
        return $this -> expenseFormValidation -> getValidFields();
    }

    public function getInputValues()
    {
        return $this -> expenseFormValidation -> getInputValues();
    }
}