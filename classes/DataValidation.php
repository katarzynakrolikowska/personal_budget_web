<?php

class DataValidation
{
    protected $data = null;
    protected $fieldName = null;

    public function __construct($data = '', $fieldName = '')
    {
        $this -> data = $data;
        $this -> fieldName = $fieldName;
    }

    public function setData($data)
    {
        $this -> data = $data;
    }

    public function setFieldName($fieldName)
    {
        $this -> fieldName = $fieldName;
    }

    public function getFieldName()
    {
        return $this -> fieldName;
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

    public function isFieldFromFormMissing()
    {
        if (!$this -> isEmpty()) {
            return false;
        } else {
            return  true;
        }
    }
    
    protected function isEmpty()
    {
        if (empty(trim($this -> data))) {
            return true;
        } else {
            return false;
        }
    }

    public function getSanitizedValue()
    {
        return htmlentities($this -> data, ENT_QUOTES, 'UTF-8');
    }
}