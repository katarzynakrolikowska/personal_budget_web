<div>
        <header class="row pl-1 header-site">
            <div class="col py-3 my-2">
                <h2><a href="index.php?action=showMain" class='header-site__main-link'><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></h2>
            </div>
            <div class="col-auto pt-5">
                <a href="index.php?action=showRegistrationForm" class="header-site__link 
                <?=$action === 'showRegistrationForm' ? 'header-site__link--active' : ''?>"><i class="fas fa-clipboard-list"></i><span> Rejestracja</span></a>
            </div>
            <div class="col-auto pt-5 pr-4">
                <a href="index.php?action=showLoginForm" class="header-site__link
                <?=$action === 'showLoginForm' ? 'header-site__link--active' : ''?>"><i class="fas fa-sign-in-alt"></i><span> Logowanie</span></a>
            </div>
        </header>