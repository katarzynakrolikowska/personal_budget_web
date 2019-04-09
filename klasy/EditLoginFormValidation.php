<?php

class EditLoginFormValidation extends DataArrayValidation
{
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields)
    {
        parent:: __construct($sendedFieldsFromForm, $namesOfRequiredFields);
    }

    public function getMessageOfFormValidation($userDataQueryGenerator)
    {
        if ($this -> isRequiredFieldsFromFormMissing()) {
            return FORM_DATA_MISSING;
        }

        if (!$this -> isValidDataFromEditLoginForm($userDataQueryGenerator)) {
			return INVALID_DATA;
        }
        
        return ACTION_OK;
    }

    private function isValidDataFromEditLoginForm($userDataQueryGenerator)
    {
        if ($this -> isValidDataFromForm($this -> getValidationObjects()) && !$this -> isLoginAlreadyExistsInDatabase($userDataQueryGenerator)) {
            return true;
        } else {
            return false;
        }
    }

    private function isLoginAlreadyExistsInDatabase($userDataQueryGenerator)
    {
        $loginValidation = new LoginValidation($this -> sendedFieldsFromForm['login'], 'login');

        if ($loginValidation -> isLoginAlreadyExistsInDatabase($userDataQueryGenerator)) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $loginValidation = new LoginValidation($this -> sendedFieldsFromForm['login'], 'login');
        
        return $validationObjects = array($loginValidation);
    }
}