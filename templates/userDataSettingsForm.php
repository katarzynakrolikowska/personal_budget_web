<div id="containerUserData">
    <div class="row headerMyData mx-0 py-2 pl-3">
        <div class="col" >
            <header>Ustawienia danych</header>
        </div>
    </div>
    <div class="row mx-0 pr-4 pl-3">
        <div class="col-12 ">
            
            <form method="post" action="index.php?action=editUserData&editedItem=name">
                <div class="row mt-5 editForm">
                    <label class="col-12 col-sm-8 inputLabel" for="inputEditName">Imię</label>
                    <div class="col-12 col-sm-8 col-md-10 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="inputEditName" placeholder="Podaj nowe imię" name="username" value="<?php
                        if (isset($_SESSION['username'])) {
                            echo $_SESSION['username'];
                            unset($_SESSION['username']);
                        } else {
                            echo $portal -> loggedInUser -> getName();
                        }?>">
                    </div>
                    
                    <div class="col-12 col-sm-8 col-md-10">
                        <?php
                            if (isset($messageError) && isset($_SESSION['errorUsername'])) {
                                echo '<h6 class="error mt-2">'.$messageError.'</h6>';
                                unset($_SESSION['errorUsername']);
                            }
                        ?>
                        <div class="row justify-content-center">
                        
                            <div class="col-8 col-sm-6 col-lg-5 input-group my-3">
                                <button type="submit" class="btn text-white btnChangeUserPassword btnSave"><i class="fas fa-plus"></i> Zapisz</button>
                            </div>
                        </div>
                    </div>  
                </div>
            </form>
                
                    
            <form method="post" action="index.php?action=editUserData&editedItem=login">
                <div class="row mt-4 editForm">
                    <label class="col-12 col-sm-8 inputLabel" for="inputEditLogin">Login</label>
                    <div class="col-12 col-sm-8 col-md-10 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                        </div>
                        <input type="text" class="form-control" id="inputEditLogin" placeholder="Podaj nowy login" name="login" value="<?php
                        if (isset($_SESSION['login'])) {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        } else {
                            echo $portal -> loggedInUser -> getLogin();
                        }?>">
                    </div>
                    <div class="col-12 col-sm-8 col-md-10">
                        <?php
                            if (isset($messageError) && isset($_SESSION['errorLogin'])) {
                                echo '<h6 class="error mt-2">'.$messageError.'</h6>';
                                unset($_SESSION['errorLogin']);
                            }
                        ?>
                    
                        <div class="row justify-content-center">
                            <div class="col-8 col-sm-6 col-lg-5 input-group my-3">
                                <button type="submit" class="btn text-white btnChangeUserPassword btnSave"><i class="fas fa-plus"></i> Zapisz</button>
                            </div>
                        </div>
                    </div>  
                </div>
            </form>
            
            <form method="post" action="index.php?action=editUserData&editedItem=password">
                <div class="row mt-4 editForm">
                   
                    <label class="col-12 col-sm-8 inputLabel" for="oldPassword">Hasło</label>
                    
                    <div class="col-12 col-sm-8 col-md-10 input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control inputEditPassword password 
                        " id="oldPasword" name ="oldPassword" placeholder="Podaj stare hasło">
                    </div>
                    <div class="col-12 col-sm-8 col-md-10 input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control inputEditPassword password" name="newPassword" placeholder="Podaj nowe hasło">
                    </div>
                    <div class="col-12 col-sm-8 col-md-10 input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control inputEditPassword password" name="newPasswordRepeated" placeholder="Powtórz nowe hasło">
                        <?php
                            if (isset($messageError) && isset($_SESSION['errorOldPassword'])) {
                                echo '<div class="col-12"><h6 class="error mt-2">'.$messageError.'</h6></div>';
                                unset($_SESSION['errorOldPassword']);
                            }
                        ?>
                    </div>
                    
                    <div class="form-check mt-2 ml-3">
						<input class="form-check-input showPasswordCheckbox" type="checkbox" value="" id="showPasswordCheckbox">
						<label class="form-check-label" for="showPasswordCheckbox">
							Pokaż hasło
						</label>
                        
                    </div>
                    
                    <div class="col-12 col-sm-8 col-md-10">
                        
                        <div class="row justify-content-center">
                            <div class="col-8 col-sm-6 col-lg-5 input-group my-3">
                                <button type="submit" class="btn text-white btnChangeUserPassword btnSave"><i class="fas fa-plus"></i> Zapisz</button>
                            </div>
                        </div>
                    </div>  
                </div>
            </form>
                
            
        </div>
    </div>
    
    
</div>