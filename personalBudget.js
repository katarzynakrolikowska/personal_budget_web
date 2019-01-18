//var animateButtons = false;

$(function(){
	if ($(window).width() <= 768) {  
		$('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
		$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');
		$('.containerHeaderMenu .headerLink i:eq(0)').attr('title', 'Twoje konto');
		$('.containerHeaderMenu .headerLink i:eq(1)').attr('title', 'Wyloguj się');
      }
	$(window).resize(function() {
       if ($(window).width() <= 768) {  
            $('.containerHeader .headerLink i:eq(0)').attr('title', 'Rejestracja');
			$('.containerHeader .headerLink i:eq(1)').attr('title', 'Logowanie');
			$('.containerHeaderMenu .headerLink i:eq(0)').attr('title', 'Twoje konto');
			$('.containerHeaderMenu .headerLink i:eq(1)').attr('title', 'Wyloguj się');
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