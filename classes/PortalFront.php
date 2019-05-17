<?php

class PortalFront extends Portal
{
    public $loggedInUser = null;
    private $validFormFields = null;
    private $inputValues = null;
    private $balance = null;
    private $personalisedOptions = null;
    private $settings = null;

    public function __construct($host, $user, $pass, $db)
    {
        $this -> dbo = $this -> connect($host, $user, $pass, $db);
        $this -> loggedInUser = $this -> getActualUser();
        $this -> initiationOfLoggedInUser();
    }

    public function getActualUser()
    {
        if (isset($_SESSION['loggedInUser'])) {
            return $_SESSION['loggedInUser'];
        } else {
            return null;
        }
    }

    private function initiationOfLoggedInUser()
    {
        if (isset($this -> loggedInUser)) {
            $this -> balance = new Balance($this -> dbo, $this -> loggedInUser);
            $this -> personalisedOptions = new PersonalisedOptions($this -> dbo, $this -> loggedInUser);
            $this -> settings = new Settings($this -> dbo, $this -> loggedInUser);
        }
    }

    public function setMessage($msg)
    {
        $_SESSION['message'] = $msg;
    }

    public function getMessage()
    {
        if (isset($_SESSION['message'])) {
            $msg = $_SESSION['message'];
            unset($_SESSION['message']);
            return $msg;
        } else {
            return null;
        }
    }

    public function logIn()
    {
        $logOperation = new LogOperation($this -> dbo);
        $msg = $logOperation -> logIn();
        $this -> setValuesOfInvalidForm($logOperation);

        return $msg;
    }

    public function setValuesOfInvalidForm($objAction)
    {
        $this -> inputValues = $objAction -> getInputValues();
        $this -> validFormFields = $objAction -> getValidFields();
    }

    public function setSessionOfInvalidForm()
    {
        $this -> setSessionOfInputValues();
        $this -> setSessionErrorsOfInvalidFormFields();
    }

    public function setSessionOfInputValues()
    {
        foreach ($this -> inputValues as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public function setSessionErrorsOfInvalidFormFields()
    {
        foreach ($this -> validFormFields as $key => $value) {
            if (!$value) {
                $key = ucfirst($key);
                $_SESSION['error'.$key] = '';
            }
        }
    }

    public function logOut()
    {
        $this -> loggedInUser = null;
        $_SESSION = array();
    }

    public function registerUser()
    {
        $registration = new Registration($this -> dbo);
        $msg = $registration -> registerUser();
        $this -> setValuesOfInvalidForm($registration);

        return $msg;
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
        $msg = $incomeAddition -> addIncome();
        $this -> setValuesOfInvalidForm($incomeAddition);

        return $msg;
    }

    public function addExpense()
    {
        $expenseAddition = new ExpenseAddition($this -> dbo, $this -> loggedInUser);
        $msg = $expenseAddition -> addExpense();
        $this -> setValuesOfInvalidForm($expenseAddition);

        return $msg;
    }

    public function setJsonFormMessage($result)
    {
        header('Content-type: application/json');

        $showModal = false;
        $msg = $this -> getMessage();
        if ($result === ACTION_OK) {
            $showModal = true;
            
        }   
        echo json_encode([
			'success' => true,
            'showModal' => $showModal,
            'msg' => $msg,
            'validFields' => $this -> validFormFields
           
		]);
    }

    public function setJsonMsgIsOptionUsed($result)
    {
        header('Content-type: application/json');
        echo json_encode([
			'success' => true,
            'optionUsed' => $result
		]);
    }

    public function setLimitValuesOfExpenseCategory($categoryId, $inputDateOfExpense)
    {
        $limitInfo = new ExpenseCategoryLimit($this -> dbo, $this -> loggedInUser);
        $limitInfo -> setLimitValuesOfExpenseCategory($categoryId, $inputDateOfExpense);
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

    public function getLabelsOfExpensesChart()
    {
        return $this -> balance -> getLabelsOfExpensesChart();
    }

    public function getDataOfExpensesChart()
    {
        return $this -> balance -> getDataOfExpensesChart();
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
        $msg = $expenseEdition -> editExpense($expenseId);
        $this -> setValuesOfInvalidForm($expenseEdition);

        return $msg;
    }

    public function deleteExpense($expenseId)
    {
        $expenseDeletion = new ExpenseDeletion($this -> dbo, $this -> loggedInUser);
        $expenseDeletion -> deleteExpense($expenseId);
    }

    public function editUserData($editedUserdata)
    {
        switch ($editedUserdata):
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

    public function getHtmlOfIncomeCategoryEditionModal()
    {
        $options = $this -> getHtmlOfOptionsForIncomeCategories();
        return ModalGenerator::getHtmlOfIncomeCategoryEditionModal($options);
    }

    public function getHtmlOfIncomeCategoryAdditionModal()
    {
        return ModalGenerator::getHtmlOfIncomeCategoryAdditionModal();
    }

    public function getHtmlOfIncomeCategoryDeletionModal()
    {
        $options = $this -> getHtmlOfOptionsForIncomeCategories();
        return ModalGenerator::getHtmlOfIncomeCategoryDeletionModal($options);
    }

    public function getHtmlOfPaymentMethodEditionModal()
    {
        $options = $this -> getHtmlOfOptionsForPaymentMethods();
        return ModalGenerator::getHtmlOfPaymentMethodEditionModal($options);
    }

    public function getHtmlOfPaymentMethodAdditionModal()
    {
        return ModalGenerator::getHtmlOfPaymentMethodAdditionModal();
    }

    public function getHtmlOfPaymentMethodDeletionModal()
    {
        $options = $this -> getHtmlOfOptionsForPaymentMethods();
        return ModalGenerator::getHtmlOfPaymentMethodDeletionModal($options);
    }

    public function getHtmlOfExpenseCategorySettingsLimitModal()
    {
        $options = $this -> getHtmlOfOptionsForExpenseCategories();
        return ModalGenerator::getHtmlOfExpenseCategorySettingsLimitModal($options);
    }

    public function getHtmlOfExpenseCategoryEditionModal()
    {
        $options = $this -> getHtmlOfOptionsForExpenseCategories();
        return ModalGenerator::getHtmlOfExpenseCategoryEditionModal($options);
    }

    public function getHtmlOfExpenseCategoryAdditionModal()
    {
        return ModalGenerator::getHtmlOfExpenseCategoryAdditionModal();
    }

    public function getHtmlOfExpenseCategoryDeletionModal()
    {
        $options = $this -> getHtmlOfOptionsForExpenseCategories();
        return ModalGenerator::getHtmlOfExpenseCategoryDeletionModal($options);
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

    public function isOptionUsed($editionContent, $optionId)
    {
        switch ($editionContent):
            case 'income':
                return $this -> settings -> isIncomeCategoryUsed($optionId);
            case 'expense':
                return $this -> settings -> isExpenseCategoryUsed($optionId);
            case 'paymentMethod':
                return $this -> settings -> isPaymentMethodUsed($optionId);
        endswitch;
    }

    public function setLimitOfExpenseCategory()
    {
        return $this -> settings -> setLimitOfExpenseCategory($this -> getExpenseCategoriesAssignedToUser());
    }
}