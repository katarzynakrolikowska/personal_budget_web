<?php

class OptionAddition
{
    public function __construct($dataFromForm)
    {
        $this -> dataFromForm = $dataFromForm;
    }

    public function addOption($optionsAssignedToUser, $incomeQueryGenerator)
    {
        $addOptionFormValidation = new AddOptionFormValidation($this -> dataFromForm, OPTION_ADDITION_FORM_FIELD, $optionsAssignedToUser);

        $message = $addOptionFormValidation -> getMessageOfAddFormValidation();

        if ($message === ACTION_OK) {
           $this -> updateData($incomeQueryGenerator);
        }

        return $message;
    }

    private function updateData($incomeQueryGenerator)
    {
        $newName = TextTransformation::getUppercaseFirstLetterAndLowercaseOtherLetters($this -> dataFromForm['newOption']);
        
        $incomeQueryGenerator -> addOptionInDatabase($newName);
    }
}