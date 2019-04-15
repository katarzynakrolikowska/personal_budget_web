<?php


class DateValidation extends DataValidation
{
    private $dateModifier = null;

    public function __construct($data = '', $fieldName = '')
    {
        parent:: __construct($data, $fieldName);
        $this -> dateModifier = new DateModifier($data);
    }

    public function setData($date)
    {
        $this -> data = $date;
        $this -> dateModifier -> initDateObj($date); 
    }

    public function isValid()
    {
        if ($this -> isEmpty()) {
            return false;
        }

        if(!$this -> isValidDateFormat()) {
            return false;
        }

        if (!$this -> isValidYearMonthDay()) {
            return false;
        }

        if ($this -> isOutOfRangeDate()) {
            return false;
        }
	
        return true;
    }

    private function isValidDateFormat()
    {
        if (!$this -> dateModifier) {
            return false;
        } else {
            return true;
        }
    }

    private function isValidYearMonthDay()
    {
        $year = $this -> dateModifier -> getYear();
        $month = $this -> dateModifier -> getMonth();
        $day = $this -> dateModifier -> getDay();

        if (!checkdate($month, $day, $year)) {
            return false;
        } else {
            return true;
        }
    }

    private function isOutOfRangeDate()
    {
        $startDate = DateModifier::getDateObjFromString(START_DATE);
        $endDate = DateModifier::getLastDateOfCurrentMonth();
        
        if ($this -> isEarlierThanStartDate($startDate) || $this -> isLatterThanEndDate($endDate)) {
            return true;
        } else {
            return false;
        }
    }

    private function isEarlierThanStartDate($startDateObj)
    {
        if ($this -> dateModifier -> getDateObj() < $startDateObj) {
            return true;
        } else {
            return false;
        }
    }

    private function isLatterThanEndDate($endDateObj)
    {
        if ($this -> dateModifier -> getDateObj() > $endDateObj) {
            return true;
        } else {
            return false;
        }
    }

    public function isFirstDateEarlierThanSecondDate($firstDateStr, $secondDateStr)
    {
        $firstDateObj = DateModifier::getDateObjFromString($firstDateStr);
        $secondDateObj = DateModifier::getDateObjFromString($secondDateStr);

        if ($firstDateObj <= $secondDateObj) {
            return true;
        } else {
            return false;
        }
    }
}