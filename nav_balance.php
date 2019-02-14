<ul class="navbar-nav">
	<li class="nav-item dropdown periodNavItem">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPeriod" title="Wybierz okres" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-calendar-alt pl-2"></i><span> Wybierz okres</span></a>
		
		<div class="dropdown-menu" aria-labelledby="navbarDropdownPeriod">
			<a class="dropdown-item" href="current_month_balance.php" id="optionCurrentMonth">Bieżący miesiąc</a>
			<a class="dropdown-item" href="previous_month_balance.php" id="optionPreviousMonth">Poprzedni miesiąc</a>
			<a class="dropdown-item" href="current_year_balance.php" id="optionCurrentYear">Bieżący rok</a>
			<a class="dropdown-item" href="#" data-toggle="modal" data-target="#selectPeriodModal" id="optionSelectPeriod">Niestandardowy</a>
		</div>
	</li>
		
	<li class="nav-item" id="logOutItemNav">
		<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Wyloguj się</a>
	</li>
</ul>