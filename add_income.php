<?php
session_start();

if(!isset($_SESSION['loggedID'])) {
	header('Location:zaloguj-sie');
	exit();
}

if(isset($_POST['amount'])) {
	$userDataOk = true;
	$amount = $_POST['amount'];
	require_once('validate_user_data.php');
	
	if(!checkAmount($amount)) {
		$userDataOk = false;
	} else $_POST['amount'] = number_format($_POST['amount'], 2, '.', '');	
	
	
	$date = $_POST['date'];
	
	if(!checkUserDate($date)) {
		$userDataOk = false;
	}
	
	if(isset($_POST['categoryIncome'])) {
		if(!checkSelectedOption($_POST['categoryIncome'], $_SESSION['categoriesIncome'])) {
			$userDataOk = false;
		}
	} else {
		$_SESSION['errorOption'] = '';
		$userDataOk = false;
	}
	
	
	if(isset($_POST['comment'])) {
		$comment = htmlentities(htmlentities($_POST['comment'], ENT_QUOTES, "UTF-8"));
		$_SESSION['comment'] = $comment;
	} 
	
	
	
	if(!$userDataOk) {
		$_SESSION['amount'] = $_POST['amount'];
		$_SESSION['date'] =  $_POST['date'];
		$_SESSION['categoryIncome'] =  $_POST['categoryIncome'];
		header('Location:dodaj-przychod');
		exit();
		
	}
	
	try {
		require_once('database.php');
		$query = 'INSERT INTO incomes VALUES(NULL, :userID, :categoryID, :amount, :date, :comment)';
		
		$command = $db -> prepare($query);
		$command -> bindValue(':userID', $_SESSION['loggedID'], PDO::PARAM_INT);
		$command -> bindValue(':categoryID', $_POST['categoryIncome'], PDO::PARAM_INT);
		$command -> bindValue(':amount', $amount, PDO::PARAM_STR);
		$command -> bindValue(':date', $date, PDO::PARAM_STR);
		$command -> bindValue(':comment', $comment, PDO::PARAM_STR);
		$command -> execute();
		
		$_SESSION['addIncomeSuccess'] = true;
		$_POST = array();
		
		
		header('Location:dodaj-przychod');
		exit();
	} catch(PDOException $error) {
		echo 'Błąd: '.$error -> getMessage().'<br />';
		echo 'Błąd serwera!';
	}
	
} else {
	header('Location:dodaj-przychod');
}


?>