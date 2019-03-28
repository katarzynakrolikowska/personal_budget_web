<?php

class PortalFront extends Portal
{
    public $loggedInUser = null;
    private $balnce = null;

    public function __construct($host, $user, $pass, $db)
    {
        $this -> dbo = $this -> connect($host, $user, $pass, $db);
        $this -> loggedInUser = $this -> getActualUser();
        $this -> balance = new Balance($this -> dbo);
    }

    
    public function getActualUser()
    {
        if (isset($_SESSION['loggedInUser'])) {
            return $_SESSION['loggedInUser'];
        } else {
            return null;
        }
    }

    public function setMessage($message)
    {
        $_SESSION['message'] = $message;
    }

    public function getMessage()
    {
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
            return $message;
        } else {
            return null;
        }
    }

    public function logIn()
    {
        $logOperation = new LogOperation($this -> dbo);
        return $logOperation -> login();
    }

    public function logOut()
    {
        $this -> loggedInUser = null;
        $_SESSION = array();
    }

    public function registerUser()
    {
        $registration = new Registration($this -> dbo);
        return $registration -> registerUser();
    }

    public function setSessionForIncomeOptionsAssignedToUser()
    {
        $incomeInsertion = new IncomeInsertion($this -> dbo);

        $_SESSION['incomeCategories'] = $incomeInsertion -> getIncomeCategoriesAssignedToUser($this -> loggedInUser);
    }

    public function addIncome()
    {
        $incomeInsertion = new IncomeInsertion($this -> dbo);
        return $incomeInsertion -> addIncome();
    }

    public function setSessionForExpenseOptionsAssignedToUser()
    {
        $expenseInsertion = new ExpenseInsertion($this -> dbo);

        $_SESSION['expenseCategories'] = $expenseInsertion -> getExpenseCategoriesAssignedToUser($this -> loggedInUser);

        $_SESSION['paymentMethods'] = $expenseInsertion -> getPaymentMethodsAssignedToUser($this -> loggedInUser);
    }

    public function addExpense()
    {
        $expenseInsertion = new ExpenseInsertion($this -> dbo);
        return $expenseInsertion -> addExpense();
    }

    public function setBalanceForCurrentMonth()
    {
        $this -> balance -> setBalanceForCurrentMonth();
    }

    public function setBalanceForPreviousMonth()
    {
        $this -> balance -> setBalanceForPreviousMonth();
    }

    public function setBalanceForCurrentYear()
    {
        $this -> balance -> setBalanceForCurrentYear();
    }

    public function setBalanceForCustomPeriod()
    {
        return $this -> balance -> setBalanceForCustomPeriod();
    }

    public function getHtmlOfIncomeTable()
    {
        return $this -> balance -> getHtmlOfIncomesTable();
    }

    public function getHtmlOfExpensesTable()
    {
        return $this -> balance -> getHtmlOfExpensesTable();
    }

    public function getDifference()
    {
        return $this -> balance -> getDifference();
    }

    public function getBalanceHeader()
    {
        return $this -> balance -> getHeader();
    }

    public function getDataPointsForExpensesChart()
    {
        return $this -> balance -> getDataPointsOfExpensesChart();
    }

    public function editUserData($editedItem)
    {
       $settings = new Settings($this -> dbo, $this -> loggedInUser);

        switch ($editedItem):
            case 'name':
                return $settings -> editUserName();
            case 'login':
                return $settings -> editUserLogin();
            case 'password':
                return $settings -> editUserPassword();
        endswitch;
    }

        
}