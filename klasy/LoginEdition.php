<?php

class LoginEdition extends UserDataEdition
{
    public function __construct($dataFromForm, $user, $dbo)
    {
        parent:: __construct($user, $dbo);
        $this -> dataArrayValidation = new DataArrayValidation($_POST, LOGIN_EDITION_FORM_FIELD);
        $this -> dataFromForm = $dataFromForm;
    }

    public function editUserData()
    {
        if ($this -> dataArrayValidation -> isRequiredFieldsFromFormMissing()) {
            return FORM_DATA_MISSING;
        }

        if (!$this -> isValidDataFromForm()) {
			return INVALID_DATA;
        }

        $this -> updateUserDataInDatabase();
        $this -> setUserDataAfterEdition();

        return ACTION_OK;
    }

    private function isValidDataFromForm()
    {
        if ($this -> dataArrayValidation -> isValidDataFromForm($this -> getValidationObjects())) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $loginValidation = new LoginValidation($this -> dataFromForm, 'login');
        
        return $validationObjects = array($loginValidation);
    }

    private function updateUserDataInDatabase()
    {
        $query = 'UPDATE users SET login = :login WHERE id = :id';

        $parametersToBind = array(':login' => $this -> dataFromForm,
                            ':id' => $this -> user -> getId());
        
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    private function setUserDataAfterEdition()
    {
        $_SESSION['loggedInUser'] -> setLogin($this -> dataFromForm);
    }
}
