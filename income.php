<?php
session_start();
if(!isset($_SESSION['loggedID'])) {
	header('Location:zaloguj-sie');
	exit();
}

$_SESSION['categoriesIncome'] = array();
try{
	require_once 'database.php';
	
	$query = $db -> prepare('SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id=:id');
	
	$query -> bindValue(':id', $_SESSION['loggedID'], PDO::PARAM_INT);
	$query -> execute();
	
	$_SESSION['categoriesIncome'] = $query -> fetchAll();
	
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
	<title>Dodaj przychód</title>
	<?php
		require_once('head_links.php');
	?>
	

</head>

<body>
	<div class="container-fluid p-0" id="containerIncome" >
		
		<?php
			$_SESSION['income'] = '';
			require_once('nav_header.php');
			unset($_SESSION['income']);
		?>
		
		<div class="row pb-sm-5 justify-content-center addDataRow mx-0">
			<?php
				if(isset($_SESSION['addIncomeSuccess'])) {
					echo '<div class="col-12 mb-4 mt-5 text-center"><h4>Przychód został dodany!</h4></div>';
					unset($_SESSION['addIncomeSuccess']);
				}
			?>
			
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 containerAddData">
				<form class="formAddData" method="post" action="add_income.php" >
					<h3>Wprowadź przychód</h3>
					<div class="input-group">
						<input type="number" class="form-control" step="0.01" lang="en" min="0.00" placeholder="Kwota" name="amount" value=
						<?php
							if(isset($_SESSION['amount'])) {
								echo $_SESSION['amount'];
								unset($_SESSION['amount']);
							} 
						?>
						>
						<div class="input-group-prepend ">
							<span class="input-group-text " id="amountIncome"><i class="fas fa-pen-alt"></i></span>
						</div>
					</div>
					<?php
						if(isset($_SESSION['errorAmount'])) {
							echo '<div class="error">'.$_SESSION['errorAmount'].'</div>';
							unset($_SESSION['errorAmount']);
						}
					?>						
					<div class="input-group">	
						<input type="date" class="form-control" id="date" name="date" value=
						<?php
							if(isset($_SESSION['date'])) {
								echo $_SESSION['date'];
								unset($_SESSION['date']);
							} else echo date('Y-m-d');
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
					<div class="input-group">
						<select class="custom-select" id="category" name="categoryIncome">
							<option disabled selected>Wybierz kategorię</option>
							<?php
								foreach($_SESSION['categoriesIncome'] as $category) {
									
									if(isset($_SESSION['categoryIncome']) && ($_SESSION['categoryIncome'] == $category['id'])) {
										echo '<option value='.$category['id'].' selected>'.$category['name'].'</option>';
									} else {
										echo '<option value='.$category['id'].'>'.$category['name'].'</option>';
									}
								}
								unset($_SESSION['categoryIncome']);
							?>
						</select>
						<div class="input-group-prepend ">
							<span class="input-group-text " id="categoriesIncome"><i class="fas fa-pen-alt "></i></span>
						</div>
					</div>
					<?php
						if(isset($_SESSION['errorOption'])) {
							echo '<div class="error">Niepoprawna kategoria!</div>';
							unset($_SESSION['errorOption']);
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
					
					
					<div class="row mx-0 mt-4">
						<div class="col px-0">
							<a href="menu-glowne" class="btn mt-4 text-white reset"><i class="fas fa-times"></i> Anuluj</a>
						</div>
					
						<div class="col px-0">
							<button type="submit" class="btn btn-default mt-4 text-white"><i class="fas fa-plus"></i> Dodaj</button>
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