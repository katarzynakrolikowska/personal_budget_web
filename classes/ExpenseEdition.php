<?php

class ExpenseEdition extends ExpenseOperations
{
    public function editExpense($expenseId)
    {
        $message = $this -> expenseFormValidation -> getMessageOfFormValidation();

        if ($message === ACTION_OK) {
            $expense = new Expense($_POST['amount'], $_POST['date'], $_POST['paymentMethod'], $_POST['category'], $_POST['comment']);
            $this -> updateData($expenseId, $expense);
        }
        return $message;
    }

    private function updateData($expenseId, $expense)
    {
        $this -> updateExpensesInDatabase($expenseId, $expense);
        $this -> updateExpensesGroupedByCategory();
    }

    private function updateExpensesInDatabase($expenseId, $expense)
    {
        $this -> expenseQueryGenerator -> updateExpensesInDatabase($expenseId, $expense);
    }
}