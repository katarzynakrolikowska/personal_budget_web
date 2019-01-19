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

$(function(){
	if ($(window).width() <= 768) {  
		$('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
		$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');
		//$('.containerHeaderMenu .headerLink i:eq(0)').attr('title', 'Twoje konto');
		//$('.containerHeaderMenu .headerLink i:eq(1)').attr('title', 'Wyloguj się');
      }
	$(window).resize(function() {
       if ($(window).width() <= 768) {  
            $('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
			$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');
			//$('.containerHeaderMenu .headerLink i:eq(0)').attr('title', 'Twoje konto');
			//$('.containerHeaderMenu .headerLink i:eq(1)').attr('title', 'Wyloguj się');
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
	
	/*$('#contentText').mouseenter(function() {
		$('#contentBg').removeClass('contentBgBlur').addClass('contentBgHover');
		$(this).removeClass('contentTextBlur').addClass('contentTextHover');
	});
		
	
	
	$('#contentText').mouseleave(function() {
		$('#contentBg').removeClass('contentBgHover').addClass('contentBgBlur');
		$(this).removeClass('contentTextHover').addClass('contentTextBlur');
	});*/
		
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
	
	
	
	
	/*$('.formAddData select').focus(function() {
		$(this).attr('size', '5');
	});
	
	$('.formAddData select').change(function() {
		$(this).attr('size', '1');
	});
	
	/*$('.navbar-toggler-icon').on('click', function() {
		
		var $photo = $('.photo');
		var $footer = $('#containerMenu footer');
		
		if($('#containerMenu button').is('.collapsed')){
			$footer.removeClass('footerMenuSticky');
		}else{
			if(!$photo.is('.footerMenuSticky')){
				$footer.addClass('footerMenuSticky');
			}
		}
	});
	
	
	/*$(window).on('scroll', function() {
		if(animateButtons == false){
			$('#startButtons').animate({
				paddingTop: '-=65'
			}, 'slow');
		}
		animateButtons = true;
	});
	
	/*$('#textCenter i').mouseleave(function() {
		if(animateButtons == false) {
			$('#startButtons').animate({
				paddingTop: '+=65'
			}, 'slow');
		}
		animateButtons = true;
	});*/
	
	
		
});