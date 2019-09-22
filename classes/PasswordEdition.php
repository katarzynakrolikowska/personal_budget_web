<?php

class PasswordEdition
{
    private $dataFromForm = null;
    
    public function __construct($dataFromForm)
    {
        $this -> dataFromForm = $dataFromForm;
    }

    public function editUserData($userDataQueryGenerator)
    {
        $editPasswordFormValidation = new EditPasswordFormValidation($this -> dataFromForm, PASSWORD_EDITION_FORM_FIELDS);

        $message = $editPasswordFormValidation -> getMessageOfFormValidation($userDataQueryGenerator);

        if ($message === ACTION_OK) {
           $this -> updateUserDataInDatabase($userDataQueryGenerator);
        }

        return $message;
    }

    private function updateUserDataInDatabase($userDataQueryGenerator)
    {
        $newPassword = TextTransformation::getHashText($this -> dataFromForm['newPassword']);
        $userDataQueryGenerator -> updatePasswordInDatabase($newPassword);
    }
}