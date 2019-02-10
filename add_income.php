<?php
session_start();

if(!isset($_SESSION['loggedID'])) {
	header('Location:login.php');
	exit();
}

if(isset($_POST['amount'])) {
	$userDataOk = true;
	$amount = $_POST['amount'];
	require_once('validate_user_data.php');
	
	if(!checkAmount($amount)) {
		$userDataOk = false;
	} else $userDataOk = true;
	
	
	
	$date = $_POST['date'];
	
	if(!checkUserDate($date)) {
		$userDataOk = false;
	} else $userDataOk = true;
	
	if(!checkSelectedOption($_POST['categoryIncome'], $_SESSION['categoriesIncome'])) {
		$userDataOk = false;
	} else $userDataOk = true;
	
	
	
	if(isset($_POST['comment'])) {
		$comment = htmlentities(htmlentities($_POST['comment'], ENT_QUOTES, "UTF-8"));
		$_SESSION['comment'] = $comment;
	} 
	
	if(!$userDataOk) {
		$_SESSION['amount'] = $_POST['amount'];
		$_SESSION['date'] =  $_POST['date'];
		header('Location:income.php');
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
		unset($_POST['amount']);
		
		header('Location:income.php');
		exit();
	} catch(PDOException $error) {
		echo 'Błąd: '.$error -> getMessage().'<br />';
		echo 'Błąd serwera!';
	}
	
} else {
	header('Location:income.php');
}


?>