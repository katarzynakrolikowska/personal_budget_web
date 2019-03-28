
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
	
	
	
	
		
		
		
	