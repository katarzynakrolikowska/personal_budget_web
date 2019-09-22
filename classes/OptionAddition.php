<?php

class OptionAddition
{
    private $dataFromForm = null;
    
    public function __construct($dataFromForm)
    {
        $this -> dataFromForm = $dataFromForm;
    }

    public function addOption($optionsAssignedToUser, $optionQueryGenerator)
    {
        $addOptionFormValidation = new AddOptionFormValidation($this -> dataFromForm, OPTION_ADDITION_FORM_FIELD, $optionsAssignedToUser);

        $message = $addOptionFormValidation -> getMessageOfAddFormValidation();

        if ($message === ACTION_OK) {
           $this -> updateData($optionQueryGenerator);
        }
        return $message;
    }

    private function updateData($optionQueryGenerator)
    {
        $newName = TextTransformation::getUppercaseFirstLetterAndLowercaseOtherLetters($this -> dataFromForm['newOption']);
        
        $optionQueryGenerator -> addOptionInDatabase($newName);
    }
}