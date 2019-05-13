


<ul class="navbar-nav">
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="dropdownSelectPeriod" title="Wybierz okres" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-calendar-alt pl-1"></i><span class="nav-link__name--select-period"> Wybierz okres</span></a>
		
		<div class="dropdown-menu" aria-labelledby="dropdownSelectPeriod">
			<a class="dropdown-item" href="index.php?action=setBalance&period=currentMonth">Bieżący miesiąc</a>
			<a class="dropdown-item" href="index.php?action=setBalance&period=previousMonth">Poprzedni miesiąc</a>
			<a class="dropdown-item" href="index.php?action=setBalance&period=currentYear">Bieżący rok</a>
			<a class="dropdown-item" href="#" data-toggle="modal" data-target="#selectPeriodModal">Niestandardowy</a>
		</div>
	</li>
		
	<li class="nav-item nav-item--logout">
		<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt pl-1"></i> Wyloguj się</a>
	</li>
</ul>