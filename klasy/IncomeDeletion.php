<?php

class IncomeDeletion extends IncomeOperations
{
    public function deleteIncome($incomeId)
    {
        $this -> deleteIncomeFromDatabase($incomeId);
        $this -> updateIncomesGroupedByCategory();
    }

    private function deleteIncomeFromDatabase($incomeId)
    {
        $this -> incomeQueryGenerator -> deleteIncomeFromDatabase($incomeId);
    }
}