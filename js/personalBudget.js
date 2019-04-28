$(document).ready(function() {
	setPopover();

	hideResultMessage();
	
	setCheckboxOfPasswordShowing();
	
	setCssForStartPageText();

	setIconsOfMainNav();
	
	setCssForAddForm();
	
	setDateRangeOfSelectPeriodModal();

	setModalOfUserDataSettings();

	setModalOfIncomeCategorySettings();

	setModalOfExpenseOptionsSettings();
	
	setToggleForDetailedRowsOfBalanceTables();

	setModalOfIncomeEditionAndExpenseEdition();

	setSettingsMenu();

	
	addIncome();
	addExpense();
});
	
function setPopover() {
	$('[data-toggle="popover"]').popover({
		placement: 'bottom',
		offset: '-112px'
	});
}

function hideResultMessage()
{
	$('.resultMessageIconClose').on('click', function() {
		$('.resultMessage').fadeOut();
	});
}

function setCheckboxOfPasswordShowing() {
	$('.showPasswordCheckbox').on('click', function() {
		var $password = $('.password');
		var typePassword = $password.attr('type');
		if(typePassword == 'password'){
			$password.attr('type', 'text')
		} else {
			$password.attr('type', 'password')
		}
	});
}

function setCssForStartPageText() {
	$('.textL').mouseenter(function() {
		$('#textLeftBg').css({
			'opacity' : '0.83',
			'transition' : 'all 0.3s ease-out'
		});
	});
	
	$('.textL').mouseleave(function() {
		$('#textLeftBg').css({
			'opacity' : '0.93',
			'transition' : 'all 0.3s ease-out'
		});
	});
	
	$('.textR').mouseenter(function() {
		$('#textRightBg').css({
			'opacity' : '0.83',
			'transition' : 'all 0.3s ease-out'
		});
	});
	
	$('.textR').mouseleave(function() {
		$('#textRightBg').css({
			'opacity' : '0.93',
			'transition' : 'all 0.3s ease-out'
		});
	});
}

function setIconsOfMainNav() {
	$('.navbar-toggler-icon').on('click', function() {
		$('.fa-bars').toggleClass('hideItem');
		$('.fa-times').toggleClass('hideItem');
	});
}

function setCssForAddForm() {
	var $formSelect = $('.formAddData select');
	var $formInput = $('.formAddData input');
	$formSelect.focus(function() {
		$(this).next().addClass('inputGroupPrependFocus');
		$(this).next().children().addClass('inputGroupTextFocus');
	});
	
	$formSelect.blur(function() {
		$(this).next().removeClass('inputGroupPrependFocus');
		$(this).next().children().removeClass('inputGroupTextFocus');
	});

	$formInput.focus(function() {
		$(this).next().addClass('inputGroupPrependFocus');
		$(this).next().children().addClass('inputGroupTextFocus');
	});
		
	$formInput.blur(function() {
		$(this).next().removeClass('inputGroupPrependFocus');
		$(this).next().children().removeClass('inputGroupTextFocus');
	});
}

function setDateRangeOfSelectPeriodModal() {
	var $dateStart = $('#dateStart');
	var $dateEnd = $('#dateEnd');

	$dateStart.on('change', function() {
		$dateEnd.attr('min', $dateStart.val());			
	});
	
	$dateEnd.on('change', function() {
		$dateStart.attr('max', $dateEnd.val());	
	});
}

