<?php

class Registration
{
    private $userDataQueryGenerator = null;
    private $registrationFormValidation = null;

    public function __construct($dbo)
    {
        $this -> userDataQueryGenerator = new UserDataQueryGenerator($dbo);
        $this -> registrationFormValidation = new RegistrationFormValidation($_POST, REGISTRATION_FORM_FIELDS);
    }

    public function registerUser()
    {
        $message = $this -> registrationFormValidation -> getMessageOfFormValidation($this -> userDataQueryGenerator);

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

    public function getValidFields()
    {
        return $this -> registrationFormValidation -> getValidFields();
    }

    public function getInputValues()
    {
        return $this -> registrationFormValidation -> getInputValues();
    }
}