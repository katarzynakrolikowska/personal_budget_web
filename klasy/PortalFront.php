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
        $this -> initiateForLogInUser();
    }

    public function getActualUser()
    {
        if (isset($_SESSION['loggedInUser'])) {
            return $_SESSION['loggedInUser'];
        } else {
            return null;
        }
    }

    private function initiateForLogInUser()
    {
        if (isset($this -> loggedInUser)) {
            $this -> balance = new Balance($this -> dbo, $this -> loggedInUser);
            $this -> personalisedOptions = new PersonalisedOptions($this -> dbo, $this -> loggedInUser);
            $this -> settings = new Settings($this -> dbo, $this -> loggedInUser);
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
        $categories = $this -> getIncomeCategoriesAssignedToUser();

        return HtmlGenerator::getHtmlOfOptionsForIncomeCategories($categories);
    }

    private function setIncomeCategoriesAssignedToUser()
    {
        $this -> personalisedOptions -> setIncomeCategoriesAssignedToUser($this -> loggedInUser);
    }

    private function getIncomeCategoriesAssignedToUser()
    {
        return $this -> personalisedOptions -> getIncomeCategoriesAssignedToUser();
    }

    public function getHtmlOfOptionsForExpenseCategories()
    {
        $this -> setExpenseCategoriesAssignedToUser();
        $categories = $this -> getExpenseCategoriesAssignedToUser();

        return HtmlGenerator::getHtmlOfOptionsForExpenseCategories($categories);
    }

    private function setExpenseCategoriesAssignedToUser()
    { 
        $this -> personalisedOptions -> setExpenseCategoriesAssignedToUser($this -> loggedInUser);
    }

    private function getExpenseCategoriesAssignedToUser()
    {
        return $this -> personalisedOptions -> getExpenseCategoriesAssignedToUser();
    }

    public function getHtmlOfOptionsForPaymentMethods()
    {
        $this -> setPaymentMethodsAssignedToUser();
        $methods = $this -> getPaymentMethodsAssignedToUser();

        return HtmlGenerator::getHtmlOfOptionsForPaymentMethods($methods);
    }

    private function setPaymentMethodsAssignedToUser()
    {
        $this -> personalisedOptions -> setPaymentMethodsAssignedToUser($this -> loggedInUser);
    }

    private function getPaymentMethodsAssignedToUser()
    {
        return $this -> personalisedOptions -> getPaymentMethodsAssignedToUser();
    }

    public function addIncome()
    {
        $incomeAddition = new IncomeAddition($this -> dbo, $this -> loggedInUser);
        return $incomeAddition -> addIncome();
    }

    public function addExpense()
    {
        $expenseAddition = new ExpenseAddition($this -> dbo, $this -> loggedInUser);
        return $expenseAddition -> addExpense();
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

    public function getMessageOfBalanceSettingsForCustomPeriod()
    {
        return $this -> balance -> getMessageOfBalanceSettingsForCustomPeriod();
    }

    public function getHtmlOfIncomesTableRows()
    {
        return $this -> balance -> getHtmlOfIncomesTableRows();
    }

    public function getHtmlOfExpensesTableRows()
    {
        return $this -> balance -> getHtmlOfExpensesTableRows();
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

    public function editIncome($incomeId)
    {
        $incomeEdition = new IncomeEdition($this -> dbo, $this -> loggedInUser);
        return $incomeEdition -> editIncome($incomeId);
    }

    public function deleteIncome($incomeId)
    {
        $incomeDeletion = new IncomeDeletion($this -> dbo, $this -> loggedInUser);
        $incomeDeletion -> deleteIncome($incomeId);
    }

    public function editExpense($expenseId)
    {
        $expenseEdition = new ExpenseEdition($this -> dbo, $this -> loggedInUser);
        return $expenseEdition -> editExpense($expenseId);
    }

    public function deleteExpense($expenseId)
    {
        $expenseDeletion = new ExpenseDeletion($this -> dbo, $this -> loggedInUser);
        $expenseDeletion -> deleteExpense($expenseId);
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

    public function getHtmlOfIncomeCategoriesList()
    {
        $this -> setIncomeCategoriesAssignedToUser();
        return HtmlGenerator::getHtmlOfDataArrayList($this -> getIncomeCategoriesAssignedToUser());
    }

    public function getHtmlOfPaymentMethodsList()
    {
        $this -> setPaymentMethodsAssignedToUser();
        return HtmlGenerator::getHtmlOfDataArrayList($this -> getPaymentMethodsAssignedToUser());
    }

    public function getHtmlOfExpenseCategoriesList()
    {
        $this -> setExpenseCategoriesAssignedToUser();
        return HtmlGenerator::getHtmlOfDataArrayList($this -> getExpenseCategoriesAssignedToUser());
    }

    public function editOption($editionContent)
    {
        switch ($editionContent):
            case 'income':
                return $this -> settings -> editIncomeCategory($this -> getIncomeCategoriesAssignedToUser());
            case 'expense':
                return $this -> settings -> editExpenseCategory($this -> getExpenseCategoriesAssignedToUser());
            case 'paymentMethod':
                return $this -> settings -> editPaymentMethod($this -> getPaymentMethodsAssignedToUser());
        endswitch;
    }

    public function addOption($editionContent)
    {
        switch ($editionContent):
            case 'income':
                return $this -> settings -> addIncomeCategory($this -> getIncomeCategoriesAssignedToUser());
            case 'expense':
                return $this -> settings -> addExpenseCategory($this -> getExpenseCategoriesAssignedToUser());
            case 'paymentMethod':
                return $this -> settings -> addPaymentMethod($this -> getPaymentMethodsAssignedToUser());
        endswitch;
    }

    public function deleteOption($editionContent)
    {
        switch ($editionContent):
            case 'income':
                return $this -> settings -> deleteIncomeCategory($this -> getIncomeCategoriesAssignedToUser());
            case 'expense':
                return $this -> settings -> deleteExpenseCategory($this -> getExpenseCategoriesAssignedToUser());
            case 'paymentMethod':
                return $this -> settings -> deletePaymentMethod($this -> getPaymentMethodsAssignedToUser());
        endswitch;
    }

    public function deleteOptionWithoutValidation($editionContent, $optionIdToRemove)
    {
        switch ($editionContent):
            case 'income':
                return $this -> settings -> deleteIncomeCategoryWithoutValidation($optionIdToRemove);
            case 'expense':
                return $this -> settings -> deleteExpenseCategoryWithoutValidation($optionIdToRemove);
            case 'paymentMethod':
                return $this -> settings -> deletePaymentMethodWithoutValidation($optionIdToRemove);
        endswitch;
    }
}