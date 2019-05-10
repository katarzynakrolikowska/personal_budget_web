<header class="row pl-3 header-site header-site--logged-in">
	<div class="col py-3 my-2">
		<h2><b><a href="index.php?action=showMainForLoginUser" class='header-site__main-link'><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2>
	</div>
	<div class="col-auto pt-4">
		<a href="index.php?action=showSettings&editionContent=userData" class="header-site__link"><i class="fas fa-user"></i> <?=$username ? $username : 'Użytkownik' ?></a>
	</div>
	<div class="col-auto pt-4 pr-4 pr-sm-4">
		<a href="#" class="header-site__link" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Wyloguj się</a>
	</div>
</header>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
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
			
	<h2><a href="index.php?action=showMainForLoginUser" class="navbar__main-link"><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></h2>
	
	<button class="navbar-toggler mr-2 mr-sm-4 collapsed" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		 <span class="navbar-toggler-icon"><i class="fas fa-bars"></i><i class="fas fa-times item-hide"></i></span>
	 </button>

	<div class="collapse navbar-collapse" id="menu">
		<ul class="navbar-nav m-auto">
			<li class="nav-item <?=$action == 'showMainForLoginUser' ? 'active' : ''?>">
				<a class="nav-link" href="index.php?action=showMainForLoginUser"><i class="icon-home"></i> Strona główna</a>
			</li>
			
			<li class="nav-item <?=$action == 'showIncomeAddForm' ? 'active' : ''?>">
				<a class="nav-link" href="index.php?action=showIncomeAddForm"><i class="icon-dollar"></i> Dodaj przychód</a>
			</li>
			
			<li class="nav-item <?=$action == 'showExpenseAddForm' ? 'active' : ''?>">
				<a class="nav-link" href="index.php?action=showExpenseAddForm"><i class="icon-shopping-basket"></i> Dodaj wydatek</a>
			</li>
			
			<li class="nav-item <?=$action == 'showBalanceForSelectedPeriod' ? 'active' : ''?>">
				<a class="nav-link" href="index.php?action=setBalance&period=currentMonth"><i class="icon-chart-bar"></i> Przeglądaj bilans</a>
			</li>
			
			<li class="nav-item <?=$action == 'showSettings' ? 'active' : ''?>">
				<a class="nav-link" href="index.php?action=showSettings&editionContent=userData" ><i class="icon-cog-alt"></i> Ustawienia</a>
			</li>
			<?php 
				if ($action !== 'showBalanceForSelectedPeriod') {
					echo '<li class="nav-item nav-item--logout">
							<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt pl-1"></i> Wyloguj się</a>
						</li>';
				}
			?>
		</ul>
		<?php 
			if ($action === 'showBalanceForSelectedPeriod') {
				require_once('templates/selectPeriodMenu.php');
			}
		?>
	</div>
</nav>

