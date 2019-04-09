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

	if ($portal -> loggedInUser) {
		$username = $portal -> loggedInUser -> getName();
	}

	if (isset($_GET['result'])) {
		$messageOK = $portal -> getMessage();
	} else {
		$messageError = $portal -> getMessage();
	}

	if (isset($_GET['period'])) {
		$period = $_GET['period'];
	}
	
		
	if (isset($_GET['editedItem'])) {
		$editedItem = $_GET['editedItem'];
	}

	if (isset($_GET['editionContent'])) {
		$editionContent = $_GET['editionContent'];
	} else {
		$editionContent = 'userData';
	}
	
	if (isset($_GET['modal'])) {
		$modal = $_GET['modal'];
	}

	if (isset($_GET['id'])) {
		$optionIdToRemove = $_GET['id'];
	}
	

	if (($action == 'showLoginForm' || $action == 'showRegistrationForm' || $action == 'showMain') && $portal -> loggedInUser){
		header('Location:index.php?action=showMainForLoginUser');
		return;
	}

	if (($action == 'showIncomeAddForm' || $action == 'showExpenseAddForm' || $action == 'showBalanceForSelectedPeriod' || $action == 'showMainForLoginUser' || $action == 'showSettings') && !($portal -> loggedInUser)){
		header('Location:index.php?action=showMain');
		return;
	}

	switch ($action):
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
					header('Location:index.php?action=showLoginForm&result=OK');
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
					header('Location:index.php?action=showIncomeAddForm&result=OK');
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
		case 'addExpense':
			switch ($portal -> addExpense()):
				case ACTION_OK:
					$portal -> setMessage('Wydatek został dodany!');
					header('Location:index.php?action=showExpenseAddForm&result=OK');
					return;
				case FORM_DATA_MISSING:
					$portal -> setMessage('Uzupełnij wymagane dane!');
					break;
				case INVALID_DATA:
					$portal -> setMessage('Nieprawidłowe dane!');
					break;
			endswitch;
			header('Location:index.php?action=showExpenseAddForm');
			break;
		case 'setBalance':
			switch ($period):
				case 'previousMonth':
					$portal -> setBalanceForPreviousMonth();
					break;
				case 'currentYear':
					$portal -> setBalanceForCurrentYear();
					break;
				case 'customPeriod':
					switch ($portal -> setBalanceForCustomPeriod()):
						case ACTION_OK:
							header('Location:index.php?action=showBalanceForSelectedPeriod');
							return;
						case FORM_DATA_MISSING:
							$portal -> setMessage('Uzupełnij wszystkie pola!');
							break;
						case INVALID_DATA:
							$portal -> setMessage('Nieprawidłowe dane!');
					endswitch;
				default:
					$portal -> setBalanceForCurrentMonth();
			endswitch;
			header('Location:index.php?action=showBalanceForSelectedPeriod');
			break;
		case 'editUserData':
			switch ($portal -> editUserData($editedItem)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zmienione!');
					header('Location:index.php?action=showSettings&result=OK');
					return;
				case FORM_DATA_MISSING:
					$portal -> setMessage('Operacja nie powiodła się! Wszystkie pola są obowiązkowe!');
					break;
				case INVALID_DATA:
					$portal -> setMessage('Operacja nie powiodła się! Wpisano nieprawidłowe dane!');
			endswitch;
			header('Location:index.php?action=showSettings&editionContent='.$editionContent);
			break;
		case 'editOption':
			switch ($portal -> editOption($editionContent)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zaktualizowane!');
					header('Location:index.php?action=showSettings&editionContent='.$editionContent.'&result=OK');
					return;
				case INVALID_DATA:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
				case REPEATED_OPTION:
					$portal -> setMessage('Operacja nie powiodła się! Wpisana opcja już istnieje!');
					break;
				default:
				case FORM_DATA_MISSING:
					$portal -> setMessage('Operacja nie powiodła się!');
					break;
				break;
			endswitch;
			header('Location:index.php?action=showSettings&editionContent='.$editionContent);
			break;
		case 'addOption':
			switch ($portal -> addOption($editionContent)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zaktualizowane!');
					header('Location:index.php?action=showSettings&editionContent='.$editionContent.'&result=OK');
					return;
				case INVALID_DATA:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
				case REPEATED_OPTION:
					$portal -> setMessage('Operacja nie powiodła się! Wpisana opcja już istnieje!');
					break;
				default:
				case FORM_DATA_MISSING:
					$portal -> setMessage('Operacja nie powiodła się!');
					break;
				break;
			endswitch;
			header('Location:index.php?action=showSettings&editionContent='.$editionContent);
			break;
		case 'deleteOption':
			switch ($portal -> deleteOption($editionContent)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zaktualizowane!');
					header('Location:index.php?action=showSettings&editionContent='.$editionContent.'&result=OK');
					return;
				case INVALID_DATA:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
				case REPEATED_OPTION:
					$portal -> setMessage('Operacja nie powiodła się! Wpisana opcja już istnieje!');
					break;
				case OPTION_USED:
					header('Location:index.php?action=showSettings&editionContent='.$editionContent.'&modal=show');
					return;
				default:
				case FORM_DATA_MISSING:
					$portal -> setMessage('Operacja nie powiodła się!');
					break;
				break;
			endswitch;
			header('Location:index.php?action=showSettings&editionContent='.$editionContent);
			break;
		case 'deleteOptionUsed':
			$portal -> deleteOptionWithoutValidation($editionContent, $optionIdToRemove);
			$portal -> setMessage('Dane zostały zaktualizowane!');
			header('Location:index.php?action=showSettings&editionContent='.$editionContent.'&result=OK');
			return;
		default:
			require_once 'templates/mainTemplate.php';
	endswitch;
} catch (PDOException $error) {
	echo 'Błąd: '.$error -> getMessage().'<br />';
	echo $error -> getTraceAsString().'<br />';
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
