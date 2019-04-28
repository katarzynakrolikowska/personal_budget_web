        <div id="containerMyExpenses">
            <div class="row headerMyExpenses mx-0 py-2 pl-3">
                <div class="col-10" >
                    <header>Metody płatności</header>
                </div>
                <div class="col-2">
                    <div class="dropdown mr-1">
                        <i class="fas fa-ellipsis-h menuDots" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseModal" id="editMethodLink">Edytuj</a>
                            <a class="dropdown-item" href="#" id="addMethodLink" data-toggle="modal" data-target="#settingsExpenseModal">Dodaj</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseModal" id="deleteMethodLink">Usuń</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-4 ml-1">
                <div class="col-10 settingsFormOptions">	
                    <?=$portal -> getHtmlOfPaymentMethodsList()?>
                </div>
            </div>

            <div class="row headerMyExpenses mx-0 py-2 pl-3">
                <div class="col-10" >
                    <header>Kategorie wydatku</header>
                </div>
                <div class="col-2">
                    <div class="dropdown mr-1">
                        <i class="fas fa-ellipsis-h menuDots" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseModal" id="limitExpenseCategoryLink">Ustaw limit</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseModal" id="editExpenseCategoryLink">Edytuj</a>
                            <a class="dropdown-item" href="#" id="addExpenseCategoryLink" data-toggle="modal" data-target="#settingsExpenseModal">Dodaj</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseModal" id="deleteExpenseCategoryLink">Usuń</a>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row mt-3 mb-4 ml-1">
                <div class="col-10 settingsFormOptions">	
                    <?=$portal -> getHtmlOfExpenseCategoriesList()?>
                </div>
            </div>
        </div>
    </div>
         
    <div class="modal fade mr-0" id="settingsExpenseModal" tabindex="-1" role="dialog" aria-labelledby="settingsExpenseModal" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-center"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body mx-2">
                   
                    <form method="post">
                        <div class="input-group mb-3" id="settingsPaymentMethodSelectDiv">
                            <select class="custom-select">
                                <option disabled selected value="0">Wybierz metodę płatności</option>
                            <?php
                                echo $htmlOfPaymentMethods;
                            ?>
                            </select>
                            <a class="input-group-prepend" data-toggle="popover">
                                <span class="input-group-text">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </a>
                        </div>

                        <div class="input-group mb-3" id="settingsExpenseCategorySelectDiv">
                            <select class="custom-select">
                                <option disabled selected value="0">Wybierz kategorię wydatku</option>
                            <?php
                                echo $htmlOfExpenseCategories;
                            ?>
                            </select>
                            <a class="input-group-prepend" data-toggle="popover">
                                <span class="input-group-text">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </a>
                        </div>
                        
                        <div class="input-group mb-3 inputOption">
                            <input type="text" class="form-control" id="inputEdition" name="newOption">
                            <a class="input-group-prepend" data-toggle="popover" data-content="Dozwolone są małe i duże litery.">
                                <span class="input-group-text">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </a>
                        </div>
                        <div class="input-group mb-3 inputLimit">
                            <input type="number" class="form-control" step="0.01" lang="en" placeholder="Wpisz kwotę limitu" name="limitAmount">
                            <a class="input-group-prepend" data-toggle="popover" data-content="Wpisz liczbę większą od zera.">
                                <span class="input-group-text">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </a>
                        </div>
                        <div class='container-info'>
                            <div class="info"></div>
                        </div>                  
                        <div class="modal-footer mt-4">
                            <a href="#" class="btn btn-primary" data-dismiss="modal">Anuluj</a>
                            <button type="submit" class="btn btnSave btn-primary text-white">Zapisz</button>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>