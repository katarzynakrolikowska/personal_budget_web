<?php

class PasswordEdition extends UserDataEdition
{
    public function __construct($dataFromForm, $user, $dbo)
    {
        parent:: __construct($user, $dbo);
        $this -> dataFromForm = $dataFromForm;
    }

    public function editUserData()
    {
        $editPasswordFormValidation = new EditPasswordFormValidation($this -> dataFromForm, PASSWORD_EDITION_FORM_FIELDS);

        $message = $editPasswordFormValidation -> getMessageOfFormValidation($this -> user -> getId(), $this -> myDB);

        if ($message === ACTION_OK) {
           $this -> updateUserDataInDatabase();
        }

        return $message;
    }

    private function updateUserDataInDatabase()
    {
        $newPassword = TextTransformation::getHashText($this -> dataFromForm['newPassword']);
        $query = 'UPDATE users SET password = :password WHERE id = :id';

        $parametersToBind = array(':password' => $newPassword,
                            ':id' => $this -> user -> getId());
        
        $this -> myDB -> executeQuery($query, $parametersToBind);
    }

}