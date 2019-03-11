<?php

class DataArrayValidation
{
    private $fieldsFromForm = array();

    public function __construct($fieldsFromForm)
    {
        $this -> fieldsFromForm = $fieldsFromForm;
        $this -> setSessionErrorForAllFieldsFromForm();
        
    }

    public function isFieldsFromFormExist()
    {
        foreach ($this -> fieldsFromForm as $field) {
            if (!isset($field)) {
                return false;
            }
        }
        return true;
    }

    public function isEmptyAllFieldsFromForm()
    {
        foreach ($this -> fieldsFromForm as $field) {
            if (!empty(trim($field))) {
                return false;
            }
        }
        return true;
    }

    public function setSessionErrorForAllFieldsFromForm()
    {
        foreach ($this -> fieldsFromForm as $name => $value) {
            $this -> setSessionErrorForFieldForm($name);
        }
    }

    private function setSessionErrorForFieldForm($fieldName)
    {
        $fieldName = HelperMethods::getUppercaseFirstLetter($fieldName);
        $_SESSION['error'.$fieldName] = true;
    }

    
}