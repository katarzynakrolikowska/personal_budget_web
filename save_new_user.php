<?php

session_start();

if(isset($_POST['username'])) {
	try {
		$username = trim($_POST['username']);
		$email = trim($_POST['email']);
		$password1 = trim($_POST['password1']);
		$password2 = trim($_POST['password2']);

		$isUserDataOk = true;


		$_SESSION['username'] =  mb_strtoupper(mb_substr($username, 0, 1)).mb_strtolower(mb_substr($username,1));

		if(empty($username)) {
			$_SESSION['errorUsername'] = 'Wpisz imię!';
			$isUserDataOk = false;
		} else if(mb_strlen($username) < 3) {
			$_SESSION['errorUsername'] = 'Imię powinno składać się z minimum 3 znaków!';
			$isUserDataOk = false;
		} else if(!preg_match('/^[a-zA-ZąęćżźńłóśĄĘĆŻŹŁÓŃŚ\s]+$/', $username)) {
			$_SESSION['errorUsername'] = 'Imię powinno składać się z samych liter!';
			$isUserDataOk = false;
		} 

		$_SESSION['email'] = $email;
		
		
		if(empty($email)) {
			$_SESSION['errorEmail'] = 'Wpisz adres email!';
			$isUserDataOk = false;
		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['errorEmail'] ='Nieprawidłowy adres email!';
			$isUserDataOk = false;
		}

		if(empty($password1)) {
			$_SESSION['errorPassword'] = 'Wpisz hasło!';
			$isUserDataOk = false;
		} else if((mb_strlen($password1) < 8) || (mb_strlen($password1) > 20)) {
			$_SESSION['errorPassword'] = 'Hasło musi posiadać od 8 do 20 znaków!';
			$isUserDataOk = false;
		} else if($password1 != $password2) {
			$_SESSION['errorPassword'] = 'Podane hasła nie są identyczne!';
			$isUserDataOk = false;
		}

		require_once('database.php');
				
		$query = 'SELECT id,password FROM users WHERE email = :email';
		
		$command = $db -> prepare($query);
		$command -> bindValue(':email', $email, PDO::PARAM_STR);
		$command -> execute();
		
		if($command -> rowCount() > 0) {
			$_SESSION['errorEmail'] ='Istnieje konto przypisane do podanego adresu email';
			$isUserDataOk = false;
		}
		
		if($isUserDataOk == false) {
			header('Location:zarejestruj-sie');
			exit();
		} else {	
			$password1 = password_hash($password1, PASSWORD_DEFAULT);
			
			$query = 'INSERT INTO users VALUES(NULL, :username, :password, :email)';
			
			$command = $db -> prepare($query);
			$command -> bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
			$command -> bindValue(':password', $password1, PDO::PARAM_STR);
			$command -> bindValue(':email', $email, PDO::PARAM_STR);
			$command -> execute();
			
			$query = 'INSERT INTO expenses_category_assigned_to_users(user_id, name) SELECT 
				(SELECT id FROM users WHERE email=:email),
				name FROM expenses_category_default as e_def ORDER BY e_def.id';
			
			$command = $db -> prepare($query);
			$command -> bindValue(':email', $email, PDO::PARAM_STR);
			$command -> execute();
			
			$query = 'INSERT INTO incomes_category_assigned_to_users(user_id, name) SELECT 
				(SELECT id FROM users WHERE email=:email),
				name FROM incomes_category_default as i_def ORDER BY i_def.id';
			
			$command = $db -> prepare($query);
			$command -> bindValue(':email', $email, PDO::PARAM_STR);
			$command -> execute();
			
			$query = 'INSERT INTO payment_methods_assigned_to_users(user_id, name) SELECT 
				(SELECT id FROM users WHERE email=:email),
				name FROM payment_methods_default as pm_def ORDER BY pm_def.id';
			
			$command = $db -> prepare($query);
			$command -> bindValue(':email', $email, PDO::PARAM_STR);
			$command -> execute();
			
			unset($_SESSION['username']);
			unset($_SESSION['email']);
			
			$_SESSION['newUserSuccess'] = 'Konto zostało założone!';
			
			header('Location:zaloguj-sie');
			exit();
		}
	} catch(PDOException $error) {
		echo 'Błąd: '.$error -> getMessage().'<br />';
		echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!';
	}
		
	
} else {
	header('Location:zarejestruj-sie');
	exit();

}

?>