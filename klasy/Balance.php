<?php

class Balance
{
    private $dbo = null;
    private $myDB = null;

    private $startDate = null;
    private $endDate = null;

    public function __construct($dbo)
    {
        $this -> dbo = $dbo;
        $this -> myDB = new MyDB($this -> dbo);
        $this -> initDefaultDateRangeOfBalance();
    }

    private function initDefaultDateRangeOfBalance()
    {
        $this -> startDate = DateModifier::getFirstDateOfCurrentMonthAsString();
        $this -> endDate = DateModifier::getLastDateOfCurrentMonthAsString();
    }

    public function setBalanceForCurrentMonth()
    {
        $this -> setBalance();
        $this -> setHeader('Twój bilans za bieżący miesiąc');
    }

    public function setBalanceForPreviousMonth()
    {
        $this -> startDate = DateModifier::getFirstDateOfPreviousMonthAsString();
        $this -> endDate = DateModifier::getLastDateOfPreviousMonthAsString();
        $this -> setHeader('Twój bilans za poprzedni miesiąc');
        $this -> setBalance();
    }

    public function setBalanceForCurrentYear()
    {
        $this -> startDate = DateModifier::getFirstDateOfCurrentYearAsString();
        $this -> endDate = DateModifier::getLastDateOfCurrentYearAsString();
        $this -> setHeader('Twój bilans za bieżący rok');
        $this -> setBalance();
    }

    public function setBalanceForCustomPeriod()
    {
        $datesFormValidation = new DatesFormValidation($_POST, BALANCE_MODAL_FORM_FIELDS);

        if ($datesFormValidation -> getMessageOfDatesFormValidation() === ACTION_OK) {
            $this -> startDate = $_POST['startDate'];
            $this -> endDate =  $_POST['endDate'];
            $this -> setHeader('Twój bilans za wybrany okres <br />(od '.$this -> startDate.' do '.$this -> endDate.')');
            $this -> setBalance();
        }

        return $datesFormValidation -> getMessageOfDatesFormValidation();
    }

    public function setHeader($text)
    {
        $_SESSION['balanceHeader'] = $text;
    }

    public function getHeader()
    {
        if (isset($_SESSION['balanceHeader'])) {
            $header = $_SESSION['balanceHeader'];
            return $header;
        } else {
            return null;
        }
    }

    private function setBalance()
    {
        $this -> setIncomes();
        $this -> setExpenses();
    }

    private function setIncomes()
    {
        $_SESSION['incomes'] = $this -> getIncomesFromDatabase();
    }

    private function getIncomesFromDatabase()
    {
        $query = 'SELECT icu.name, SUM(i.amount) as iSum FROM incomes as i, incomes_category_assigned_to_users as icu WHERE icu.user_id=i.user_id AND icu.id = i.income_category_assigned_to_user_id AND i.user_id=:userID AND i.date_of_income>=:startDate AND i.date_of_income<=:endDate GROUP BY icu.name ORDER BY iSUM DESC';

        $parametersToBind = array(':userID' => $_SESSION['loggedInUser'] ->                                 getId(),
                                    ':startDate' => $this -> startDate,
                                    ':endDate' => $this -> endDate);
        
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    private function setExpenses()
    {
        $_SESSION['expenses'] = $this -> getExpensesFromDatabase();
    }

    private function getExpensesFromDatabase()
    {
        $query = 'SELECT ecu.name, SUM(e.amount) as eSum FROM expenses as e, expenses_category_assigned_to_users as ecu WHERE ecu.user_id=e.user_id AND ecu.id = e.expense_category_assigned_to_user_id AND e.user_id=:userID AND e.date_of_expense>=:startDate AND e.date_of_expense<=:endDate GROUP BY ecu.name ORDER BY eSUM DESC';

        $parametersToBind = array(':userID' => $_SESSION['loggedInUser'] ->                                 getId(),
                                    ':startDate' => $this -> startDate,
                                    ':endDate' => $this -> endDate);
        
        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function getHtmlOfIncomesTable()
    {
        $html = '';
        if ($_SESSION['incomes']) {
            foreach ($_SESSION['incomes'] as $income) {
                $incomeAmount = AmountModifier::getNumberFormatWithSpace($income['iSum']);
                $html .= '<tr><td>'.$income['name'].'</td><td class="text-right"><b>'.$incomeAmount.'</b></td></tr>';
            }
            $sum = AmountModifier::getNumberFormatWithSpace($this -> getSumOfIncomes());
            $html .= '<tr><td><b>RAZEM</b></td><td class="text-right"><b>'.$sum.'</b></td></tr>';
            return $html;
        } else {
            return null;
        }
    }

    private function getSumOfIncomes()
    {
        $sum = 0;
        if ($_SESSION['incomes']) {
            foreach ($_SESSION['incomes'] as $income) {
                $sum += $income['iSum'];
            }
        }
        return $sum;
    }


    public function getHtmlOfExpensesTable()
    {
        $html = '';
        if (isset($_SESSION['expenses']) && (!empty($_SESSION['expenses']))) {
            foreach ($_SESSION['expenses'] as $expense) {
                $expenseAmount = AmountModifier::getNumberFormatWithSpace($expense['eSum']);
                $html .= '<tr><td>'.$expense['name'].'</td><td class="text-right"><b>'.$expenseAmount.'</b></td></tr>';
            }
            $sum = AmountModifier::getNumberFormatWithSpace($this -> getSumOfExpenses());
            $html .= '<tr><td><b>RAZEM</b></td><td class="text-right"><b>'.$sum.'</b></td></tr>';
            return $html;
        } else {
            return null;
        }
    }

    private function getSumOfExpenses()
    {
        $sum = 0;
        if (isset($_SESSION['expenses'])) {
            foreach ($_SESSION['expenses'] as $expense) {
                $sum += $expense['eSum'];
            }
        }
        return $sum;
    }

    public function getDifference()
    {
        $incomes = $this -> getSumOfIncomes();
        $expenses = $this -> getSumOfExpenses();

        return AmountModifier::getNumberFormatWithSpace($incomes - $expenses);
    }

    public function getDataPointsOfExpensesChart()
    {
        $sum = $this -> getSumOfExpenses();
        
        $chartGenerator = new ChartGenerator();
        if (isset($_SESSION['expenses'])) {
            foreach ($_SESSION['expenses'] as $row) {
                $point = array("y" => $row['eSum']/ $sum * 100, "label" => $row['name']);
                $chartGenerator -> setDataPoint($point);
            }
        }
        
        return $chartGenerator -> getDataPoints();
    }
}