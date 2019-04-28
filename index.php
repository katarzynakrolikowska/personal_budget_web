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

	if (isset($_GET['categoryId'])) {
		$limitedCategoryId = $_GET['categoryId'];
	}

	if (isset($_GET['date'])) {
		$inputDateOfExpense = $_GET['date'];
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

	if (isset($_GET['category'])) {
		$category = $_GET['category'];
	}

	if (isset($_GET['itemId'])) {
		$itemId = $_GET['itemId'];
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
			switch ($portal -> logIn()):
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
			$portal -> setSessionOfInvalidForm();
			header('Location:index.php?action=showLoginForm');
			break;
		case 'loginAjax':
			switch ($result = $portal -> logIn()):
				case ACTION_OK:
					break;
				case FORM_DATA_MISSING:
					$portal -> setMessage('Uzupełnij wszystkie dane!');
					break;
				case INVALID_DATA:
					$portal -> setMessage('Nieprawidłowy login lub hasło!');
					break;
				default:
					$portal -> setMessage('Błąd serwera! Proszę spróbować później.');
			endswitch;
			$portal -> setJsonFormMessage($result);
			exit();
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
				case PASSWORDS_DO_NOT_MATCH:
					$portal -> setMessage('Podane hasła nie są identyczne!');
					break;
				case LOGIN_ALREADY_EXISTS:
					$portal -> setMessage('Istnieje konto przypisane do podanego loginu!');
					break;
				case INVALID_DATA:
				default:
					$portal -> setMessage('Nieprawidłowe dane!');
					break;
			endswitch;
			$portal -> setSessionOfInvalidForm();
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
				default:
					$portal -> setMessage('Nieprawidłowe dane!');
					break;
			endswitch;
			$portal -> setSessionOfInvalidForm();
			header('Location:index.php?action=showIncomeAddForm');
			break;
		case 'addIncomeAjax':
			switch ($result = $portal -> addIncome()):
				case ACTION_OK:
					$portal -> setMessage('Przychód został dodany!'); 
					break;
				case FORM_DATA_MISSING:
					$portal -> setMessage('Uzupełnij wymagane dane!');
					break;
				case INVALID_DATA:
				default:
					$portal -> setMessage('Nieprawidłowe dane!');
					break;
			endswitch;
			$portal -> setJsonFormMessage($result);
			exit();
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
				default:
					$portal -> setMessage('Nieprawidłowe dane!');
					break;
			endswitch;
			$portal -> setSessionOfInvalidForm();
			header('Location:index.php?action=showExpenseAddForm');
			break;
		case 'addExpenseAjax':
			switch ($result = $portal -> addExpense()):
				case ACTION_OK:
					$portal -> setMessage('Wydatek został dodany!'); 
					break;
				case FORM_DATA_MISSING:
					$portal -> setMessage('Uzupełnij wymagane dane!');
					break;
				case INVALID_DATA:
				default:
					$portal -> setMessage('Nieprawidłowe dane!');
					break;
			endswitch;
			$portal -> setJsonFormMessage($result);
			exit();
		case 'getLimitInfo':
			$portal -> setLimitValuesOfExpenseCategory($limitedCategoryId, $inputDateOfExpense);
			exit();
		case 'setBalance':
			switch ($period):
				case 'previousMonth':
					$portal -> setBalanceForPreviousMonth();
					break;
				case 'currentYear':
					$portal -> setBalanceForCurrentYear();
					break;
				case 'customPeriod':
					switch ($portal -> getMessageOfBalanceSettingsForCustomPeriod()):
						case ACTION_OK:
							header('Location:index.php?action=showBalanceForSelectedPeriod');
							return;
						case INVALID_DATA:
						case FORM_DATA_MISSING:
						default:
							$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
							break;
					endswitch;
				default:
					$portal -> setBalanceForCurrentMonth();
			endswitch;
			header('Location:index.php?action=showBalanceForSelectedPeriod');
			break;
		case 'editIncome':
			switch ($portal -> editIncome($itemId)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zmienione!');
					header('Location:index.php?action=showBalanceForSelectedPeriod&result=OK');
					return;
				case INVALID_DATA:
				case FORM_DATA_MISSING:
				default:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
			endswitch;
			header('Location:index.php?action=showBalanceForSelectedPeriod');
			break;
		case 'editIncomeAjax':
			switch ($result = $portal -> editIncome($itemId)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zmienione!');
					break;
				case INVALID_DATA:
				case FORM_DATA_MISSING:
				default:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
			endswitch;
			
			$portal -> setJsonFormMessage($result);
			break;
		case 'deleteIncome':
			$portal -> deleteIncome($itemId);
			$portal -> setMessage('Dane zostały zmienione!');
			header('Location:index.php?action=showBalanceForSelectedPeriod&result=OK');
			return;
		case 'editExpense':
			switch($portal -> editExpense($itemId)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zmienione!');
					header('Location:index.php?action=showBalanceForSelectedPeriod&result=OK');
					return;
				case INVALID_DATA:
				case FORM_DATA_MISSING:
				default:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
			endswitch;
			header('Location:index.php?action=showBalanceForSelectedPeriod');
			break;
		case 'deleteExpense':
			$portal -> deleteExpense($itemId);
			$portal -> setMessage('Dane zostały zmienione!');
			header('Location:index.php?action=showBalanceForSelectedPeriod&result=OK');
			return;
		case 'editUserData':
			switch ($portal -> editUserData($editedItem)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zmienione!');
					header('Location:index.php?action=showSettings&result=OK');
					return;
				case LOGIN_ALREADY_EXISTS:
					$portal -> setMessage('Operacja nie powiodła się! Podany login jest zajęty!');
					break;
				case INVALID_DATA:
				case FORM_DATA_MISSING:
				default:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
			endswitch;
			header('Location:index.php?action=showSettings&editionContent='.$editionContent);
			break;
		case 'editUserDataAjax':
		$_SESSION['test'] .= $editedItem.'<br />';
			switch ($portal -> editUserData($editedItem)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zmienione!');
					break;
				case LOGIN_ALREADY_EXISTS:
					$portal -> setMessage('Operacja nie powiodła się! Podany login jest zajęty!');
					break;
				case INVALID_DATA:
				case FORM_DATA_MISSING:
				default:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
			endswitch;
			echo $portal -> getMessage();
			//$portal -> setJsonFormMessage();
			break;
		case 'editOption':
			switch ($portal -> editOption($editionContent)):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zaktualizowane!');
					header('Location:index.php?action=showSettings&editionContent='.$editionContent.'&result=OK');
					return;
				case REPEATED_OPTION:
					$portal -> setMessage('Operacja nie powiodła się! Wpisana opcja już istnieje!');
					break;
				case INVALID_DATA:
				case FORM_DATA_MISSING:
				default:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
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
				case REPEATED_OPTION:
					$portal -> setMessage('Operacja nie powiodła się! Wpisana opcja już istnieje!');
					break;
				case INVALID_DATA:
				case FORM_DATA_MISSING:
				default:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
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
				case FORM_DATA_MISSING:
				default:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
				break;
			endswitch;
			header('Location:index.php?action=showSettings&editionContent='.$editionContent);
			break;
		case 'checkOptionBeforeDeletion':
			$result = $portal -> isOptionUsed($editionContent, $optionIdToRemove);
			$portal -> setJsonMsgIsOptionUsed($result);
			exit();
		case 'setLimit':
			switch ($portal -> setLimitOfExpenseCategory()):
				case ACTION_OK:
					$portal -> setMessage('Dane zostały zaktualizowane!');
					header('Location:index.php?action=showSettings&editionContent='.$editionContent.'&result=OK');
					return;
				case FORM_DATA_MISSING:
				case INVALID_DATA:
				default:
					$portal -> setMessage('Operacja nie powiodła się! Nieprawidłowe dane!');
					break;
			endswitch;
			header('Location:index.php?action=showSettings&editionContent='.$editionContent);
			break;
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
