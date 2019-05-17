<?php

class ExpenseCategoryLimit
{
    private $expenseCategoryQueryGenerator = null;

    public function __construct($dbo, $user)
    {
        $this -> expenseCategoryQueryGenerator = new ExpenseCategoryQueryGenerator($dbo, $user);
    }

    public function setLimitValuesOfExpenseCategory($categoryId, $inputDateOfExpense)
    {
        header('Content-type: application/json');
        
        $limit = $this -> getLimitOfExpenseCategory($categoryId);
        $sumOfExpenses = $this -> getSumOfSelectedExpenseCategoryInSelectedMonth($categoryId, $inputDateOfExpense);
        $difference = $limit - $sumOfExpenses;

        echo json_encode([
			'success' => true,
            'limit' => $limit,
            'sum' => $sumOfExpenses,
            'diff' => $difference
		]);
    }

    private function getLimitOfExpenseCategory($categoryId)
    {
        return $this -> expenseCategoryQueryGenerator -> getLimitOfExpenseCategory($categoryId);
    }

    private function getSumOfSelectedExpenseCategoryInSelectedMonth($categoryId, $inputDateOfExpense)
    {
        $sum = $this -> expenseCategoryQueryGenerator -> getSumOfSelectedExpenseCategoryInSelectedMonth($categoryId, $inputDateOfExpense);

        if (!$sum) {
            $sum = '0.00';
        }
        return $sum;
    }
}