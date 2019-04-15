<?php

class ExpenseOperations
{
    protected $expenseQueryGenerator = null;
    protected $personalisedOptions = null;

    public function __construct($dbo, $user)
    {
        $this -> expenseQueryGenerator = new ExpenseQueryGenerator($dbo, $user);
        $this -> personalisedOptions = new PersonalisedOptions($dbo, $user);
    }

    protected function updateExpensesGroupedByCategory()
    {
        $_SESSION['expenses'] = $this -> expenseQueryGenerator -> getExpensesGroupedByCategoryForSelectedPeriod($_SESSION['startDate'], $_SESSION['endDate']);
    }
}