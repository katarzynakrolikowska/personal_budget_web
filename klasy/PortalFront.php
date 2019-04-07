<?php

class PortalFront extends Portal
{
    public $loggedInUser = null;
    private $balance = null;
    private $personalisedOptions = null;
    private $settings = null;

    public function __construct($host, $user, $pass, $db)
    {
        $this -> dbo = $this -> connect($host, $user, $pass, $db);
        $this -> loggedInUser = $this -> getActualUser();
        $this -> balance = new Balance($this -> dbo);
        $this -> personalisedOptions = new PersonalisedOptions($this -> dbo, $this -> loggedInUser -> getId());
        $this -> settings = new Settings($this -> dbo, $this -> loggedInUser);
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

    public function getHtmlOfOptionsForIncomeCategories()
    {
        $this -> setIncomeCategoriesAssignedToUser();

        if (!isset($_SESSION['category'])) {
            $_SESSION['category'] = null;
        }

        $categories = $this -> personalisedOptions -> getIncomeCategoriesAssignedToUser();
        
        $html = HtmlGenerator::getHtmlOfOptionsWithSelectedOption($categories, $_SESSION['category']);
        
        unset($_SESSION['category']);

        return $html;
    }

    public function setIncomeCategoriesAssignedToUser()
    {
        $this -> personalisedOptions -> setIncomeCategoriesAssignedToUser($this -> loggedInUser);
    }

    public function addIncome()
    {
        $incomeInsertion = new IncomeInsertion($this -> dbo, $this -> loggedInUser -> getId());
        return $incomeInsertion -> addIncome();
    }

    public function getHtmlOfOptionsForExpenseCategories()
    {
        $this -> setExpenseCategoriesAssignedToUser();

        $html = HtmlGenerator::getHtmlOfOptionsWithSelectedOption($this -> personalisedOptions -> getExpenseCategoriesAssignedToUser(), $_SESSION['category']);

        unset($_SESSION['category']);

        return $html;
    }

    public function setExpenseCategoriesAssignedToUser()
    {
        $this -> personalisedOptions -> setExpenseCategoriesAssignedToUser($this -> loggedInUser);
    }

    public function getHtmlOfOptionsForPaymentMethods()
    {
        $this -> setPaymentMethodsAssignedToUser();

        $html = HtmlGenerator::getHtmlOfOptionsWithSelectedOption($this -> personalisedOptions -> getPaymentMethodsAssignedToUser(), $_SESSION['paymentMethod']);

        unset($_SESSION['paymentMethod']);
        
        return $html;
    }

    public function setPaymentMethodsAssignedToUser()
    {
        $this -> personalisedOptions -> setPaymentMethodsAssignedToUser($this -> loggedInUser);
    }

    public function addExpense()
    {
        $expenseInsertion = new ExpenseInsertion($this -> dbo, $this -> loggedInUser -> getId());
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
        switch ($editedItem):
            case 'name':
                return $this -> settings -> editUserName();
            case 'login':
                return $this -> settings -> editUserLogin();
            case 'password':
                return $this -> settings -> editUserPassword();
        endswitch;
    }

    public function getHtmlOfIncomeList()
    {
        $this -> setIncomeCategoriesAssignedToUser();
        return HtmlGenerator::getHtmlOfDataArrayList($this -> personalisedOptions -> getIncomeCategoriesAssignedToUser());
    }

    public function editOption($editionContent)
    {
        switch ($editionContent):
            case 'income':
                return $this -> settings -> editIncomeCategory($this -> personalisedOptions -> getIncomeCategoriesAssignedToUser());
            case 'expense':
                return $this -> settings -> editExpenseCategory();
            case 'paymentMethod':
                return $this -> settings -> editPaymentMethod();
        endswitch;
    }

    public function addOption($editionContent)
    {
        switch ($editionContent):
            case 'income':
                return $this -> settings -> addIncomeCategory($this -> personalisedOptions -> getIncomeCategoriesAssignedToUser());
            case 'expense':
                return $this -> settings -> addExpenseCategory();
            case 'paymentMethod':
                return $this -> settings -> addPaymentMethod();
        endswitch;
    }

    public function deleteOption($editionContent)
    {
        switch ($editionContent):
            case 'income':
                return $this -> settings -> deleteIncomeCategory($this -> personalisedOptions -> getIncomeCategoriesAssignedToUser());
            case 'expense':
                return $this -> settings -> deleteExpenseCategory();
            case 'paymentMethod':
                return $this -> settings -> deletePaymentMethod();
        endswitch;
    }

    public function deleteOptionWithoutValidation($editionContent, $optionIdToRemove)
    {
        switch ($editionContent):
            case 'income':
                return $this -> settings -> deleteIncomeCategoryWithoutValidation($optionIdToRemove);
            case 'expense':
                return $this -> settings -> deleteExpenseCategoryWithoutValidation();
            case 'paymentMethod':
                return $this -> settings -> deletePaymentMethodWithoutValidation();
        endswitch;
    }

        
}