<! DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>Przeglądaj bilans</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=latin-ext" rel="stylesheet">
	
	

</head>

<body>
	<div class="container-fluid p-0" id="containerBalance" >
		<div class="row pl-3 m-0 containerHeaderMenu">
			<div class="col py-3 my-2">
				<header><h2><b><a href="menu.html" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
			</div>
			<div class="col-auto pt-4">
				<a href="settings.html" class="headerLink" id="linkUser"><i class="fas fa-user"></i><span> Użytkownik</span></a>
			</div>
			<div class="col-auto pt-4 pr-4 pr-sm-4">
				<a href="#" class="headerLink" id="linkLogOut" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i><span> Wyloguj się</span></a>
			</div>
		</div>
		
		<div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="logoutModalLabel">Czy na pewno chcesz się wylogować?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-footer">
						<a href="#" class="btn btn-primary" data-dismiss="modal">Anuluj</a>
						<a href="startPage.html" class="btn btn-primary">Wyloguj się</a>
					</div>
				</div>
			</div>
		</div>
		
		<nav class="navbar navbar-expand-lg justify-content-between sticky-top shadow">
			
			<header><h2><b><a href="menu.html" ><i class="fas fa-hand-holding-usd"></i> fullWallet.pl</a></b></h2></header>
			
			<button class="navbar-toggler mr-2 mr-sm-4 collapsed" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				 <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
			 </button>

			<div class="collapse navbar-collapse " id="menu">
				<ul class="navbar-nav m-auto ">
				    <li class="nav-item mainSiteItem">
						<a class="nav-link" href="menu.html"><i class="icon-home"></i> Strona główna</a>
				    </li>
					
				    <li class="nav-item">
						<a class="nav-link" href="income.html"><i class="icon-dollar"></i> Dodaj przychód</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="expense.html"><i class="icon-shopping-basket"></i> Dodaj wydatek</a>
					</li>
					
					<li class="nav-item active">
						<a class="nav-link" href="balance.html"><i class="icon-chart-bar"></i> Przeglądaj bilans<span class="sr-only">(current)</span></a>
					</li>
					
					<li class="nav-item dropdown">
						<a class="nav-link " href="settings.html" ><i class="icon-cog-alt"></i> Ustawienia</a>	
						
					</li>
					
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item dropdown periodNavItem">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPeriod" title="Wybierz okres" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-calendar-alt pl-2"></i><span> Wybierz okres</span></a>
						
						<div class="dropdown-menu" aria-labelledby="navbarDropdownPeriod">
							<a class="dropdown-item" href="#" id="optionCurrentMonth">Bieżący miesiąc</a>
							<a class="dropdown-item" href="#" id="optionPreviousMonth">Poprzedni miesiąc</a>
							<a class="dropdown-item" href="#" id="optionCurrentYear">Bieżący rok</a>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#selectPeriodModal" id="optionSelectPeriod">Niestandardowy</a>
						</div>
					</li>
						
					<li class="nav-item" id="logOutItemNav">
						<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Wyloguj się</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<div class="modal fade " id="selectPeriodModal" tabindex="-1" role="dialog" aria-labelledby="selectPeriodModalLabel" aria-hidden="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="selectPeriodModalLabel">Wybierz zakres</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group row pr-5">
								<label class="col-form-label col-4 text-center" for="dateStart">Od dnia</label>
								<input type="date" class="form-control col-8" id="dateStart" required>
							</div>
							
							<div class="form-group row pr-5">	
								<label class="col-form-label col-4 text-center" for="dateEnd">Do dnia</label>
								<input type="date" class="form-control col-8" id="dateEnd" placeholder="Data końcowa" required>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-primary" data-dismiss="modal">Anuluj</a>
						<a href="#" class="btn btn-primary" id="btnOK" data-dismiss="modal">OK</a>
					</div>
					
				</div>
			</div>
		</div>
			
		
		<div class="row justify-content-center pt-5 mx-0">
			<div class="col-auto headerOption">
				<header><h3>Twój bilans za 
					<span> bieżący miesiąc</span>
				</h3></header>
			</div>
		</div>
		<div class="row mx-0 my-5 rowTables justify-content-around">
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
				<header><h4><b>Przychody</b></h4></header>
				<table class="table" id="tableIncome">
					<thead>
						<tr>
							<th scope="col">Kategoria</th>
							<th scope="col" class="text-center">Data</th>
							<th scope="col" class="text-right">Kwota</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
			
			<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
				<header><h4><b>Wydatki</b></h4></header>
				<table class="table" id="tableExpense">
					<thead>
						<tr>
							<th scope="col">Kategoria</th>
							<th scope="col" class="text-center">Data</th>
							<th scope="col" class="text-right">Kwota</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="row justify-content-center mr-0">
			<div class="col-12 col-md-10 col-lg-8 " id="resultBg">
				<div class="resultText shadow">
					TWÓJ BILANS: <span id="resultBalance"></span> PLN
				</div>
				<div class="col text-center my-4" id="resultComment"></div>
			</div>
		</div>
		
			
		
		<div class="row mr-0 mb-5">
			<div class="col-12 text-center">
				<header><h2><b>Spójrz jeszcze raz, na co wydałeś w wybranym okresie</b></h2></header>	
			</div>
		</div>
		
		<div class="row justify-content-center rowChart mr-0">
			<div class="col col-lg-10 " id="chart">
				<div id="chartContainer"></div>
			</div>
		</div>
		
		<div class="row mx-0">
			<footer class="col footerMenu text-center  py-2">
				<p class="text-muted">2018 &copy; fullWallet.pl</p>	
			</footer>	
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script type="text/javascript" src="personalBudget.js"></script>
	
</body>


</html>