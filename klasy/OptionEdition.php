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

    public function setLimitOfCategory($optionsAssignedToUser, $optionQueryGenerator)
    {
        $setLimitFormValidation = new SetLimitFormValidation($this -> dataFromForm, SETTINGS_LIMIT_FORM_FIELDS, $optionsAssignedToUser);

        $message = $setLimitFormValidation -> getMessageOfFormValidation();

        if ($message === ACTION_OK) {
           $this -> updateLimitOfCategory($optionQueryGenerator);
        }

        return $message;
    }

    public function updateLimitOfCategory($optionQueryGenerator)
    {
        $limitAmount = $this -> dataFromForm['limitAmount'];
        $categoryId = $this -> dataFromForm['selectedOption'];
        $optionQueryGenerator -> updateLimitOfCategoryInDatabase($limitAmount, $categoryId);
    }
}