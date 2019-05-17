<?php

class LoginEdition
{
    private $dataFromForm = null;
    
    public function __construct($dataFromForm)
    {
        $this -> dataFromForm = $dataFromForm;
    }

    public function editUserData($userDataQueryGenerator)
    {
        $editLoginFormValidation = new EditLoginFormValidation($_POST, LOGIN_EDITION_FORM_FIELD);

        $msg = $editLoginFormValidation -> getMessageOfFormValidation($userDataQueryGenerator);
        if ($msg == ACTION_OK) {
            $this -> updateUserDataInDatabase($userDataQueryGenerator);
            $this -> setUserDataAfterEdition();
        }
        return $msg;
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
