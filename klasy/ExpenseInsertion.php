<?php

class ExpenseInsertion
{
    private $dbo = null;
    private $expense = null;
    private $dataArrayValidation = null;
    private $userId = null;
   
    public function __construct($dbo, $id)
    {
        $this -> dbo = $dbo;
        $this -> userId = $id;
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
        $personalisedOptions = new PersonalisedOptions($this -> dbo, $this -> userId);

        $amountValidation = new AmountValidation($this -> expense -> getAmount(), 'amount');
        $dateValidation = new DateValidation($this -> expense -> getTransferDate(), 'date');
        $paymentMethodValidation = new InputSelectValidation($this -> expense -> getPaymentMethod(), 'paymentMethod', $personalisedOptions -> getPaymentMethodsAssignedToUser());
        $categoryValidation = new InputSelectValidation($this -> expense -> getCategory(), 'category', $personalisedOptions -> getExpenseCategoriesAssignedToUser());

        return $validationObjects = array($amountValidation,                                                      $dateValidation,
                                          $paymentMethodValidation, 
                                          $categoryValidation);
    }

    private function insertDataIntoDatabase()
    {
        $myDB = new MyDB($this -> dbo);
        $query = 'INSERT INTO expenses VALUES(NULL, :userID, :categoryID, :paymentID, :amount, :date, :comment)';

        $parametersToBind = array(':userID' => $this -> userId, 
                            ':categoryID' => $this -> expense -> getCategory(),
                            ':paymentID' => $this -> expense -> getPaymentMethod(),
                            ':amount' => $this -> expense -> getAmount(), 
                            ':date' => $this -> expense -> getTransferDate(), 
                            ':comment' => $this -> expense -> getComment());

        $myDB -> executeQuery($query, $parametersToBind);
    }
}