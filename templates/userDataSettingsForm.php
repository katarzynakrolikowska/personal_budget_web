    <div id="containerUserData">
        <div class="row headerMyData mx-0 py-2 pl-3">
            <div class="col-12" >
                <header>Dane osobowe</header>
            </div>
        </div>
        
        <div class="row mx-0 pr-4 pl-3 mt-4 mb-5">
            <div class="col-12" >
                <header>Imię</header>
            </div>
            
            <div class="col-10 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>            
                <input type="text" disabled class="form-control" value="<?= $portal -> loggedInUser -> getName()?>">
            </div>
            <div class="col-2">
                <div class="dropdown mr-1">
                    <i class="fas fa-ellipsis-h menuDots" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsUserDataModal" id="editUsernameLink">Edytuj</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row  mx-0 py-2 pl-3">
            <div class="col-12" >
                <header>Login</header>
            </div>
            
        </div>
        <div class="row mx-0 pr-4 pl-3 mb-5">
            <div class="col-10 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                </div>            
                <input type="text" disabled class="form-control" value="<?= $portal -> loggedInUser -> getLogin()?>">
            </div>
            <div class="col-2">
                <div class="dropdown mr-1">
                    <i class="fas fa-ellipsis-h menuDots" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsUserDataModal" id="editLoginLink">Edytuj</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mx-0 py-2 pl-3">
            <div class="col-12">
                <header>Hasło</header>
            </div>
            
        </div>
        <div class="row mx-0 pr-4 pl-3 mb-5">
            <div class="col-10 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>            
                <input type="password" disabled class="form-control">
            </div>
            <div class="col-2">
                <div class="dropdown mr-1">
                    <i class="fas fa-ellipsis-h menuDots" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsUserDataModal" id="editPasswordLink">Edytuj</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="settingsUserDataModal" tabindex="-1" role="dialog" aria-labelledby="settingsUserDataModal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title text-center"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body mx-4">
                <form method="post">
                    <div class="input-group mb-3 editNameField">
						<input type="text" class="form-control" placeholder="Wpisz nowe imię" name="username">
						<a class="input-group-prepend" data-toggle="popover" data-content="Imię powinno składać się z samych liter (minimum 3 znaki).">
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div>
                    
                    </div>
                    <div class="input-group mb-3 editLoginField">
                        
                        <input type="text" class="form-control" id="inputEditLogin" placeholder="Podaj nowy login" name="login">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Login powinien składać sie z minimum 3 znaków, może zawierać litery (bez polskich znaków), cyfry oraz znaki _ lub .">
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div class="input-group mb-3 editPasswordField">
                        <input type="password" class="form-control inputEditPassword password 
                        " id="oldPasword" name ="oldPassword" placeholder="Podaj stare hasło">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Wpisz stare hasło.">
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div class="input-group mb-3 editPasswordField">
                        <input type="password" class="form-control password" name="newPassword" placeholder="Podaj nowe hasło">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Hasło powinno składać się od 8 do 20 znaków.">
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div class="input-group mb-3 editPasswordField">
                        <input type="password" class="form-control password" name="newPasswordRepeated" placeholder="Powtórz nowe hasło">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Powtórz nowe hasło.">
							<span class="input-group-text">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div class="form-check mt-2 ml-3 editPasswordField">
						<input class="form-check-input showPasswordCheckbox" type="checkbox" value="" id="showPasswordCheckbox">
						<label class="form-check-label" for="showPasswordCheckbox">
							Pokaż hasło
						</label>
                        
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8 input-group my-3">
                            <button type="submit" class="btn btn-primary max-width mt-4 text-white">Zapisz</button>
                        </div>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>