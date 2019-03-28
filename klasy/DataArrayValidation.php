<?php

class DataArrayValidation
{
    protected $sendedFieldsFromForm = array();
    private $namesOfRequiredFields = array();
    private $dataValidation = null;
   
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields)
    {
        $this -> sendedFieldsFromForm = $sendedFieldsFromForm;
        $this -> namesOfRequiredFields = $namesOfRequiredFields;
        $this -> setSessionValueOfFieldsFromForm();
    }

    private function setSessionValueOfFieldsFromForm()
    {
        foreach ($this -> sendedFieldsFromForm as $key => $value) {
            $this -> dataValidation = new DataValidation($value, $key);
            $this -> dataValidation -> setSessionData();
        }
    }


    public function isRequiredFieldsFromFormMissing()
    {
        $isMissing = false;

        foreach ($this -> namesOfRequiredFields as $name) {
            $this -> dataValidation = new DataValidation($this -> sendedFieldsFromForm[$name], $name);
            if ($this -> dataValidation -> isFieldFromFormMissing()) {
                $isMissing = true;
            }
        }

        if ($isMissing) {
             return true;
        } else {
            return false;
        }
    }

    public function setSessionErrorForRequiredFields()
    {
        foreach ($this -> namesOfRequiredFields as $name) {
            $this -> dataValidation -> setFieldName($name);
            $this -> dataValidation -> setSessionErrorForFormField();
        }
    }

    public function isValidDataFromForm($validationObjects)
    {
        $userDataOk = true;

        foreach ($validationObjects as $validationObj) {
            
            if (!$validationObj -> isValid()) {
                $validationObj -> setSessionErrorForFormField();
                $userDataOk = false;
            } else {
                $validationObj -> unsetSessionErrorOfFormField();
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