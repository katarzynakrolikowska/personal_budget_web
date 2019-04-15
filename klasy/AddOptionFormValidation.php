<?php

class AddOptionFormValidation
{
    private $dataFromForm= null;
    private $optionFormValidation = null;

    public function __construct($dataFromForm, $namesOfRequiredFields, $optionsAssignedToUser)
    {
        $this -> dataFromForm = $dataFromForm;
        $this -> optionFormValidation = new OptionFormValidation($dataFromForm, $namesOfRequiredFields, $optionsAssignedToUser);
    }

    public function getMessageOfAddFormValidation()
    {
        $validationObjects = $this -> getValidationObjects();
        
        if ($this -> optionFormValidation ->  isRequiredFieldsFromFormMissing()) {
            return  FORM_DATA_MISSING;
        }
        
        if (!$this -> optionFormValidation -> isValidDataFromForm($validationObjects)) {
			return INVALID_DATA;
        }

        if ($this -> optionFormValidation -> isNewOptionAlreadyAssignedToUser()) {
            return REPEATED_OPTION;
        }

        return ACTION_OK;
    }

    private function getValidationObjects()
    {
        $optionTextValidation = new NameValidation($this -> dataFromForm['newOption'], 'newOption');
        
        return $validationObjects = array($optionTextValidation);
    }


}