function setModalOfUserDataSettings() {
	var $modal = $('#settingsUserDataModal');
	var $nameField = $modal.find('.editNameField');
	var $loginField = $modal.find('.editLoginField');
	var $paswordField = $modal.find('.editPasswordField');

	$(document).on('click', '#editUsernameLink', function() {
		var name = $('.rowNameEdition input').val();
		$modal.find('h5').text('Edytuj imię');
		$nameField.removeClass('hideItem');
		$loginField.addClass('hideItem');
		$paswordField.addClass('hideItem');
		$modal.find('form').attr('action', 'index.php?action=editUserData&editedItem=name');
		$nameField.find('input').val(name);
		
	});


	$(document).on('click', '#editLoginLink', function() {
		var login = $('.rowLoginEdition input').val();
		$modal.find('h5').text('Edytuj login');
		$nameField.addClass('hideItem');
		$loginField.removeClass('hideItem');
		$paswordField.addClass('hideItem');
		$modal.find('form').attr('action', 'index.php?action=editUserData&editedItem=login');
		$loginField.find('input').val(login);
		
	});

	$(document).on('click', '#editPasswordLink', function() {
		$modal.find('.password').val('');
		$modal.find('h5').text('Edytuj hasło');
		$nameField.addClass('hideItem');
		$loginField.addClass('hideItem');
		$paswordField.removeClass('hideItem');
		$modal.find('form').attr('action', 'index.php?action=editUserData&editedItem=password');
	});
}

function setModalOfIncomeCategorySettings() {
	var $modal = $('#settingsIncomeModal');
	var $selectDiv = $modal.find('#settingsIncomeSelectDiv');
	var $inputOption = $('.inputOption');
	var $modal = $('#settingsIncomeModal');
	var $containerInfo = $modal.find('.container-info');
	var $info = $modal.find('.info');
	var $form = $modal.find('form');
	


	$('#editIncomeLink').on('click', function() {
		removeSelectedOption($form);
		removeInputValues($form)
		$modal.find('h5').text('Edytuj kategorię przychodu');
		$containerInfo.hide();
		$selectDiv.removeClass('hideItem actionDelete');
		$inputOption.removeClass('hideItem');
		$selectDiv.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz edytować.');
		$modal.find('.btnSave').text('Zapisz');
		$form.attr('action', 'index.php?action=editOption&editionContent=income');
	});

	$('#addIncomeLink').on('click', function() {
		removeInputValues($form)
		$modal.find('h5').text('Dodaj kategorię przychodu');
		$containerInfo.hide();
		$selectDiv.addClass('hideItem').removeClass('actionDelete');
		$inputOption.removeClass('hideItem');
		$modal.find('.btnSave').text('Dodaj');
		$form.attr('action', 'index.php?action=addOption&editionContent=income');
	});

	$('#deleteIncomeLink').on('click', function(e) {
		removeSelectedOption($form);
		$modal.find('h5').text('Usuń kategorię przychodu');
		$containerInfo.show();
		$info.hide();
		$selectDiv.removeClass('hideItem').addClass('actionDelete');
		$inputOption.addClass('hideItem');
		$selectDiv.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz usunąć.');
		$modal.find('.btnSave').text('Usuń');
		$form.attr('action', 'index.php?action=deleteOption&editionContent=income');
		showWarningOptionUsed($modal, $selectDiv, 'income');
	});
}

function showWarningOptionUsed($modal, $selectDiv, editionContent)
{
	var $select = $selectDiv.find('select');
	var $info = $modal.find('.info');
	$select.on('change', function(e) {
		e.preventDefault();
		var selectedOption = $select.val();
		$.get('index.php?action=checkOptionBeforeDeletion', {id:selectedOption, editionContent: editionContent}, function(data) {
			if (data.success && data.optionUsed) {
				var warningText = getWarningAssignedToEditionContent(editionContent);
				$info.html(warningText).show();
			} else {
				$info.hide();
			}
		});
	});
}

function getWarningAssignedToEditionContent(editionContent)
{
	switch (editionContent) {
		case 'income':
			return 'Usunięcie wybranej kategorii spowoduje usunięcie przychodów związanych z tą kategorią!<br />Czy chcesz usunąć wybraną kategorię?';
		case 'paymentMethod':
			return 'Usunięcie wybranej metody płatności spowoduje usunięcie wydatków związanych z tą metodą!<br />Czy chcesz usunąć wybraną metodę?';
		case 'expense':
			return 'Usunięcie wybranej kategorii spowoduje usunięcie wydatków związanych z tą kategorią!<br />Czy chcesz usunąć wybraną kategorię?';
		default:
			return '';
	}
}
	
