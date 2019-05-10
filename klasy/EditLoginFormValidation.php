<?php

class EditLoginFormValidation extends DataArrayValidation
{
    public function getMessageOfFormValidation($userDataQueryGenerator)
    {
        if ($this -> isRequiredFieldsFromFormMissing()) {
            $r= FORM_DATA_MISSING;
        }else if (!$this -> isValidDataFromEditLoginForm($userDataQueryGenerator)) {
			$r= INVALID_DATA;
        }else if ($this -> isLoginAlreadyExistsInDatabase($userDataQueryGenerator)) {
            $r= LOGIN_ALREADY_EXISTS;
        } else {
            $r= ACTION_OK;
        }
        return $r;
    }

    private function isValidDataFromEditLoginForm($userDataQueryGenerator)
    {
        if ($this -> isValidDataFromForm($this -> getValidationObjects())) {
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