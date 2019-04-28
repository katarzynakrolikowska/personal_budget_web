
<div class="row mx-0 my-5 rowTables justify-content-around">

	<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
	
		<header><h4><b>Przychody</b></h4></header>
		<table class="table" id="tableIncomes">
			<thead>
				<tr>
					<th>Kategoria</th>
					
					<th class="text-right">Kwota</th>
					<th class="cellArrowsIcon"></th>
				</tr>
			</thead>
			<tbody>
				
					<?php
					if ($portal -> getHtmlOfIncomesTableRows()) {
						echo $portal -> getHtmlOfIncomesTableRows();
					} else {
						echo '<tr>
							<td><b>RAZEM</b></td>
							<td class="text-right"><b>0.00</b></td>
							<td class="cellArrowsIcon"></td>
						</tr>';
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
					<th scope="col"  id="test" >Kategoria</th>
					<th scope="col" class="text-right">Kwota</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($portal -> getHtmlOfExpensesTableRows()) {
					echo $portal -> getHtmlOfExpensesTableRows();
				} else {
					echo '<tr><td><b>RAZEM</b></td><td class="text-right"><b>0.00</b></td><td class="cellMenuDots"></td></tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php

?>
<div class="row justify-content-center mr-0" id="rowResultBg">
	<div class="col-12 col-md-10 col-lg-8 " id="colResultBg">
		<div class="resultText shadow "<?=$portal -> getDifference() < 0 ? 'style="background:#EF5350"' : 'style="background:#4CAF50"'?>>
			TWÓJ BILANS: <span class="nowrap">
			<?php
				echo $portal -> getDifference();
			?>
			PLN</span> 
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
if ($portal -> getHtmlOfExpensesTableRows()) {
	require_once('templates/displayChart.php');
}
?>

<div class="modal fade" id="balanceEditionModal" tabindex="-1" role="dialog" aria-labelledby="balanceEditionModal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title text-center"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body mx-4">
			
				<form class="balanceEditForm" method="post">
				<div class="messageError error"></div>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="amount" step="0.01" lang="en" min="0.00" placeholder="Kwota" name="amount">
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole nie może pozostać puste. Wpisz liczbę większą od zera.">
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
											
					<div class="input-group mb-3">
						<input type="date" class="form-control" id="date" name="date">
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole nie może pozostać puste. Wpisz datę w formacie rrrr-mm-dd z przedziału od <?=START_DATE?> do końca bieżącego miesiąca.">
						
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
					<div class="input-group mb-3" id="divSelectPayment">
						<select class="custom-select" id="paymentMethod" name="paymentMethod">
							<option disabled selected value="n">Wybierz metodę płatności</option>
							<?php
								echo $portal -> getHtmlOfOptionsForPaymentMethods();
							?>
						</select>
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole nie może pozostać puste. Wybierz metodę płatności.">
						
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>	
					<div class="input-group mb-3">
						<select class="custom-select" id="incomeCategory" name="category">
							<option disabled selected value='0'>Wybierz kategorię</option>
							<?php
								echo $portal -> getHtmlOfOptionsForIncomeCategories();
							?>
						</select>

						<select class="custom-select" id="expenseCategory" name="category">
							<option disabled selected value='0'>Wybierz kategorię</option>
							<?php
								echo $portal -> getHtmlOfOptionsForExpenseCategories();
							?>
						</select>
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole nie może pozostać puste. Wybierz kategorię.">
						
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
											
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="comment" placeholder="Komentarz (opcjonalnie)" name="comment">
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole jest opcjonalne.">
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
					
					<div class="row mx-0 my-3">
						<div class="col-12 px-0">
							<button type="submit" class="btn btn-default mt-4 text-white"><i class="fas fa-plus"></i> Zapisz</button>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>