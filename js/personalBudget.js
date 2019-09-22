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
	
	editName();
	editLogin();
	editPassword();

	editIncomeCategory();
	addIncomeCategory();
	deleteIncomeCategory();

	editPaymentMethod();
	addPaymentMethod();
	deletePaymentMethod();

	setLimitOfExpenseCategory();
	editExpenseCategory();
	addExpenseCategory();
	deleteExpenseCategory();
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
		$('.js-message--result').text('');
		$('.border-red').removeClass('border-red');
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

	$('#editIncomeCategoryLink').on('click', function() {
		var $form = $('#modalIncomeCategoryEdition form');
		removeSelectedOption($form);
		removeInputValues($form);
		setPopover();
	});

	$('#addIncomeCategoryLink').on('click', function() {
		var $form = $('#modalIncomeCategoryAddition form');
		removeInputValues($form);
	});

	$('#deleteIncomeCategoryLink').on('click', function(e) {
		var $modal = $('#modalIncomeCategoryDeletion');
		var $form = $modal.find('form');
		var $containerSelectCategory = $modal.find('.js-container-select-category');
		var $info = $modal.find('.js-info-option-used');
		$info.hide();
		removeSelectedOption($form);
		setPopover();
		showWarningOptionUsed($info, $containerSelectCategory, 'income');
	});
}

