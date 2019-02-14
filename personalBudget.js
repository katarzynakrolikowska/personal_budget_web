
$(function(){
	
	//set settings menu
	var $containerMyData = $('#containerMyData');
	var $containerMyIncomes = $('#containerMyIncomes');
	var $containerMyExpenses = $('#containerMyExpenses');
	
	var $navLinkData = $('.navLinkData');
	var $navLinkIncome = $('.navLinkIncome');
	var $navLinkExpense = $('.navLinkExpense');
	
	$navLinkData.on('click', function() {
		$containerMyData.removeClass('hideItem');
		$containerMyIncomes.addClass('hideItem');
		$containerMyExpenses.addClass('hideItem');
		
		$(this).addClass('active');
		$navLinkIncome.removeClass('active');
		$navLinkExpense.removeClass('active');
		
	});
		
	$navLinkIncome.on('click', function() {
		$containerMyData.addClass('hideItem');
		$containerMyIncomes.removeClass('hideItem');
		$containerMyExpenses.addClass('hideItem');
		
		$(this).addClass('active');
		$navLinkData.removeClass('active');
		$navLinkExpense.removeClass('active');
	});
	
	$navLinkExpense.on('click', function() {
		$containerMyData.addClass('hideItem');
		$containerMyIncomes.addClass('hideItem');
		$containerMyExpenses.removeClass('hideItem');
		
		$(this).addClass('active');
		$navLinkData.removeClass('active');
		$navLinkIncome.removeClass('active');
	});
	
	
	//set modal text after data edit
	$('.linkDelete').on('click', function() {
		$('#settingsModal p').text("Dane usunięto!");
	});
	
	var $btnSave = $('.btnSave');
	var $settingsModal = $('#settingsModal');
	
	/*btnSave.on('click', function() {
		$settingsModal.text("Dane zaktualizowano!");
	});	*/
	
		
		
	//set sticky footer
	if($(document).height() >= $(window).height()){
		$('footer').addClass('footerMenuSticky');
	}else{
		$('footer').removeClass('footerMenuSticky');
	}
	
	$(window).resize(function() {
		if($(document).height() >= $(window).height()){
			$('footer').addClass('footerMenuSticky');
		}else{
			$('footer').removeClass('footerMenuSticky');
		}
	});
	
	
	// set title of header icon for <= sm size
	if ($(window).width() <= 767.98) {  
		$('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
		$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');
		$('#containerSettings .colSettingsNav ul').removeClass('flex-column');
		$('#containerSettings .colSettingsNav ul li:eq(0)').attr('title', 'Moje dane');
		$('#containerSettings .colSettingsNav ul li:eq(1)').attr('title', 'Moje przychody');
		$('#containerSettings .colSettingsNav ul li:eq(2)').attr('title', 'Moje wydatki');
      }
	$(window).resize(function() {
       if ($(window).width() <= 767.98) {  
            $('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
			$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');
			$('#containerSettings .colSettingsNav ul').removeClass('flex-column');
			$('#containerSettings .colSettingsNav ul li:eq(0)').attr('title', 'Moje dane');
			$('#containerSettings .colSettingsNav ul li:eq(1)').attr('title', 'Moje przychody');
			$('#containerSettings .colSettingsNav ul li:eq(2)').attr('title', 'Moje wydatki');
       }else{
		   $('#containerSettings .colSettingsNav ul').addClass('flex-column');
		   
	   }
	});
	
	
	
	$('#showPassword').on('click', function() {
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
	
	
	
	
	
	//set header of balance site
	var $dropdownMenuPeriod = $('ul .periodNavItem div a');
	var $headerOption = $('.headerOption span');
	var $modalSelectPeriod = $('#selectPeriodModal');
	var $dateStart = $modalSelectPeriod.find('.modal-body #dateStart');
	var $dateEnd = $modalSelectPeriod.find('.modal-body #dateEnd');
	
	$dropdownMenuPeriod.each(function() {
		$(this).on('click', function() {
			if(this.id == 'optionCurrentMonth'){
				$headerOption.text(' bieżący miesiąc');
			}else if(this.id == 'optionPreviousMonth'){
				$headerOption.text(' poprzedni miesiąc');
			}else if(this.id == 'optionCurrentYear'){
				$headerOption.text(' bieżący rok');
			}else if(this.id == 'optionSelectPeriod'){
				$modalSelectPeriod.find('.modal-footer #btnOK').on('click', function() {
					if($dateStart.val() != '' && $dateEnd.val() != ''){
						
						$headerOption.html(' wybrany okres'+ '<br />' +'<span class="customPeriodHeader">' + $dateStart.val() +' - '+ $dateEnd.val() + '</span>');
					}
				});
			}
		});
	});
	
	// set date range of modalSelectPeriod
	$dateStart.on('change', function() {
		$dateEnd.attr('min', $dateStart.val());			
	});
	
	$dateEnd.on('change', function() {
		$dateStart.attr('max', $dateEnd.val());	
	});
	

	
	var userName = 'imię';
	var userEmail = 'email';
	var userPassword = 'hasło';
	
	
	
	//set user data
	
	var $userNameSpan = $('.dataUser #headerName span');
	var $userEmailSpan = $('.dataUser #headerEmail span');
	var $userPasswordSpan = $('.dataUser #headerPassword span');
	
	$userNameSpan.text(userName);
	$userEmailSpan.text(userEmail);
	$userPasswordSpan.text('ukryte');
	
	var $dataUser = $('.dataUser');
	var userInput = '';
	
	
	//edit user name
	var $formUserName = $dataUser.next().eq(0);
	
	$dataUser.find('#editNameLink').on('click', function() {
		$formUserName.removeClass('hideItem');	
	});
	
	$formUserName.find('.btnChangeUserName').on('click', function(e) {
		e.preventDefault();
		userInput = $(this).parent().prev().find('.inputEditName');
		if(userInput.val() !== ''){
			userName = userInput.val();
			
			$userNameSpan.text(userName);
			
			userInput.val('');
			$settingsModal.find('p').text("Dane zaktualizowano!");
		}else{
			$settingsModal.find('p').text("Operacja nie powiodła się!");
		}
		$formUserName.addClass('hideItem');
		
	});
		
		
	//edit user email
		
	var $formUserEmail = $dataUser.next().eq(1);
	
	$dataUser.find('#editEmailLink').on('click', function() {
		$formUserEmail.removeClass('hideItem');	
	});
	
	$formUserEmail.find('.btnChangeUserEmail').on('click', function(e) {
		e.preventDefault();		
		userInput = $(this).parent().prev().find('.inputEditEmail');
		if(userInput.val() !== ''){
			userEmail = userInput.val();
			$userEmailSpan.text(userEmail);
			
			userInput.val('');
			$settingsModal.find('p').text("Dane zaktualizowano!");
		}else{
			$settingsModal.find('p').text("Operacja nie powiodła się!");
		}
		$formUserEmail.addClass('hideItem');
		
	});
	
	//edit user password
	
	var $formUserPassword = $dataUser.next().eq(2);
	
	$dataUser.find('#editPasswordLink').on('click', function() {
		$formUserPassword.removeClass('hideItem');	
	});
	
	$formUserPassword.find('.btnChangeUserPassword').on('click', function(e) {
		e.preventDefault();	
		$formUserPassword.addClass('hideItem');
		$settingsModal.find('p').text("Dane zaktualizowano!");
	});
	
	
	//edit incomes
	var $containerMyIncomes = $('#containerMyIncomes');
	var $formIncomes = $containerMyIncomes.find('form');
	$containerMyIncomes.find('#editLastIncomeLink').on('click', function(e) {
		e.preventDefault();
		$formIncomes.eq(0).removeClass('hideItem');
	});
	 
	$containerMyIncomes.find('.btnChangeIncome').on('click', function(e) {
		e.preventDefault();
		$formIncomes.eq(0).addClass('hideItem');
	});
	
	$containerMyIncomes.find('#addCategoryIncomeLink').on('click', function(e) {
		e.preventDefault();
		$formIncomes.eq(1).removeClass('hideItem');
	});
	 
	$containerMyIncomes.find('.btnAddCategoryIncome').on('click', function(e) {
		e.preventDefault();
		$formIncomes.eq(1).addClass('hideItem');
	});
	
	
	//edit expenses
	
	var $containerMyExpenses = $('#containerMyExpenses');
	var $formExpenses = $containerMyExpenses.find('form');
	$containerMyExpenses.find('#editLastExpenseLink').on('click', function(e) {
		e.preventDefault();
		$formExpenses.eq(0).removeClass('hideItem');
	});
	 
	$containerMyExpenses.find('.btnChangeExpense').on('click', function(e) {
		e.preventDefault();
		$formExpenses.eq(0).addClass('hideItem');
	});
	
	
	$containerMyExpenses.find('#addPaymentExpenseLink').on('click', function(e) {
		e.preventDefault();
		$formExpenses.eq(1).removeClass('hideItem');
	});
	 
	$containerMyExpenses.find('.btnAddPaymentExpense').on('click', function(e) {
		e.preventDefault();
		$formExpenses.eq(1).addClass('hideItem');
	});
	
	
	$containerMyExpenses.find('#addCategoryExpenseLink').on('click', function(e) {
		e.preventDefault();
		$formExpenses.eq(2).removeClass('hideItem');
	});
	 
	$containerMyExpenses.find('.btnAddCategoryExpense').on('click', function(e) {
		e.preventDefault();
		$formExpenses.eq(2).addClass('hideItem');
	});
	
	
	
	
});
	
	
	
	
		
		
		
	