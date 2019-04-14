<?php

class EditPasswordFormValidation extends DataArrayValidation
{
    public function getMessageOfFormValidation($userDataQueryGenerator)
    {
        if ($this ->  isRequiredFieldsFromFormMissing()) {
            $_SESSION['errorOldPassword'] = '';
            return  FORM_DATA_MISSING;
        }
        
        if (!$this -> isValidDataFromEditPasswordForm($userDataQueryGenerator)) {
            $_SESSION['errorOldPassword'] = '';
            return INVALID_DATA;
        }
        return ACTION_OK;
    }

    private function isValidDataFromEditPasswordForm($userDataQueryGenerator)
    {
        if ($this -> isPasswordAssignedToUser($userDataQueryGenerator) && $this -> isValidNewPassword()) {
            return true;
        } else {
            return false;
        }
    }

    private function isPasswordAssignedToUser($userDataQueryGenerator)
    {
        $passwordValidation = new PasswordValidation($this -> sendedFieldsFromForm['oldPassword']);

        if ($passwordValidation -> isPasswordAssignedToLogInUser($userDataQueryGenerator)) {
            return true;
        } else {
            return false;
        }
    }
    private function isValidNewPassword()
    {
        if ($this -> isValidDataFromForm($this -> getValidationObjects()) && $this -> isCorrectRepetedPassword()) {
            return true;
        } else {
            return false;
        }
    }

    private function isCorrectRepetedPassword()
    {
        $newPasswordValidation = $this -> getValidationObjects()[0];

        if ($newPasswordValidation -> isPasswordMatched($this -> sendedFieldsFromForm['newPasswordRepeated'])) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $passwordValidation = new PasswordValidation($this -> sendedFieldsFromForm['newPassword'], 'newPassword');
        
        return $validationObjects = array($passwordValidation);
    }
}