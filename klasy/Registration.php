<?php

class Registration
{
    private $dbo = null;
    private $dataArrayValidation = null;
    

    public function __construct($dbo, $dataArray)
    {
        $this -> dbo = $dbo;
        $this -> dataArrayValidation = new DataArrayValidation($dataArray, FORM_REGISTRATION_FIELDS);
    }

    public function registerUser()
    {
        if ($this -> isAllRequiredDataMissing()) {
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

    

    private function isAllRequiredDataMissing()
    {
        if ($this -> dataArrayValidation -> isRequiredFieldsFromFormMissing()) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidDataFromRegistrationForm()
    {
        $userDataOK = true;

        if (!$this -> isValidNameFromRegistrationForm()) {
            $userDataOK = false;
        }

        if (!$this -> isValidLoginFromRegistrationForm()) {
            $userDataOK = false;
        }

        if (!$this -> isValidPasswordFromRegistrationForm()) {
            $userDataOK = false;
        }

        return $userDataOK;
    }

    private function isValidNameFromRegistrationForm()
    {
        $nameValidation = new NameValidation($_POST['username']);       
        if ($nameValidation -> isValidName()) {
            unset($_SESSION['errorUsername']);
            return true;
        } else {
            return false;
        }
    }

    private function isValidLoginFromRegistrationForm()
    {
        $loginValidation = new LoginValidation($_POST['login']);
        if ($loginValidation -> isValidLogin()) {
            unset($_SESSION['errorLogin']);
            return true;
        } else {
            return false;
        }
    }

    private function isValidPasswordFromRegistrationForm()
    {
        $passwordValidation = new PasswordValidation($_POST['password1']);

        if ($passwordValidation -> isValidPassword()) {
            unset($_SESSION['errorPassword1']);
            return true;
        } else {
            return false;
        }
    }

    private function isPasswordsMatched()
    {
        if ($_POST['password1'] === $_POST['password2']) {
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

        $this -> setDefaultCategoriesForNewUser();
    }

    private function addUserDataToDatabase()
    {
        $_POST['password1'] = TextTransformation::getHashText($_POST['password1']);

        $myDB = new MyDB($this -> dbo);
        $query = 'INSERT INTO users VALUES(NULL, ?, ?, ?)';
        $parametersToBind = array($_POST['username'] => PDO::PARAM_STR,
                            $_POST['password1'] => PDO::PARAM_STR,
                            $_POST['login'] => PDO::PARAM_STR);
        
        $myDB -> executeQuery($query, $parametersToBind);
    }

    private function setDefaultCategoriesForNewUser()
    {
        $myDB = new MyDB($this -> dbo);

        $query = 'INSERT INTO expenses_category_assigned_to_users(user_id,              name) SELECT (SELECT id FROM users WHERE login=?),
                name FROM expenses_category_default as e_def ORDER BY     e_def.id';
        $parametersToBind = array($_POST['login'] => PDO::PARAM_STR);

        $myDB -> executeQuery($query, $parametersToBind);

        $query = 'INSERT INTO incomes_category_assigned_to_users(user_id, name)         SELECT (SELECT id FROM users WHERE login=?),
                name FROM incomes_category_default as i_def ORDER BY i_def.id';
        
        $myDB -> executeQuery($query, $parametersToBind);

        $query = 'INSERT INTO payment_methods_assigned_to_users(user_id, name)          SELECT (SELECT id FROM users WHERE login=?),
                name FROM payment_methods_default as pm_def ORDER BY pm_def.id';

        $myDB -> executeQuery($query, $parametersToBind);

        
    }

    
}