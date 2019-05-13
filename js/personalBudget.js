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
	$('.js-message--result__icon--close').on('click', function() {
		$('.js-message--result').fadeOut();
	});
}

function setCheckboxOfPasswordShowing() {
	$('.js-checkbox--show-password').on('click', function() {
		var $password = $('.js-password--show');
		var typePassword = $password.attr('type');
		if(typePassword == 'password'){
			$password.attr('type', 'text')
		} else {
			$password.attr('type', 'password')
		}
	});
}

function setCssForStartPageText() {
	$('.js-start-site__text-left').mouseenter(function() {
		$('#textLeftBg').css({
			'opacity' : '0.83',
			'transition' : 'all 0.3s ease-out'
		});
	});
	
	$('.js-start-site__text-left').mouseleave(function() {
		$('#textLeftBg').css({
			'opacity' : '0.93',
			'transition' : 'all 0.3s ease-out'
		});
	});
	
	$('.js-start-site__text-right').mouseenter(function() {
		$('#textRightBg').css({
			'opacity' : '0.83',
			'transition' : 'all 0.3s ease-out'
		});
	});
	
	$('.js-start-site__text-right').mouseleave(function() {
		$('#textRightBg').css({
			'opacity' : '0.93',
			'transition' : 'all 0.3s ease-out'
		});
	});
}

function setIconsOfMainNav() {
	$('.navbar-toggler-icon').on('click', function() {
		$('.fa-bars').toggleClass('item-hide');
		$('.fa-times').toggleClass('item-hide');
	});
}

function setCssForAddForm() {
	var $formSelect = $('.form--add-data select');
	var $formInput = $('.form--add-data input');
	$formSelect.focus(function() {
		$(this).next().addClass('input-group-prepend--focus');
		$(this).next().children().addClass('input-group-text--focus');
	});
	
	$formSelect.blur(function() {
		$(this).next().removeClass('input-group-prepend--focus');
		$(this).next().children().removeClass('input-group-text--focus');
	});

	$formInput.focus(function() {
		$(this).next().addClass('input-group-prepend--focus');
		$(this).next().children().addClass('input-group-text--focus');
	});
		
	$formInput.blur(function() {
		$(this).next().removeClass('input-group-prepend--focus');
		$(this).next().children().removeClass('input-group-text--focus');
	});
}

function setDateRangeOfSelectPeriodModal() {
	var $dateStart = $('.js-modal__input-start-date');
	var $dateEnd = $('.js-modal__input-end-date');

	$dateStart.on('change', function() {
		$dateEnd.attr('min', $dateStart.val());			
	});
	
	$dateEnd.on('change', function() {
		$dateStart.attr('max', $dateEnd.val());	
	});
}

function setModalOfUserDataSettings() {
	var $nameField = $('.js-modal__input--name-edition');
	var $loginField = $('.js-modal__input--login-edition');

	$(document).on('click', '#editUsernameLink', function() {
		var name = $('.js-row-edition-name input').val();
		$nameField.find('input').val(name);
	});

	$(document).on('click', '#editLoginLink', function() {
		var login = $('.js-row-edition-login input').val();
		$loginField.find('input').val(login);
	});

	$(document).on('click', '#editPasswordLink', function() {
		$modal.find('.password').val('');
	});
}

function setModalOfIncomeCategorySettings() {
	var $modal = $('#settingsIncomeCategoryModal');
	var $containerSelectCategory = $modal.find('.js-container-select-category');
	var $containerInputCategory = $('.js-container-input-category');
	var $containerInfo = $modal.find('.js-container-info-option-used');
	var $info = $modal.find('.js-info-option-used');
	var $form = $modal.find('form');
	var $btnSubmit = $modal.find('.modal-footer button');


	$('#editIncomeCategoryLink').on('click', function() {
		removeSelectedOption($form);
		removeInputValues($form)
		$modal.find('h5').text('Edytuj kategorię przychodu');
		$containerInfo.hide();
		$containerSelectCategory.removeClass('item-hide actionDelete');
		$containerInputCategory.removeClass('item-hide');
		$containerSelectCategory.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz edytować.');
		$btnSubmit.text('Zapisz');
		$form.attr('action', 'index.php?action=editOption&editionContent=income');
	});

	$('#addIncomeCategoryLink').on('click', function() {
		removeInputValues($form)
		$modal.find('h5').text('Dodaj kategorię przychodu');
		$containerInfo.hide();
		$containerSelectCategory.addClass('item-hide').removeClass('actionDelete');
		$containerInputCategory.removeClass('item-hide');
		$btnSubmit.text('Dodaj');
		$form.attr('action', 'index.php?action=addOption&editionContent=income');
	});

	$('#deleteIncomeCategoryLink').on('click', function(e) {
		removeSelectedOption($form);
		$modal.find('h5').text('Usuń kategorię przychodu');
		$containerInfo.show();
		$info.hide();
		$containerSelectCategory.removeClass('item-hide').addClass('actionDelete');
		$containerInputCategory.addClass('item-hide');
		$containerSelectCategory.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz usunąć.');
		$btnSubmit.text('Usuń');
		$form.attr('action', 'index.php?action=deleteOption&editionContent=income');
		showWarningOptionUsed($modal, $containerSelectCategory, 'income');
	});
}

