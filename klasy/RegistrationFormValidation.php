<?php

class RegistrationFormValidation extends DataArrayValidation
{
    public function getMessageOfFormValidation($userDataQueryGenerator)
    {
        if ($this -> isRequiredFieldsFromFormMissing()) {
            return FORM_DATA_MISSING;
        }
        
        if (!$this -> isValidDataFromRegistrationForm()) {
			return INVALID_DATA;
        }

        if ($this -> isUserExists($userDataQueryGenerator)) {
            return LOGIN_ALREADY_EXISTS;
        }
        
        if (!$this -> isPasswordsMatched()) {
            return PASSWORDS_DO_NOT_MATCH;
        }

        return ACTION_OK;
    }

    private function isValidDataFromRegistrationForm()
    {
        if ($this -> isValidDataFromForm($this -> getValidationObjects())) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $nameValidation = new NameValidation($this -> sendedFieldsFromForm['username'], 'username');
        $loginValidation = new LoginValidation($this -> sendedFieldsFromForm['login'], 'login');
        $passwordValidation = new PasswordValidation($this -> sendedFieldsFromForm['password1'], 'password1');
       
        return $validationObjects = array($nameValidation,                                                        $loginValidation,
                                          $passwordValidation);
    }

    private function isPasswordsMatched()
    {
        $passwordValidation = new PasswordValidation($this -> sendedFieldsFromForm['password1']);

        if ($passwordValidation -> isPasswordMatched($this -> sendedFieldsFromForm['password2'])) {
            return true;
        }
    }

    private function isUserExists($userDataQueryGenerator)
    {
        $loginValidation = new LoginValidation($this -> sendedFieldsFromForm['login']);
        if ($loginValidation -> isLoginAlreadyExistsInDatabase($userDataQueryGenerator)) {
            return true;
        } else {
            return false;
        }
    }
}