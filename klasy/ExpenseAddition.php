<?php

class ExpenseAddition extends ExpenseOperations
{
    public function addExpense()
    {
        $expenseFormValidation = new ExpenseFormValidation($_POST, EXPENSE_FORM_FIELDS, $this -> personalisedOptions);

        $message = $expenseFormValidation -> getMessageOfFormValidation();

        if ($message === ACTION_OK) {
            $expense = new Expense($_POST['amount'], $_POST['date'], $_POST['paymentMethod'], $_POST['category'], $_POST['comment']);

            $this -> insertDataIntoDatabase($expense);
        }
        return $message;
    }
    
    private function insertDataIntoDatabase($expense)
    {
        $this -> expenseQueryGenerator -> insertDataIntoDatabase($expense);
    }
}