function showWarningOptionUsed($modal, $selectDiv, editionContent)
{
	var $select = $selectDiv.find('select');
	var $info = $modal.find('.js-info-option-used');
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
	var $modal = $('#settingsExpenseOptionModal');
	var $containerSelectPayment = $modal.find('.js-container-select-payment');
	var $containerSelectCategory = $modal.find('.js-container-select-category');
	var $containerInputOption = $('.js-container-input-option');
	var $containerInputLimit = $('.js-container-input-limit');
	var $containerInfo = $modal.find('.js-container-info-option-used');
	var $info = $modal.find('.js-info-option-used');
	var $btnSubmit = $modal.find('.modal-footer button');

	$('#editMethodLink').on('click', function() {
		$modal.find('h5').text('Edytuj metodę płatności');
		$containerSelectCategory.addClass('item-hide');
		$containerSelectPayment.removeClass('item-hide');
		$containerSelectCategory.find('.custom-select').removeAttr('name');
		$containerSelectPayment.find('.custom-select').attr('name', 'selectedOption');
		$containerInfo.hide();
		$containerInputOption.removeClass('item-hide');
		$containerInputLimit.addClass('item-hide');
		$containerSelectPayment.find('a').attr('data-content', 'Wybierz metodę płatności, którą chcesz edytować.');
		$containerInputOption.find('input').attr('placeholder', 'Wpisz nową metodę płatności');
		$btnSubmit.text('Zapisz');
		$modal.find('form').attr('action', 'index.php?action=editOption&editionContent=paymentMethod');
	});

	$('#addMethodLink').on('click', function() {
		$modal.find('h5').text('Dodaj metodę płatności');
		$containerInfo.hide();
		$containerSelectCategory.addClass('item-hide');
		$containerSelectPayment.addClass('item-hide');
		$containerInputOption.removeClass('item-hide');
		$containerInputLimit.addClass('item-hide');
		$btnSubmit.text('Dodaj');
		$containerInputOption.find('input').attr('placeholder', 'Wpisz nową metodę płatności');
		$modal.find('form').attr('action', 'index.php?action=addOption&editionContent=paymentMethod');
	});

	$('#deleteMethodLink').on('click', function() {
		$modal.find('h5').text('Usuń metodę płatności');
		$containerSelectPayment.removeClass('item-hide');
		$containerInfo.show();
		$info.hide();
		$containerInputOption.addClass('item-hide');
		$containerInputLimit.addClass('item-hide');
		$containerSelectCategory.addClass('item-hide');
		$containerSelectCategory.find('.custom-select').removeAttr('name');
		$containerSelectPayment.find('.custom-select').attr('name', 'selectedOption');
		$containerSelectPayment.find('a').attr('data-content', 'Wybierz metodę płatności, którą chcesz usunąć.');
		$btnSubmit.text('Usuń');
		$modal.find('form').attr('action', 'index.php?action=deleteOption&editionContent=paymentMethod');

		showWarningOptionUsed($modal, $containerSelectPayment, 'paymentMethod');
	});

	$('#limitExpenseCategoryLink').on('click', function() {
		$modal.find('h5').text('Ustaw miesięczny limit dla kategorii wydatku');
		$containerInfo.hide();
		$containerSelectPayment.addClass('item-hide');
		$containerSelectCategory.removeClass('item-hide');
		$containerInputOption.addClass('item-hide');
		$containerInputLimit.removeClass('item-hide');
		$containerSelectPayment.find('.custom-select').removeAttr('name');
		$containerSelectCategory.find('.custom-select').attr('name', 'selectedOption');
		$containerSelectCategory.find('a').attr('data-content', 'Wybierz kategorię, dla której chcesz ustawić limit.');
		$btnSubmit.text('Zapisz');
		$modal.find('form').attr('action', 'index.php?action=setLimit&editionContent=expense');
	});

	$('#editExpenseCategoryLink').on('click', function() {
		$modal.find('h5').text('Edytuj kategorię wydatku');
		$containerInfo.hide();
		$containerSelectPayment.addClass('item-hide');
		$containerSelectCategory.removeClass('item-hide');
		$containerInputOption.removeClass('item-hide');
		$containerInputLimit.addClass('item-hide');
		$containerSelectPayment.find('.custom-select').removeAttr('name');
		$containerSelectCategory.find('.custom-select').attr('name', 'selectedOption');
		$containerSelectCategory.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz edytować.');
		$containerInputOption.find('input').attr('placeholder', 'Wpisz nową kategorię');
		$btnSubmit.text('Zapisz');
		$modal.find('form').attr('action', 'index.php?action=editOption&editionContent=expense');
	});

	$('#addExpenseCategoryLink').on('click', function() {
		$modal.find('h5').text('Dodaj kategorię wydatku');
		$containerInfo.hide();
		$containerSelectPayment.addClass('item-hide');
		$containerSelectCategory.addClass('item-hide');
		$containerInputOption.removeClass('item-hide');
		$containerInputLimit.addClass('item-hide');
		$containerInputOption.find('input').attr('placeholder', 'Wpisz nową kategorię');
		$btnSubmit.text('Dodaj');
		$modal.find('form').attr('action', 'index.php?action=addOption&editionContent=expense');
	});

	$('#deleteExpenseCategoryLink').on('click', function() {
		$modal.find('h5').text('Usuń kategorię wydatku');
		$containerSelectPayment.addClass('item-hide');
		$containerSelectCategory.removeClass('item-hide');
		$containerInfo.show();
		$info.hide();
		$containerInputOption.addClass('item-hide');
		$containerInputLimit.addClass('item-hide');
		$containerSelectPayment.find('.custom-select').removeAttr('name');
		$containerSelectCategory.find('.custom-select').attr('name', 'selectedOption');
		$containerSelectCategory.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz usunąć.');
		$btnSubmit.text('Usuń');
		$modal.find('form').attr('action', 'index.php?action=deleteOption&editionContent=expense');

		showWarningOptionUsed($modal, $containerSelectCategory, 'expense');
	});
}
	
