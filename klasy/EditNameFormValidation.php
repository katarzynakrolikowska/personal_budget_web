<?php

class EditNameFormValidation extends DataArrayValidation
{
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields)
    {
        parent:: __construct($sendedFieldsFromForm, $namesOfRequiredFields);
    }

    public function getMessageOfFormValidation()
    {
        if ($this -> isRequiredFieldsFromFormMissing()) {
            return FORM_DATA_MISSING;
        }

        if (!$this -> isValidDataFromForm($this -> getValidationObjects())) {
			return INVALID_DATA;
        }
        
        return ACTION_OK;
    }

    private function getValidationObjects()
    {
        $nameValidation = new NameValidation($this -> sendedFieldsFromForm['username'], 'username');
        
        return $validationObjects = array($nameValidation);
    }
}