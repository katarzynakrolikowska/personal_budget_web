<?php

require_once 'constants.php';
spl_autoload_register('classLoader');
session_start();
try {
	$portal = new PortalFront('localhost', 'root', '', 'personal_budget_data');
	$action = 'showMain';

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}

	if (isset($_GET['msg'])) {
		$messageOK = $portal -> getMessage();
	} else {
		$messageError = $portal -> getMessage();
	}
	

	if ($portal -> loggedInUser) {
		$username = $portal -> loggedInUser -> getName();
	}

	if (($action == 'showLoginForm' || $action == 'showRegistrationForm' || $action == 'showMain') && $portal -> loggedInUser){
		header('Location:index.php?action=showMainForLoginUser');
		return;
	}

	if (($action == 'showIncomeAddForm' || $action == 'showExpenseAddForm' || $action == 'showBalance' || $action == 'showMainForLoginUser') && !($portal -> loggedInUser)){
		header('Location:index.php?action=showMain');
		return;
	}

	switch($action):
		case 'login':
			switch ($portal -> login()):
				case ACTION_OK:
					header('Location:index.php?action=showMainForLoginUser');
					return;
				case FORM_DATA_MISSING:
					$portal -> setMessage('Uzupełnij wszystkie dane!');
					break;
				case INVALID_DATA:
					$portal -> setMessage('Nieprawidłowy login lub hasło!');
					break;
				default:
					$portal -> setMessage('Błąd serwera! Proszę spróbować później.');
			endswitch;
			header('Location:index.php?action=showLoginForm');
			break;
		case 'logout':
			$portal -> logout();
			header('Location:index.php?action=showMain');
			break;
		case 'register':
			switch ($portal -> registerUser()):
				case ACTION_OK:
					$portal -> setMessage('Konto zostało założone!');
					header('Location:index.php?action=showLoginForm&msg=OK');
					return;
				case FORM_DATA_MISSING:
					$portal -> setMessage('Uzupełnij wszystkie dane!');
					break;
				case INVALID_DATA:
					$portal -> setMessage('Nieprawidłowe dane!');
					break;
				case PASSWORDS_DO_NOT_MATCH:
					$portal -> setMessage('Podane hasła nie są identyczne!');
					break;
				case LOGIN_ALREADY_EXISTS:
					$portal -> setMessage('Istnieje konto przypisane do podanego loginu!');
					break;
			endswitch;
			header('Location:index.php?action=showRegistrationForm');
			break;
		case 'addIncome':
			switch ($portal -> addIncome()):
				case ACTION_OK:
					$portal -> setMessage('Przychód został dodany!');
					header('Location:index.php?action=showIncomeAddForm&msg=OK');
					return;
				case FORM_DATA_MISSING:
					$portal -> setMessage('Uzupełnij wymagane dane!');
					break;
				case INVALID_DATA:
					$portal -> setMessage('Nieprawidłowe dane!');
					break;
			endswitch;
			header('Location:index.php?action=showIncomeAddForm');
			break;
		default:
			require_once 'templates/mainTemplate.php';
	endswitch;
} catch (PDOException $error) {
	echo 'Błąd: '.$error -> getMessage().'<br />';
	echo 'Błąd serwera!';
} catch (Exception $error) {
	echo $error -> getMessage().'<br />';
	echo $error -> getTraceAsString().'<br />';
}

function classLoader($name)
{
	if (file_exists("klasy/$name.php")){
		require_once("klasy/$name.php");
	  } else {
		throw new Exception("Brak pliku z definicją klasy.");
	  }
}
?>