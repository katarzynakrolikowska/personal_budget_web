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
			$_SESSION['menu'] = '';
			require_once('nav_header.php');
			unset($_SESSION['menu']);
		?>
		
		
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