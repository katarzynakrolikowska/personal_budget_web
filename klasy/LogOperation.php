<?php

class LogOperation
{
    private $dbo =null;

    public function __construct($dbo)
    {
        $this -> dbo = $dbo;
    }

    public function logIn()
    {
        if ($this -> isAllRequiredDataMissing()) {
            return FORM_DATA_MISSING;
        }

        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');

        $query = $this->dbo->prepare('SELECT id, username, password FROM users WHERE email=:login');
		$query -> bindValue(':login', $login, PDO::PARAM_STR);
        $query -> execute();
        
        $result = $query->fetch();

        if ($query->rowCount() <> 1) {
            return INVALID_DATA;
        }

        if (!password_verify( $password, $result['password'])) {
            return INVALID_DATA;
        }

        $_SESSION['loggedInUser'] = new User($result['id'], $result['username'], $login);
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
}