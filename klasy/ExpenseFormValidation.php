<?php

class ExpenseFormValidation extends DataArrayValidation
{
    private $categoriesAssignedToUser = null;
    private $payMethodsAssignedToUser = null;
    
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields,$personalisedOptions)
    {
        parent:: __construct($sendedFieldsFromForm, $namesOfRequiredFields);
        $this -> categoriesAssignedToUser = $personalisedOptions -> getExpenseCategoriesAssignedToUser();
        $this -> payMethodsAssignedToUser = $personalisedOptions -> getPaymentMethodsAssignedToUser();
    }

    public function getMessageOfEditFormValidation()
    {
        $message = $this -> getMessageOfFormValidation();

        $this -> unsetSessionErrorsOfFieldsFromForm();
        $this -> unsetSessionFieldsFromForm();
        
        return $message;
    }

    public function getMessageOfFormValidation()
    {
        if ($this -> isRequiredFieldsFromFormMissing()) {
            return FORM_DATA_MISSING;
        }

        if (!$this -> isValidExpenseData()) {
            return INVALID_DATA;
        }

        $this -> unsetSessionFieldsFromForm();
        return ACTION_OK;
    }

    private function isValidExpenseData()
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
        $paymentMethodValidation = new InputSelectValidation($this -> sendedFieldsFromForm['paymentMethod'], 'paymentMethod', $this -> payMethodsAssignedToUser);
        $categoryValidation = new InputSelectValidation($this -> sendedFieldsFromForm['category'], 'category', $this -> categoriesAssignedToUser);

        return $validationObjects = array($amountValidation, 
                                        $dateValidation,
                                        $paymentMethodValidation, 
                                        $categoryValidation);
    }
}