        
        
        
        
        <div class="row container-settings__header text-gray max-width mx-0 py-2 pl-3">
            <div class="col-10" >
                <h3>Metody płatności</h3>
            </div>
            <div class="col-2">
                <div class="dropdown mr-1">
                    <i class="fas fa-ellipsis-h dropdown-settings__icon-dots" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseOptionModal" id="editMethodLink">Edytuj</a>
                        <a class="dropdown-item" href="#" id="addMethodLink" data-toggle="modal" data-target="#settingsExpenseOptionModal">Dodaj</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseOptionModal" id="deleteMethodLink">Usuń</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-4 ml-1">
            <div class="col-10 content-settings__list">	
                <?=$portal -> getHtmlOfPaymentMethodsList()?>
            </div>
        </div>

        <div class="row container-settings__header text-gray max-width mx-0 py-2 pl-3">
            <div class="col-10" >
                <h3>Kategorie wydatku</h3>
            </div>
            <div class="col-2">
                <div class="dropdown mr-1">
                    <i class="fas fa-ellipsis-h dropdown-settings__icon-dots" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseOptionModal" id="limitExpenseCategoryLink">Ustaw limit</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseOptionModal" id="editExpenseCategoryLink">Edytuj</a>
                        <a class="dropdown-item" href="#" id="addExpenseCategoryLink" data-toggle="modal" data-target="#settingsExpenseOptionModal">Dodaj</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsExpenseOptionModal" id="deleteExpenseCategoryLink">Usuń</a>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-3 mb-4 ml-1">
            <div class="col-10 content-settings__list">	
                <?=$portal -> getHtmlOfExpenseCategoriesList()?>
            </div>
        </div>
    
    </div>
         
    <div class="modal fade mr-0" id="settingsExpenseOptionModal" tabindex="-1" role="dialog" aria-labelledby="settingsExpenseOptionModal" aria-hidden="true">
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
                        <div class="input-group mb-3 js-container-select-payment">
                            <select class="custom-select">
                                <option disabled selected value="0">Wybierz metodę płatności</option>
                            <?php
                                echo $htmlOfPaymentMethods;
                            ?>
                            </select>
                            <a class="input-group-prepend" data-toggle="popover">
                                <span class="input-group-text cursor-pointer rounded-right">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </a>
                        </div>

                        <div class="input-group mb-3 js-container-select-category">
                            <select class="custom-select">
                                <option disabled selected value="0">Wybierz kategorię wydatku</option>
                            <?php
                                echo $htmlOfExpenseCategories;
                            ?>
                            </select>
                            <a class="input-group-prepend" data-toggle="popover">
                                <span class="input-group-text cursor-pointer rounded-right">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </a>
                        </div>
                        
                        <div class="input-group mb-3 js-container-input-option">
                            <input type="text" class="form-control" name="newOption">
                            <a class="input-group-prepend" data-toggle="popover" data-content="Dozwolone są małe i duże litery.">
                                <span class="input-group-text cursor-pointer rounded-right">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </a>
                        </div>
                        <div class="input-group mb-3 js-container-input-limit">
                            <input type="number" class="form-control" step="0.01" lang="en" placeholder="Wpisz kwotę limitu" name="limitAmount">
                            <a class="input-group-prepend" data-toggle="popover" data-content="Wpisz liczbę większą od zera.">
                                <span class="input-group-text cursor-pointer rounded-right">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </a>
                        </div>
                        <div class='js-container-info-option-used'>
                            <div class="js-info-option-used"></div>
                        </div>                 
                        <div class="modal-footer mt-4">
                            <a href="#" class="btn btn-primary" data-dismiss="modal">Anuluj</a>
                            <button type="submit" class="btn form-settings__btn--submit btn-primary">Zapisz</button>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>