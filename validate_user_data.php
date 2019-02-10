<?php
session_start();

if(!isset($_SESSION['loggedID'])) {
	header('Location:login.php');
	exit();
} else if(!isset($_POST['amount'])) {
	header('Location:menu.php');
	exit();
}



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
		$today = new DateTime();
		
		$year = $today -> format('Y');
		$month = $today -> format('m');
		$day = $today -> format('d');
		$daysCountOfCurrentMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$startDate = DateTime::createFromFormat('Y-m-d', '1900-01-01');
		$endtDate = DateTime::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$daysCountOfCurrentMonth);
		if(!checkdate($month, $day, $year) || $dateObj <= $startDate || $dateObj >= $endtDate) {
			$_SESSION['errorDate'] = 'Niepoprawna data!';
			return false;
		} else return true;	
	} 
}


function checkSelectedOption($selectedOption, $arrayOptions) {
	if(!isset($selectedOption)) {
		return $_SESSION['errorOption'] = false;
	} else {
		
		foreach($arrayOptions as $option) {
			if($selectedOption != $option['id']){
				$_SESSION['errorOption'] = false;
			} else {
				unset($_SESSION['errorOption']);
				return true;
			}
		}
	}
	if(isset($_SESSION['errorOption'])) return false;
	
}

?>