function setToggleForDetailedRowsOfBalanceTables() {
	var $incomeDetailedRow = $('.js-table-incomes__row-detail');
	var $expenseDetailedRow = $('.js-table-expenses__row-detail');
	$(document).on('click','.js-table-balance__icon-arrow', function() {
		var $key = '.'+this.id;
		$(this).find('i').toggleClass('rotation');
		$expenseDetailedRow.filter($key).toggleClass('item-hide');
		$incomeDetailedRow.filter($key).toggleClass('item-hide');
	});
}
	
function setModalOfIncomeEditionAndExpenseEdition()
{
	var $settingsModalBalance = $('#balanceEditionModal');
	var $containerSelectPayment = $settingsModalBalance.find('.js-container-select-payment');
	var $inputSelectPayment = $containerSelectPayment.find('.js-modal-edition__input-payment');
	var $inputAmount = $settingsModalBalance.find('.js-modal-edition__input-amount');
	var $inputDate = $settingsModalBalance.find('.js-modal-edition__input-date');
	var $inputIncomeCategory = $settingsModalBalance.find('.js-modal-edition__input-income-cat');
	var $inputExpenseCategory = $settingsModalBalance.find('.js-modal-edition__input-expense-cat');
	var $inputComment = $settingsModalBalance.find('.js-modal-edition__input-comment');


	$('.js-link-edit-Income').on('click', function() {
		$settingsModalBalance.find('h5').text('Edytuj przychód');
		$containerSelectPayment.addClass('item-hide');
		$inputExpenseCategory.addClass('item-hide');
		$inputIncomeCategory.removeClass('item-hide');
		var id = this.id;
		var $actualDetailedRow = $(this).closest('.js-table-incomes__row-detail');
		var $previousGeneralisedRow = $actualDetailedRow.prevAll('.js-table-incomes__row-general:first');

		var amount = $actualDetailedRow.find('.js-row-detail__amount').text().replace(/\s+/g, '');
		var date = $actualDetailedRow.find('.js-row-detail__date').text();
		var category = $previousGeneralisedRow.find('.js-table-balance__category-name').text();
		var comment = $actualDetailedRow.find('.js-row-detail__comment').text();

		$inputAmount.val(amount);
		$inputDate.val(date);
		$inputIncomeCategory.find('option').removeAttr('selected');
		$inputIncomeCategory.find('option:contains("'+category+'")').attr('selected', 'true');
		$inputComment.val(comment);

		$settingsModalBalance.find('form').attr('action', 'index.php?action=editIncome&itemId='+id+'\'');
	});


	$('.js-link-edit-Expense').on('click', function() {
		$settingsModalBalance.find('h5').text('Edytuj wydatek');
		$containerSelectPayment.removeClass('item-hide');
		$inputExpenseCategory.removeClass('item-hide');
		$inputIncomeCategory.addClass('item-hide');
		var id = this.id;
		var $actualDetailedRow = $(this).closest('.js-table-expenses__row-detail');
		var $previousGeneralisedRow = $actualDetailedRow.prevAll('.js-table-expenses__row-general:first');

		var amount = $actualDetailedRow.find('.js-row-detail__amount').text().replace(/\s+/g, '');
		var date = $actualDetailedRow.find('.js-row-detail__date').text();
		var payment = $actualDetailedRow.find('.js-row-detail__payment').text();
		var category = $previousGeneralisedRow.find('.js-table-balance__category-name').text();
		var comment = $actualDetailedRow.find('.js-row-detail__comment').text();

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
	$navSettingsList = $('.js-nav-settings__list');
	$navSettingsListItem = $navSettingsList.find('li');

	if ($(window).width() <= 767.98) {
		$navSettingsList.removeClass('flex-column');
		$navSettingsListItem.removeClass('max-width');
    } else {
		$navSettingsList.addClass('flex-column');
		$navSettingsListItem.addClass('max-width');
	}
	$(window).resize(function() {
		if ($(window).width() <= 767.98) {
			$navSettingsList.removeClass('flex-column');
			$navSettingsListItem.removeClass('max-width');
		}else{
			$navSettingsList.addClass('flex-column');
			$navSettingsListItem.addClass('max-width');
		}
	});
}

function addIncome()
{
	var $form = $('.js-container--add-income .js-form--add-data');
	var action = 'addIncomeAjax';
	executeActionOfSiteForm($form, action);
}

function addExpense()
{
	var $form = $('.js-container--add-expense .js-form--add-data');
	var action = 'addExpenseAjax';
	executeActionOfSiteForm($form, action);
}

function executeActionOfSiteForm($form, action)
{
	$('.js-col--add-data').on('submit', $form, function(e) {
		e.preventDefault();
		var details = $form.serialize();

		$.ajax({
			url: 'index.php?action=' + action,
			type: 'POST',
			data: details, 
			dataType: 'json',
			success: function(data) { 
				if (data.modal) {
					$form.find('.js-message-error').text('');
					$('.js-container-limit').addClass('item-hide');
					removeFormValues($form);
					$('.border-red').removeClass('border-red');
					$('#modalActionResult').modal('show');
					$('.js-modal--result__body h5').text(data.msg);
				} else {
					setErrorBorder($form, data.validFields);
					$form.find('.js-message-error').text(data.msg);
				}
			},
			error: function(jqxhr) {
				$modal.modal('hide');
				$('#modalActionResult').modal('show');
				$('.js-modal--result__body h5').text(jqxhr.status);
			}
		});
	});
}

function removeFormValues($form)
{
	var today = getCurrentDate();
	removeInputValues($form);
	$form.find('.js-date').val(today);
	removeSelectedOption($form);
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

function getCurrentDate()
{
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0');
	var yyyy = today.getFullYear();

	return today = yyyy + '-' + mm + '-' + dd;
}

function setErrorBorder($form, validFields)
{
	for (key in validFields) {
		if (!validFields[key]) {
			$form.find('[name=' + key + ']').parent().addClass('border-red');
		} else {
			$form.find('[name=' + key + ']').parent().removeClass('border-red');
		}
	}
}

	