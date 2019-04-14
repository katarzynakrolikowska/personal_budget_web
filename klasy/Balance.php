<?php

class Balance
{
    private $startDate = null;
    private $endDate = null;
    private $incomeQueryGenerator = null;
    private $expenseQueryGenerator = null;

    public function __construct($dbo, $user)
    {
        $this -> incomeQueryGenerator = new IncomeQueryGenerator($dbo, $user);
        $this -> expenseQueryGenerator = new ExpenseQueryGenerator($dbo, $user);
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

    public function getMessageOfBalanceSettingsForCustomPeriod()
    {
        $datesFormValidation = new DatesFormValidation($_POST, SELECT_PERIOD_MODAL_FORM_FIELDS);

         if ($datesFormValidation -> getMessageOfDatesFormValidation() === ACTION_OK) {
            $this -> setBalanceForCustomPeriod();
        }
        return $datesFormValidation -> getMessageOfDatesFormValidation();
    }

    public function setBalanceForCustomPeriod()
    {
        $this -> startDate = $_POST['startDate'];
        $this -> endDate =  $_POST['endDate'];
        $this -> setHeader('Twój bilans za wybrany okres <br />(od '.$this -> startDate.' do '.$this -> endDate.')');
        $this -> setBalance();
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
        $this -> setDatesOfBalance();
        $this -> setIncomes();
        $this -> setExpenses();
    }

    private function setDatesOfBalance()
    {
        $_SESSION['startDate'] = $this -> startDate;
        $_SESSION['endDate'] = $this -> endDate;
    }

    private function getStartDate()
    {
        if (isset($_SESSION['startDate'])) {
            return $_SESSION['startDate'];
        } else {
            return null;
        }
    }

    private function getEndDate()
    {
        if (isset($_SESSION['endDate'])) {
            return $_SESSION['endDate'];
        } else {
            return null;
        }
    }

    private function setIncomes()
    {
        $_SESSION['incomes'] = $this -> getIncomesFromDatabase();
    }

    private function getIncomesFromDatabase()
    {      
        return $this -> incomeQueryGenerator -> getIncomesGroupedByCategoryForSelectedPeriod($this -> startDate, $this -> endDate);
    }

    private function setExpenses()
    {
        $_SESSION['expenses'] = $this -> getExpensesFromDatabase();
    }

    private function getExpensesFromDatabase()
    {
        return $this -> expenseQueryGenerator -> getExpensesGroupedByCategoryForSelectedPeriod($this -> startDate, $this -> endDate);
    }

    public function getHtmlOfIncomesTableRows()
    {
        $incomes = $this -> getIncomes();
        $html = '';
        $index = 1;

        if ($incomes) {
            $sum = AmountModifier::getNumberFormatWithSpace($this -> getSumOfIncomes());

            foreach ($incomes as $income) {
                $html .= HtmlGenerator::getHtmlOfSummedIncomesTableRow($income, $index);

                $deteiledIncomes = $this -> getDetailedIncomesOfSelectedCategory($income['name']);

                $html .= HtmlGenerator::getHtmlOfDetailedIncomesRows($deteiledIncomes, $index);

                $index ++;
            }
            $html .= HtmlGenerator::getHtmlOfSummaryRow($sum);
        }
        return $html;
    }

    private function getIncomes()
    {
        if (isset($_SESSION['incomes'])) {
            return $_SESSION['incomes'];
        } else {
            return null;
        }
    }

    private function getDetailedIncomesOfSelectedCategory($category)
    {
        return $this -> incomeQueryGenerator -> getDetailedIncomesOfSelectedCategoryAndPeriod($category, $this -> getStartDate(), $this -> getEndDate());
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

    public function getHtmlOfExpensesTableRows()
    {
        $expenses = $this -> getExpenses();
        $html = '';
        $index = 1;

        if ($expenses) {
            $sum = AmountModifier::getNumberFormatWithSpace($this -> getSumOfExpenses());

            foreach ($expenses as $expense) {
                $html .= HtmlGenerator::getHtmlOfSummedExpensesTableRow($expense, $index);

                $deteiledExpenses = $this -> getDetailedExpensesOfSelectedCategory($expense['name']);

                $html .= HtmlGenerator::getHtmlOfDetailedExpensesRows($deteiledExpenses, $index);

                $index ++;
            }
            $html .= HtmlGenerator::getHtmlOfSummaryRow($sum);
        }
        return $html;
    }

    private function getExpenses()
    {
        if (isset($_SESSION['expenses'])) {
            return $_SESSION['expenses'];
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

    private function getDetailedExpensesOfSelectedCategory($category)
    {
        return $this -> expenseQueryGenerator -> getDetailedExpensesOfSelectedCategoryAndPeriod($category, $this -> getStartDate(), $this -> getEndDate());
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