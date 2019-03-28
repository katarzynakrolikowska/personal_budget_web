
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
				if ($portal -> getHtmlOfIncomeTable()) {
					echo $portal -> getHtmlOfIncomeTable();
				} else {
					echo '<tr><td><b>RAZEM</b></td><td class="text-right"><b>0.00</b></td></tr>';
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
				if ($portal -> getHtmlOfExpensesTable()) {
					echo $portal -> getHtmlOfExpensesTable();
				} else {
					echo '<tr><td><b>RAZEM</b></td><td class="text-right"><b>0.00</b></td></tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php

?>
<div class="row justify-content-center mr-0">
	<div class="col-12 col-md-10 col-lg-8 " id="resultBg">
		<div class="resultText shadow "<?=$portal -> getDifference() < 0 ? 'style="background:#EF5350"' : 'style="background:#4CAF50"'?>>
			TWÓJ BILANS: <span>
			<?php
				echo '<span class="nowrap">'.$portal -> getDifference().'</span>';
			?>
			</span> PLN
		</div>
		<div class="col text-center my-4" id="resultComment">
		<?php 
		if ($portal -> getDifference() < 0) {
			echo 'Uważaj, wpadasz w długi!';
		} else {
			echo 'Gratulacje! Świetnie zarządzasz finansami!';
		}?>
		</div>
	</div>
</div>
<?php
if ($portal -> getHtmlOfExpensesTable()) {
	require_once('templates/displayChart.php');
}

?>