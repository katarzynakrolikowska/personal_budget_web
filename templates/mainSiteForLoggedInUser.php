		<article class="row mx-0 mb-5 pb-5 justify-content-center">
			<div class="col-12 col-md-auto px-0 mt-5 mt-sm-0">
				<!--Photo by rawpixel.com from Pexels-->
				<img src="img/pexels-photo-908288.jpeg" class="img--position max-width">
				<div class="main-site__bg-text bg-red">

				</div>
				<div class="main-site__bg-text px-4 pt-2 text-white">
					<div id="carouselMainSite" class="carousel slide max-height" data-ride="carousel">
						<div class="carousel-inner max-height">
							<div class="carousel-item active">
								<h1 class="carousel__header font-weight-bold">Dodaj przychody i wydatki.</h1>
								<div class="carousel__content-text">Nastapiła zmiana środków na Twoim koncie? Nie czekaj, zaktualizuj stan swoich finansów.</div>
								<div class="row justify-content-between">
									<a class="col-auto carousel__button" href="index.php?action=showIncomeAddForm" role="button">
										Dodaj przychód
									</a>
									<a class="col-auto carousel__button" href="index.php?action=showExpenseAddForm" role="button">
										Dodaj wydatek
									</a>
								</div>
							</div>
							<div class="carousel-item">
								<h1 class="carousel__header font-weight-bold">Monitoruj finanse.</h1>
								<div class="carousel__content-text">Wybierz interesujący Cię okres czasu <span class="nowrap">i sprawdź</span> czy jesteś na plusie, czy na minusie?</div>
								<div class="row">
									<a class="col-auto carousel__button" href="index.php?action=setBalance&period=currntMonth" role="button">
										Zobacz bilans
									</a>
								</div>
							</div>
							<div class="carousel-item">
								<h1 class="carousel__header font-weight-bold">Personalizuj aplikację.</h1>
								<div class="carousel__content-text">Dowolnie edytuj, dodawaj i ususwaj kategorie bądź metody płatności według własnych preferencji.</div>
								<div class="row">
									<a class="col-auto carousel__button" href="index.php?action=showSettings&editionContent=income" role="button">
										Pokaż ustawienia
									</a>
								</div>
							</div>
							<ol class="carousel-indicators">
								<li data-target="#carouselMainSite" data-slide-to="0" class="active"></li>
								<li data-target="#carouselMainSite" data-slide-to="1"></li>
								<li data-target="#carouselMainSite" data-slide-to="2"></li>
							</ol>
						</div>
						
					</div>
				</div>
				
			</div>
		</article>
