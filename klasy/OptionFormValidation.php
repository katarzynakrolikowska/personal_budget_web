<?php

class OptionFormValidation extends DataArrayValidation
{
    private $optionsAssignedToUser = null;
    
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields,$optionsAssignedToUser)
    {
        parent:: __construct($sendedFieldsFromForm, $namesOfRequiredFields);
        $this -> optionsAssignedToUser = $optionsAssignedToUser;
    }
  
    public function isValidDataFromOptionForm($validationObjects)
    {
        if ($this -> isValidDataFromForm($validationObjects)) {
            return true;
        } else {
            return false;
        }
    }

    public function isNewOptionAlreadyAssignedToUser()
    {
        $this -> sendedFieldsFromForm['newOption'] = TextTransformation::getUppercaseFirstLetterAndLowercaseOtherLetters($this -> sendedFieldsFromForm['newOption']);
        

        $optionValidation = new InputSelectValidation($this -> sendedFieldsFromForm['newOption'], 'newOption', $this -> optionsAssignedToUser);

        if ($optionValidation -> isSelectedOptionExistsInArrayOptions()) {
            return true;
        } else {
            return false;
        }
    }
}