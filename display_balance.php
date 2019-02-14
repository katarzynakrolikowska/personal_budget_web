<?php
	if(isset($_SESSION['errorDate'])) {
		echo '<div class="error mt-4">'.'Podano niepoprawne daty!'.'</div>';
		unset($_SESSION['errorDate']);
	}
?>	
<div class="row justify-content-center pt-5 mx-0">
	<div class="col-auto headerOption">
		<header><h3>
		<?php
		if(isset($_SESSION['selectedPeriod'])) {
			echo $_SESSION['selectedPeriod'];
			unset($_SESSION['selectedPeriod']);
		}
		?>
		</h3></header>
	</div>
</div>
<div class="row mx-0 my-5 rowTables justify-content-around">
	<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
		<header><h4><b>Przychody</b></h4></header>
		<table class="table" id="tableIncomes">
			<thead>
				<tr>
					<th scope="col">Kategoria</th>
					<th scope="col" class="text-right">Kwota</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($_SESSION['incomes'])) {
					$sumIncomes = 0;
					foreach($_SESSION['incomes'] as $income) {
						echo '<tr><td>'.$income['name'].'</td><td class="text-right"><b>'.decimalFormat($income['iSum']).'</b></td></tr>';
						$sumIncomes += $income['iSum'];
					}
					
					echo '<tr><td><b>RAZEM</b></td><td class="text-right"><b>'.decimalFormat($sumIncomes).'</b></td></tr>';
					
				}
				?>
			</tbody>
		</table>
	</div>
	
	<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
		<header><h4><b>Wydatki</b></h4></header>
		<table class="table" id="tableExpenses">
			<thead>
				<tr>
					<th scope="col">Kategoria</th>
					<th scope="col" class="text-right">Kwota</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($_SESSION['expenses'])) {
					$sumExpenses = 0;
					foreach($_SESSION['expenses'] as $expense) {
						echo '<tr><td>'.$expense['name'].'</td><td class="text-right"><b>'.decimalFormat($expense['eSum']).'</b></td></tr>';
						$sumExpenses += $expense['eSum'];
					}
					
					echo '<tr><td><b>RAZEM</b></td><td class="text-right"><b>'.decimalFormat($sumExpenses).'</b></td></tr>';
					$diff = $sumIncomes - $sumExpenses;
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php
if(isset($_SESSION['expenses'])) {
	foreach($_SESSION['expenses'] as $row) {
		array_push($dataPoints, array("y" => $row['eSum']/$sumExpenses*100, "label" => $row['name']));
	}
}
?>
<div class="row justify-content-center mr-0">
	<div class="col-12 col-md-10 col-lg-8 " id="resultBg">
		<div class="resultText shadow "<?=$diff < 0 ? 'style="background:#EF5350"' : 'style="background:#4CAF50"'?>>
			TWÓJ BILANS: <span>
			<?php
				echo decimalFormat($diff);
			?>
			</span> PLN
		</div>
		<div class="col text-center my-4" id="resultComment">
		<?php 
		if($diff < 0) {
			echo 'Uważaj, wpadasz w długi!';
		} else {
			echo 'Gratulacje! Świetnie zarządzasz finansami!';
		}?>
		</div>
	</div>
</div>
<?php
if(!empty($_SESSION['expenses'])) {
	require_once('chart.php');

}
?>