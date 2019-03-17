<?php

class PortalFront extends Portal
{
    public $loggedInUser = null;

    public function __construct($host, $user, $pass, $db)
    {
        $this -> dbo = $this -> connect($host, $user, $pass, $db);
        $this -> loggedInUser = $this -> getActualUser();
    }

    
    public function getActualUser()
    {
        if (isset($_SESSION['loggedInUser'])) {
            return $_SESSION['loggedInUser'];
        } else {
            return null;
        }
    }

    public function setMessage($message)
    {
        $_SESSION['message'] = $message;
    }

    public function getMessage()
    {
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
            return $message;
        } else {
            return null;
        }
    }

    public function logIn()
    {
        $logOperation = new LogOperation($this -> dbo);
        return $logOperation -> login();
    }

    public function logOut()
    {
        $this -> loggedInUser = null;
        $_SESSION = array();
    }

    public function registerUser()
    {
        $registration = new Registration($this -> dbo, $_POST);
        return $registration -> registerUser();
    }

    public function getIncomeCategoriesAssignedToUser($user)
    {
        $incomeAppendForm = new IncomeAppendForm($this -> dbo);
        return $incomeAppendForm -> getIncomeCategoriesAssignedToUser($user);
    }

    public function addIncome()
    {
        $incomeAppendForm = new IncomeAppendForm($this -> dbo);
        return $incomeAppendForm -> addIncome();
    }

}