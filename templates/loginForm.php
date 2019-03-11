		
		
		<div class="row my-5 pb-sm-5 mx-0 justify-content-center">
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 login">
				<div class="row">
					
					<div class="col-sm-2 px-0">
						<div class="sideBg"></div>
					</div>
					
					<div class="col-12 col-sm p-5 shadow-lg" style="height:100%">
						<header><h3>Logowanie</h3></header>

						<?php
							if (isset($messageForUser)) {
								echo '<h6 class="error">'.$messageForUser.'</h6>';
							}
						?>
					
						<form class="formLogin" 
							action = "index.php?action=login"
        					method = "post">
						
							<div class="input-group mb-1
							<?php
								if ($_SESSION['errorLogin']) {
									echo 'errorBorder';
									$_SESSION['errorLogin'] = false;
								}
							?>">
								<div class="input-group-prepend">
									<span class="input-group-text" id="userLogin"><i class="fas fa-user"></i></span>
								</div>

								<input type="text" class="form-control" placeholder="Login" name="login" value=
								<?php
									if(isset($_SESSION['login'])) {
										echo $_SESSION['login'];
										unset($_SESSION['login']);
									}  
								?>
								>
							</div>
											
							<div class="input-group mb-1 mt-3
							<?php
								if ($_SESSION['errorPassword']) {
									echo 'errorBorder';
									$_SESSION['errorPassword'] = false;
								}
							?>">
								<div class="input-group-prepend">
									<span class="input-group-text" ><i class="fas fa-lock"></i></span>
								</div>

								<input type="password" class="form-control password" placeholder="Hasło" name="password">
								
							</div>
							
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