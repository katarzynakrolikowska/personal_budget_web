<?php

class DataValidation
{
    protected $data = null;

    public function __construct($data)
    {
        $this -> data = $data;
    }

    public function setData($data)
    {
        $this -> data = $data;
    }

    public function isValidLength($minLength, $maxLength)
    {
        if ($this -> isValidMinLength($minLength) && $this -> isValidMaxLength($maxLength)) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidMinLength($minLength)
    {
        $dataLength = mb_strlen($this -> data);

        if ($dataLength >= $minLength) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidMaxLength($maxLength)
    {
        $dataLength = mb_strlen($this -> data);

        if ($dataLength <= $maxLength) {
            return true;
        } else {
            return false;
        }
    }

    public function getSanitizedValue()
    {
        return htmlentities($this -> data, ENT_QUOTES, 'UTF-8');
    }

    public function isEmpty()
    {
        if (empty(trim($this -> data))) {
            return true;
        } else {
            return false;
        }
    }

    public function isExist()
    {
        if (isset($this -> data)) {
            return true;
        } else {
            return false;
        }
    }

    public function setSessionData($name)
    {
        $_SESSION[$name] = $this -> getSanitizedValue();
    }

    /*public function setSessionError($name, $info = ''){
        $name = ucfirst($name);
        $_SESSION['error'.$name] = $info;
    }


    public function setSessionErrorForData($name)
    {
        $name = ucfirst($name);
        $_SESSION['error'.$name] = true;
    }*/

    /*public function unsetSessionData($key)
    {
        unset($_SESSION[$key]);
    }*/
}