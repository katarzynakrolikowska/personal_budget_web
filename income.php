<?php
session_start();
if(!isset($_SESSION['loggedID'])) {
	header('Location:login.php');
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=latin-ext" rel="stylesheet">
	
	

</head>

<body>
	<div class="container-fluid p-0" id="containerIncome" >
		
		<?php
			require_once('nav_header.php');
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
						<input type="number" class="form-control" step="0.01" placeholder="Kwota" name="amount" value=
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
								//echo DateTime::createFromFormat('Y-m-d', $_SESSION['date']) -> format('Y-m-d');
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
									echo '<option value='.$category['id'].'>'.$category['name'].'</option>';	
								}
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
							<a href="menu.php" class="btn mt-4 text-white reset"><i class="fas fa-times"></i> Anuluj</a>
						</div>
					
						<div class="col px-0">
							<button type="submit" class="btn btn-default mt-4 text-white"><i class="fas fa-plus"></i> Dodaj</button>
						</div>
					</div>
				</form>
				
			</div>
			
		</div>
		
		<div class="row mx-0">
			<footer class="col footerMenu text-center py-2">
				<p class="text-muted">2018 &copy; fullWallet.pl</p>	
			</footer>	
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	
	<script type="text/javascript" src="http://localhost/PB/js/personalBudget.js"></script>
</body>


</html>