<?php
session_start();
if(isset($_SESSION['loggedID'])) {
	header('Location:menu.php');
	exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>Rejestracja</title>
	<?php
		require_once('head_links.php');
	?>
	
</head>

<body>
	<div class="container-fluid" id="containerRegistration">
		<div class="row pl-1 containerHeader">
			<div class="col py-3 my-2">
				<header><h2><b><a href="index.php" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
			</div>
			<div class="col-auto pt-5">
				<a href="registration.php" class="headerLink" id="linkRegister"><i class="fas fa-clipboard-list"></i><span> Rejestracja</span></a>
			</div>
			<div class="col-auto pt-5 pr-4">
				<a href="login.php" class="headerLink" id="linkLogin"><i class="fas fa-sign-in-alt"></i><span> Logowanie</span></a>
			</div>
		</div>
		
		<div class="row my-5 pb-sm-5 justify-content-center">
			
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 registration ">
				<div class="row" >
					
					<div class="col-sm-2 p-0 ">
						<div class="sideBg"></div>
					</div>
					<div class="col-12 col-sm p-5 shadow-lg">
						<header><h3>Rejestracja</h3></header>
					
						<form class="formRegister" method="post" action="save_new_user.php">
							
							<div class="input-group mb-1">
								
								<input type="text" class="form-control" placeholder="Imię" name="username" value=
								<?php
									if(isset($_SESSION['username'])) {
										echo $_SESSION['username'];
										unset($_SESSION['username']);
									}
								?>
								>
								<div class="input-group-prepend">
									<span class="input-group-text" id="userName"><i class="fas fa-user"></i></span>
								</div>
				
							</div>				
							<?php
								if(isset($_SESSION['errorUsername'])) {
									echo '<div class="error">'.$_SESSION['errorUsername'].'</div>';
									unset($_SESSION['errorUsername']);
								}
							?>
							<div class="input-group mb-1 mt-3">
								
								<input type="text" class="form-control" placeholder="Email" name="email" value=
								<?php
									if(isset($_SESSION['email'])) {
										echo $_SESSION['email'];
										unset($_SESSION['email']);
									}
								?>
								>
								<div class="input-group-prepend">
									<span class="input-group-text" id="userEmail"><i class="fas fa-envelope"></i></span>
								</div>
								
							</div>
							<?php
								if(isset($_SESSION['errorEmail'])) {
									echo '<div class="error">'.$_SESSION['errorEmail'].'</div>';
									unset($_SESSION['errorEmail']);
								}
							?>					
							<div class="input-group mb-1 mt-3">
								
								<input type="password" class="form-control password" placeholder="Hasło" name="password1" >
								<div class="input-group-prepend">
									<span class="input-group-text" ><i class="fas fa-lock"></i></span>
								</div>
								
							</div>
							<?php
								if(isset($_SESSION['errorPassword'])) {
									echo '<div class="error">'.$_SESSION['errorPassword'].'</div>';
									unset($_SESSION['errorPassword']);
								}
							?>
							<div class="input-group mb-1 mt-3">
								
								<input type="password" class="form-control password" placeholder="Powtórz hasło" name="password2" >
								<div class="input-group-prepend">
									<span class="input-group-text" ><i class="fas fa-lock"></i></span>
								</div>
								
							</div>
						
							<div class="form-check mt-3">
								<input class="form-check-input" type="checkbox" value="" id="showPassword">
								<label class="form-check-label" for="showPassword">
									Pokaż hasło
								</label>
							</div>
							
								<button type="submit" class="btn btn-default mt-4 text-white">Zarejestruj się</button>
							
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