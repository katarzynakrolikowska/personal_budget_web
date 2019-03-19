<?php

class DataArrayValidation
{
    protected $sendedFieldsFromForm = array();
    private $namesOfRequiredFields = array();
    private $dataValidation = null;
   
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields, $dataValidation = null)
    {
        $this -> sendedFieldsFromForm = $sendedFieldsFromForm;
        $this -> namesOfRequiredFields = $namesOfRequiredFields;
        $this -> dataValidation = new DataValidation($dataValidation);
        $this -> setSessionFieldsFromFormValue();
    }

    public function isRequiredFieldsFromFormMissing()
    {
        $isMissing = false;

        foreach ($this -> namesOfRequiredFields as $name) {
            if ($this -> isFieldFromFormMissing($name)) {
                $isMissing = true;
            }
        }

        if ($isMissing) {
             return true;
        } else {
            return false;
        }
    }

    private function isFieldFromFormMissing($fieldName)
    {
        $this -> dataValidation -> setData($this -> sendedFieldsFromForm[$fieldName]);

        if (!$this -> dataValidation -> isExist()) {
            $this -> setSessionErrorForFormField($fieldName);
            return  true;
        } else if ($this -> dataValidation -> isEmpty()) {
            $this -> setSessionErrorForFormField($fieldName);
            return  true;
        } else {
            $this -> unsetSessionErrorOfFormField($fieldName);
            return false;
        }
    }

    public function setSessionErrorForRequiredFields()
    {
        foreach ($this -> namesOfRequiredFields as $name) {
            $this -> setSessionErrorForFormField($name);
        }
    }

    private function setSessionErrorForFormField($fieldName)
    {
        $fieldName = ucfirst($fieldName);
        $_SESSION['error'.$fieldName] = '';
    }

    private function unsetSessionErrorOfFormField($fieldName)
    {
        $fieldName = ucfirst($fieldName);
        unset($_SESSION['error'.$fieldName]);
    }

    private function setSessionFieldsFromFormValue()
    {
        foreach ($this -> sendedFieldsFromForm as $key => $value) {
            $this -> dataValidation -> setData($value);
            $this -> dataValidation -> setSessionData($key);
        }
    }

    public function isValidDataFromForm($validationObjects)
    {
        $userDataOk = true;

        foreach ($validationObjects as $errorName => $validationObj) {
            
            if (!$validationObj -> isValid()) {
                $_SESSION[$errorName] = '';
                $userDataOk = false;
            } else {
                unset($_SESSION[$errorName]);
            }

        }
        return $userDataOk;
    }

    public function unsetSessionFieldsFromForm()
    {
        foreach ($this -> sendedFieldsFromForm as $name => $value) {
            unset($_SESSION[$name]);
        }
    }
    
}