<?php

class PasswordEdition extends UserDataEdition
{
    public function __construct($dataFromForm, $user, $dbo)
    {
        parent:: __construct($user, $dbo);
        //$this -> dataArrayValidation = new DataArrayValidation($dataFromForm, PASSWORD_EDITION_FORM_FIELDS);
        $this -> dataFromForm = $dataFromForm;
    }

    public function editUserData()
    {
        /*if ($this -> dataArrayValidation -> isRequiredFieldsFromFormMissing()) {
            $_SESSION['errorOldPassword'] = '';
            return FORM_DATA_MISSING;
        }

        if (!$this -> isValidDataFromForm()) {
            $_SESSION['errorOldPassword'] = '';
			return INVALID_DATA;
        }

        

        return ACTION_OK;*/
        $editPasswordFormValidation = new EditPasswordFormValidation($this -> dataFromForm, PASSWORD_EDITION_FORM_FIELDS);

        $message = $editPasswordFormValidation -> getMessageOfFormValidation($this -> user -> getId(), $this -> myDB);

        if ($message === ACTION_OK) {
           $this -> updateUserDataInDatabase();
        }

        return $message;

    }

    /*private function isValidDataFromForm()
    {
        if ($this -> isCorrectPasswordAssignedToUser() && $this -> isValidNewPassword()) {
            return true;
        } else {
            return false;
        }
    }

    private function isCorrectPasswordAssignedToUser()
    {
        $passwordValidation = new PasswordValidation($this -> dataFromForm['oldPassword']);

        if ($passwordValidation -> isCorrectPasswordAssignedToUser($this -> user -> getId(), $this -> myDB)) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidNewPassword()
    {
        $newPasswordValidation = $this -> getValidationObjects()[0];

        if ($this -> dataArrayValidation -> isValidDataFromForm($this -> getValidationObjects()) && $newPasswordValidation -> isPasswordMatched($this -> dataFromForm['newPasswordRepeated'])) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $passwordValidation = new PasswordValidation($this -> dataFromForm['newPassword'], 'newPassword');
        
        return $validationObjects = array($passwordValidation);
    }*/

    private function updateUserDataInDatabase()
    {
        $newPassword = TextTransformation::getHashText($this -> dataFromForm['newPassword']);
        $query = 'UPDATE users SET password = :password WHERE id = :id';

        $parametersToBind = array(':password' => $newPassword,
                            ':id' => $this -> user -> getId());
        
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

}