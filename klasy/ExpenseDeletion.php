<?php

class ExpenseDeletion extends ExpenseOperations
{
    public function deleteExpense($expenseId)
    {
        $this -> deleteExpenseFromDatabase($expenseId);
        $this -> updateExpensesGroupedByCategory();
    }

    private function deleteExpenseFromDatabase($expenseId)
    {
        $this -> expenseQueryGenerator -> deleteExpenseFromDatabase($expenseId);
    }
}