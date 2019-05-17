<div class="row pb-sm-5 justify-content-center js-container--add-income p-0 mx-0">
    
    <div class="col-12 col-sm-10 col-md-8 col-lg-6 p-0 js-col--add-data">
        <form class="form--add-data js-form--add-data pt-5" method="post" action="index.php?action=addIncome" >
            <h3 class="text-gray form-add--width mx-auto">Wprowadź przychód</h3>
            <div class="js-message-error text-center text-red"></div>
            
            <div class="input-group my-4 mx-auto form-add--width
            <?php
                if (isset($_SESSION['errorAmount'])) {
                    echo 'border-red';
                    unset($_SESSION['errorAmount']);
                }
            ?>">
                
                <input type="number" autocomplete="off" class="form-control input-border" step="0.01" lang="en" min="0.00" placeholder="Kwota" name="amount" value=
                <?php
                    if(isset($_SESSION['amount'])) {
                        echo $_SESSION['amount'];
                        unset($_SESSION['amount']);
                    } 
                ?>
                >
                <a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest obowiązkowe. Wpisz liczbę większą od zera.">
                
                    <span class="input-group-text input-border bg-white">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
                                    
            <div class="input-group my-4 mx-auto form-add--width
            <?php
                if (isset($_SESSION['errorDate'])) {
                    echo 'border-red';
                    unset($_SESSION['errorDate']);
                }
            ?>">	
                <input type="date" class="form-control input-border js-date" name="date" value=
                <?php
                    if(isset($_SESSION['date'])) {
                        echo $_SESSION['date'];
                        unset($_SESSION['date']);
                    } else echo date('Y-m-d');
                ?>>
                <a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest obowiązkowe. Wpisz datę w formacie rrrr-mm-dd z przedziału od <?=START_DATE?> do końca bieżącego miesiąca.">
                
                    <span class="input-group-text input-border bg-white">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
                
            <div class="input-group my-4 mx-auto form-add--width
            <?php
                if (isset($_SESSION['errorCategory'])) {
                    echo 'border-red';
                    unset($_SESSION['errorCategory']);
                }
            ?>">
                <select class="custom-select input-border" name="category">
                    <option disabled selected value='0'>Wybierz kategorię</option>
                    <?php
                        echo $portal -> getHtmlOfOptionsForIncomeCategories();
                    ?>
                </select>
                <a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest obowiązkowe. Wybierz kategorię przychodu.">
                
                    <span class="input-group-text input-border bg-white">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
                                    
            <div class="input-group my-4 mx-auto form-add--width">
                <input type="text" class="form-control input-border" placeholder="Komentarz (opcjonalnie)" name="comment" value=
                <?php
                    if(isset($_SESSION['comment'])) {
                        echo '"'.$_SESSION['comment'].'"';
                        unset($_SESSION['comment']);
                    } 
                ?>>
                <a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest opcjonalne.">
                
                    <span class="input-group-text input-border bg-white">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
            
            <div class="row mx-0 mt-4">
                <div class="col px-0">
                    <a href="index.php?action=showIncomeAddForm" class="btn form-add__btn--reset mt-4 text-white reset max-width"><i class="fas fa-times"></i> Anuluj</a>
                </div>
            
                <div class="col px-0">
                    <button type="submit" class="btn form-add__btn--submit btn-default mt-4 text-white max-width"><i class="fas fa-plus"></i> Dodaj</button>
                </div>
            </div>
        </form>
    </div>
</div>