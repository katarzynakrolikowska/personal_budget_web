<?php

class DataArrayValidation
{
    protected $sendedFieldsFromForm = array();
    private $namesOfRequiredFields = array();
    private $dataValidation = null;
    private $validFields = array();
    private $inputValues = array();
   
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields)
    {
        $this -> sendedFieldsFromForm = $sendedFieldsFromForm;
        $this -> namesOfRequiredFields = $namesOfRequiredFields;
        $this -> setInputValues();
    }

    private function setInputValues()
    {
        foreach ($this -> sendedFieldsFromForm as $key => $value) {
            $this -> dataValidation = new DataValidation($value, $key);
            $value = $this -> dataValidation -> getSanitizedValue();
            $this -> inputValues[$key] = $value;
        }
    }

    public function getInputValues()
    {
        return $this -> inputValues;
    }

    public function isRequiredFieldsFromFormMissing()
    {
        $isMissing = false;

        foreach ($this -> namesOfRequiredFields as $name) {
            $this -> dataValidation = new DataValidation();

            if ($this -> isExist($name)) {
                $this -> setDataValidation($name);

                if ($this -> dataValidation -> isFieldFromFormMissing()) {
                    $this -> validFields[$name] = false;
                    $isMissing = true;
                } else {
                    $this -> validFields[$name] = true;
                }
            } else {
                $this -> validFields[$name] = false;
                $isMissing = true;
            }
        }
        if ($isMissing) {
             return true;
        } else {
            return false;
        }
    }

    private function isExist($name)
    {
        if (isset($this -> sendedFieldsFromForm[$name])) {
            return true;
        } else {
            return false;
        }
    }

    private function setDataValidation($name)
    {
        $data = $this -> sendedFieldsFromForm[$name];
        $this -> dataValidation -> setData($data);
        $this -> dataValidation -> setFieldName($name);
    }

    public function setInvalidAllRequiredFields()
    {
        foreach ($this -> namesOfRequiredFields as $name) {
            $this -> validFields[$name] = false;
        }
    }

    public function isValidDataFromForm($validationObjects)
    {
        $userDataOk = true;

        foreach ($validationObjects as $validationObj) {
            $name = $validationObj -> getFieldName();
            if (!$validationObj -> isValid()) {
                $this -> validFields[$name] = false;
                $userDataOk = false;
            } else {
                $this -> validFields[$name] = true;
            }
        }
        return $userDataOk;
    }

    public function getValidFields()
    {
        return $this -> validFields;
    }
}