function setModalOfExpenseOptionsSettings() {
	var $modal = $('#settingsExpenseModal');
	var $selectPaymentMethodDiv = $modal.find('#settingsPaymentMethodSelectDiv');
	var $selectExpenseCategoryDiv = $modal.find('#settingsExpenseCategorySelectDiv');
	var $inputOption = $('.inputOption');
	var $inputLimit = $('.inputLimit');
	var $containerInfo = $modal.find('.container-info');
	var $info = $modal.find('.info');

	$('#editMethodLink').on('click', function() {
		$modal.find('h5').text('Edytuj metodę płatności');
		$selectExpenseCategoryDiv.addClass('hideItem');
		$selectPaymentMethodDiv.removeClass('hideItem');
		$selectExpenseCategoryDiv.find('.custom-select').removeAttr('name');
		$selectPaymentMethodDiv.find('.custom-select').attr('name', 'selectedOption');
		$containerInfo.hide();
		$inputOption.removeClass('hideItem');
		$inputLimit.addClass('hideItem');
		$selectPaymentMethodDiv.find('a').attr('data-content', 'Wybierz metodę płatności, którą chcesz edytować.');
		$inputOption.find('#inputEdition').attr('placeholder', 'Wpisz nową metodę płatności');
		$modal.find('.btnSave').text('Zapisz');
		$modal.find('form').attr('action', 'index.php?action=editOption&editionContent=paymentMethod');
	});

	$('#addMethodLink').on('click', function() {
		$modal.find('h5').text('Dodaj metodę płatności');
		$containerInfo.hide();
		$selectExpenseCategoryDiv.addClass('hideItem');
		$selectPaymentMethodDiv.addClass('hideItem');
		$inputOption.removeClass('hideItem');
		$inputLimit.addClass('hideItem');
		$modal.find('.btnSave').text('Dodaj');
		$inputOption.find('#inputEdition').attr('placeholder', 'Wpisz nową metodę płatności');
		$modal.find('form').attr('action', 'index.php?action=addOption&editionContent=paymentMethod');
	});

	$('#deleteMethodLink').on('click', function() {
		$modal.find('h5').text('Usuń metodę płatności');
		$selectPaymentMethodDiv.removeClass('hideItem');
		$containerInfo.show();
		$info.hide();
		$inputOption.addClass('hideItem');
		$inputLimit.addClass('hideItem');
		$selectExpenseCategoryDiv.addClass('hideItem');
		$selectExpenseCategoryDiv.find('.custom-select').removeAttr('name');
		$selectPaymentMethodDiv.find('.custom-select').attr('name', 'selectedOption');
		$selectPaymentMethodDiv.find('a').attr('data-content', 'Wybierz metodę płatności, którą chcesz usunąć.');
		$modal.find('.btnSave').text('Usuń');
		$modal.find('form').attr('action', 'index.php?action=deleteOption&editionContent=paymentMethod');

		showWarningOptionUsed($modal, $selectPaymentMethodDiv, 'paymentMethod');
	});

	$('#limitExpenseCategoryLink').on('click', function() {
		$modal.find('h5').text('Ustaw miesięczny limit dla kategorii wydatku');
		$containerInfo.hide();
		$selectPaymentMethodDiv.addClass('hideItem');
		$selectExpenseCategoryDiv.removeClass('hideItem');
		$inputOption.addClass('hideItem');
		$inputLimit.removeClass('hideItem');
		$selectPaymentMethodDiv.find('.custom-select').removeAttr('name');
		$selectExpenseCategoryDiv.find('.custom-select').attr('name', 'selectedOption');
		$selectExpenseCategoryDiv.find('a').attr('data-content', 'Wybierz kategorię, dla której chcesz ustawić limit.');
		$modal.find('.btnSave').text('Zapisz');
		$modal.find('form').attr('action', 'index.php?action=setLimit&editionContent=expense');
	});

	$('#editExpenseCategoryLink').on('click', function() {
		$modal.find('h5').text('Edytuj kategorię wydatku');
		$containerInfo.hide();
		$selectPaymentMethodDiv.addClass('hideItem');
		$selectExpenseCategoryDiv.removeClass('hideItem');
		$inputOption.removeClass('hideItem');
		$inputLimit.addClass('hideItem');
		$selectPaymentMethodDiv.find('.custom-select').removeAttr('name');
		$selectExpenseCategoryDiv.find('.custom-select').attr('name', 'selectedOption');
		$selectExpenseCategoryDiv.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz edytować.');
		$inputOption.find('#inputEdition').attr('placeholder', 'Wpisz nową kategorię');
		$modal.find('.btnSave').text('Zapisz');
		$modal.find('form').attr('action', 'index.php?action=editOption&editionContent=expense');
	});

	$('#addExpenseCategoryLink').on('click', function() {
		$modal.find('h5').text('Dodaj kategorię wydatku');
		$containerInfo.hide();
		$selectPaymentMethodDiv.addClass('hideItem');
		$selectExpenseCategoryDiv.addClass('hideItem');
		$inputOption.removeClass('hideItem');
		$inputLimit.addClass('hideItem');
		$inputOption.find('#inputEdition').attr('placeholder', 'Wpisz nową kategorię');
		$modal.find('.btnSave').text('Dodaj');
		$modal.find('form').attr('action', 'index.php?action=addOption&editionContent=expense');
	});

	$('#deleteExpenseCategoryLink').on('click', function() {
		$modal.find('h5').text('Usuń kategorię wydatku');
		$selectPaymentMethodDiv.addClass('hideItem');
		$selectExpenseCategoryDiv.removeClass('hideItem');
		$containerInfo.show();
		$info.hide();
		$inputOption.addClass('hideItem');
		$inputLimit.addClass('hideItem');
		$selectPaymentMethodDiv.find('.custom-select').removeAttr('name');
		$selectExpenseCategoryDiv.find('.custom-select').attr('name', 'selectedOption');
		$selectExpenseCategoryDiv.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz usunąć.');
		$modal.find('.btnSave').text('Usuń');
		$modal.find('form').attr('action', 'index.php?action=deleteOption&editionContent=expense');

		showWarningOptionUsed($modal, $selectExpenseCategoryDiv, 'expense');
	});
}
	
