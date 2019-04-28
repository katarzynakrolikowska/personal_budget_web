    <div id="containerMyIncomes">
        <div class="row headerMyIncomes mx-0 py-2 pl-3">
            <div class="col-10" >
                <header>Kategorie przychodu</header>
            </div>
            <div class="col-2">
                <div class="dropdown mr-1">
                    <i class="fas fa-ellipsis-h menuDots" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsIncomeModal" id="editIncomeLink">Edytuj</a>
                        <a class="dropdown-item" href="#" id="addIncomeLink" data-toggle="modal" data-target="#settingsIncomeModal">Dodaj</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsIncomeModal" id="deleteIncomeLink">Usuń</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 ml-1">
            <div class="col-10 settingsFormOptions">	
                <?=$portal -> getHtmlOfIncomeCategoriesList()?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="settingsIncomeModal" tabindex="-1" role="dialog" aria-labelledby="settingsIncomeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title text-center"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body mx-4">
                
                <form method="post">
                    <div class="input-group mb-3" id="settingsIncomeSelectDiv">
                        <select class="custom-select" name="selectedOption">
                            <option disabled selected value="0">Wybierz kategorię przychodu</option>
                        <?php
                            echo $htmlOfOptions;
                        ?>
                        </select>
                        <a class="input-group-prepend" data-toggle="popover">
                            <span class="input-group-text">
                                <i class="fas fa-info-circle"></i>
                            </span>
                        </a>
                    </div>
                    
                    <div class="input-group mb-1 inputOption">
                        <input type="text" class="form-control" id="inputEdition" placeholder="Wpisz nową kategorię"  name="newOption">
                        <a class="input-group-prepend" data-toggle="popover" data-content="Dozwolone są małe i duże litery.">
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
