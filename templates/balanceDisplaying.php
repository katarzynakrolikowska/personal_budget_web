<article>
	<section class="row mx-0 my-5 justify-content-around">

		<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
		
			<h4 class="pl-1"><b>Przychody</b></h4>
			<table class="table tabel-balance--font-size" id="tableIncomes">
				<thead>
					<tr>
						<th class="table-balance__th">Kategoria</th>
						<th class="text-right table-balance__th">Kwota</th>
						<th class="table-balance__th"></th>
					</tr>
				</thead>
				<tbody class="table-balance__tbody">
						<?php
						if ($portal -> getHtmlOfIncomesTableRows()) {
							echo $portal -> getHtmlOfIncomesTableRows();
						} else {
							echo '<tr>
									<td class="border-top-green"><b>RAZEM</b></td>
									<td class="text-right border-top-green"><b>0.00</b></td>
									<td class="border-top-green"></td>
								</tr>';
						}
						?>
				</tbody>
			</table>
		</div>
		
		<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
			<h4 class="pl-1"><b>Wydatki</b></h4>
			<table class="table" id="tableExpenses">
				<thead>
					<tr>
						<th class="table-balance__th">Kategoria</th>
						<th class="text-right table-balance__th">Kwota</th>
						<th class="table-balance__th"></th>
					</tr>
				</thead>
				<tbody class="table-balance__tbody">
					<?php
					if ($portal -> getHtmlOfExpensesTableRows()) {
						echo $portal -> getHtmlOfExpensesTableRows();
					} else {
						echo '<tr>
								<td class="border-top-green"><b>RAZEM</b></td>
								<td class="text-right border-top-green"><b>0.00</b></td>
								<td class="border-top-green"></td>
							</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</section>
	<?php

	?>
	<section class="row justify-content-center mr-0">
		<div class="col-12 col-md-10 col-lg-8 mb-5 py-3 container-balance-comment">
			<h2 class="py-5 mt-3 mb-4 mx-3 rounded text-center text-white shadow"<?=$portal -> getDifference() < 0 ? 'style="background:#EF5350"' : 'style="background:#4CAF50"'?>>
				<b>TWÓJ BILANS: <span class="nowrap">
				<?php
					echo $portal -> getDifference();
				?>
				PLN</span></b> 
			</h2>
			<h3 class="col text-center text-gray">
			<?php 
			if ($portal -> getDifference() < 0) {
				echo 'Uważaj, wpadasz w długi!';
			} else {
				echo 'Gratulacje! Świetnie zarządzasz finansami!';
			}?>
			</h3>
		</div>
	</section>
	<?php
	if ($portal -> getHtmlOfExpensesTableRows()) {
		require_once('templates/displayChart.php');
	}
	?>
</article>

<div class="modal fade" id="modalBalanceEdition" tabindex="-1" role="dialog" aria-labelledby="modalBalanceEditionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body mx-4">
			
				<form method="post">
					<div class="input-group mb-3">
						<input type="number" class="form-control js-modal-edition__input-amount" step="0.01" lang="en" min="0.00" placeholder="Kwota" name="amount">
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole nie może pozostać puste. Wpisz liczbę większą od zera.">
							<span class="input-group-text rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
											
					<div class="input-group mb-3">
						<input type="date" class="form-control js-modal-edition__input-date" name="date">
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole nie może pozostać puste. Wpisz datę w formacie rrrr-mm-dd z przedziału od <?=START_DATE?> do końca bieżącego miesiąca.">
							<span class="input-group-text rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
					<div class="input-group mb-3 js-container-select-payment">
						<select class="custom-select js-modal-edition__input-payment" name="paymentMethod">
							<option disabled selected value="n">Wybierz metodę płatności</option>
							<?php
								echo $portal -> getHtmlOfOptionsForPaymentMethods();
							?>
						</select>
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole nie może pozostać puste. Wybierz metodę płatności.">
							<span class="input-group-text rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>	
					<div class="input-group mb-3">
						<select class="custom-select js-modal-edition__input-income-cat" name="category">
							<option disabled selected value='0'>Wybierz kategorię</option>
							<?php
								echo $portal -> getHtmlOfOptionsForIncomeCategories();
							?>
						</select>

						<select class="custom-select js-modal-edition__input-expense-cat" name="category">
							<option disabled selected value='0'>Wybierz kategorię</option>
							<?php
								echo $portal -> getHtmlOfOptionsForExpenseCategories();
							?>
						</select>
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole nie może pozostać puste. Wybierz kategorię.">
							<span class="input-group-text rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
											
					<div class="input-group mb-3">
						<input type="text" class="form-control js-modal-edition__input-comment" placeholder="Komentarz (opcjonalnie)" name="comment">
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole jest opcjonalne.">
							<span class="input-group-text rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
					
					<div class="row mx-0 my-3">
						<div class="col-12 px-0">
							<button type="submit" class="btn btn-default form-edit__btn--submit mt-4 py-2 text-white max-width rounded"><i class="fas fa-plus"></i> Zapisz</button>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>