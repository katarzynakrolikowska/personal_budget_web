
var today = new Date();
var currentYear = today.getFullYear();
var currentMonth = today.getMonth() + 1;
var currentDay = today.getDate();
if(currentDay < 10)
	currentDay = "0" + currentDay;
	
if(currentMonth < 10)
	currentMonth = "0" + currentMonth;

var currentDate = currentYear + "-" + currentMonth + "-" + currentDay;


var categoriesExpense = new Array(17);
categoriesExpense[0] = "Jedzenie";
categoriesExpense[1] = "Mieszkanie";
categoriesExpense[2] = "Transport";
categoriesExpense[3] = "Telekomunikacja";
categoriesExpense[4] = "Opieka zdrowotna";
categoriesExpense[5] = "Ubranie";
categoriesExpense[6] = "Higiena";
categoriesExpense[7] = "Dzieci";
categoriesExpense[8] = "Rozrywka";
categoriesExpense[9] = "Wycieczka";
categoriesExpense[10] = "Szkolenia";
categoriesExpense[11] = "Książki";
categoriesExpense[12] = "Oszczędności";
categoriesExpense[13] = "Na złotą jesień, czyli emeryturę";
categoriesExpense[14] = "Spłata długów";
categoriesExpense[15] = "Darowizna";
categoriesExpense[16] = "Inne wydatki";

var categoriesIncome = new Array(4);
categoriesIncome[0] = "Wynagrodzenie";
categoriesIncome[1] = "Odsetki bankowe";
categoriesIncome[2] = "Sprzedaż na allegro";
categoriesIncome[3] = "Inne";

var paymentMethod = new Array(3);
paymentMethod[0] = "Gotówka";
paymentMethod[1] = "Karta debetowa";
paymentMethod[2] = "Karta kredytowa";

$(function(){
	
	//set incomes categories
	var $setIncomesCategories = $('.setIncomeCategories');
	var $newOption = $('<option>');
	
	$setIncomesCategories.append($newOption.append('Wybierz kategorię').attr({
		'disabled': true,
		'selected': true
	}));
	for(i = 0; i < categoriesIncome.length; i++){
		$newOption = $('<option>');
		$setIncomesCategories.append($newOption.append(categoriesIncome[i]));
		
	}
	
	
	//set expenses categories
	
	var $setExpenseCategories = $('.setExpenseCategories');
	var $newOption = $('<option>');
	
	$setExpenseCategories.append($newOption.append('Wybierz kategorię').attr({
		'disabled': true,
		'selected': true
	}));
	for(i = 0; i < categoriesExpense.length; i++){
		$newOption = $('<option>');
		$setExpenseCategories.append($newOption.append(categoriesExpense[i]));
		
	}
	
	
	//set payments method
	var $setPaymentMethods = $('.setPaymentMethods');
	var $newOption = $('<option>');
	
	$setPaymentMethods.append($newOption.append('Wybierz metodę płatności').attr({
		'disabled': true,
		'selected': true
	}));
	for(i = 0; i < paymentMethod.length; i++){
		$newOption = $('<option>');
		$setPaymentMethods.append($newOption.append(paymentMethod[i]));
		
	}
	
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
	
	//set active menu item
	//var $listItems = $('nav ul');
	//$('#pp').addClass('active');
	
	/*$listItems.find('a').each(function() {
		$(this).on('click', function() {
			$listItems.find('li').removeClass('active');
			this.parent().addClass('active');
		});
	});
	
	$listItems.find('#first').on('click', function() {
		$('#pp').addClass('active');
	});*/
	
	
	
	
	
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
	
	
	//set income table
	var $incomeTableBody = $('#tableIncome tbody');
	var sumOfIncomes = 0;
	for(i = 0; i < categoriesIncome.length; i++) {
		$incomeTableBody.append('<tr><td>'+categoriesIncome[i]+'</td><td class="text-right">'+currentDate+'</td><td class="text-right"><b>'+i+'</b></td></tr>');
		sumOfIncomes += i;
	}
	$incomeTableBody.append('<tr><td></td><td class="text-right"><b>'+"RAZEM"+'</b></td><td class="text-right"><b>'+sumOfIncomes+'</b></td></tr>');
	
	//set expense table
	var $expenseTableBody = $('#tableExpense tbody');
	var sumOfExpenses = 0;
	for(i = 0; i < categoriesExpense.length; i++) {
		$expenseTableBody.append('<tr><td>'+categoriesExpense[i]+'</td><td class="text-right">'+currentDate+'</td><td class="text-right"><b>'+i+'</b></td></tr>');
		sumOfExpenses += i;
	}
	$expenseTableBody.append('<tr><td></td><td class="text-right"><b>'+"RAZEM"+'</b></td><td class="text-right"><b>'+sumOfExpenses+'</b></td></tr>');
	
	
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
	
	
	//display balance 
	var difference = sumOfIncomes - sumOfExpenses;
	
	$('#resultBalance').text(difference);
	
	if(difference < 0){
		$('#containerBalance .resultText').css('background', '#EF5350');
		$('#resultComment').text("Uważaj, wpadasz w długi!");
	}
	else if(difference > 0){
		$('#containerBalance .resultText').css('background', '#4CAF50');
		$('#resultComment').text("Gratulacje! Świetnie zarządzasz finansami!");
	}
	
	
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
	
	
	
	
	
	
	//set chart
	
	var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	data: [{
		type: "pie",
		startAngle: 240,
		yValueFormatString: "##0.00\"%\"",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: 1, label: categoriesExpense[0]}
			
		]
	}]
	});
	chart.render();
	
	for(i = 1; i < categoriesExpense.length; i++){
		chart.options.data[0].dataPoints.push({ y: i, label: categoriesExpense[i]});
		
	}
	
	chart.render();
	
	
});
	
	
	
	
	
		
		
		
	