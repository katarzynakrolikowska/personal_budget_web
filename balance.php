<?php

session_start();


if(!isset($_SESSION['loggedID'])) {
	header('Location:login.php');
	exit();
} 
if(!isset($_SESSION['selectedPeriod'])) {
	header('Location:current_month_balance.php');
	exit();
}
require_once('validate_user_data.php');
$dataPoints = array();



?>
<! DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>Przeglądaj bilans</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=latin-ext" rel="stylesheet">
	
	
</head>

<body>
	<div class="container-fluid p-0" id="containerBalance" >
		<?php
			$_SESSION['balance'] = '';
			require_once('nav_header.php');
			unset($_SESSION['balance']);
		?>
		
		<div class="modal fade " id="selectPeriodModal" tabindex="-1" role="dialog" aria-labelledby="selectPeriodModalLabel" aria-hidden="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="selectPeriodModalLabel">Wybierz zakres</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="custom_period.php" method="post"> 
							<div class="form-group row pr-5">
								<label class="col-form-label col-4 text-center" for="dateStart">Od dnia</label>
								<input type="date" class="form-control col-8" id="dateStart" name="startDate">
							</div>
							
							<div class="form-group row pr-5">	
								<label class="col-form-label col-4 text-center" for="dateEnd">Do dnia</label>
								<input type="date" class="form-control col-8" id="dateEnd" placeholder="Data końcowa" name="endDate">
							</div>
							
							
							<a href="#" class="btn btn-primary" data-dismiss="modal">Anuluj</a>
							<button type="submit" class="btn btn-primary" id="btnOK" >OK</button>
						</form>
					</div>
					
				</div>
			</div>
		</div>
		
		
		
		<?php
		
		if(empty($_SESSION['incomes']) && empty($_SESSION['expenses'])) {
			echo '<div class="row justify-content-center pt-5 mx-0">
					<div class="col-auto headerOption">
						<header><h5>
							W wybranych okresie nie wprowdziłeś danych!
						</h5></header>
					</div>
				</div>';
		} else {
			require_once('display_balance.php');
		}
		
		?>
		<div class="row mx-0">
			<footer class="col footerMenu  text-center py-2" style="bottom:-400">
				<p class="text-muted">2018 &copy; fullWallet.pl</p>	
			</footer>	
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	
	<?php
		
		if(!empty($_SESSION['expenses'])) {
			require_once('set_chart.php');
		}
	?>

	<script type="text/javascript" src="personalBudget.js"></script>
	
</body>


</html>