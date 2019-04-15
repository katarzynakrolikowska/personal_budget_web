<?php

class IncomeOperations
{
    protected $incomeQueryGenerator = null;
    protected $personalisedOptions = null;

    public function __construct($dbo, $user)
    {
        $this -> incomeQueryGenerator = new IncomeQueryGenerator($dbo, $user);
        $this -> personalisedOptions = new PersonalisedOptions($dbo, $user);
    }

    protected function updateIncomesGroupedByCategory()
    {
        $_SESSION['incomes'] = $this -> incomeQueryGenerator -> getIncomesGroupedByCategoryForSelectedPeriod($_SESSION['startDate'], $_SESSION['endDate']);
    }
}