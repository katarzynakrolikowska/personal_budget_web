
    <div class="row container-settings__header text-gray max-width mx-0 py-2 pl-3">
        <div class="col-10" >
            <h3>Kategorie przychodu</h3>
        </div>
        <div class="col-2">
            <div class="dropdown mr-1">
                <i class="fas fa-ellipsis-h dropdown-settings__icon-dots" data-toggle="dropdown"></i>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsIncomeCategoryModal" id="editIncomeCategoryLink">Edytuj</a>
                    <a class="dropdown-item" href="#" id="addIncomeCategoryLink" data-toggle="modal" data-target="#settingsIncomeCategoryModal">Dodaj</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsIncomeCategoryModal" id="deleteIncomeCategoryLink">Usuń</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 ml-1">
        <div class="col-10 content-settings__list">	
            <?=$portal -> getHtmlOfIncomeCategoriesList()?>
        </div>
    </div>
</div>


<div class="modal fade" id="settingsIncomeCategoryModal" tabindex="-1" role="dialog" aria-labelledby="settingsIncomeCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body mx-4">
                
                <form method="post">
                    <div class="input-group mb-3 js-container-select-category">
                        <select class="custom-select" name="selectedOption">
                            <option disabled selected value="0">Wybierz kategorię przychodu</option>
                        <?php
                            echo $htmlOfOptions;
                        ?>
                        </select>
                        <a class="input-group-prepend" data-toggle="popover">
                            <span class="input-group-text cursor-pointer rounded-right">
                                <i class="fas fa-info-circle"></i>
                            </span>
                        </a>
                    </div>
                    
                    <div class="input-group mb-1 js-container-input-category">
                        <input type="text" class="form-control" placeholder="Wpisz nową kategorię"  name="newOption">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Dozwolone są małe i duże litery.">
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
                        <button type="submit" class="btn btn-primary form-settings__btn--submit">Zapisz</button>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>
