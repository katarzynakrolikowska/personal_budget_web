<?php

function checkAmount(&$amount) {
	$amount = str_replace([',', ' '], ['.', ''], $amount);
	if(empty($amount)) {
		 $_SESSION['errorAmount'] = 'Wpisz kwotę!';
		return false;
	} else if(!filter_var($amount, FILTER_VALIDATE_FLOAT)) {
		$_SESSION['errorAmount'] = 'Nieprawidłowa kwota!';
		return false;
	} else if((float)$amount < 0) {
		$_SESSION['errorAmount'] = 'Kwota nie może być ujemna!';
		return false;
	} else return true;
	
}

function checkUserDate($date) {
	$dateObj = DateTime::createFromFormat('Y-m-d', $date);
	if(empty($date)) {
		$_SESSION['errorDate'] = 'Wybierz datę!';
		return false;
		
	} else if(!$dateObj) {
		$_SESSION['errorDate'] = 'Wpisz datę w formacie rrrr-mm-dd!';
		return false;
	} else {
		
		
		$year = $dateObj -> format('Y');
		$month = $dateObj -> format('m');
		$day = $dateObj -> format('d');
		$daysCountOfCurrentMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$startDate = DateTime::createFromFormat('Y-m-d', '1900-01-01');
		$endtDate = getLastDateOfCurrentMonth();
		if(!checkdate($month, $day, $year) || $dateObj < $startDate || $dateObj > $endtDate) {
			$_SESSION['errorDate'] = 'Niepoprawna data!';
			return false;
		} else return true;	
	} 
}


function checkSelectedOption($selectedOption, $arrayOptions) {
		
	foreach($arrayOptions as $option) {
		if($selectedOption != $option['id']){
			$_SESSION['errorOption'] = false;
		} else {
			unset($_SESSION['errorOption']);
			return true;
		}
	}
	
	if(isset($_SESSION['errorOption'])) return false;
	
}

$today = new DateTime();
$GLOBALS['year'] = $today -> format('Y');
$GLOBALS['month'] = $today -> format('m');

function getLastDateOfCurrentMonth() {
	
	$daysCountOfCurrentMonth = cal_days_in_month(CAL_GREGORIAN, $GLOBALS['month'], $GLOBALS['year']);
	return DateTime::createFromFormat('Y-m-d', $GLOBALS['year'].'-'.$GLOBALS['month'].'-'.$daysCountOfCurrentMonth);
}


function getFirstDateOfCurrentMonth() {
	
	 return DateTime::createFromFormat('Y-m-d', $GLOBALS['year'].'-'.$GLOBALS['month'].'-'.'1');
}

function getLastDateOfPreviousMonth() {
	
	 return getFirstDateOfCurrentMonth() -> modify('-1 day');
	 
}

function getFirstDateOfPreviousMonth() {
	
	 return getFirstDateOfCurrentMonth() -> modify('-1 month');
	 
}


function decimalFormat($amount) {
	return number_format($amount, 2, '.', ' ');
}


?>