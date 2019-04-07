<?php

class DeleteOptionFormValidation
{
    private $dataFromForm= null;
    private $optionsAssignedToUser = null;
    private $optionFormValidation = null;

    public function __construct($dataFromForm, $namesOfRequiredFields, $optionsAssignedToUser)
    {
        $this -> dataFromForm = $dataFromForm;
        $this -> optionsAssignedToUser = $optionsAssignedToUser;
        $this -> optionFormValidation = new OptionFormValidation($dataFromForm, $namesOfRequiredFields, $optionsAssignedToUser);
    }

    public function getMessageOfDeleteFormValidation($optionQueryGenerator)
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

        if ($this -> isOptionUsed($optionQueryGenerator)) {
            return OPTION_USED;
        }

        return ACTION_OK;
    }

    private function getValidationObjects()
    {
        $optionValidation = new InputSelectValidation($this -> dataFromForm['selectedOption'], 'selectedOption', $this -> optionsAssignedToUser);
        
        return $validationObjects = array($optionValidation);
    }

    private function isOptionUsed($optionQueryGenerator)
    {
        $results = $optionQueryGenerator -> getDataAssignedToOption($this -> dataFromForm['selectedOption']);

        if (sizeof($results) > 0) {
            return true;
        } else {
            return false;
        }
    }

}