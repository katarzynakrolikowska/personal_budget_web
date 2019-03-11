<?php

class Registration
{
    private $dbo =null;

    public function __construct($dbo)
    {
        $this -> dbo = $dbo;
    }

    public function registerUser()
    {
        if ($this -> isAllRequiredDataMissing()) {
            return FORM_DATA_MISSING;
        }
        
        if (!$this -> isValidDataFromRegistrationForm()) {
			return INVALID_DATA;
        }

        if ($this -> isLoginExists()) {
            return LOGIN_ALREADY_EXISTS;
        }
        
        if (!$this -> isPasswordsMatched()) {
            return PASSWORDS_DO_NOT_MATCH;
        }

        $this -> addNewUserToDatabase();

        return ACTION_OK;
    }

    private function isAllRequiredDataMissing()
    {
        $dataArrayValidation = new DataArrayValidation($_POST);
        if (!$dataArrayValidation -> isFieldsFromFormExist()) {
            return true;
        } else if ($dataArrayValidation -> isEmptyAllFieldsFromForm()) {
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

        unset($_SESSION['username']);
		unset($_SESSION['login']);
        
        return $userDataOK;
    }

    private function isValidNameFromRegistrationForm()
    {
        $nameValidation = new NameValidation($_POST['username']);
        $_SESSION['username'] = $nameValidation -> getSanitizeValue();
        if ($nameValidation -> isValidName()) {
            $_SESSION['errorUsername'] = false;
            return true;
        } else {
            return false;
        }
    }

    private function isValidLoginFromRegistrationForm()
    {
        $loginValidation = new LoginValidation($_POST['login']);
        $_SESSION['login'] = $loginValidation -> getSanitizeValue();
        if ($loginValidation -> isValidLogin()) {
            $_SESSION['errorLogin'] = false;
            return true;
        } else {
            return false;
        }
    }

    private function isValidPasswordFromRegistrationForm()
    {
        $passwordValidation = new PasswordValidation($_POST['password1']);

        if ($passwordValidation -> isValidPassword()) {
            $_SESSION['errorPassword1'] = false;
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

    private function isLoginExists()
    {
        $query = 'SELECT id,password FROM users WHERE login = ?';
        $myDB = new MyDB($this -> dbo);
        $parametersToBind = array($_POST['login'] => PDO::PARAM_STR);
        
        if (sizeof($myDB -> getQueryResult($query, $parametersToBind)) > 0) {
            $_SESSION['errorLogin'] = true;
            return true;
        } else {
            return false;
        }
    }

    private function addNewUserToDatabase()
    {
        $this -> addCredentialsToDatabase();

        $this -> setDefaultCategoriesForNewUser();
    }

    private function addCredentialsToDatabase()
    {
        $_POST['password1'] = HelperMethods::getHashText($_POST['password1']);

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
                
        $parametersToBind = array($_POST['login'] => PDO::PARAM_STR);

        $myDB -> executeQuery($query, $parametersToBind);

        $query = 'INSERT INTO payment_methods_assigned_to_users(user_id, name)          SELECT (SELECT id FROM users WHERE login=?),
                name FROM payment_methods_default as pm_def ORDER BY pm_def.id';
        
        $parametersToBind = array($_POST['login'] => PDO::PARAM_STR);

        $myDB -> executeQuery($query, $parametersToBind);

        
    }

    
}