<?php

class EditPasswordFormValidation extends DataArrayValidation
{
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields)
    {
        parent:: __construct($sendedFieldsFromForm, $namesOfRequiredFields);
    }

    public function getMessageOfFormValidation($id, $myDB)
    {
        if ($this ->  isRequiredFieldsFromFormMissing()) {
            $_SESSION['errorOldPassword'] = '';
            return  FORM_DATA_MISSING;
        }
        
        if (!$this -> isValidDataFromEditPasswordForm($id, $myDB)) {
            $_SESSION['errorOldPassword'] = '';
            return INVALID_DATA;
        }

        return ACTION_OK;
    }

    private function isValidDataFromEditPasswordForm($id, $myDB)
    {
        if ($this -> isCorrectPasswordAssignedToUser($id, $myDB) && $this -> isValidNewPassword()) {
            return true;
        } else {
            return false;
        }
    }

    private function isCorrectPasswordAssignedToUser($id, $myDB)
    {
        $passwordValidation = new PasswordValidation($this -> sendedFieldsFromForm['oldPassword']);

        if ($passwordValidation -> isCorrectPasswordAssignedToUser($id, $myDB)) {
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