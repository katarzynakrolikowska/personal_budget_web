<?php

class DateModifier
{
    private static $today = null;
    private $dateObj = null;

    public function __construct($date)
    {
        self::$today = new DateTime();
        $this -> initDateObj($date);
    }

    public function initDateObj($date)
    {
        $this -> dateObj = self::getDateObjFromString($date);
    }

    public static function getDateObjFromString($date)
    {
        if (DateTime::createFromFormat('Y-m-d', $date)) {
            return DateTime::createFromFormat('Y-m-d', $date);
        } else {
            return null;
        }
    }

    public function getDateObj()
    {
        return $this -> dateObj;
    }

    private static function getDateAsString($dateObj)
    {
        if ($dateObj -> format('Y-m-d')) {
            return $dateObj -> format('Y-m-d');
        } else {
            return null;
        }
    }

    public function getYear()
    {
        if ($this -> dateObj) {
            return $this -> dateObj -> format('Y'); 
        }
    }

    public function getMonth()
    {
        if ($this -> dateObj) {
            return $this -> dateObj -> format('m'); 
        }
    }

    public function getDay()
    {
        if ($this -> dateObj) {
            return $this -> dateObj -> format('d'); 
        }
    }

    public static function getLastDateOfCurrentMonthAsString()
    {
        return self::getDateAsString(self::getLastDateOfCurrentMonth());
    }

    public static function getLastDateOfCurrentMonth()
    {
        $daysCountOfCurrentMonth = self::getDaysCountOfCurrentMonth();
       
        return self::getDateObjFromString(self::getCurrentYear().'-'.self::getCurrentMonth().'-'.$daysCountOfCurrentMonth);
    }

    private static function getDaysCountOfCurrentMonth()
    {
        return cal_days_in_month(CAL_GREGORIAN, self::getCurrentMonth(), self::getCurrentYear());
    }

    public static function getFirstDateOfCurrentMonthAsString()
    {
        return self::getDateAsString(self::getFirstDateOfCurrentMonth());
    }

    public static function getFirstDateOfCurrentMonth()
    {
        return self::getDateObjFromString(self::getCurrentYear().'-'.self::getCurrentMonth().'-1');
    }

    public static function getLastDateOfPreviousMonthAsString()
    {
        return self::getDateAsString(self::getLastDateOfPreviousMonth());
    }

    public static function getLastDateOfPreviousMonth()
    {
        return self::getFirstDateOfCurrentMonth() -> modify('-1 day');
    }

    public static function getFirstDateOfPreviousMonthAsString()
    {
        return self::getDateAsString(self::getFirstDateOfPreviousMonth());
    }

    public static function getFirstDateOfPreviousMonth()
    {
        return self::getFirstDateOfCurrentMonth() -> modify('-1 month');
    }

    public static function getFirstDateOfCurrentYearAsString()
    {
        return self::getCurrentYear().'-01-01';
    }

    public static function getLastDateOfCurrentYearAsString()
    {
        return self::getCurrentYear().'-12-31';
    }

    private static function getCurrentYear()
    {
        $today = new DateTime();
        return $today -> format('Y');
    }

    private static function getCurrentMonth()
    {   
        $today = new DateTime();
        return $today -> format('m');
    }

    
}