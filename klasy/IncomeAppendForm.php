<?php

class IncomeAppendForm
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

        //$_POST = array();

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
        $amountValidation = new AmountValidation($this -> income -> getAmount());
        $dateValidation = new DateValidation($this -> income -> getTransferDate());
        $categoryValidation = new InputSelectValidation($this -> income -> getCategory(), $_SESSION['incomeCategories']);

        return $validationObjects = array('errorAmount' => $amountValidation, 'errorDate' => $dateValidation, 'errorCategory' => $categoryValidation);
    }



    public function getIncomeCategoriesAssignedToUser($user)
    {
        $query = 'SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id=?';

        $parametersToBind = array($user -> getId() => PDO::PARAM_INT);

        return $this -> myDB -> getQueryResult($query, $parametersToBind);
    }

    private function insertDataIntoDatabase()
    {
        $query = 'INSERT INTO incomes VALUES(NULL, ?, ?, ?, ?, ?)';

        $parametersToBind = array($_SESSION['loggedInUser'] -> getId() =>                           PDO::PARAM_INT, 
                            $this -> income -> getCategory() => PDO::PARAM_INT,
                            $this -> income -> getAmount() => PDO::PARAM_STR, 
                            $this -> income -> getTransferDate() => PDO::PARAM_STR, 
                            $this -> income -> getComment() => PDO::PARAM_STR);

        $this -> myDB -> executeQuery($query, $parametersToBind);
    }
    
    
    
        
    
}