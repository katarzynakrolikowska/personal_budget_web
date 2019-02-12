<?php
session_start();

if(isset($_SESSION['loggedID'])) {
	header('Location:menu.php');
	exit();
}

?>


<! DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>Logowanie</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=latin-ext" rel="stylesheet">
	
	

</head>

<body>
	<div class="container-fluid " id="containerLogin" >
		<div class="row pl-1 containerHeader">
			<div class="col py-3 my-2">
				<header><h2><b><a href="index.php" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
			</div>
			<div class="col-auto pt-5">
				<a href="registration.php" class="headerLink" id="linkR"><i class="fas fa-clipboard-list"></i><span> Rejestracja</span></a>
			</div>
			<div class="col-auto pt-5 pr-4">
				<a href="login.php" class="headerLink" id="linkL"><i class="fas fa-sign-in-alt"></i><span> Logowanie</span></a>
			</div>
		</div>
		
		<div class="row my-5 pb-sm-5">
			<div class="col"></div>
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 login ">
				<div class="row" style="height:360;">
					
					<div class="col-12 col-sm-2 p-0 ">
						
						<div class="sideBg"></div>
					</div>
					<div class="col-12 col-sm p-5 shadow-lg">
						<header><h3>Logowanie</h3></header>
					
						<form class="formRegister" action="login_user.php" method="post">
						
							<div class="input-group mb-1">
								<input type="text" class="form-control" placeholder="Email" name="emailLog" value=
								<?php
									if(isset($_SESSION['givenEmail'])) {
										echo $_SESSION['givenEmail'];
										
									}
								?>
								><div class="input-group-prepend">
									<span class="input-group-text" id="userEmail"><i class="fas fa-envelope"></i></span>
								</div>
							</div>
											
							<div class="input-group mb-1 mt-3">	
								<input type="password" class="form-control password" placeholder="Hasło" name="passwordLog">
								<div class="input-group-prepend">
									<span class="input-group-text" ><i class="fas fa-lock"></i></span>
								</div>
							</div>
							<?php
								if(isset($_SESSION['givenEmail'])) {
									echo '<div class="error">Nieprawidłowy adres email lub hasło!</div>';
									unset($_SESSION['givenEmail']);
								}
							?>	
							<div class="form-check mt-3">
								<input class="form-check-input" type="checkbox" value="" id="showPassword">
								<label class="form-check-label" for="showPassword">
									Pokaż hasło
								</label>
							</div>
							
								<button type="submit" class="btn btn-default mt-4 mb-2  text-white">Zaloguj się</button>
							
						</form>
					</div>
					
				</div>
			</div>
			<div class="col"></div>
		</div>
		
		<div class="row">
			<footer class="col footerLogin  text-center py-2">
				<p class="text-muted">2018 &copy; fullWallet.pl</p>	
			</footer>	
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script type="text/javascript" src="http://localhost/PB/js/personalBudget.js"></script>
</body>


</html>