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
         
    <div class="modal fade" id="settingsExpenseModal" tabindex="-1" role="dialog" aria-labelledby="settingsExpenseModal" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-center"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body mx-2">
                    <div id="info"></div>
                    <form method="post">
                        <div class="input-group mb-3" id="settingsPaymentMethodSelect">
                            <select class="custom-select">
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

                        <div class="input-group mb-3" id="settingsExpenseCategorySelect">
                            <select class="custom-select">
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
                        
                        <div class="input-group mb-1 inputOption">
                            <input type="text" class="form-control" id="inputEdition" name="newOption">
                            <a class="input-group-prepend" data-toggle="popover" data-content="Dozwolone są małe i duże litery.">
                                <span class="input-group-text">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </a>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-8 input-group my-3">
                                <button type="submit" class="btn btn-primary max-width mt-4 text-white">Zapisz</button>
                            </div>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>