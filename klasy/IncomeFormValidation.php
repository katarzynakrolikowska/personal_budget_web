<?php

class IncomeFormValidation extends DataArrayValidation
{
    private $categoriesAssignedToUser = null;
    
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields,$personalisedOptions)
    {
        parent:: __construct($sendedFieldsFromForm, $namesOfRequiredFields);
        $this -> categoriesAssignedToUser = $personalisedOptions -> getIncomeCategoriesAssignedToUser();
    }

    public function getMessageOfEditFormValidation()
    {
        $message = $this -> getMessageOfFormValidation();

        $this -> unsetSessionFieldsFromForm();
        $this -> unsetSessionErrorsOfFieldsFromForm();

        return $message;
    }

    public function getMessageOfFormValidation()
    {
        if ($this -> isRequiredFieldsFromFormMissing()) {
           return FORM_DATA_MISSING;
        }
        
        if (!$this -> isValidIncomeData()) {
           return INVALID_DATA;
        }
        $this -> unsetSessionFieldsFromForm();
        return ACTION_OK;
    }

    private function isValidIncomeData()
    {
        if ($this -> isValidDataFromForm($this -> getValidationObjects())) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $amountValidation = new AmountValidation($this -> sendedFieldsFromForm['amount'], 'amount');
        $dateValidation = new DateValidation($this -> sendedFieldsFromForm['date'], 'date');
        $categoryValidation = new InputSelectValidation($this -> sendedFieldsFromForm['category'], 'category', $this -> categoriesAssignedToUser);

        return $validationObjects = array($amountValidation, 
                                        $dateValidation, 
                                        $categoryValidation);
    }
}