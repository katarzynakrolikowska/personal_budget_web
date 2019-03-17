<div class="row pb-sm-5 justify-content-center addDataRow mx-0">
    
    <div class="col-12 col-sm-10 col-md-8 col-lg-6 containerAddData">
        <form class="formAddData" method="post" action="index.php?action=addIncome" >
            <h3>Wprowadź przychód</h3>
            
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
                
                <input type="number" class="form-control" step="0.01" lang="en" min="0.00" placeholder="Kwota" name="amount" value=
                <?php
                    if(isset($_SESSION['amount'])) {
                        echo $_SESSION['amount'];
                        unset($_SESSION['amount']);
                    } 
                ?>
                >
                <a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Wpisz liczbę większą od zera.">
                
                    <span class="input-group-text" id="userName">
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
                <input type="date" class="form-control" id="date" name="date" value=
                <?php
                    if(isset($_SESSION['date'])) {
                        echo $_SESSION['date'];
                        unset($_SESSION['date']);
                    } else echo date('Y-m-d');
                ?>>
                <a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Wpisz datę w formacie rrrr-mm-dd z przedziału od <?=START_DATE?> do końca bieżącego miesiąca.">
                
                <span class="input-group-text" id="userName">
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
                    <option disabled selected value='0'>Wybierz kategorię</option>
                    <?php
                        foreach($_SESSION['incomeCategories'] as $category) {
                            
                            if (isset($_SESSION['category']) && 
                            ($_SESSION['category'] == $category['id'])) {
                                echo '<option value='.$category['id'].' selected>'.$category['name'].'</option>';
                                unset($_SESSION['category']);
                            } else {
                                echo '<option value='.$category['id'].'>'.$category['name'].'</option>';
                            }
                        }
                        //unset($_SESSION['incomeCategories']);
                    ?>
                </select>
                <a class="input-group-prepend" data-toggle="popover" data-content="To pole jest obowiązkowe. Wybierz kategorię przychodu.">
                
                    <span class="input-group-text" id="userName">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </a>
            </div>
                                    
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Komentarz (opcjonalnie)" name="comment" value=
                <?php
                    if(isset($_SESSION['comment'])) {
                        echo '"'.$_SESSION['comment'].'"';
                        unset($_SESSION['comment']);
                    } 
                ?>>
                <a class="input-group-prepend" data-toggle="popover" data-content="To pole jest opcjonalne.">
                
                <span class="input-group-text" id="userName">
                    <i class="fas fa-info-circle"></i>
                </span>
            </a>
            </div>
            
            <div class="row mx-0 mt-4">
                <div class="col px-0">
                    <a href="menu-glowne" class="btn mt-4 text-white reset"><i class="fas fa-times"></i> Anuluj</a>
                </div>
            
                <div class="col px-0">
                    <button type="submit" class="btn btn-default mt-4 text-white"><i class="fas fa-plus"></i> Dodaj</button>
                </div>
            </div>
        </form>

        <?php
        foreach ($_POST as $key => $val)
        {
            echo $key.' = '.$val.'<br />';
        }
        ?>
    </div>
    
</div>