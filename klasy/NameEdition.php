<?php

class NameEdition extends UserDataEdition
{
    public function __construct($dataFromForm, $user, $dbo)
    {
        parent:: __construct($user, $dbo);
        $this -> dataArrayValidation = new DataArrayValidation($_POST, NAME_EDITION_FORM_FIELD);
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
        $nameValidation = new NameValidation($this -> dataFromForm, 'username');
        
        return $validationObjects = array($nameValidation);
    }

    private function updateUserDataInDatabase()
    {
        $query = 'UPDATE users SET username = :name WHERE id = :id';

        $parametersToBind = array(':name' => $this -> dataFromForm,
                            ':id' => $this -> user -> getId());
        
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

    private function setUserDataAfterEdition()
    {
        $_SESSION['loggedInUser'] -> setName($this -> dataFromForm);
    }
}