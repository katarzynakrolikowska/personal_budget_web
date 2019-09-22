<?php

class IncomeEdition extends IncomeOperations
{
    public function editIncome($incomeId)
    {
        $message = $this -> incomeFormValidation -> getMessageOfFormValidation();

        if ($message === ACTION_OK) {
            $income = new Income($_POST['amount'], $_POST['date'], $_POST['category'], $_POST['comment']);
            $this -> updateData($incomeId, $income);
        }
        return $message;
    }

    private function updateData($incomeId, $income)
    {
        $this -> updateIncomesInDatabase($incomeId, $income);
        $this -> updateIncomesGroupedByCategory();
    }

    private function updateIncomesInDatabase($incomeId, $income)
    {
        $this -> incomeQueryGenerator -> updateIncomesInDatabse($incomeId, $income);
    }
}