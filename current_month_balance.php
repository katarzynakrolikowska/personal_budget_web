<?php
session_start();
if(!isset($_SESSION['loggedID'])) {
	header('Location:zaloguj-sie');
	exit();
}

require_once('validate_user_data.php');
	
$startDate = getFirstDateOfCurrentMonth() -> format('Y-m-d');
$endDate = getLastDateOfCurrentMonth() -> format('Y-m-d');
$_SESSION['selectedPeriod'] = 'Twój bilans za bieżący miesiąc';	
try {
	require_once('balance_query.php');
	selectIncomes($startDate, $endDate);
	
	
	header('Location:przegladaj-bilans');
	exit();
} catch(PDOException $error) {
	echo 'Błąd: '.$error -> getMessage().'<br />';
	echo 'Błąd serwera!';
}



?>