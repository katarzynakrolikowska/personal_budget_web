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




?>
<! DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>Przeglądaj bilans</title>
	<?php
		require_once('head_links.php');
	?>
	
	
</head>

<body>
	<div class="container-fluid p-0" id="containerBalance" >
		<?php
			$_SESSION['balance'] = '';
			require_once('nav_header.php');
			
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
							
							<div class="row justify-content-around">
								<a href="#" class="btn btn-primary col-4" data-dismiss="modal">Anuluj</a>
								<button type="submit" class="btn btn-primary col-4" id="btnOK" >OK</button>
							</div>
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
			<footer class="col footerMenu  text-center py-2">
				<p class="text-muted">2018 &copy; fullWallet.pl</p>	
			</footer>	
		</div>
	
		<?php
			require_once('footer.php');
			unset($_SESSION['balance']);
		?>
	
</body>


</html>