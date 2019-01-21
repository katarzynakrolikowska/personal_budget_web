//var animateButtons = false;
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

$(function(){
	
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
	if ($(window).width() <= 768) {  
		$('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
		$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');
      }
	$(window).resize(function() {
       if ($(window).width() <= 768) {  
            $('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
			$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');	
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
	
	
	//set current date formAddIncome
	$('.formAddData #date').val(currentDate);
	
	
	//set range of input date
	$('[type="date"]').attr({
		'min' : '1900-01-01',
		'max' : currentDate
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