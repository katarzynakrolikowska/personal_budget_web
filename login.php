<?php
session_start();

if(isset($_SESSION['loggedID'])) {
	header('Location:menu-glowne');
	exit();
}

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>Logowanie</title>
	<?php
		require_once('head_links.php');
	?>
	
	

</head>

<body>
	<div class="container-fluid" id="containerLogin">
		<div class="row pl-1 containerHeader">
			<div class="col py-3 my-2">
				<header><h2><b><a href="zapanuj-nad-wlasnymi-finansami" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
			</div>
			<div class="col-auto pt-5">
				<a href="zarejestruj-sie" class="headerLink" id="linkRegister"><i class="fas fa-clipboard-list"></i><span> Rejestracja</span></a>
			</div>
			<div class="col-auto pt-5 pr-4">
				<a href="zaloguj-sie" class="headerLink" id="linkLogin"><i class="fas fa-sign-in-alt"></i><span> Logowanie</span></a>
			</div>
		</div>
		
		<?php
		if(isset($_SESSION['newUserSuccess'])) {
			echo '<h3 class="newUserInfo">'.$_SESSION['newUserSuccess'].'</h3>';
			unset($_SESSION['newUserSuccess']);
		}
		?>
		
		<div class="row my-5 pb-sm-5 mb-5 justify-content-center">
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 login ">
				<div class="row">
					
					<div class="col-sm-2 p-0 ">
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
							
							<button type="submit" class="btn btn-default mt-4 text-white">Zaloguj się</button>
							
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<?php
			require_once('footer.php');
		?>
</body>


</html>