<div class="row my-5 pb-sm-5 mx-0 justify-content-center">
	<div class="col-12 col-sm-10 col-md-8 col-lg-6 registration ">
		<div class="row" >
			
			<div class="col-sm-2 p-0 ">
				<div class="sideBg"></div>
			</div>
			<div class="col-12 col-sm p-5 shadow-lg" style="height:100%">
				<header><h3>Rejestracja</h3></header>

				<?php
					if (isset($messageError)) {
						echo '<h6 class="error">'.$messageError.'</h6>';
					}
				?>

				<form class="formRegister" method="post" action="index.php?action=register">
					
					<div class="input-group mb-1 
					<?php
						if (isset($_SESSION['errorUsername'])) {
							echo 'errorBorder';
							unset($_SESSION['errorUsername']);
						}
					?>">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-user"></i>
							<span>
						</div>
						<input type="text" class="form-control" placeholder="Imię" name="username"
						<?php
							if (isset($_SESSION['username'])) {
								echo  'value='.$_SESSION['username'];
								unset($_SESSION['username']);
							}
						?>>
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Imię powinno składać się z samych liter (minimum 3 znaki).">
						
							<span class="input-group-text" id="userName">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
		
					</div>				
					
					<div class="input-group mb-1 mt-3
					<?php
						if (isset($_SESSION['errorLogin'])) {
							echo 'errorBorder';
							unset($_SESSION['errorLogin']);
						}
					?>">
						<div class="input-group-prepend">
							<span class="input-group-text" ><i class="fas fa-user-lock"></i></span>
						</div>

						<input type="text" class="form-control" placeholder="Login" name="login" 
						<?php
							if(isset($_SESSION['login'])) {
								echo 'value='.$_SESSION['login'];
								unset($_SESSION['login']);
							}
						?>>

						<a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Login powinien składać sie z minimum 3 znaków, może zawierać litery (bez polskich znaków), cyfry oraz znaki _ lub .">
							<span class="input-group-text" id="userName">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
									
					<div class="input-group mb-1 mt-3 
					<?php
						if (isset($_SESSION['errorPassword1'])) {
							echo 'errorBorder';
						}
					?>">
						<div class="input-group-prepend">
							<span class="input-group-text" ><i class="fas fa-lock"></i></span>
						</div>

						<input type="password" class="form-control password" placeholder="Hasło" name="password1">
						
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Hasło powinno zawierać od 8 do 20 znaków.">
							<span class="input-group-text" id="userName">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
					</div>
					
					<div class="input-group mb-1 mt-3
					<?php
						if (isset($_SESSION['errorPassword1'])) {
							echo 'errorBorder';
							unset($_SESSION['errorPassword1']);
						}
					?>">
						<div class="input-group-prepend">
							<span class="input-group-text" ><i class="fas fa-lock"></i></span>
						</div>

						<input type="password" class="form-control password" id="pass2" placeholder="Potwierdź hasło" name="password2">
						
						<a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Powtórz wpisane wyżej hasło.">
							<span class="input-group-text" id="userName">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
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

