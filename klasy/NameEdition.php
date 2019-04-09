<?php

class NameEdition
{
    public function __construct($dataFromForm)
    {
        $this -> dataFromForm = $dataFromForm;
    }

    public function editUserData($userDataQueryGenerator)
    {
        $editNameFormValidation = new EditNameFormValidation($_POST, NAME_EDITION_FORM_FIELD);

        $message = $editNameFormValidation -> getMessageOfFormValidation();

        if ($message === ACTION_OK) {
            $this -> updateUserDataInDatabase($userDataQueryGenerator);
            $this -> setUserDataAfterEdition();
        }
        return $message;
    }

    private function updateUserDataInDatabase($userDataQueryGenerator)
    {
        $userDataQueryGenerator -> updateUserNameInDatabase($this -> dataFromForm);
    }

    private function setUserDataAfterEdition()
    {
        $_SESSION['loggedInUser'] -> setName($this -> dataFromForm);
    }
}