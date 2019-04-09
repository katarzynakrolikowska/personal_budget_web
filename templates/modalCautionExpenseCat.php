<script type="text/javascript">
    
    $(function(){
        var $inputSelectPaymentMethod = $('#settingsPaymentMethodSelect');
        var $inputSelectExpenseCategory = $('#settingsExpenseCategorySelect');
        var $inputOption = $('.inputOption');
        var $settingsModalExpense = $('#settingsExpenseModal');
        var $info = $settingsModalExpense.find('#info');

        $settingsModalExpense.find('h5').text('Usuń kategorię wydatku');
        $inputSelectExpenseCategory.addClass('hideItem');
        $inputSelectPaymentMethod.addClass('hideItem');
        $info.removeClass('hideItem');
        $inputOption.addClass('hideItem');
        $info.html('Usunięcie wybranej kategorii wydatku spowoduje usunięcie wydatków związanych z tą kategorią!<br />Czy chcesz usunąć wybraną kategorię wydatku?');
        $settingsModalExpense.find('.btn').text('Usuń kategorię wydatku');
        $('#settingsExpenseModal').modal('show');
        $settingsModalExpense.find('form').attr('action', 'index.php?action=deleteOptionUsed&editionContent=expense&id=<?=$_SESSION['selectedOption']?>');
    });

</script>