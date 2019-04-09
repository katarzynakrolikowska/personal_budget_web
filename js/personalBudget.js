
$(function(){
	
	$('[data-toggle="popover"]').popover({
		placement: 'bottom',
		offset: '-112px'
		
	});


	
	//set modal text after data edit
	$('.linkDelete').on('click', function() {
		$('#settingsModal p').text("Dane usunięto!");
	});
	
	var $btnSave = $('.btnSave');
	var $settingsModal = $('#settingsModal');
	

	
	// set title of header icon for <= sm size
	if ($(window).width() <= 767.98) {  
		$('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
		$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');
		$('#rowSettings .colSettingsNav ul').removeClass('flex-column');
		$('#rowSettings .colSettingsNav ul li:eq(0)').attr('title', 'Moje dane');
		$('#rowSettings .colSettingsNav ul li:eq(1)').attr('title', 'Moje przychody');
		$('#rowSettings .colSettingsNav ul li:eq(2)').attr('title', 'Moje wydatki');
      }
	$(window).resize(function() {
       if ($(window).width() <= 767.98) {  
            $('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
			$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');
			$('#rowSettings .colSettingsNav ul').removeClass('flex-column');
			$('#rowSettings .colSettingsNav ul li:eq(0)').attr('title', 'Moje dane');
			$('#rowSettings .colSettingsNav ul li:eq(1)').attr('title', 'Moje przychody');
			$('#rowSettings .colSettingsNav ul li:eq(2)').attr('title', 'Moje wydatki');
       }else{
		   $('#rowSettings .colSettingsNav ul').addClass('flex-column');
		   
	   }
	});
	
	
	
	$('.showPasswordCheckbox').on('click', function() {
		var $password = $('.password');
		var typePassword = $password.attr('type');
		if(typePassword == 'password'){
			$password.attr('type', 'text')
		} else {
			$password.attr('type', 'password')
		}
	});
	

		
	//set css for start page text
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
	
	
	
	//set css for add income form and add expense form
	$('.formAddData select').focus(function() {
		$(this).next().addClass('inputGroupPrependFocus');
		$(this).next().children().addClass('inputGroupTextFocus');
	});
		
	$('.formAddData select').blur(function() {
		$(this).next().removeClass('inputGroupPrependFocus');
		$(this).next().children().removeClass('inputGroupTextFocus');
	});
	
	$('.formAddData input').focus(function() {
		$(this).next().addClass('inputGroupPrependFocus');
		$(this).next().children().addClass('inputGroupTextFocus');
	});
		
	$('.formAddData input').blur(function() {
		$(this).next().removeClass('inputGroupPrependFocus');
		$(this).next().children().removeClass('inputGroupTextFocus');
	});

	
	// set date range of modalSelectPeriod
	var $dateStart = $('#dateStart');
	var $dateEnd = $('#dateEnd');

	$dateStart.on('change', function() {
		$dateEnd.attr('min', $dateStart.val());			
	});
	
	$dateEnd.on('change', function() {
		$dateStart.attr('max', $dateEnd.val());	
	});


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
		$settingsModalIncome.find('.btn').text('Edytuj kategorię');
		$settingsModalIncome.find('form').attr('action', 'index.php?action=editOption&editionContent=income');

	});

	$('#addIncomeLink').on('click', function() {
		$settingsModalIncome.find('h5').text('Dodaj kategorię przychodu');
		$info.addClass('hideItem');
		$inputSelectOption.addClass('hideItem');
		$inputOption.removeClass('hideItem');
		$settingsModalIncome.find('.btn').text('Dodaj kategorię');
		$settingsModalIncome.find('form').attr('action', 'index.php?action=addOption&editionContent=income');
	});

	$('#deleteIncomeLink').on('click', function() {
		$settingsModalIncome.find('h5').text('Usuń kategorię przychodu');
		$info.addClass('hideItem');
		$inputSelectOption.removeClass('hideItem');
		$inputOption.addClass('hideItem');
		$inputSelectOption.find('a').attr('data-content', 'Wybierz kategorię, którą chcesz usunąć.');
		$settingsModalIncome.find('.btn').text('Usuń kategorię');
		$settingsModalIncome.find('form').attr('action', 'index.php?action=deleteOption&editionContent=income');
	});


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
		$settingsModalExpense.find('.btn').text('Edytuj metodę płatności');
		$settingsModalExpense.find('form').attr('action', 'index.php?action=editOption&editionContent=paymentMethod');

	});

	$('#addMethodLink').on('click', function() {
		$settingsModalExpense.find('h5').text('Dodaj metodę płatności');
		$info.addClass('hideItem');
		$inputSelectExpenseCategory.addClass('hideItem');
		$inputSelectPaymentMethod.addClass('hideItem');
		$inputOption.removeClass('hideItem');
		$settingsModalExpense.find('.btn').text('Dodaj metodę');
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
		$settingsModalExpense.find('.btn').text('Usuń metodę płatności');
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
		$settingsModalExpense.find('.btn').text('Edytuj kategorię');
		$settingsModalExpense.find('form').attr('action', 'index.php?action=editOption&editionContent=expense');

	});

	$('#addExpenseCategoryLink').on('click', function() {
		$settingsModalExpense.find('h5').text('Dodaj kategorię wydatku');
		$info.addClass('hideItem');
		$inputSelectPaymentMethod.addClass('hideItem');
		$inputSelectExpenseCategory.addClass('hideItem');
		$inputOption.removeClass('hideItem');
		$inputOption.find('#inputEdition').attr('placeholder', 'Wpisz nową kategorię');
		$settingsModalExpense.find('.btn').text('Dodaj kategorię');
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
		$settingsModalExpense.find('.btn').text('Usuń kategorię');
		$settingsModalExpense.find('form').attr('action', 'index.php?action=deleteOption&editionContent=expense');
	});

	
});
	
	
	
	
		
		
		
	