<?php

class SetLimitFormValidation extends DataArrayValidation
{
    private $optionsAssignedToUser = null;

    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields, $optionsAssignedToUser)
    {
        parent:: __construct($sendedFieldsFromForm, $namesOfRequiredFields);
        $this -> optionsAssignedToUser = $optionsAssignedToUser;
    }

    public function getMessageOfFormValidation()
    {
        if ($this ->  isRequiredFieldsFromFormMissing()) {
            return  FORM_DATA_MISSING;
        }

        $validationObjects = $this -> getValidationObjects();
        
        if (!$this -> isValidDataFromForm($validationObjects)) {
			return INVALID_DATA;
        }
        return ACTION_OK;
    }

    private function getValidationObjects()
    {
        $optionValidation = new InputSelectValidation($this -> sendedFieldsFromForm['selectedOption'], 'selectedOption', $this -> optionsAssignedToUser);

        $limitValidation = new AmountValidation($this -> sendedFieldsFromForm['limitAmount'], 'limitAmount');
        
        return $validationObjects = array($optionValidation, $limitValidation);
    }
}