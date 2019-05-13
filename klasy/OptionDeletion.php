<?php

class OptionDeletion
{
    private $dataFromForm = null;
    
    public function __construct($dataFromForm)
    {
        $this -> dataFromForm = $dataFromForm;
    }

    public function deleteOption($optionsAssignedToUser, $optionQueryGenerator)
    {
        $deleteOptionFormValidation = new DeleteOptionFormValidation($this -> dataFromForm, OPTION_DELETION_FORM_FIELD, $optionsAssignedToUser);

        $message = $deleteOptionFormValidation -> getMessageOfDeleteFormValidation($optionQueryGenerator);

        if ($message === ACTION_OK) {
           $this -> updateData($optionQueryGenerator);
        }
        return $message;
    }

    private function updateData($optionQueryGenerator)
    {
        $optionQueryGenerator -> removeOptionFromDatabase($this -> dataFromForm['selectedOption']);
    }
}