<?php

class IncomeAddition extends IncomeOperations
{
    public function addIncome()
    {
        $message = $this -> incomeFormValidation -> getMessageOfFormValidation();

        if ($message === ACTION_OK) {
            $income = new Income($_POST['amount'], $_POST['date'], $_POST['category'], $_POST['comment']);

            $this -> insertDataIntoDatabase($income);
        }
        return $message;
    }

    private function insertDataIntoDatabase($income)
    {
        $this -> incomeQueryGenerator -> insertDataIntoDatabase($income);
    }
    
    public function getValidFields()
    {
        return $this -> incomeFormValidation -> getValidFields();
    }

    public function getInputValues()
    {
        return $this -> incomeFormValidation -> getInputValues();
    }
}