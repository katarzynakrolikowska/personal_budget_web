<?php

class Registration
{
    private $dbo = null;
    private $dataArrayValidation = null;

    public function __construct($dbo)
    {
        $this -> dbo = $dbo;
        $this -> dataArrayValidation = new DataArrayValidation($_POST, REGISTRATION_FORM_FIELDS);
    }

    public function registerUser()
    {
        if ($this -> dataArrayValidation -> isRequiredFieldsFromFormMissing()) {
            return FORM_DATA_MISSING;
        }
        
        if (!$this -> isValidDataFromRegistrationForm()) {
			return INVALID_DATA;
        }

        if ($this -> isUserExists()) {
            return LOGIN_ALREADY_EXISTS;
        }
        
        if (!$this -> isPasswordsMatched()) {
            return PASSWORDS_DO_NOT_MATCH;
        }

        $this -> addNewUserToDatabase();

        $_SESSION = array();
        return ACTION_OK;
    }

    private function isValidDataFromRegistrationForm()
    {
        if ($this -> dataArrayValidation -> isValidDataFromForm($this -> getValidationObjects())) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $nameValidation = new NameValidation($_POST['username'], 'username');
        $loginValidation = new LoginValidation($_POST['login'], 'login');
        $passwordValidation = new PasswordValidation($_POST['password1'], 'password1');
       
        return $validationObjects = array($nameValidation,                                                        $loginValidation,
                                          $passwordValidation);
    }

    private function isPasswordsMatched()
    {
        $passwordValidation = new PasswordValidation($_POST['password1']);

        if ($passwordValidation -> isPasswordMatched($_POST['password2'])) {
            return true;
        }
        
    }

    private function isUserExists()
    {
        $loginValidation = new LoginValidation($_POST['login']);
        if ($loginValidation -> isLoginExists($this -> dbo)) {
            return true;
        } else {
            return false;
        }
    }

    private function addNewUserToDatabase()
    {
        $this -> addUserDataToDatabase();

        $this -> setDefaultOptionsForNewUser();
    }

    private function addUserDataToDatabase()
    {
        $_POST['password1'] = TextTransformation::getHashText($_POST['password1']);

        $myDB = new MyDB($this -> dbo);

        $query = 'INSERT INTO users VALUES(NULL, :username, :password, :login)';
        $parametersToBind = array(':username' => $_POST['username'],
                            ':password' => $_POST['password1'],
                            ':login' => $_POST['login']);
        
        $myDB -> executeQuery($query, $parametersToBind);
    }

    private function setDefaultOptionsForNewUser()
    {
        $myDB = new MyDB($this -> dbo);
        $parametersToBind = array(':login' => $_POST['login']);

        $query = 'INSERT INTO expenses_category_assigned_to_users(user_id,              name) SELECT (SELECT id FROM users WHERE login=:login),
                name FROM expenses_category_default as e_def ORDER BY     e_def.id';
        $myDB -> executeQuery($query, $parametersToBind);

        $query = 'INSERT INTO incomes_category_assigned_to_users(user_id, name)         SELECT (SELECT id FROM users WHERE login=:login),
                name FROM incomes_category_default as i_def ORDER BY i_def.id';
        $myDB -> executeQuery($query, $parametersToBind);

        $query = 'INSERT INTO payment_methods_assigned_to_users(user_id, name)          SELECT (SELECT id FROM users WHERE login=:login),
                name FROM payment_methods_default as pm_def ORDER BY pm_def.id';
        $myDB -> executeQuery($query, $parametersToBind);

    }


    
}