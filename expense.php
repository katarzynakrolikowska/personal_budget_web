<?php
session_start();
if(!isset($_SESSION['loggedID'])) {
	header('Location:login.php');
	exit();
}

$_SESSION['paymentMethods'] = array();
$_SESSION['categoriesExpense'] = array();
try{
	require_once 'database.php';
	
	$query = $db -> prepare('SELECT id, name FROM payment_methods_assigned_to_users WHERE user_id=:id');
	
	$query -> bindValue(':id', $_SESSION['loggedID'], PDO::PARAM_INT);
	$query -> execute();
	
	$_SESSION['paymentMethods'] = $query -> fetchAll();
	
	
	$query = $db -> prepare('SELECT id, name FROM expenses_category_assigned_to_users WHERE user_id=:id');
	
	$query -> bindValue(':id', $_SESSION['loggedID'], PDO::PARAM_INT);
	$query -> execute();
	
	$_SESSION['categoriesExpense'] = $query -> fetchAll();
} catch(PDOException $error) {
	echo $error -> getMessage().'<br />';
	echo 'Błąd serwera!';
}
?>


<! DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>Dodaj wydatek</title>
	<?php
		require_once('head_links.php');
	?>
	
	

</head>

<body>
	<div class="container-fluid p-0" id="containerExpense" >
		<?php
			$_SESSION['expense'] = '';
			require_once('nav_header.php');
			unset($_SESSION['expense']);
		?>
		
		<div class="row pb-5 justify-content-center addDataRow mx-0">
			
			<?php
				if(isset($_SESSION['addExpenseSuccess'])) {
					echo '<div class="col-12 mb-4 mt-5 text-center"><h4>Wydatek został dodany!</h4></div>';
					unset($_SESSION['addExpenseSuccess']);
				}
			?>
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 containerAddData">
				<form class="formAddData" action="add_expense.php" method="post">
					<h3>Wprowadź wydatek</h3>
					
					<div class="input-group ">
						<input type="number" class="form-control" step="0.01" placeholder="Kwota" name="amount" value=
						<?php
							if(isset($_SESSION['amount'])) {
								echo $_SESSION['amount'];
								unset($_SESSION['amount']);
							} 
						?>>
						<div class="input-group-prepend ">
							<span class="input-group-text" id="amountExpense"><i class="fas fa-pen-alt" ></i></span>
						</div>
					</div>
					<?php
						if(isset($_SESSION['errorAmount'])) {
							echo '<div class="error">'.$_SESSION['errorAmount'].'</div>';
							unset($_SESSION['errorAmount']);
						}
					?>						
					<div class="input-group ">	
						<input type="date" class="form-control" id="date" name="date" placeholder="Data" value=
						<?php
							if(isset($_SESSION['date'])) {
								echo $_SESSION['date'];
								unset($_SESSION['date']);
							} else {
								echo date('Y-m-d');
							}
						?>>
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
						</div>
					</div>
					<?php
						if(isset($_SESSION['errorDate'])) {
							echo '<div class="error">'.$_SESSION['errorDate'].'</div>';
							unset($_SESSION['errorDate']);
						}
					?>	
					<div class="input-group ">
						<select class="custom-select" id="paymentMethod" name="paymentMethod">
							<option disabled selected value="n">Wybierz metodę płatności</option>
							<?php
								foreach($_SESSION['paymentMethods'] as $method) {
									if(isset($_SESSION['paymentMethod']) && ($_SESSION['paymentMethod'] == $method['id'])) {
										echo '<option value='.$method['id'].' selected>'.$method['name'].'</option>';
									} else {
										echo '<option value='.$method['id'].'>'.$method['name'].'</option>';
									}
								}
								unset($_SESSION['paymentMethod']);
							?>
						</select>
						<div class="input-group-prepend ">
							<span class="input-group-text " id="paymentMethods"><i class="fas fa-pen-alt "></i></span>
						</div>
					</div>
					<?php
						if(isset($_SESSION['errorOptionPayment'])) {
							echo '<div class="error">Niepoprawna metoda płatności!</div>';
							unset($_SESSION['errorOptionPayment']);
						}
					?>	
					<div class="input-group ">
						<select class="custom-select" id="category" name="categoryExpense">
							<option disabled selected>Wybierz kategorię</option>
							<?php
								foreach($_SESSION['categoriesExpense'] as $category) {
									if(isset($_SESSION['categoryExpense']) && ($_SESSION['categoryExpense'] == $category['id'])) {
										echo '<option value='.$category['id'].' selected>'.$category['name'].'</option>';
									} else {
										echo '<option value='.$category['id'].'>'.$category['name'].'</option>';
									}
								}
								unset($_SESSION['categoryExpense']);
							?>
						</select>
						<div class="input-group-prepend ">
							<span class="input-group-text " id="categoriesExpense"><i class="fas fa-pen-alt "></i></span>
						</div>
					</div>
					<?php
						if(isset($_SESSION['errorOptionExp'])) {
							echo '<div class="error">Niepoprawna kategoria!</div>';
							unset($_SESSION['errorOptionExp']);
						}
					?>						
					<div class="input-group ">
						<input type="text" class="form-control" placeholder="Komentarz (opcjonalnie)" name="comment" value=
						<?php
							if(isset($_SESSION['comment'])) {
								echo '"'.$_SESSION['comment'].'"';
								unset($_SESSION['comment']);
							} 
						?>>
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
						</div>
					</div>
					
					
					<div class="row mx-0">
						<div class="col px-0">
							<a href="menu.php" class="btn mt-4 text-white reset"><i class="fas fa-times"></i> Anuluj</a>
						</div>
					
						<div class="col px-0">
							<button type="submit" class="btn btn-default mt-4 text-white"><i class="fas fa-plus"></i> Dodaj </button>
						</div>
					</div>
				</form>
				
			</div>
			
		</div>
		
		<?php
			require_once('footer.php');
		?>
</body>


</html>