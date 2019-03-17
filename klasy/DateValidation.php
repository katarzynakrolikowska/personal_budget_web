<?php


class DateValidation extends DataValidation
{
    private $today = null;
    private $dateObj = null;

    public function __construct($data)
    {
        parent:: __construct($data);
        $this -> today = new DateTime();
        $this -> dateObj = DateTime::createFromFormat('Y-m-d', $this -> data);
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
        if (!$this -> dateObj) {
            return false;
        } else {
            return true;
        }
    }

    private function isValidYearMonthDay()
    {
        $year = $this -> getYear();
        $month = $this -> getMonth();
        $day = $this -> getDay();

        if (!checkdate($month, $day, $year)) {
            return false;
        } else {
            return true;
        }
    }

    private function getYear()
    {
        return $this -> dateObj -> format('Y');
    }

    private function getMonth()
    {
        return $this -> dateObj -> format('m');
    }

    private function getDay()
    {
        return $this -> dateObj -> format('d');
    }

    private function isOutOfRangeDate()
    {
        $startDate = DateTime::createFromFormat('Y-m-d', START_DATE);
        $endDate = $this -> getLastDateOfCurrentMonth();

        if ($this -> isEarlierThanStartDate($startDate) || $this -> isLatterThanEndDate($endDate)) {
            return true;
        } else {
            return false;
        }
    }

    private function getLastDateOfCurrentMonth()
    {
        $daysCountOfCurrentMonth = $this -> getDaysCountOfCurrentMonth();
       
        return DateTime::createFromFormat('Y-m-d', $this -> getCurrentYear().'-'.$this -> getCurrentMonth().'-'.$daysCountOfCurrentMonth);
    }

    private function getDaysCountOfCurrentMonth()
    {
        return cal_days_in_month(CAL_GREGORIAN, $this -> getCurrentMonth(), $this -> getCurrentYear());
    }

    private function getCurrentYear()
    {
        return $this -> today -> format('Y');
    }

    private function getCurrentMonth()
    {
        return $this -> today -> format('m');
    }

    private function isEarlierThanStartDate($startDate)
    {
        if ($this -> dateObj < $startDate) {
            return true;
        } else {
            return false;
        }
    }

    private function isLatterThanEndDate($endDate)
    {
        if ($this -> dateObj > $endDate) {
            return true;
        } else {
            return false;
        }
    }

    

}