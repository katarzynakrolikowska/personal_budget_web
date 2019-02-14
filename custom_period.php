<?php
session_start();
if(!isset($_SESSION['loggedID'])) {
	header('Location:login.php');
	exit();
}
if(isset($_POST['startDate']) && isset($_POST['endDate'])) {

	require_once('validate_user_data.php');
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	
	
	if(!checkUserDate($startDate) || !checkUserDate($endDate)) {
		header('Location:balance.php');
		exit();
	
	}
		
	$startDateObj = DateTime::createFromFormat('Y-m-d', $startDate);
	$endDateObj = DateTime::createFromFormat('Y-m-d', $endDate);
	if($startDateObj > $endDateObj) {
		$_SESSION['errorDate'] = 'Podano niepoprawne daty!';
		header('Location:balance.php');
		exit();
	}
	//$startDate = DateTime::createFromFormat('Y-m-d', date('Y').'-01-01') -> format('Y-m-d');
	//$endDate = DateTime::createFromFormat('Y-m-d', date('Y').'-12-31') -> format('Y-m-d');
	$_SESSION['selectedPeriod'] = 'Twój bilans za wybrany okres <br /> '.$startDate.' - '.$endDate;		
	try {
		require_once('balance_query.php');
		selectIncomes($startDate, $endDate);
		header('Location:balance.php');
		exit();
	} catch(PDOException $error) {
		echo 'Błąd: '.$error -> getMessage().'<br />';
		echo 'Błąd serwera!';
	}
} else {
	header('Location:balance.php');
	exit();
}


?>