<?php

class Registration
{
    private $userDataQueryGenerator = null;

    public function __construct($dbo)
    {
        $this -> userDataQueryGenerator = new UserDataQueryGenerator($dbo);
    }

    public function registerUser()
    {
        $registrationFormValidation = new RegistrationFormValidation($_POST, REGISTRATION_FORM_FIELDS);

        $message = $registrationFormValidation -> getMessageOfFormValidation($this -> userDataQueryGenerator);

        if ($message === ACTION_OK) {
            $this -> addNewUserToDatabase();
            $_SESSION = array();
        }
        return $message;
    }

    private function addNewUserToDatabase()
    {
        $this -> addUserDataToDatabase();
        $this -> setDefaultOptionsForNewUser();
    }

    private function addUserDataToDatabase()
    {
        $_POST['password1'] = TextTransformation::getHashText($_POST['password1']);

        $this -> userDataQueryGenerator -> insertDataOfNewUserIntoDatabase($_POST['username'], $_POST['login'], $_POST['password1']);
    }

    private function setDefaultOptionsForNewUser()
    {
        $this -> userDataQueryGenerator -> setDefaultOptionsForNewUser($_POST['login']);                        
    }
}