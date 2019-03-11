

<div class="row pl-3 m-0 containerHeaderMenu">
	<div class="col py-3 my-2">
		<header><h2><b><a href="menu-glowne" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
	</div>
	<div class="col-auto pt-4">
		<a href="zmien-ustawienia" class="headerLink" id="linkUser"><i class="fas fa-user"></i><span> <?=$username ? $username : 'Użytkownik' ?></span></a>
	</div>
	<div class="col-auto pt-4 pr-4 pr-sm-4">
		<a href="#" class="headerLink" id="linkLogOut" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i><span> Wyloguj się</span></a>
	</div>
</div>
<div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="logoutModalLabel">Czy na pewno chcesz się wylogować?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-footer">
				<a href="#" class="btn btn-primary" data-dismiss="modal">Anuluj</a>
				<a href="index.php?action=logout" class="btn btn-primary">Wyloguj się</a>
			</div>
		</div>
	</div>
</div>

<nav class="navbar navbar-expand-lg justify-content-between sticky-top shadow">
			
	<header><h2><b><a href="menu-glowne" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
	
	<button class="navbar-toggler mr-2 mr-sm-4 collapsed" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		 <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
	 </button>

	<div class="collapse navbar-collapse " id="menu">
		<ul class="navbar-nav m-auto ">
			<li class="nav-item <?=isset($_SESSION['menu']) ? 'active' : ''?>" >
				<a class="nav-link" id="first" href="menu-glowne"><i class="icon-home"></i> Strona główna</a>
			</li>
			
			<li class="nav-item <?=isset($_SESSION['income']) ? 'active' : ''?>">
				<a class="nav-link" href="dodaj-przychod"><i class="icon-dollar"></i> Dodaj przychód</a>
			</li>
			
			<li class="nav-item <?=isset($_SESSION['expense']) ? 'active' : ''?>">
				<a class="nav-link " href="dodaj-wydatek"><i class="icon-shopping-basket"></i> Dodaj wydatek</a>
			</li>
			
			<li class="nav-item <?=isset($_SESSION['balance']) ? 'active' : ''?>" id="itemBalance">
				<a class="nav-link " href="przegladaj-bilans"><i class="icon-chart-bar"></i> Przeglądaj bilans</a>
			</li>
			
			<li class="nav-item dropdown <?=isset($_SESSION['settings']) ? 'active' : ''?>">
				<a class="nav-link " href="zmien-ustawienia" ><i class="icon-cog-alt"></i> Ustawienia</a>
				
			</li>
			
			<li class="nav-item" id="logOutItemNav">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Wyloguj się</a>
			</li>
		</ul>
		<?php 
			if(isset($_SESSION['balance'])) {
				require_once('nav_balance.php');
			}
		?>
	</div>
</nav>
