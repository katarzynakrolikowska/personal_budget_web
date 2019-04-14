$(function(){
	
	setPopover();
	
	setCheckboxOfPasswordShowing();
	
	setCssForStartPageText();
	
	setCssForAddForm();
	
	setDateRangeOfSelectPeriodModal();

	setModalOfUserDataSettings();

	setModalOfIncomeCategorySettings();

	setModalOfExpenseOptionsSettings();
	
	setToggleForDetailedRowsOfBalanceTables();

	setModalOfIncomeEditionAndExpenseEdition();

	setSettingsMenu();
});
	
function setPopover() {
	$('[data-toggle="popover"]').popover({
		placement: 'bottom',
		offset: '-112px'
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
	var $settingsUserDataModal = $('#settingsUserDataModal');

	$('#editUsernameLink').on('click', function() {
		$settingsUserDataModal.find('h5').text('Edytuj imię');
		$settingsUserDataModal.find('.editNameField').removeClass('hideItem');
		$settingsUserDataModal.find('.editLoginField').addClass('hideItem');
		$settingsUserDataModal.find('.editPasswordField').addClass('hideItem');
		$settingsUserDataModal.find('form').attr('action', 'index.php?action=editUserData&editedItem=name');
	});

	$('#editLoginLink').on('click', function() {
		$settingsUserDataModal.find('h5').text('Edytuj login');
		$settingsUserDataModal.find('.editNameField').addClass('hideItem');
		$settingsUserDataModal.find('.editLoginField').removeClass('hideItem');
		$settingsUserDataModal.find('.editPasswordField').addClass('hideItem');
		$settingsUserDataModal.find('form').attr('action', 'index.php?action=editUserData&editedItem=login');
	});

	$('#editPasswordLink').on('click', function() {
		$settingsUserDataModal.find('h5').text('Edytuj hasło');
		$settingsUserDataModal.find('.editNameField').addClass('hideItem');
		$settingsUserDataModal.find('.editLoginField').addClass('hideItem');
		$settingsUserDataModal.find('.editPasswordField').removeClass('hideItem');
		$settingsUserDataModal.find('form').attr('action', 'index.php?action=editUserData&editedItem=password');
	});
}

function setModalOfIncomeCategorySettings() {
	var $inputSelectOption = $('#settingsIncomeSelect');
	var $inputOption = $('.inputOption');
	var $settingsModalIncome = $('#settingsIncomeModal');
	var $info = $settingsModalIncome.find('#info');

	$('#editIncomeLink').on('click', function() {
		$settingsModalIncome.find('h5').text('Edytuj kategorię przychodu');
		$info.addClass('hideItem');
		$inputSelectOption.removeClass('hideItem');
		$inputOption.removeClass('hideItem');
		$inputSelectOption.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz edytować.');
		$settingsModalIncome.find('.btn').text('Zapisz');
		$settingsModalIncome.find('form').attr('action', 'index.php?action=editOption&editionContent=income');
	});

	$('#addIncomeLink').on('click', function() {
		$settingsModalIncome.find('h5').text('Dodaj kategorię przychodu');
		$info.addClass('hideItem');
		$inputSelectOption.addClass('hideItem');
		$inputOption.removeClass('hideItem');
		$settingsModalIncome.find('.btn').text('Dodaj');
		$settingsModalIncome.find('form').attr('action', 'index.php?action=addOption&editionContent=income');
	});

	$('#deleteIncomeLink').on('click', function() {
		$settingsModalIncome.find('h5').text('Usuń kategorię przychodu');
		$info.addClass('hideItem');
		$inputSelectOption.removeClass('hideItem');
		$inputOption.addClass('hideItem');
		$inputSelectOption.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz usunąć.');
		$settingsModalIncome.find('.btn').text('Usuń');
		$settingsModalIncome.find('form').attr('action', 'index.php?action=deleteOption&editionContent=income');
	});
}
	
function setModalOfExpenseOptionsSettings() {
	var $inputSelectPaymentMethod = $('#settingsPaymentMethodSelect');
	var $inputSelectExpenseCategory = $('#settingsExpenseCategorySelect');
	var $inputOption = $('.inputOption');
	var $settingsModalExpense = $('#settingsExpenseModal');
	var $info = $settingsModalExpense.find('#info');

	$('#editMethodLink').on('click', function() {
		$settingsModalExpense.find('h5').text('Edytuj metodę płatności');
		$inputSelectExpenseCategory.addClass('hideItem');
		$inputSelectPaymentMethod.removeClass('hideItem');$inputSelectExpenseCategory.find('.custom-select').removeAttr('name');
		$inputSelectPaymentMethod.find('.custom-select').attr('name', 'selectedOption');
		$info.addClass('hideItem');
		$inputOption.removeClass('hideItem');
		$inputSelectPaymentMethod.find('a').attr('data-content', 'Wybierz metodę płatności, którą chcesz edytować.');
		$inputOption.find('#inputEdition').attr('placeholder', 'Wpisz nową metodę płatności');
		$settingsModalExpense.find('.btn').text('Zapisz');
		$settingsModalExpense.find('form').attr('action', 'index.php?action=editOption&editionContent=paymentMethod');
	});

	$('#addMethodLink').on('click', function() {
		$settingsModalExpense.find('h5').text('Dodaj metodę płatności');
		$info.addClass('hideItem');
		$inputSelectExpenseCategory.addClass('hideItem');
		$inputSelectPaymentMethod.addClass('hideItem');
		$inputOption.removeClass('hideItem');
		$settingsModalExpense.find('.btn').text('Dodaj');
		$inputOption.find('#inputEdition').attr('placeholder', 'Wpisz nową metodę płatności');
		$settingsModalExpense.find('form').attr('action', 'index.php?action=addOption&editionContent=paymentMethod');
	});

	$('#deleteMethodLink').on('click', function() {
		$settingsModalExpense.find('h5').text('Usuń metodę płatności');
		$info.addClass('hideItem');
		$inputSelectPaymentMethod.removeClass('hideItem');
		$inputOption.addClass('hideItem');
		$inputSelectExpenseCategory.addClass('hideItem');
		$inputSelectExpenseCategory.find('.custom-select').removeAttr('name');
		$inputSelectPaymentMethod.find('.custom-select').attr('name', 'selectedOption');
		$inputSelectPaymentMethod.find('a').attr('data-content', 'Wybierz metodę płatności, którą chcesz usunąć.');
		$settingsModalExpense.find('.btn').text('Usuń');
		$settingsModalExpense.find('form').attr('action', 'index.php?action=deleteOption&editionContent=paymentMethod');
	});

	$('#editExpenseCategoryLink').on('click', function() {
		$settingsModalExpense.find('h5').text('Edytuj kategorię wydatku');
		$info.addClass('hideItem');
		$inputSelectPaymentMethod.addClass('hideItem');
		$inputSelectExpenseCategory.removeClass('hideItem');
		$inputOption.removeClass('hideItem');
		$inputSelectPaymentMethod.find('.custom-select').removeAttr('name');
		$inputSelectExpenseCategory.find('.custom-select').attr('name', 'selectedOption');
		$inputSelectExpenseCategory.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz edytować.');
		$inputOption.find('#inputEdition').attr('placeholder', 'Wpisz nową kategorię');
		$settingsModalExpense.find('.btn').text('Zapisz');
		$settingsModalExpense.find('form').attr('action', 'index.php?action=editOption&editionContent=expense');
	});

	$('#addExpenseCategoryLink').on('click', function() {
		$settingsModalExpense.find('h5').text('Dodaj kategorię wydatku');
		$info.addClass('hideItem');
		$inputSelectPaymentMethod.addClass('hideItem');
		$inputSelectExpenseCategory.addClass('hideItem');
		$inputOption.removeClass('hideItem');
		$inputOption.find('#inputEdition').attr('placeholder', 'Wpisz nową kategorię');
		$settingsModalExpense.find('.btn').text('Dodaj');
		$settingsModalExpense.find('form').attr('action', 'index.php?action=addOption&editionContent=expense');
	});

	$('#deleteExpenseCategoryLink').on('click', function() {
		$settingsModalExpense.find('h5').text('Usuń kategorię wydatku');
		$info.addClass('hideItem');
		$inputSelectPaymentMethod.addClass('hideItem');
		$inputSelectExpenseCategory.removeClass('hideItem');
		$inputOption.addClass('hideItem');
		$inputSelectPaymentMethod.find('.custom-select').removeAttr('name');
		$inputSelectExpenseCategory.find('.custom-select').attr('name', 'selectedOption');
		$inputSelectExpenseCategory.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz usunąć.');
		$settingsModalExpense.find('.btn').text('Usuń');
		$settingsModalExpense.find('form').attr('action', 'index.php?action=deleteOption&editionContent=expense');
	});
}
	
function setToggleForDetailedRowsOfBalanceTables() {
	var $incomeDetailedRow = $('.incomeDetailedRow');
	$incomeDetailedRow.hide();
	$(document).on('click','.arrow', function() {
		var $key = '.'+this.id;
		$incomeDetailedRow.filter($key).slideToggle(100);
	});

	var $expenseDetailedRow = $('.expenseDetailedRow');
	$expenseDetailedRow.hide();
	$(document).on('click','.arrow', function() {
		var $key = '.'+this.id;
		$expenseDetailedRow.filter($key).slideToggle(100);
	});
}
	
function setModalOfIncomeEditionAndExpenseEdition()
{
	var $settingsModalBalance = $('#balanceModal');
	var $divSelectPayment = $('#balanceModal #divSelectPayment');
	var $inputSelectPayment = $('#balanceModal #paymentMethod');
	var $inputAmount = $('#balanceModal #amount');
	var $inputDate = $('#balanceModal #date');
	var $inputIncomeCategory = $('#balanceModal #incomeCategory');
	var $inputExpenseCategory = $('#balanceModal #expenseCategory');
	var $inputComment = $('#balanceModal #comment');


	$('.editIncomeLink').on('click', function() {
		$settingsModalBalance.find('h5').text('Edytuj przychód');
		$divSelectPayment.addClass('hideItem');
		$inputExpenseCategory.addClass('hideItem');
		$inputIncomeCategory.removeClass('hideItem');
		var $id = this.id;
		var $actualDetailedRow = $(this).closest('.incomeDetailedRow');
		var $previousSumRow = $actualDetailedRow.prevAll('.incomeSumRow:first');

		var $amount = $actualDetailedRow.find('.amount').text().replace(/\s+/g, '');
		var $date = $actualDetailedRow.find('.date').text();
		var $category = $previousSumRow.find('.category').text();
		var $comment = $actualDetailedRow.find('.comment').text();

		$inputAmount.val($amount);
		$inputDate.val($date);
		$inputIncomeCategory.find('option').removeAttr('selected');
		$inputIncomeCategory.find('option:contains("'+$category+'")').attr('selected', 'true');
		$inputComment.val($comment);

		$settingsModalBalance.find('form').attr('action', 'index.php?action=editIncome&itemId='+$id+'\'');
	});


	$('.editExpenseLink').on('click', function() {
		$settingsModalBalance.find('h5').text('Edytuj wydatek');
		$divSelectPayment.removeClass('hideItem');
		$inputExpenseCategory.removeClass('hideItem');
		$inputIncomeCategory.addClass('hideItem');
		var $id = this.id;
		var $actualDetailedRow = $(this).closest('.expenseDetailedRow');
		var $previousSumRow = $actualDetailedRow.prevAll('.expenseSumRow:first');

		var $amount = $actualDetailedRow.find('.amount').text().replace(/\s+/g, '');
		var $date = $actualDetailedRow.find('.date').text();
		var $payment = $actualDetailedRow.find('.payment').text();
		var $category = $previousSumRow.find('.category').text();
		var $comment = $actualDetailedRow.find('.comment').text();

		$inputAmount.val($amount);
		$inputDate.val($date);
		$inputSelectPayment.find('option').removeAttr('selected');
		$inputSelectPayment.find('option:contains("'+$payment+'")').attr('selected', 'true');
		$inputExpenseCategory.find('option').removeAttr('selected');
		$inputExpenseCategory.find('option:contains("'+$category+'")').attr('selected', 'true');
		$inputComment.val($comment);

		$settingsModalBalance.find('form').attr('action', 'index.php?action=editExpense&itemId='+$id+'\'');
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
	