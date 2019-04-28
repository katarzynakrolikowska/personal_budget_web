<?php

class ExpenseQueryGenerator extends QueryGenerator
{
    public function getExpensesGroupedByCategoryForSelectedPeriod($startDate, $endDate)
    {
        $query = 'SELECT ecu.name, SUM(e.amount) as eSum 
                    FROM expenses as e, expenses_category_assigned_to_users as ecu 
                    WHERE ecu.user_id=e.user_id 
                    AND ecu.id = e.expense_category_assigned_to_user_id 
                    AND e.user_id=:userID 
                    AND e.date_of_expense>=:startDate 
                    AND e.date_of_expense<=:endDate 
                    GROUP BY ecu.name 
                    ORDER BY eSum DESC';

        $parametersToBind = array(':userID' => $this -> user -> getId(),
                                    ':startDate' => $startDate,
                                    ':endDate' => $endDate);
        
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function getDetailedExpensesOfSelectedCategoryAndPeriod($category, $startDate, $endDate)
    {
        $query = 'SELECT e.id, e.amount, e.date_of_expense as date, pmu.name as payment, e.expense_comment as comment FROM expenses as e, payment_methods_assigned_to_users as pmu 
            WHERE e.user_id=:userID 
            AND e.expense_category_assigned_to_user_id = (
                SELECT ecu.id 
                FROM expenses_category_assigned_to_users as ecu 
                WHERE ecu.name=:category 
                AND ecu.user_id=e.user_id) 
            AND e.payment_method_assigned_to_user_id = pmu.id 
            AND pmu.user_id = e.user_id
            AND e.date_of_expense>=:startDate 
            AND e.date_of_expense<=:endDate 
            ORDER BY e.amount DESC';

        $parametersToBind = array(':userID' => $this -> user -> getId(),
                                    ':category' => $category,
                                    ':startDate' => $startDate,
                                    ':endDate' => $endDate);
        
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function insertDataIntoDatabase($expense)
    {
        $query = 'INSERT INTO expenses VALUES(NULL, :userID, :categoryID, :paymentID, :amount, :date, :comment)';

        $parametersToBind = array(':userID' => $this -> user -> getId(), 
                            ':categoryID' => $expense -> getCategory(),
                            ':paymentID' => $expense -> getPaymentMethod(),
                            ':amount' => $expense -> getAmount(), 
                            ':date' => $expense -> getTransferDate(), 
                            ':comment' => $expense -> getComment());

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function updateExpensesInDatabase($expenseId, $expense)
    {
        $query = 'UPDATE expenses 
                    SET expense_category_assigned_to_user_id = :categoryID, payment_method_assigned_to_user_id = :paymentMethodId, amount = :amount, date_of_expense = :date, expense_comment = :comment 
                    WHERE id = :expenseID';

        $parametersToBind = array(':categoryID' => $expense -> getCategory(),
                            ':paymentMethodId' => $expense -> getPaymentMethod(),
                            ':amount' => $expense -> getAmount(),
                            ':date' => $expense -> getTransferDate(), 
                            ':comment' => $expense -> getComment(), 
                            ':expenseID' => $expenseId);

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    public function deleteExpenseFromDatabase($expenseId)
    {
        $query = 'DELETE 
                    FROM expenses 
                    WHERE id = :expenseID';
        $parametersToBind = array(':expenseID' => $expenseId);

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }
}