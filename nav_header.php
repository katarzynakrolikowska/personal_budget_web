<div class="row pl-3 m-0 containerHeaderMenu">
	<div class="col py-3 my-2">
		<header><h2><b><a href="menu.php" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
	</div>
	<div class="col-auto pt-4">
		<a href="settings.html" class="headerLink" id="linkUser"><i class="fas fa-user"></i><span> <?php echo $_SESSION['username'];?></span></a>
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
				<a href="logout_user.php" class="btn btn-primary">Wyloguj się</a>
			</div>
		</div>
	</div>
</div>