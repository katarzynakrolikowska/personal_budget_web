
<?php
require_once 'templates/selectPeriodModal.php';

if (isset($messageError)) {
    echo '<h6 class="error mt-4">'.$messageError.'</h6>';
}
?>	
<div class="row justify-content-center pt-5 mx-0">
    <div class="col-auto headerOption">
        <header><h3>
        <?=$portal -> getBalanceHeader();?>
        </h3></header>
    </div>
</div>

<?php
if(empty($_SESSION['incomes']) && empty($_SESSION['expenses'])) {
    echo '<div class="row justify-content-center pt-5 mx-0 balanceNoData">
            <div class="col-auto headerOption">
                <header><h5 class="text-center">
                    W wybranym okresie nie wprowdziłeś danych!
                </h5></header>
            </div>
        </div>';
} else {
    require_once('templates/balanceDisplaying.php');
}
?>