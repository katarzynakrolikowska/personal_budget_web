<div class="row pb-5 js-container--add-expense justify-content-center p-0 mx-0">
    <div class="col-12 col-sm-11 col-md-9 col-lg-8 pt-2 bg-lightgreen container-limit--font-size js-container-limit item-hide">
        <div class="row">
            <div class="col-6 col-md-3 mb-2">
                <b>Limit:</b><br />
                <span class="js-limit-value"></span>
            </div>
            <div class="col-6 col-md-3 mb-2">
                <b>Zapisane wydatki:</b><br />
                <span class="js-expenses-sum"></span>
            </div>
            <div class="col-6 col-md-3 mb-2">
                <b>Wolne środki:</b><br />
                <span class="js-difference"></span>
            </div>
            <div class="col-6 col-md-3 mb-2">
                <b>Wydatki + wpisana kwota:</b><br />
                <span class="js-actual-sum"></span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-10 col-md-8 col-lg-6 p-0 js-col--add-data">
        <form class="pt-5 form--add-data js-form--add-data" action="index.php?action=addExpense" method="post">
            <h3 class="text-gray form-add--width mx-auto">Wprowadź wydatek</h3>
            <div class="js-message-error text-center text-red"></div>
            <div class="input-group my-4 mx-auto form-add--width
            <?php
                if (isset($_SESSION['errorAmount'])) {
                    echo 'border-red';
                    unset($_SESSION['errorAmount']);
                }
            ?>">
                <input type="number" autocomplete="off" class="form-control input-border js-amount-expense" step="0.01" placeholder="Kwota" name="amount" value=
                <?php
                    if(isset($_SESSION['amount'])) {
                        echo $_SESSION['amount'];
                        unset($_SESSION['amount']);
                    }
                ?>>
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
                <input type="date" class="form-control input-border js-date js-date-expense" name="date" placeholder="Data" value=
                <?php
                    if(isset($_SESSION['date'])) {
                        echo $_SESSION['date'];
                        unset($_SESSION['date']);
                    } else {
                        echo date('Y-m-d');
                    }
                ?>>
                 <a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest obowiązkowe. Wpisz datę w formacie rrrr-mm-dd z przedziału od <?=START_DATE?> do końca bieżącego miesiąca.">
                    
                    <span class="input-group-text input-border bg-white">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
           	
            <div class="input-group my-4 mx-auto form-add--width
            <?php
                if (isset($_SESSION['errorPaymentMethod'])) {
                    echo 'border-red';
                    unset($_SESSION['errorPaymentMethod']);
                }
            ?>">
                <select class="custom-select input-border" name="paymentMethod">
                    <option disabled selected value="0">Wybierz metodę płatności</option>
                    <?php
                        echo $portal -> getHtmlOfOptionsForPaymentMethods();
                    ?>
                </select>
                <a class="input-group-prepend cursor-pointer" data-toggle="popover" data-content="To pole jest obowiązkowe. Wybierz metodę płatności.">
                
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
                <select class="custom-select input-border js-category-expense" name="category">
                    <option disabled selected>Wybierz kategorię</option>
                    <?php
                        echo $portal -> getHtmlOfOptionsForExpenseCategories();
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
            
            <div class="row mx-0">
                <div class="col px-0">
                    <a href="index.php?action=showExpenseAddForm" class="btn mt-4 text-white form-add__btn--reset reset max-width"><i class="fas fa-times"></i> Anuluj</a>
                </div>
            
                <div class="col px-0">
                    <button type="submit" class="btn form-add__btn--submit btn-default mt-4 text-white max-width"><i class="fas fa-plus"></i> Dodaj</button>
                </div>
            </div>
        </form>
    </div>
</div>