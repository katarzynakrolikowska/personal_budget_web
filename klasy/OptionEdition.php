<?php

class OptionEdition
{
    private $dataFromForm = null;

    public function __construct($dataFromForm)
    {
        $this -> dataFromForm = $dataFromForm;
    }

    public function editOption($optionsAssignedToUser, $optionQueryGenerator)
    {
        $editOptionFormValidation = new EditOptionFormValidation($this -> dataFromForm, OPTION_EDITION_FORM_FIELDS, $optionsAssignedToUser);

        $message = $editOptionFormValidation -> getMessageOfEditFormValidation();

        if ($message === ACTION_OK) {
           $this -> updateData($optionQueryGenerator);
        }

        return $message;
    }

    private function updateData($optionQueryGenerator)
    {
        $newName = TextTransformation::getUppercaseFirstLetterAndLowercaseOtherLetters($this -> dataFromForm['newOption']);
        
        $optionQueryGenerator -> editOptionInDatabase($this -> dataFromForm['selectedOption'], $newName);
    }
}