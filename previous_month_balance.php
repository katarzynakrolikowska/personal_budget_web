<?php
session_start();
if(!isset($_SESSION['loggedID'])) {
	header('Location:zaloguj-sie');
	exit();
}


require_once('validate_user_data.php');
	
$startDate = getFirstDateOfPreviousMonth() -> format('Y-m-d');
$endDate = getLastDateOfPreviousMonth() -> format('Y-m-d');
$_SESSION['selectedPeriod'] = 'Twój bilans za poprzedni miesiąc';		
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