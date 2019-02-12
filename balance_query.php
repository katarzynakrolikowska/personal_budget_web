<?php


function selectIncomes($startDate, $endDate) {
	require_once('database.php');
	
	$query = 'SELECT icu.name, SUM(i.amount) as iSum FROM incomes as i, incomes_category_assigned_to_users as icu WHERE icu.user_id=i.user_id AND icu.id = i.income_category_assigned_to_user_id AND i.user_id=:userID AND i.date_of_income>=:startDate AND i.date_of_income<=:endDate GROUP BY icu.name ORDER BY iSUM DESC';
	
	$command = $db -> prepare($query);
	$command -> bindValue(':userID', $_SESSION['loggedID'], PDO::PARAM_INT);
	$command -> bindValue(':startDate', $startDate, PDO::PARAM_STR);
	$command -> bindValue(':endDate', $endDate, PDO::PARAM_STR);
	$command -> execute();
	
	
	$_SESSION['incomes'] = $command -> fetchAll();
	
	$query = 'SELECT ecu.name, SUM(e.amount) as eSum FROM expenses as e, expenses_category_assigned_to_users as ecu WHERE ecu.user_id=e.user_id AND ecu.id = e.expense_category_assigned_to_user_id AND e.user_id=:userID AND e.date_of_expense>=:startDate AND e.date_of_expense<=:endDate GROUP BY ecu.name ORDER BY eSUM DESC';
	
	$command = $db -> prepare($query);
	$command -> bindValue(':userID', $_SESSION['loggedID'], PDO::PARAM_INT);
	$command -> bindValue(':startDate', $startDate, PDO::PARAM_STR);
	$command -> bindValue(':endDate', $endDate, PDO::PARAM_STR);
	$command -> execute();
	
	
	$_SESSION['expenses'] = $command -> fetchAll();
}

?>