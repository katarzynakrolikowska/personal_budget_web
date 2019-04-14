<?php

class DatesFormValidation extends DataArrayValidation
{
    private $dateValidation = null;
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields)
    {
        parent:: __construct($sendedFieldsFromForm, $namesOfRequiredFields);
        $this -> dateValidation = new DateValidation();
    }

    public function getMessageOfDatesFormValidation()
    {
        if ($this ->  isRequiredFieldsFromFormMissing()) {
            return  FORM_DATA_MISSING;
        }
        
        if (!$this -> isValidDatesFromForm()) {
            return INVALID_DATA;
        }

        return ACTION_OK;
    }

    private function isValidDatesFromForm()
    {
        if ($this -> isValidDataFromForm($this -> getValidationObjects()) && $this -> isChronologicDates()) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationObjects()
    {
        $startDateValidation = new DateValidation($this -> sendedFieldsFromForm['startDate'], 'startDate');
        $endDateValidation = new DateValidation($this -> sendedFieldsFromForm['endDate'], 'endDate');

        return $validationObjects = array($startDateValidation,
                                        $endDateValidation);
    }

    private function isChronologicDates()
    {
        $firstDate = $this -> sendedFieldsFromForm['startDate'];
        $secondDate = $this -> sendedFieldsFromForm['endDate'];

        if ($this -> dateValidation -> isFirstDateEarlierThanSecondDate($firstDate, $secondDate)) {
            return true;
        } else {
            return false;
        }
    }
}