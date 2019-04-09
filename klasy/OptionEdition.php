<?php

class OptionEdition
{
    public function __construct($dataFromForm)
    {
        $this -> dataFromForm = $dataFromForm;
    }

    public function editOption($optionsAssignedToUser, $incomeQueryGenerator)
    {
        $editOptionFormValidation = new EditOptionFormValidation($this -> dataFromForm, OPTION_EDITION_FORM_FIELDS, $optionsAssignedToUser);

        $message = $editOptionFormValidation -> getMessageOfEditFormValidation();

        if ($message === ACTION_OK) {
           $this -> updateData($incomeQueryGenerator);
        }

        $_SESSION['test'] = $this -> dataFromForm['newOption'];
        return $message;
    }

    private function updateData($incomeQueryGenerator)
    {
        $newName = TextTransformation::getUppercaseFirstLetterAndLowercaseOtherLetters($this -> dataFromForm['newOption']);
        
        $incomeQueryGenerator -> editOptionInDatabase($this -> dataFromForm['selectedOption'], $newName);
    }
}