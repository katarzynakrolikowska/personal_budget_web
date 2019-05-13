<?php

class LogInFormValidation extends DataArrayValidation
{
    public function getMessageOfFormValidation($userDataQueryGenerator)
    {
        if ($this -> isRequiredFieldsFromFormMissing()) {
            return FORM_DATA_MISSING;
        }
        
        if (!$this -> isValidDataFromLoginForm($userDataQueryGenerator)) {
            return INVALID_DATA;
        }

        return ACTION_OK;
    }

    private function isValidDataFromLoginForm($userDataQueryGenerator)
    {
        $passwordAssignedToLogin = $this -> getPasswordAssignedToLogin($userDataQueryGenerator);
        
        if ($this -> isUserExists($passwordAssignedToLogin) && $this -> isCorrectPassword($passwordAssignedToLogin)) {
            return true;
        } else {
            $this -> setInvalidAllRequiredFields();
            return false;
        }
    }

    private function getPasswordAssignedToLogin($userDataQueryGenerator)
    {
        return $userDataQueryGenerator -> getPasswordAssignedToLogin($this -> sendedFieldsFromForm['login']);
    }

    private function isUserExists($passwordAssignedToLogin)
    {
        if ($passwordAssignedToLogin) {
            return true;
        } else {
            return false;
        }
    }

    private function isCorrectPassword($passwordFromDatabase)
    {
        $passwordValidation = new PasswordValidation($this -> sendedFieldsFromForm['password']);
        if ($passwordValidation -> isPasswordAssignedToUser($passwordFromDatabase)) {
            return true;
        } else {
            return false;
        }
    }
}