<?php
session_start();
if(!isset($_SESSION['loggedID'])) {
	header('Location:login.php');
	exit();
}
?>
<! DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>Ustawienia</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=latin-ext" rel="stylesheet">
	
	

</head>

<body>
	<div class="container-fluid p-0" id="containerSettings" >
		
		<?php
			$_SESSION['settings'] = '';
			require_once('nav_header.php');
			unset($_SESSION['settings']);
		?>
		<div class="row justify-content-sm-center my-5 mx-0 pt-5 " id="rowMyAccount">
		
			<div class="col col-md-3 col-xl-2 px-0 colSettingsNav">
				<ul class="nav flex-column settingsNav">
					<li class="nav-item">
						<a class="nav-link active navLinkData" href="#"><i class="fas fa-user-edit"></i><span class="navTitleText"> Moje dane</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link navLinkIncome" href="#"><i class="far fa-money-bill-alt"></i><i class="fas fa-pen iconPenIncome"></i><span class="navTitleText"> Moje przychody</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link navLinkExpense" href="#"><i class="fas fa-shopping-basket"></i><i class="fas fa-pen iconPenExpense"></i> <span class="navTitleText">Moje wydatki</span></a>
					</li>
				</ul>
			</div>
			<div class="col-12 col-md-7 col-xl-6 px-0 colMyAccount">
				<div id="containerMyData">
					<div class="row headerMyData mx-0 py-2">
						<div class="col" >
							<header>Dane osobiste</header>
						</div>
					</div>
					<div class="row mx-0 pr-4">
						<div class="col-12 ">
							
							<div class="row dataUser mt-4">
								<div class="col-11 " id="headerName">Imię: <span></span></div>
								
								<div class="col-1">
									<a href="#" id="editNameLink" title="Edytuj"><i class="fas fa-edit"></i></a>
								</div>
							</div>
							
							<form class="hideItem">
								<div class=" row mt-2 " >
									<div class="col-12 col-sm-8 input-group">
										<input type="text" class="form-control inputEditName" placeholder="Podaj nowe imię">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
									</div>
									<div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
										<button type="submit" class="btn text-white btnChangeUserName btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
									</div>
								</div>
							</form>
								
								
							<div class="row dataUser mt-4">
								<div class="col-11 " id="headerEmail">Email: <span></span></div>
								
								<div class="col-1 pr-2">
									<a href="#" id="editEmailLink" title="Edytuj"><i class="fas fa-edit"></i></a>
								</div>
							</div>
							<form class="hideItem">
								<div class=" row mt-2" >
									<div class="col-12 col-sm-8 input-group">
										<input type="email" class="form-control inputEditEmail"placeholder="Podaj nowy adres email">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-envelope"></i></span>
										</div>
									</div>
									<div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
										<button type="submit" class="btn text-white btnChangeUserEmail btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
									</div>
								</div>
							</form>
								
							<div class="row dataUser my-4">
								<div class="col-11" id="headerPassword">Hasło: <span></span></div>
								
								<div class="col-1">
									<a href="#" id="editPasswordLink" title="Edytuj"><i class="fas fa-edit"></i></a>
								</div>
							</div>
							<form class="hideItem">
								<div class="row mt-2" >
									<div class="col-12 col-sm-8 input-group mb-2">
										<input type="password" class="form-control inputEditPassword" id="oldPassword" placeholder="Podaj stare hasło">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-lock"></i></span>
										</div>
									</div>
									<div class="col-12 col-sm-8 input-group mb-2">
										<input type="password" class="form-control inputEditPassword" id="newPassword" placeholder="Podaj nowe hasło">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-lock"></i></span>
										</div>
									</div>
									<div class="col-12 col-sm-8 input-group">
										<input type="password" class="form-control inputEditPassword" id="repeatNewPassword" placeholder="Powtórz nowe hasło">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-lock"></i></span>
										</div>
									</div>
									<div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0 ">
										<button type="submit" class="btn text-white btnChangeUserPassword btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz </button>
									</div>
								</div>
							</form>
								
							
						</div>
					</div>
					
					
				</div>
				
				<div id="containerMyIncomes" class="hideItem">
					<div class="row headerMyIncomes mx-0 py-2">
						<div class="col" >
							<header>Ustawienia przychodów</header>
						</div>
					</div>
					
					<div class="row mx-0 pr-4 mb-5">
						<div class="col-12 ">
							
							<div class="row incomeUser mt-5 ">
							
								<label for="settingsLastIncomeSelect" class="col-sm-2 col-md-3 col-lg-2">Ostatnie przychody</label>
								<div class="col-10 col-sm-8 col-md-7 col-lg-8">	
									<select class="custom-select" id="settingsLastIncomeSelect">
										<option value="1">data przychód</option>
										<option value="2">data przychód</option>
										<option value="3">data przychód</option>
										<option value="4">data przychód</option>
									</select>
								</div>
								<div class="col-1 pl-1 pl-sm-3">
									<a href="#" id="editLastIncomeLink" title="Edytuj"><i class="fas fa-edit"></i></a>
								</div>
								<div class="col-1">
									<a href="#" id="deleteLastIncomeLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
								</div>
							</div>
							
							<form class="row incomeUser mt-3 hideItem" id="editDataIncome">
							
								<div class="col-12 col-sm-8 mb-2 input-group">
									<input type="number" class="form-control" placeholder="Podaj nową kwotę">
									<div class="input-group-prepend ">
									<span class="input-group-text " id="amountIncome"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
								
										
										
								<div class="col-12 col-sm-8 mb-2 input-group ">	
									<input type="date" class="form-control" id="date" placeholder="Data">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
								
					
								<div class="col-12 col-sm-8 mb-2 input-group ">
									<select class="custom-select setIncomeCategories" id="category">
									</select>
									<div class="input-group-prepend ">
										<span class="input-group-text " id="categoriesIncome"><i class="fas fa-pen-alt "></i></span>
									</div>
								</div>
								
								<div class=" col-12 col-sm-8 mb-2 input-group">
									<input type="text" class="form-control" placeholder="Komentarz (opcjonalnie)">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
								<div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
									<button type="submit" class="btn text-white btnChangeIncome btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
								</div>
								
								
							</form>
							
							<div class="row incomeUser mt-4 mb-3">	
								<label for="settingsIncomeCategorySelect" class="col-sm-2 col-md-3 col-lg-2">Kategorie</label>
								<div class="col-10 col-sm-8 col-md-7 col-lg-8">	
									<select class="custom-select setIncomeCategories" id="settingsIncomeCategorySelect">
										
									</select>
								</div>
								
								<div class="col-1 pl-1 pl-sm-3">
									<a href="#" id="addCategoryIncomeLink" title="Dodaj"><i class="fas fa-plus"></i></a>
								</div>
								<div class="col-1">
									<a href="#" id="deleteCategoryIncomeLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
								</div>
							</div>
							<form class="row incomeUser hideItem" id="addCategoryIncome">
								<div class=" col-12 col-sm-8 mb-2 input-group">
									<input type="text" class="form-control" placeholder="Podaj nową kategorię">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
								<div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
									<button type="submit" class="btn text-white btnAddCategoryIncome btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
								</div>
							</form>
							
						</div>
					</div>
				</div>
				
				<div id="containerMyExpenses" class="hideItem">
					<div class="row headerMyExpenses mx-0 py-2">
						<div class="col" >
							<header>Ustawienia wydatków</header>
						</div>
					</div>
					
					<div class="row mx-0 pr-4 mb-5">
						<div class="col-12 ">
							
							<div class="row expenseUser mt-5">
							
								<label for="settingsLastExpenseSelect" class="col-sm-2 col-md-3 col-lg-2">Ostatnie wydatki</label>
								<div class="col-10 col-sm-8 col-md-7 col-lg-8">	
									<select class="custom-select" id="settingsLastExpenseSelect">
										<option value="1">data wydatek</option>
										<option value="2">data wydatek</option>
										<option value="3">data wydatek</option>
										<option value="4">data wydatek</option>
									</select>
								</div>
								<div class="col-1 pl-1 pl-sm-3">
									<a href="#" id="editLastExpenseLink" title="Edytuj"><i class="fas fa-edit"></i></a>
								</div>
								<div class="col-1">
									<a href="#" id="deleteLastExpenseLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
								</div>
							</div>
							
							<form class="row expenseUser mt-3 hideItem" id="editDataExpense">
							
								<div class="col-12 col-sm-8 mb-2 input-group">
									<input type="number" class="form-control" placeholder="Podaj nową kwotę">
									<div class="input-group-prepend ">
									<span class="input-group-text " id="amountExpense"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
								
										
										
								<div class="col-12 col-sm-8 mb-2 input-group ">	
									<input type="date" class="form-control" id="date" placeholder="Data">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
								
								
								<div class="col-12 col-sm-8 mb-2 input-group">	
									<select class="custom-select setPaymentMethods" id="settingsExpensePaymentSelect">
										
									</select>
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
					
								<div class="col-12 col-sm-8 mb-2 input-group ">
									<select class="custom-select setExpenseCategories" id="category">
										
									</select>
									<div class="input-group-prepend ">
										<span class="input-group-text " id="categoriesExpense"><i class="fas fa-pen-alt "></i></span>
									</div>
								</div>
								

								
								<div class=" col-12 col-sm-8 mb-2 input-group">
									<input type="text" class="form-control" placeholder="Komentarz (opcjonalnie)">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
								<div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
									<button type="submit" class="btn text-white btnChangeExpense btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
								</div>
								
								
							</form>
							
							<div class="row expenseUser mt-4 mb-3 mb-sm-0">	
								<label for="settingsExpensePaymentSelect" class="col-sm-2 col-md-3 col-lg-2">Metody płatności</label>
								<div class="col-10 col-sm-8 col-md-7 col-lg-8">	
									<select class="custom-select setPaymentMethods" id="settingsExpensePaymentSelect">
										
									</select>
								</div>
								
								<div class="col-1 pl-1 pl-sm-3">
									<a href="#" id="addPaymentExpenseLink" title="Dodaj"><i class="fas fa-plus"></i></a>
								</div>
								<div class="col-1">
									<a href="#" id="deletePaymentExpenseLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
								</div>
							</div>
							
							<form class="row expenseUser hideItem" id="addPaymentExpense">
								<div class=" col-12 col-sm-8 mb-2 input-group">
									<input type="text" class="form-control" placeholder="Podaj nową metodę płatności">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
								<div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
									<button type="submit" class="btn text-white btnAddPaymentExpense btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
								</div>
							</form>
							
							
							<div class="row expenseUser mt-4 mb-3">	
								<label for="settingsExpenseCategorySelect" class="col-sm-2 col-md-3 col-lg-2">Kategorie</label>
								<div class="col-10 col-sm-8 col-md-7 col-lg-8">	
									<select class="custom-select setExpenseCategories" id="settingsIExpenseCategorySelect">
										
									</select>
								</div>
								
								<div class="col-1 pl-1 pl-sm-3">
									<a href="#" id="addCategoryExpenseLink" title="Dodaj"><i class="fas fa-plus"></i></a>
								</div>
								<div class="col-1">
									<a href="#" id="deleteCategoryExpenseLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
								</div>
							</div>
							
							<form class="row expenseUser hideItem" id="addCategoryExpense">
								<div class=" col-12 col-sm-8 mb-2 input-group">
									<input type="text" class="form-control" placeholder="Podaj nową kategorię">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
									</div>
								</div>
								<div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
									<button type="submit" class="btn text-white btnAddCategoryExpense btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
								</div>
							</form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row mx-0 mt-5">
			<footer class="col footerMenu  text-center py-2">
				<p class="text-muted">2018 &copy; fullWallet.pl</p>	
			</footer>	
		</div>
		
		<div class="modal fade " id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModal" aria-hidden="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header ">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body m-auto">
						<p></p>
					</div>
					
					<div class="modal-footer">
						<a href="#" class="btn btn-primary" id="buttonOK" data-dismiss="modal">OK</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script type="text/javascript" src="personalBudget.js"></script>
</body>


</html>