function setToggleForDetailedRowsOfBalanceTables() {
	var $incomeDetailedRow = $('.incomeDetailedRow');
	var $expenseDetailedRow = $('.expenseDetailedRow');
	$(document).on('click','.arrow', function() {
		var $key = '.'+this.id;
		$(this).find('i').toggleClass('rotation');
		$expenseDetailedRow.filter($key).toggleClass('hideItem');
		$incomeDetailedRow.filter($key).toggleClass('hideItem');
	});
}
	
function setModalOfIncomeEditionAndExpenseEdition()
{
	var $settingsModalBalance = $('#balanceEditionModal');
	var $divSelectPayment = $('#balanceEditionModal #divSelectPayment');
	var $inputSelectPayment = $('#balanceEditionModal #paymentMethod');
	var $inputAmount = $('#balanceEditionModal #amount');
	var $inputDate = $('#balanceEditionModal #date');
	var $inputIncomeCategory = $('#balanceEditionModal #incomeCategory');
	var $inputExpenseCategory = $('#balanceEditionModal #expenseCategory');
	var $inputComment = $('#balanceEditionModal #comment');


	$('.editIncomeLink').on('click', function() {
		$settingsModalBalance.find('h5').text('Edytuj przychód');
		$divSelectPayment.addClass('hideItem');
		$inputExpenseCategory.addClass('hideItem');
		$inputIncomeCategory.removeClass('hideItem');
		var id = this.id;
		var $actualDetailedRow = $(this).closest('.incomeDetailedRow');
		var $previousSumRow = $actualDetailedRow.prevAll('.incomeSumRow:first');

		var sumRowId = $previousSumRow.find('.nowrap').id;
		var amount = $actualDetailedRow.find('.amount').text().replace(/\s+/g, '');
		var date = $actualDetailedRow.find('.date').text();
		var category = $previousSumRow.find('.category').text();
		var comment = $actualDetailedRow.find('.comment').text();

		$inputAmount.val(amount);
		$inputDate.val(date);
		$inputIncomeCategory.find('option').removeAttr('selected');
		$inputIncomeCategory.find('option:contains("'+category+'")').attr('selected', 'true');
		$inputComment.val(comment);

		$settingsModalBalance.find('form').attr('action', 'index.php?action=editIncome&itemId='+id+'\'');

		//editIncome(id, sumRowId);
	});


	$('.editExpenseLink').on('click', function() {
		$settingsModalBalance.find('h5').text('Edytuj wydatek');
		$divSelectPayment.removeClass('hideItem');
		$inputExpenseCategory.removeClass('hideItem');
		$inputIncomeCategory.addClass('hideItem');
		var id = this.id;
		var $actualDetailedRow = $(this).closest('.expenseDetailedRow');
		var $previousSumRow = $actualDetailedRow.prevAll('.expenseSumRow:first');

		var amount = $actualDetailedRow.find('.amount').text().replace(/\s+/g, '');
		var date = $actualDetailedRow.find('.date').text();
		var payment = $actualDetailedRow.find('.payment').text();
		var category = $previousSumRow.find('.category').text();
		var comment = $actualDetailedRow.find('.comment').text();

		$inputAmount.val(amount);
		$inputDate.val(date);
		$inputSelectPayment.find('option').removeAttr('selected');
		$inputSelectPayment.find('option:contains("'+payment+'")').attr('selected', 'true');
		$inputExpenseCategory.find('option').removeAttr('selected');
		$inputExpenseCategory.find('option:contains("'+category+'")').attr('selected', 'true');
		$inputComment.val(comment);

		$settingsModalBalance.find('form').attr('action', 'index.php?action=editExpense&itemId='+id+'\'');

		
	});
}