function showWarningOptionUsed($info, $containerSelectCategory, editionContent)
{
	var $select = $containerSelectCategory.find('select');
	
	$select.on('change', function(e) {
		e.preventDefault();
		var selectedOption = $select.val();
		$.get('index.php?action=checkOptionBeforeDeletion', {id:selectedOption, editionContent: editionContent}, function(data) {
			if (data.success && data.optionUsed) {
				var warningText = getWarningAssignedToEditionContent(editionContent);
				$info.hide().html(warningText).slideDown();
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
	$('#editMethodLink').on('click', function() {
		var $form = $('#modalPaymentMethodEdition form');
		removeSelectedOption($form);
		removeInputValues($form);
		setPopover();
	});

	$('#addMethodLink').on('click', function() {
		var $form = $('#modalPaymentMethodEdition form');
		removeInputValues($form);
	});

	$('#deleteMethodLink').on('click', function() {
		var $modal = $('#modalPaymentMethodDeletion');
		var $form = $modal.find('form');
		var $containerSelectCategory = $modal.find('.js-container-select-category');
		var $info = $modal.find('.js-info-option-used');
		$info.hide();
		removeSelectedOption($form);
		setPopover();
		showWarningOptionUsed($info, $containerSelectCategory, 'paymentMethod');
	});

	$('#limitExpenseCategoryLink').on('click', function() {
		var $form = $('#modalExpenseCategoryLimit form');
		removeSelectedOption($form);
		removeInputValues($form);
		setPopover();
	});

	$('#editExpenseCategoryLink').on('click', function() {
		var $form = $('#modalExpenseCategoryEdition form');
		removeSelectedOption($form);
		removeInputValues($form);
		setPopover();
	});

	$('#addExpenseCategoryLink').on('click', function() {
		var $form = $('#modalExpenseCategoryEdition form');
		removeInputValues($form);
	});

	$('#deleteExpenseCategoryLink').on('click', function() {
		var $modal = $('#modalExpenseCategoryDeletion');
		var $form = $modal.find('form');
		var $containerSelectCategory = $modal.find('.js-container-select-category');
		var $info = $modal.find('.js-info-option-used');
		$info.hide();
		removeSelectedOption($form);
		setPopover();
		showWarningOptionUsed($info, $containerSelectCategory, 'expense');
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
	var $settingsModalBalance = $('#modalBalanceEdition');
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
				if (data.showModal) {
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
				showModalResultError($modal);
				//$('.js-modal--result__body h5').text(jqxhr.status);
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

function showModalResultError($modal)
{
	$modal.modal('hide');
	$('.js-modal--result__body h5').text('Wystąpił błąd! Proszę spróbować później!');
	$('#modalActionResult').modal('show');
}

function editName()
{
	$modal = $('#modalUsernameEdition');
	var $form = $modal.find('form');
	$form.on('submit', function(e) {
		
		e.preventDefault();
		var details = $form.serialize();

		$.ajax({
			url: 'index.php?action=editUserDataAjax&editedUserdata=name',
			type: 'POST',
			data: details, 
			success: function(data) { 
				$('.js-modal--result__body h5').text(data);
				$('.js-container-edition-name').load('index.php?action=showSettings&editionContent=userData .js-row-edition-name');
				$('.js-container-link--username').load('index.php?action=showSettings&editionContent=userData .js-link--username');
				$('#modalUsernameEdition').modal('hide');
				$('#modalActionResult').modal('show');
			},
			error: function(jqxhr) {
				showModalResultError($modal);
				//$('.js-modal--result__body h5').text(jqxhr.responseText);
			}
		});
	});
}

function editLogin()
{
	$modal = $('#modalLoginEdition');
	var $form = $modal.find('form');
	$form.on('submit', function(e) {
		e.preventDefault();
		var details = $form.serialize();

		$.ajax({
			url: 'index.php?action=editUserDataAjax&editedUserdata=login',
			type: 'POST',
			data: details,
			success: function(data) { 
				$('.js-modal--result__body h5').text(data);
				$('.js-container-edition-login').load('index.php?action=showSettings&editionContent=userData .js-row-edition-login');
				$('#modalLoginEdition').modal('hide');
				$('#modalActionResult').modal('show');
			},
			error: function(jqxhr) {
				showModalResultError($modal);
				//$('.js-modal--result__body h5').text(jqxhr.responseText);
			}
		});
	});
}

function editPassword()
{
	$modal = $('#modalPasswordEdition');
	var $form = $modal.find('form');
	$form.on('submit', function(e) {
		e.preventDefault();
		var details = $form.serialize();

		$.ajax({
			url: 'index.php?action=editUserDataAjax&editedUserdata=password',
			type: 'POST',
			data: details,
			success: function(data) { 
				$('.js-modal--result__body h5').text(data);
				$modal.modal('hide');
				$('#modalActionResult').modal('show');
			},
			error: function(jqxhr) {
				showModalResultError($modal);
				//$('.js-modal--result__body h5').text(jqxhr.responseText);
			}
		});
	});
}

function editIncomeCategory()
{
	var modal = '#modalIncomeCategoryEdition';
	var url = 'index.php?action=setOptionAjax&actionSettings=edit&editionContent=income';

	executeSettingsIncomeCategory(modal, url);
}

function executeSettingsIncomeCategory(modal, url)
{
	$modal = $(modal);
	var $form = $modal.find('form');
	$form.on('submit', function(e) {
		e.preventDefault();
		var details = $form.serialize();

		$.ajax({
			url: url,
			type: 'POST',
			data: details,
			success: function(data) {
				updateIncomeCategories();
				showModalResultOk(modal, data);
			},
			error: function(jqxhr) {
				showModalResultError($modal);
				//$('.js-modal--result__body h5').text(jqxhr.responseText);
			}
		});
	});
}

function updateIncomeCategories()
{
	$('.js-row--income-categories-list').load('index.php?action=showSettings&editionContent=income .js-col--income-categories-list');
	$('#modalIncomeCategoryEdition .js-container-select-category').load('index.php?action=showSettings&editionContent=income #modalIncomeCategoryEdition .js-container-select-category');
	$('#modalIncomeCategoryDeletion .js-container-select-category').load('index.php?action=showSettings&editionContent=income #modalIncomeCategoryDeletion .js-container-select-category');
}

function showModalResultOk(modal, data)
{
	$('.js-modal--result__body h5').text(data);
	$(modal).modal('hide');
	$('#modalActionResult').modal('show');
}

function addIncomeCategory()
{
	var modal = '#modalIncomeCategoryAddition';
	var url = 'index.php?action=setOptionAjax&actionSettings=add&editionContent=income';

	executeSettingsIncomeCategory(modal, url);
}

function deleteIncomeCategory()
{
	var modal = '#modalIncomeCategoryDeletion';
	var url = 'index.php?action=setOptionAjax&actionSettings=delete&editionContent=income';

	executeSettingsIncomeCategory(modal, url);
}

function editPaymentMethod()
{
	var modal = '#modalPaymentMethodEdition';
	var url = 'index.php?action=setOptionAjax&actionSettings=edit&editionContent=paymentMethod';

	executeSettingsPaymentMethods(modal, url);
}

function executeSettingsPaymentMethods(modal, url)
{
	$modal = $(modal);
	var $form = $modal.find('form');
	$form.on('submit', function(e) {
		e.preventDefault();
		var details = $form.serialize();

		$.ajax({
			url: url,
			type: 'POST',
			data: details,
			success: function(data) {
				updatePaymentMethods();
				showModalResultOk(modal, data);
			},
			error: function(jqxhr) {
				showModalResultError($modal);
				//$('.js-modal--result__body h5').text(jqxhr.responseText);
			}
		});
	});
}

function updatePaymentMethods()
{
	$('.js-row--payment-methods-list').load('index.php?action=showSettings&editionContent=paymentMethod .js-col--payment-methods-list');
	$('#modalPaymentMethodEdition .js-container-select-category').load('index.php?action=showSettings&editionContent=paymentMethod #modalPaymentMethodEdition .js-container-select-category');
	$('#modalPaymentMethodDeletion .js-container-select-category').load('index.php?action=showSettings&editionContent=paymentMethod #modalPaymentMethodDeletion .js-container-select-category');
}

function addPaymentMethod()
{
	var modal = '#modalPaymentMethodAddition';
	var url = 'index.php?action=setOptionAjax&actionSettings=add&editionContent=paymentMethod';

	executeSettingsPaymentMethods(modal, url);
}

function deletePaymentMethod()
{
	var modal = '#modalPaymentMethodDeletion';
	var url = 'index.php?action=setOptionAjax&actionSettings=delete&editionContent=paymentMethod';

	executeSettingsPaymentMethods(modal, url);
}

function setLimitOfExpenseCategory()
{
	var modal = '#modalExpenseCategoryLimit';
	var url = 'index.php?action=setLimitAjax&editionContent=expense';
	
	$modal = $(modal);
	var $form = $modal.find('form');
	$form.on('submit', function(e) {
		e.preventDefault();
		var details = $form.serialize();

		$.ajax({
			url: url,
			type: 'POST',
			data: details,
			success: function(data) {
				updateExpenseCategoriesList();
				showModalResultOk(modal, data);
			},
			error: function(jqxhr) {
				showModalResultError($modal);
				//$('.js-modal--result__body h5').text(jqxhr.responseText);
			}
		});
	});
	

}

function editExpenseCategory()
{
	var modal = '#modalExpenseCategoryEdition';
	var url = 'index.php?action=setOptionAjax&actionSettings=edit&editionContent=expense';

	executeSettingsExpenseCategories(modal, url);
}

function executeSettingsExpenseCategories(modal, url)
{
	$modal = $(modal);
	var $form = $modal.find('form');
	$form.on('submit', function(e) {
		e.preventDefault();
		var details = $form.serialize();

		$.ajax({
			url: url,
			type: 'POST',
			data: details,
			success: function(data) {
				updateExpenseCategories();
				showModalResultOk(modal, data);
			},
			error: function(jqxhr) {
				showModalResultError($modal);
				//$('.js-modal--result__body h5').text(jqxhr.responseText);
			}
		});
	});
}

function updateExpenseCategories()
{
	updateExpenseCategoriesList();
	$('#modalExpenseCategoryEdition .js-container-select-category').load('index.php?action=showSettings&editionContent=expense #modalExpenseCategoryEdition .js-container-select-category');
	$('#modalExpenseCategoryDeletion .js-container-select-category').load('index.php?action=showSettings&editionContent=expense #modalExpenseCategoryDeletion .js-container-select-category');
	$('#modalExpenseCategoryLimit .js-container-select-category').load('index.php?action=showSettings&editionContent=expense #modalExpenseCategoryLimit .js-container-select-category');
}

function updateExpenseCategoriesList()
{
	$('.js-row--expense-categories-list').load('index.php?action=showSettings&editionContent=expense .js-col--expense-categories-list');
}

function addExpenseCategory()
{
	var modal = '#modalExpenseCategoryAddition';
	var url = 'index.php?action=setOptionAjax&actionSettings=add&editionContent=expense';

	executeSettingsExpenseCategories(modal, url);
}

function deleteExpenseCategory()
{
	var modal = '#modalExpenseCategoryDeletion';
	var url = 'index.php?action=setOptionAjax&actionSettings=delete&editionContent=expense';

	executeSettingsExpenseCategories(modal, url);
}