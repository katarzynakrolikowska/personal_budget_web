<?php
session_start();
if(!isset($_SESSION['loggedID'])) {
	header('Location:login.php');
	exit();
}


require_once('validate_user_data.php');
	
$startDate = DateTime::createFromFormat('Y-m-d', date('Y').'-01-01') -> format('Y-m-d');
$endDate = DateTime::createFromFormat('Y-m-d', date('Y').'-12-31') -> format('Y-m-d');
$_SESSION['selectedPeriod'] = 'Twój bilans za bieżący rok';		
try {
	require_once('balance_query.php');
	selectIncomes($startDate, $endDate);
	header('Location:balance.php');
	exit();
} catch(PDOException $error) {
	echo 'Błąd: '.$error -> getMessage().'<br />';
	echo 'Błąd serwera!';
}



?>