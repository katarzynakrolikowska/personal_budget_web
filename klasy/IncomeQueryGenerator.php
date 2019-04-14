<?php

class IncomeQueryGenerator extends QueryGenerator
{
    public function getIncomesGroupedByCategoryForSelectedPeriod($startDate, $endDate)
    {
        $query = 'SELECT icu.name, SUM(i.amount) as iSum FROM incomes as i, incomes_category_assigned_to_users as icu WHERE icu.user_id=i.user_id AND icu.id = i.income_category_assigned_to_user_id AND i.user_id=:userID AND i.date_of_income>=:startDate AND i.date_of_income<=:endDate GROUP BY icu.name ORDER BY iSum DESC';

        $parametersToBind = array(':userID' => $this -> user -> getId(),
                                    ':startDate' => $startDate,
                                    ':endDate' => $endDate);
        
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function getDetailedIncomesOfSelectedCategoryAndPeriod($category, $startDate, $endDate)
    {
        $query = 'SELECT i.id, i.amount, i.date_of_income as date, i.income_comment as comment FROM incomes as i WHERE i.user_id=:userID AND i.income_category_assigned_to_user_id = (SELECT icu.id FROM incomes_category_assigned_to_users as icu WHERE icu.name=:category AND icu.user_id=i.user_id) AND i.date_of_income>=:startDate AND i.date_of_income<=:endDate ORDER BY i.amount DESC';

        $parametersToBind = array(':userID' => $this -> user -> getId(),
                                    ':category' => $category,
                                    ':startDate' => $startDate,
                                    ':endDate' => $endDate);
        
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function updateIncomesInDatabse($incomeId, $income)
    {
        $query = 'UPDATE incomes SET income_category_assigned_to_user_id = :categoryID, amount = :amount, date_of_income = :date, income_comment = :comment WHERE id = :incomeID';

        $parametersToBind = array(':categoryID' => $income -> getCategory(), 
                            ':amount' => $income -> getAmount(),
                            ':date' => $income -> getTransferDate(), 
                            ':comment' => $income -> getComment(), 
                            ':incomeID' => $incomeId);

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function insertDataIntoDatabase($income)
    {
        $query = 'INSERT INTO incomes VALUES(NULL, :userID, :categoryID, :amount, :date, :comment)';

        $parametersToBind = array(':userID' => $this -> user -> getId(), 
                            ':categoryID' => $income -> getCategory(),
                            ':amount' => $income -> getAmount(), 
                            ':date' => $income -> getTransferDate(), 
                            ':comment' => $income -> getComment());

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function deleteIncomeFromDatabase($incomeId)
    {
        $query = 'DELETE FROM incomes WHERE id = :incomeID';
        $parametersToBind = array(':incomeID' => $incomeId);

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }
}