function setSettingsMenu()
{
	if ($(window).width() <= 767.98) {
		$('#rowSettings .colSettingsNav ul').removeClass('flex-column');
      }
	$(window).resize(function() {
		if ($(window).width() <= 767.98) {
			$('#rowSettings .colSettingsNav ul').removeClass('flex-column');
		}else{
			$('#rowSettings .colSettingsNav ul').addClass('flex-column');
		}
	 });
}

function addIncome()
{
	var $form = $('.addIncomeRow .formAddData');
	var action = 'addIncomeAjax';
	executeActionOfSiteForm($form, action);
}

function addExpense()
{
	var $form = $('.addExpenseRow .formAddData');
	var action = 'addExpenseAjax';
	executeActionOfSiteForm($form, action);
}

function executeActionOfSiteForm($form, action)
{
	$('.containerAddData').on('submit', $form, function(e) {
		e.preventDefault();
		var details = $form.serialize();
		
		$.ajax({
			url: 'index.php?action=' + action,
			type: 'POST',
			data: details, 
			dataType: 'json',
			success: function(data) { 
				if (data.modal) {
					$form.find('.messageError').text('');
					$('.limitInfo').addClass('hideItem');
					removeFormValues($form);
					$('.errorBorder').removeClass('errorBorder');
					$('#modalActionResult').modal('show');
					$('.modalResultBody h5').text(data.msg);
				} else {
					setErrorBorder($form, data.validFields);
					$form.find('.messageError').text(data.msg);
				}
			},
			error: function(jqxhr) {
				$modal.modal('hide');
				$('#modalActionResult').modal('show');
				$('.modalResultBody h5').text(jqxhr.status);
			}
		});
	});
}

function removeFormValues($form)
{
	var today = getCurrentDate();
	removeInputValues($form);
	$form.find('.date').val(today);
	removeSelectedOption($form);
}

function getCurrentDate()
{
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0');
	var yyyy = today.getFullYear();

	return today = yyyy + '-' + mm + '-' + dd;
}

function removeInputValues($form)
{
	$form.find('.form-control').val('');
}

function removeSelectedOption($form)
{
	$form.find('.custom-select option').removeAttr('selected');
	$form.find('option:disabled').attr('selected', 'selected');
}

function setErrorBorder($form, validFields)
{
	for (key in validFields) {
		if (!validFields[key]) {
			$form.find('[name=' + key + ']').parent().addClass('errorBorder');
		} else {
			$form.find('[name=' + key + ']').parent().removeClass('errorBorder');
		}
	}
}



	