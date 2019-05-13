<?php
require_once 'templates/selectPeriodModal.php';
?>	
<div class="row justify-content-center pt-5 mx-0">
    <div class="col-auto">
        <header>
            <h2 class="text-center text-gray">
            <?=$portal -> getBalanceHeader();?>
            </h2>
        </header>
    </div>
</div>

<?php
if(empty($_SESSION['incomes']) && empty($_SESSION['expenses'])) {
    echo '<div class="row justify-content-center pt-5 mx-0">
            <div class="col-auto">
                <h5 class="text-center">
                    Nie wprowadziłeś przychodów lub wydatków <span class="nowrap">w wybranym</span> okresie!
                </h5>
            </div>
        </div>';
} else {
    require_once('templates/balanceDisplaying.php');
}
?>