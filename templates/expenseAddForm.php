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
                <div class="input-group-prepend ">
                    <span class="input-group-text" id="amountExpense"><i class="fas fa-pen-alt" ></i></span>
                </div>
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
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                </div>
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
                        foreach ($_SESSION['paymentMethods'] as $method) {
                            if (isset($_SESSION['paymentMethod']) && ($_SESSION['paymentMethod'] == $method['id'])) {
                                echo '<option value='.$method['id'].' selected>'.$method['name'].'</option>';
                                unset($_SESSION['paymentMethod']);
                            } else {
                                echo '<option value='.$method['id'].'>'.$method['name'].'</option>';
                            }
                        }
                    ?>
                </select>
                <div class="input-group-prepend ">
                    <span class="input-group-text " id="paymentMethods"><i class="fas fa-pen-alt "></i></span>
                </div>
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
                        foreach ($_SESSION['expenseCategories'] as $category) {
                            if (isset($_SESSION['category']) && ($_SESSION['category'] == $category['id'])) {
                                echo '<option value='.$category['id'].' selected>'.$category['name'].'</option>';
                                unset($_SESSION['category']);
                            } else {
                                echo '<option value='.$category['id'].'>'.$category['name'].'</option>';
                            }
                        }
                    ?>
                </select>
                <div class="input-group-prepend ">
                    <span class="input-group-text " id="categoriesExpense"><i class="fas fa-pen-alt "></i></span>
                </div>
            </div>
            					
            <div class="input-group ">
                <input type="text" class="form-control" placeholder="Komentarz (opcjonalnie)" name="comment" value=
                <?php
                    if(isset($_SESSION['comment'])) {
                        echo '"'.$_SESSION['comment'].'"';
                        unset($_SESSION['comment']);
                    } 
                ?>>
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                </div>
            </div>
            
            
            <div class="row mx-0">
                <div class="col px-0">
                    <a href="#" class="btn mt-4 text-white reset"><i class="fas fa-times"></i> Anuluj</a>
                </div>
            
                <div class="col px-0">
                    <button type="submit" class="btn btn-default mt-4 text-white"><i class="fas fa-plus"></i> Dodaj </button>
                </div>
            </div>
        </form>
        
    </div>
    
</div>
