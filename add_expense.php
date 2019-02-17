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
	} 
	
	
	
	$date = $_POST['date'];
	
	if(!checkUserDate($date)) {
		$userDataOk = false;
	} 
	

	
	if(isset($_POST['paymentMethod'])) {
		if(!checkSelectedOption($_POST['paymentMethod'], $_SESSION['paymentMethods'])) {
			$_SESSION['errorOptionPayment'] = '';
			$userDataOk = false;
		}
	} else {
		$_SESSION['errorOptionPayment'] = '';
		$userDataOk = false;
	}
	
	if(isset($_POST['categoryExpense'])) {
		if(!checkSelectedOption($_POST['categoryExpense'], $_SESSION['categoriesExpense'])) {
			$_SESSION['errorOptionExp'] = '';
			$userDataOk = false;
		}
	} else {
		$_SESSION['errorOptionExp'] = '';
		$userDataOk = false;
	}
	
	
	if(isset($_POST['comment'])) {
		$comment = htmlentities(htmlentities($_POST['comment'], ENT_QUOTES, "UTF-8"));
		$_SESSION['comment'] = $comment;
	} 
	
	if(!$userDataOk) {
		$_SESSION['amount'] = $_POST['amount'];
		$_SESSION['date'] =  $_POST['date'];
		$_SESSION['categoryExpense'] =  $_POST['categoryExpense'];
		$_SESSION['paymentMethod'] =  $_POST['paymentMethod'];
		header('Location:expense.php');
		exit();
	}
	
	try {
		require_once('database.php');
		$query = 'INSERT INTO expenses VALUES(NULL, :userID, :categoryID, :paymentID, :amount, :date, :comment)';
		
		$command = $db -> prepare($query);
		$command -> bindValue(':userID', $_SESSION['loggedID'], PDO::PARAM_INT);
		$command -> bindValue(':categoryID', $_POST['categoryExpense'], PDO::PARAM_INT);
		$command -> bindValue(':paymentID', $_POST['paymentMethod'], PDO::PARAM_INT);
		$command -> bindValue(':amount', $amount, PDO::PARAM_STR);
		$command -> bindValue(':date', $date, PDO::PARAM_STR);
		$command -> bindValue(':comment', $comment, PDO::PARAM_STR);
		$command -> execute();
		
		$_SESSION['addExpenseSuccess'] = true;
		
		$_POST = array();
		
		header('Location:expense.php');
		exit();
	} catch(PDOException $error) {
		echo 'Błąd: '.$error -> getMessage().'<br />';
		echo 'Błąd serwera!';
	}
	
} else {
	header('Location:expense.php');
}


?>