<?php

class DatesFormValidation extends DataArrayValidation
{
    private $dateValidation = null;
    public function __construct($sendedFieldsFromForm, $namesOfRequiredFields, $dataValidation = null)
    {
        parent:: __construct($sendedFieldsFromForm, $namesOfRequiredFields, $dataValidation = null);
        $this -> dateValidation = new DateValidation();
    }

    public function getMessageOfDatesFormValidation()
    {
        if ($this ->  isRequiredFieldsFromFormMissing()) {
            return  FORM_DATA_MISSING;
        }

        if (!$this -> isValidDates()) {
            return INVALID_DATA;
        }

        if (!$this -> isChronologicDates()) {
            return INVALID_DATA;
        }

        return ACTION_OK;
    }

    private function isValidDates()
    {
        foreach ($this -> sendedFieldsFromForm as $key => $value) {
            $this -> dateValidation -> setData($value);
            if (!$this -> dateValidation -> isValid()) {
                return false;
            }
        }
       
        return true;
    }

    private function isChronologicDates()
    {
        if ($this -> dateValidation -> isFirstDateEarlierThanSecondDate($this -> sendedFieldsFromForm['startDate'], $this -> sendedFieldsFromForm['endDate'])) {
            return true;
        } else {
            return false;
        }
    }
}