	
		<article class="row my-5 pb-sm-5 mx-0 justify-content-center">
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 px-0 container-registration">
				<div class="row" >
					<div class="col-sm-2 p-0 ">
						<div class="container-registration--bg-side"></div>
					</div>
					<div class="col-12 col-sm p-5 shadow-lg max-height">
						<h3 class="pb-2">Rejestracja</h3>
						<form class="form-registration" method="post" action="index.php?action=register">
							
							<div class="input-group mb-1 
							<?php
								if (isset($_SESSION['errorUsername'])) {
									echo 'border-red';
									unset($_SESSION['errorUsername']);
								}
							?>">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-user form__icon--width"></i>
									<span>
								</div>
								<input type="text" class="form-control" placeholder="Imię" name="username"
								<?php
									if (isset($_SESSION['username'])) {
										echo  'value='.$_SESSION['username'];
										unset($_SESSION['username']);
									}
								?>>
								<a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest obowiązkowe. Imię powinno składać się z samych liter (minimum 3 znaki).">
								
									<span class="input-group-text form__icon-tip">
										<i class="fas fa-info-circle form__icon--width"></i>
									</span>
								</a>
							</div>				
							
							<div class="input-group mb-1 mt-3
							<?php
								if (isset($_SESSION['errorLogin'])) {
									echo 'border-red';
									unset($_SESSION['errorLogin']);
								}
							?>">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user-lock form__icon--width"></i></span>
								</div>

								<input type="text" class="form-control" placeholder="Login" name="login" 
								<?php
									if(isset($_SESSION['login'])) {
										echo 'value='.$_SESSION['login'];
										unset($_SESSION['login']);
									}
								?>>

								<a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest obowiązkowe. Login powinien składać sie z minimum 3 znaków, może zawierać litery (bez polskich znaków), cyfry oraz znaki _ lub .">
									<span class="input-group-text form__icon-tip">
										<i class="fas fa-info-circle form__icon--width"></i>
									</span>
								</a>
							</div>
											
							<div class="input-group mb-1 mt-3 
							<?php
								if (isset($_SESSION['errorPassword1'])) {
									echo 'border-red';
								}
							?>">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-lock form__icon--width"></i></span>
								</div>

								<input type="password" class="form-control js-password--show" placeholder="Hasło" name="password1">
								
								<a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest obowiązkowe. Hasło powinno zawierać od 8 do 20 znaków.">
									<span class="input-group-text form__icon-tip">
										<i class="fas fa-info-circle form__icon--width"></i>
									</span>
								</a>
							</div>
							
							<div class="input-group mb-1 mt-3
							<?php
								if (isset($_SESSION['errorPassword1'])) {
									echo 'border-red';
									unset($_SESSION['errorPassword1']);
								}
							?>">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-lock form__icon--width"></i></span>
								</div>

								<input type="password" class="form-control js-password--show" id="pass2" placeholder="Potwierdź hasło" name="password2">
								
								<a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest obowiązkowe. Powtórz wpisane wyżej hasło.">
									<span class="input-group-text form__icon-tip">
										<i class="fas fa-info-circle form__icon--width"></i>
									</span>
								</a>
							</div>
							
							<div class="form-check mt-3">
								<input class="form-check-input js-checkbox--show-password" type="checkbox" value="" id='showPasswordCheckbox'>
								<label class="form-check-label" for="showPasswordCheckbox">
									Pokaż hasło
								</label>
							</div>
							
							<button type="submit" class="btn btn-default btn-blue max-width mt-4 text-white">Zarejestruj się</button>	
						</form>
					</div>
				</div>
			</div>
		</article>

