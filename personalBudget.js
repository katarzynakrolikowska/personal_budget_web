var animateButtons = false;

$(function(){
	$(window).resize(function() {
       if ($(window).width() <= 768) {  
              $('.headerLink i:eq(0)').attr('title', 'Rejestracja');
			  $('.headerLink i:eq(1)').attr('title', 'Logowanie');
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