<div id="containerMain">
    <div class="row pl-1 containerHeader">
        <div class="col py-3 my-2">
            <header><h2><b><a href="index.php?action=showMain" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
        </div>
        <div class="col-auto pt-5">
            <a href="index.php?action=showRegistrationForm" class="headerLink 
            <?=$action === 'showRegistrationForm' ? 'activeLink' : ''?>" id="linkRegister"><i class="fas fa-clipboard-list"></i><span> Rejestracja</span></a>
        </div>
        <div class="col-auto pt-5 pr-4">
            <a href="index.php?action=showLoginForm" class="headerLink
            <?=$action === 'showLoginForm' ? 'activeLink' : ''?>" id="linkLogin"><i class="fas fa-sign-in-alt"></i><span> Logowanie</span></a>
        </div>
    </div>