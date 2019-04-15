<?php

class IncomeAddition extends IncomeOperations
{
    public function addIncome()
    {
        $incomeFormValidation = new IncomeFormValidation($_POST, INCOME_FORM_FIELDS, $this -> personalisedOptions);

        $message = $incomeFormValidation -> getMessageOfFormValidation();

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
}