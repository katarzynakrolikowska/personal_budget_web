<?php

class IncomeInsertion
{
    private $dbo = null;
    private $myDB = null;
    private $income = null;
    private $dataArrayValidation = null;
        
   
    public function __construct($dbo)
    {
        $this -> dbo = $dbo;
        $this -> myDB = new MyDB($this -> dbo);
        $this -> income = new Income();
        $this -> dataArrayValidation = new DataArrayValidation($_POST, INCOME_FORM_FIELDS);
    }

    public function addIncome()
    {
        if ($this -> isRequiredDataMissing()) {
            return FORM_DATA_MISSING;
        }

        $this -> setIncome($_POST['amount'], $_POST['date'], $_POST['category'], $_POST['comment']);
        
        
        if (!$this -> isValidIncomeData()) {
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

    private function setIncome($amount, $date, $category, $comment)
    {
        $this -> income -> setAmount($amount);
        $this -> income -> setTransferDate($date);
        $this -> income -> setCategory($category);
        $this -> income -> setComment($comment);
    }

    private function isValidIncomeData()
    {
        if ($this -> dataArrayValidation -> isValidDataFromForm($this -> getValidationObjects())) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $amountValidation = new AmountValidation($this -> income -> getAmount(), 'amount');
        $dateValidation = new DateValidation($this -> income -> getTransferDate(), 'date');
        $categoryValidation = new InputSelectValidation($this -> income -> getCategory(), 'category', $_SESSION['incomeCategories']);

        return $validationObjects = array($amountValidation, 
                                        $dateValidation, 
                                        $categoryValidation);
    }



    public function getIncomeCategoriesAssignedToUser($user)
    {
        $query = 'SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id=:id';

        $parametersToBind = array(':id' => $user -> getId());

        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    private function insertDataIntoDatabase()
    {
        $query = 'INSERT INTO incomes VALUES(NULL, :userID, :categoryID, :amount, :date, :comment)';

        $parametersToBind = array(':userID' => $_SESSION['loggedInUser'] ->                          getId(), 
                            ':categoryID' => $this -> income -> getCategory(),
                            ':amount' => $this -> income -> getAmount(), 
                            ':date' => $this -> income -> getTransferDate(), 
                            ':comment' => $this -> income -> getComment());

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }
    
}