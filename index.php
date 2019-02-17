<?php
session_start();

if(isset($_SESSION['loggedID'])) {
	header('Location:menu-glowne');
	exit();
}

?>


<! DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>fullWallet - zapanuj nad własnymi finansami</title>
	<?php
		require_once('head_links.php');
	?>
	
	

</head>

<body>
	<div class="container-fluid " id="containerStartPage">
		<div class="row pl-1 containerHeader" >
			<div class="col py-3 my-2">
				<header><h2><b><a href="zapanuj-nad-wlasnymi-finansami"><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
			</div>
			<div class="col-auto pt-5 ">
				<a href="zarejestruj-sie" class="headerLink"><i class="fas fa-clipboard-list"></i><span> Rejestracja</span></a>
			</div>
			
			<div class="col-auto pt-5 pr-4">
				<a href="zaloguj-sie" class="headerLink"><i class="fas fa-sign-in-alt"></i><span> Logowanie</span></a>
			</div>
		</div>
		
		<div class="row">
			<div class="col-12 col-md-6 px-0" style="height:300;">
				<img src="img/office-pen-calculator-computation-163032.jpeg" style="width:100%;height:100%" id="imgLeft">
				<div class="p-3" id="textLeftBg">
					
				</div>
				<div class="textL" >
					Chciałbyś zacząć oszczędzać, ale nie wiesz jak?
					<br />
					Nie masz zapału do zbierania paraganów, które i tak za chwilę zgubisz?
					<br />
					Nie chcesz tracić czasu na wykonywanie nudnych obliczeń na kalkulatorze?
				</div>
			</div>
		
			<div class="col-12 col-md-6 px-0" style="height:300;">
				<img src="img/alone-bills-cash-1435192.jpg" style="width:100%;height:100%" id="imgRight">
				<!--Photo by rawpixel.com from Pexels-->
				<div class="p-3" id="textRightBg">
					
				</div>
				<div class="textR">
					Jesteś na tak? <br />
					Wypróbuj fullWallet.pl! <br />
					Apka pomoże Ci przejąć kontrolę nad finansami wykonując wszystkie obliczenia za Ciebie, a dzięki wersji mobilnej dodasz przychód bądź wydatek w każdej chwili.
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col"></div>
			<div class="col-auto mt-5 pt-3 font-weight-bold" id="textCenter">
				<p class="mb-3">Weź sprawy w swoje ręce i ciesz się pełnym portfelem!</p>
				<p><i class="fas fa-angle-double-down"></i></p>
			</div>
			<div class="col"></div>
		</div>
		
		<div class="row pb-5" id="startButtons">
			<div class="col-12 col-md-6 mb-5 mb-md-2 text-center" >
				
				<p>Jesteś tutaj pierwszy raz?</p>
				<a class="btn btn-lg py-2 btnRegister shadow" href="zarejestruj-sie" role="button"><i class="fas fa-clipboard-list"></i> Zarejestruj się</a>
				</div>
			
			
			<div class="col-12 col-md-6 text-center">
				<p>Masz już konto?</p>
				<a class="btn btn-lg py-2 btnLogin shadow" href="zaloguj-sie" role="button"><i class="fas fa-sign-in-alt"></i> Zaloguj się</a>
			</div>
		
		</div>
		
		<?php
			require_once('footer.php');
		?>
</body>


</html>