<article class="row my-5 pb-sm-5 mx-0 justify-content-center">
	<div class="col-12 col-sm-10 col-md-8 col-lg-6 px-0 container-login">
		<div class="row">
			
			<div class="col-sm-2 px-0">
				<div class="container-login--bg-side"></div>
			</div>
			
			<div class="col-12 col-sm p-5 shadow-lg max-height">
				<header><h3>Logowanie</h3></header>
			
				<form class="js-form-login" action="index.php?action=login" method="post">
					<div class="input-group mb-1
					<?php
						if (isset($_SESSION['errorLogin'])) {
							echo 'border-red';
							unset($_SESSION['errorLogin']);
						}
					?>">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user form__icon--width"></i></span>
						</div>

						<input type="text" class="form-control" placeholder="Login" name="login" value=
						<?php
							if(isset($_SESSION['login'])) {
								echo $_SESSION['login'];
								unset($_SESSION['login']);
							}  
						?>>
					</div>
									
					<div class="input-group mb-1 mt-3
					<?php
						if (isset($_SESSION['errorPassword'])) {
							echo 'border-red';
							unset($_SESSION['errorPassword']);
						}
					?>">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-lock form__icon--width"></i></span>
						</div>
						<input type="password" class="form-control js-password--show" placeholder="Hasło" name="password">
					</div>
					
					<div class="form-check mt-3">
						<input class="form-check-input js-checkbox--show-password" type="checkbox" value="" id="showPasswordCheckbox">
						<label class="form-check-label" for="showPasswordCheckbox">
							Pokaż hasło
						</label>
					</div>
					
					<button type="submit" class="btn btn-default btn-blue max-width mt-4 text-white">Zaloguj się</button>
				</form>
				
			</div>
		</div>
	</div>
</article>