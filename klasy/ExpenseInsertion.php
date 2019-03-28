<?php

class ExpenseInsertion
{
    private $dbo = null;
    private $myDB = null;
    private $expense = null;
    private $dataArrayValidation = null;
        
   
    public function __construct($dbo)
    {
        $this -> dbo = $dbo;
        $this -> myDB = new MyDB($this -> dbo);
        $this -> expense = new Expense();
        $this -> dataArrayValidation = new DataArrayValidation($_POST, EXPENSE_FORM_FIELDS);
    }

    public function addExpense()
    {
        if ($this -> isRequiredDataMissing()) {
            return FORM_DATA_MISSING;
        }

        $this -> setExpense($_POST['amount'], $_POST['date'], $_POST['paymentMethod'], $_POST['category'], $_POST['comment']);
        
        
        if (!$this -> isValidExpenseData()) {
            return INVALID_DATA;
        }

        $this -> insertDataIntoDatabase();
        $this -> dataArrayValidation -> unsetSessionFieldsFromForm();

        return ACTION_OK;
    }

    private function isRequiredDataMissing()
    {
        if ($this -> dataArrayValidation -> isRequiredFieldsFromFormMissing()) {
            return true;
        } else {
            return false;
        }
    }

    private function setExpense($amount, $date, $paymentMethod, $category, $comment)
    {
        $this -> expense -> setAmount($amount);
        $this -> expense -> setTransferDate($date);
        $this -> expense -> setPaymentMethod($paymentMethod);
        $this -> expense -> setCategory($category);
        $this -> expense -> setComment($comment);
    }

    private function isValidExpenseData()
    {
        if ($this -> dataArrayValidation -> isValidDataFromForm($this -> getValidationObjects())) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $amountValidation = new AmountValidation($this -> expense -> getAmount(), 'amount');
        $dateValidation = new DateValidation($this -> expense -> getTransferDate(), 'date');
        $paymentMethodValidation = new InputSelectValidation($this -> expense -> getPaymentMethod(), 'paymentMethod', $_SESSION['paymentMethods']);
        $categoryValidation = new InputSelectValidation($this -> expense -> getCategory(), 'category', $_SESSION['expenseCategories']);

        return $validationObjects = array($amountValidation,                                                      $dateValidation,
                                          $paymentMethodValidation, 
                                          $categoryValidation);
    }

    public function getExpenseCategoriesAssignedToUser($user)
    {
        $query = 'SELECT id, name FROM expenses_category_assigned_to_users WHERE user_id=:id';

        $parametersToBind = array(':id' => $user -> getId());

        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    public function getPaymentMethodsAssignedToUser($user)
    {
        $query = 'SELECT id, name FROM payment_methods_assigned_to_users WHERE user_id=:id';

        $parametersToBind = array(':id' => $user -> getId());

        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    private function insertDataIntoDatabase()
    {
        $query = 'INSERT INTO expenses VALUES(NULL, :userID, :categoryID, :paymentID, :amount, :date, :comment)';

        $parametersToBind = array(':userID' => $_SESSION['loggedInUser'] ->                          getId(), 
                            ':categoryID' => $this -> expense -> getCategory(),
                            ':paymentID' => $this -> expense -> getPaymentMethod(),
                            ':amount' => $this -> expense -> getAmount(), 
                            ':date' => $this -> expense -> getTransferDate(), 
                            ':comment' => $this -> expense -> getComment());

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }
}