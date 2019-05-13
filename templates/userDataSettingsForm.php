    
        <div class="row container-settings__header text-gray max-width mx-0 py-2 pl-3">
            <div class="col-12" >
                <h3>Dane osobowe</h3>
            </div>
        </div>
        <div class="js-container-edition-name">
            <div class="row mx-0 pr-4 pl-3 mt-4 mb-5 js-row-edition-name">
                <div class="col-12 mb-1">
                    <h6>Imię</h6>
                </div>
                
                <div class="col-10 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>            
                    <input type="text" disabled class="form-control" value="<?= $portal -> loggedInUser -> getName()?>">
                </div>
                
                <div class="col-2">
                    <div class="dropdown mr-1">
                        <i class="fas fa-ellipsis-h dropdown-settings__icon-dots" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#usernameEditionModal" id="editUsernameLink">Edytuj</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="js-container-edition-login">
            <div class="row  mx-0 pr-4 pl-3 mt-4 mb-5 js-row-edition-login">
                <div class="col-12 mb-1" >
                    <h6>Login</h6>
                </div>
            
                <div class="col-10 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                    </div>            
                    <input type="text" disabled class="form-control" value="<?= $portal -> loggedInUser -> getLogin()?>">
                </div>
                <div class="col-2">
                    <div class="dropdown mr-1">
                        <i class="fas fa-ellipsis-h dropdown-settings__icon-dots" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#loginEditionModal" id="editLoginLink">Edytuj</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0 pr-4 pl-3 mt-4 mb-5">
            <div class="col-12 mb-1">
                <h6>Hasło</h6>
            </div>
            <div class="col-10 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>            
                <input type="password" disabled class="form-control">
            </div>
            <div class="col-2">
                <div class="dropdown mr-1">
                    <i class="fas fa-ellipsis-h dropdown-settings__icon-dots" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#passwordEditionModal" id="editPasswordLink">Edytuj</a>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

<div class="modal fade" id="usernameEditionModal" tabindex="-1" role="dialog" aria-labelledby="usernameEditionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title text-center">Edytuj imię</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body px-0 px-4">
                <form method="post" action='index.php?action=editUserData&editedItem=name'>
                    <div class="input-group mb-4 mt-2 js-modal__input--name-edition">
						<input type="text" class="form-control" placeholder="Wpisz nowe imię" name="username">
						<a class="input-group-prepend" data-toggle="popover" data-content="Imię powinno składać się z samych liter (minimum 3 znaki).">
							<span class="input-group-text cursor-pointer rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div class="row justify-content-around border-top py-3">
                        <a href="#" class="col-5 btn btn-primary" data-dismiss="modal">Anuluj</a>
                        <button type="submit" class="col-5 btn btn-primary">Zapisz</button>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loginEditionModal" aria-labelledby="loginEditionModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title text-center">Edytuj login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-0 px-4">
                <form method="post" action="index.php?action=editUserData&editedItem=login">
                    
                    <div class="input-group mb-4 mt-2 js-modal__input--login-edition">
                        <input type="text" class="form-control" placeholder="Podaj nowy login" name="login">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Login powinien składać sie z minimum 3 znaków, może zawierać litery (bez polskich znaków), cyfry oraz znaki _ lub .">
							<span class="input-group-text cursor-pointer rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div class="row justify-content-around border-top py-3">
                        <a href="#" class="col-5 btn btn-primary" data-dismiss="modal">Anuluj</a>
                        <button type="submit" class="col-5 btn btn-primary">Zapisz</button>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="passwordEditionModal" aria-labelledby="passwordEditionModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title text-center">Edytuj hasło</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body px-0 px-4">
                <form method="post" action="index.php?action=editUserData&editedItem=password">
                    <div class="input-group mb-3 mt-2">
                        <input type="password" class="form-control password" id="oldPasword" name ="oldPassword" placeholder="Podaj stare hasło">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Wpisz stare hasło.">
							<span class="input-group-text cursor-pointer rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control password" name="newPassword" placeholder="Podaj nowe hasło">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Hasło powinno składać się od 8 do 20 znaków.">
							<span class="input-group-text cursor-pointer rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control password" name="newPasswordRepeated" placeholder="Powtórz nowe hasło">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Powtórz nowe hasło.">
							<span class="input-group-text cursor-pointer rounded-right">
								<i class="fas fa-info-circle"></i>
							</span>
						</a>
                    </div>
                    <div class="form-check mt-2 mb-3">
						<input class="form-check-input js-checkbox--show-password px-5" type="checkbox" value="" id="showPasswordCheckbox">
						<label class="form-check-label" for="showPasswordCheckbox">
							Pokaż hasło
						</label>
                        
                    </div>
                    <div class="row justify-content-around border-top py-3">
                        <a href="#" class="col-5 btn btn-primary" data-dismiss="modal">Anuluj</a>
                        <button type="submit" class="col-5 btn btn-primary">Zapisz</button>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>