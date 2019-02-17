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
	<?php
		require_once('head_links.php');
	?>
	
	

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
				<div class="contentBg">

				</div>
				<div class="contentText " id="contentText">
					Dzień dobry <?php echo $_SESSION['username'].'!<br />';?>
					Co mogę dzisiaj dla Ciebie zrobić?
				</div>
			</div>
		</div>
		<?php
			require_once('footer.php');
		?>
		
</body>


</html>