<?php

class EditOptionFormValidation
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

    public function getMessageOfEditFormValidation()
    {
        if ($this -> optionFormValidation ->  isRequiredFieldsFromFormMissing()) {
            return  FORM_DATA_MISSING;
        }

         $validationObjects = $this -> getValidationObjects();
        
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
        $optionValidation = new InputSelectValidation($this -> dataFromForm['selectedOption'], 'selectedOption', $this -> optionsAssignedToUser);

        $optionTextValidation = new TextValidation($this -> dataFromForm['newOption'], 'newOption');
        
        return $validationObjects = array($optionValidation, $optionTextValidation);
    }
}