<div class="row pb-5 addDataRow addExpenseRow justify-content-center mx-0">
    <div class="col-12 col-sm-11 col-md-9 col-lg-8 pt-2 limitInfo hideItem">
        <div class="row">
            <div class="col-6 col-md-3 mb-2">
                <header>Limit:</header>
                <span class="limitValue"></span>
            </div>
            <div class="col-6 col-md-3 mb-2">
                <header>Zapisane wydatki:</header>
                <span class="sumExpenses"></span>
            </div>
            <div class="col-6 col-md-3 mb-2">
                <header>Wolne środki:</header>
                <span class="difference"></span>
            </div>
            <div class="col-6 col-md-3 mb-2">
                <header>Wydatki + wpisana kwota:</header>
                <span class="actualSum"></span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-10 col-md-8 col-lg-6 containerAddData">
        <form class="formAddData" action="index.php?action=addExpense" method="post">
            <h3>Wprowadź wydatek</h3>
            <div class="messageError error"></div>
            <div class="input-group 
            <?php
                if (isset($_SESSION['errorAmount'])) {
                    echo 'errorBorder';
                    unset($_SESSION['errorAmount']);
                }
            ?>">
                <input type="number" class="form-control expenseAmount" step="0.01" placeholder="Kwota" name="amount" value=
                <?php
                    if(isset($_SESSION['amount'])) {
                        echo $_SESSION['amount'];
                        unset($_SESSION['amount']);
                    }
                ?>>
                <a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Wpisz liczbę większą od zera.">
                    
                    <span class="input-group-text">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
           						
            <div class="input-group 
            <?php
                if (isset($_SESSION['errorDate'])) {
                    echo 'errorBorder';
                    unset($_SESSION['errorDate']);
                }
            ?>">	
                <input type="date" class="form-control date expenseDate" name="date" placeholder="Data" value=
                <?php
                    if(isset($_SESSION['date'])) {
                        echo $_SESSION['date'];
                        unset($_SESSION['date']);
                    } else {
                        echo date('Y-m-d');
                    }
                ?>>
                 <a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Wpisz datę w formacie rrrr-mm-dd z przedziału od <?=START_DATE?> do końca bieżącego miesiąca.">
                    
                    <span class="input-group-text">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
           	
            <div class="input-group 
            <?php
                if (isset($_SESSION['errorPaymentMethod'])) {
                    echo 'errorBorder';
                    unset($_SESSION['errorPaymentMethod']);
                }
            ?>">
                <select class="custom-select" name="paymentMethod">
                    <option disabled selected value="0">Wybierz metodę płatności</option>
                    <?php
                        echo $portal -> getHtmlOfOptionsForPaymentMethods();
                    ?>
                </select>
                <a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Wybierz metodę płatności.">
                
                    <span class="input-group-text">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
            
            <div class="input-group 
            <?php
                if (isset($_SESSION['errorCategory'])) {
                    echo 'errorBorder';
                    unset($_SESSION['errorCategory']);
                }
            ?>">
                <select class="custom-select expenseCatSelect" name="category">
                    <option disabled selected>Wybierz kategorię</option>
                    <?php
                        echo $portal -> getHtmlOfOptionsForExpenseCategories();
                    ?>
                </select>
                <a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Wybierz kategorię przychodu.">
                
                    <span class="input-group-text">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
            					
            <div class="input-group ">
                <input type="text" class="form-control" placeholder="Komentarz (opcjonalnie)" name="comment" value=
                <?php
                    if(isset($_SESSION['comment'])) {
                        echo '"'.$_SESSION['comment'].'"';
                        unset($_SESSION['comment']);
                    } 
                ?>>
                <a class="input-group-prepend" data-toggle="popover" data-content="To pole jest opcjonalne.">
                
                    <span class="input-group-text">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
            
            <div class="row mx-0">
                <div class="col px-0">
                    <a href="index.php?action=showExpenseAddForm" class="btn mt-4 text-white reset"><i class="fas fa-times"></i> Anuluj</a>
                </div>
            
                <div class="col px-0">
                    <button type="submit" class="btn btn-default mt-4 text-white"><i class="fas fa-plus"></i> Dodaj</button>
                </div>
            </div>
        </form>
    </div>
</div>