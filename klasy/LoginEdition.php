<?php

class LoginEdition
{
    public function __construct($dataFromForm)
    {
        $this -> dataFromForm = $dataFromForm;
    }

    public function editUserData($userDataQueryGenerator)
    {
        $editLoginFormValidation = new EditLoginFormValidation($_POST, LOGIN_EDITION_FORM_FIELD);

        $message = $editLoginFormValidation -> getMessageOfFormValidation($userDataQueryGenerator);

        if ($message === ACTION_OK) {
            $this -> updateUserDataInDatabase($userDataQueryGenerator);
            $this -> setUserDataAfterEdition();
        }
        return $message;
    }

    private function updateUserDataInDatabase($userDataQueryGenerator)
    {
        $userDataQueryGenerator -> updateLoginInDatabase($this -> dataFromForm);
    }

    private function setUserDataAfterEdition()
    {
        $_SESSION['loggedInUser'] -> setLogin($this -> dataFromForm);
    }
}
