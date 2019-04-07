<div class="row pb-5 justify-content-center addDataRow mx-0">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6 containerAddData">
        <form class="formAddData" action="index.php?action=addExpense" method="post">
            <h3>Wprowadź wydatek</h3>

            <?php
                if (isset($messageError)) {
                    echo '<h6 class="error">'.$messageError.'</h6>';
                }
            ?>

            <div class="input-group 
            <?php
                if (isset($_SESSION['errorAmount'])) {
                    echo 'errorBorder';
                    unset($_SESSION['errorAmount']);
                }
            ?>">
                <input type="number" class="form-control" step="0.01" placeholder="Kwota" name="amount" value=
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
                <input type="date" class="form-control" id="date" name="date" placeholder="Data" value=
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
                <select class="custom-select" id="paymentMethod" name="paymentMethod">
                    <option disabled selected value="n">Wybierz metodę płatności</option>
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
                <select class="custom-select" id="category" name="category">
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
                    <button type="submit" class="btn btn-default mt-4 text-white"><i class="fas fa-plus"></i> Dodaj </button>
                </div>
            </div>
        </form>
        
    </div>
    
</div>
