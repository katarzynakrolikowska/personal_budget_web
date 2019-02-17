<?php

session_start();

if(isset($_SESSION['loggedID'])) {
	header('Location:menu-glowne');
	exit();
}

if(isset($_POST['emailLog'])) {
	$email = filter_input(INPUT_POST, 'emailLog');
	$password = filter_input(INPUT_POST, 'passwordLog');
	
	
	try {
		require_once 'database.php';
		$query = $db -> prepare('SELECT id, username, password FROM users WHERE email=:email');
		$query -> bindValue(':email', $email, PDO::PARAM_STR);
		$query -> execute();
		
		$user = $query -> fetch();
		
		if($user && password_verify($password, $user['password'])) {
			$_SESSION['loggedID'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			header('Location:menu-glowne');
			exit();
		} else {
			$_SESSION['givenEmail'] = $email;
			header('Location:zaloguj-sie');
			exit();
		}
		
		
		
	} catch(PDOException $error) {
		echo $error -> getMessage().'<br />';
		echo 'Błąd serwera!';
	}
	
	
} else {
	header('Location:zaloguj-sie');
}


?>