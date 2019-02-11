<?php
session_start();
if(!isset($_SESSION['loggedID'])) {
	header('Location:login.php');
	exit();
}
?>

<! DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>Menu</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=latin-ext" rel="stylesheet">
	
	

</head>

<body>
	<div class="container-fluid p-0" id="containerMenu" >
		
		<?php
			require_once('nav_header.php');
		?>
		
		<nav class="navbar navbar-expand-lg justify-content-between sticky-top shadow">
			
			<header><h2><b><a href="menu.php" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
			
			<button class="navbar-toggler mr-2 mr-sm-4 collapsed" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				 <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
			 </button>

			<div class="collapse navbar-collapse " id="menu">
				<ul class="navbar-nav m-auto ">
				    <li class="nav-item active">
						<a class="nav-link" href="menu.php"><i class="icon-home"></i> Strona główna</a>
				    </li>
					
				    <li class="nav-item">
						<a class="nav-link" href="income.php"><i class="icon-dollar"></i> Dodaj przychód</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link " href="expense.html"><i class="icon-shopping-basket"></i> Dodaj wydatek</a>
					</li>
					
					<li class="nav-item" id="itemBalance">
						<a class="nav-link " href="balance.html"><i class="icon-chart-bar"></i> Przeglądaj bilans</a>
					</li>
					
					<li class="nav-item dropdown">
						<a class="nav-link " href="settings.html" ><i class="icon-cog-alt"></i> Ustawienia</a>
						
					</li>
					
					<li class="nav-item" id="logOutItemNav">
						<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Wyloguj się</a>
					</li>
				</ul>
			</div>
		</nav>
		

		
		<div class="row mx-0 mb-5 pb-5 justify-content-center">
			<div class="col-12 col-md-auto px-0 mt-5 mt-sm-0 photo" >
				<!--Photo by rawpixel.com from Pexels-->
				<img src="img/pexels-photo-908288.jpeg" >
				<div class="contentBg " id="contentBg">

				</div>
				<div class="contentText " id="contentText">
					Dzień dobry <?php echo $_SESSION['username'].'!<br />';?>
					Co mogę dzisiaj dla Ciebie zrobić?
				</div>
			</div>
		</div>
		
		<div class="row mx-0">
			<footer class="col footerMenu text-center py-2">
				<p class="text-muted">2018 &copy; fullWallet.pl</p>	
			</footer>	
		</div>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="//stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	
	<script type="text/javascript" src="personalBudget.js"></script>
</body>


</html>