<script type="text/javascript">
    
    $(function(){

        var $inputSelectPaymentMethod = $('#settingsPaymentMethodSelect');
        var $inputSelectExpenseCategory = $('#settingsExpenseCategorySelect');
        var $inputOption = $('.inputOption');
        var $settingsModalExpense = $('#settingsExpenseModal');
        var $info = $settingsModalExpense.find('#info');

        $settingsModalExpense.find('h5').text('Usuń metodę płatności');
        $inputSelectExpenseCategory.addClass('hideItem');
        $inputSelectPaymentMethod.addClass('hideItem');
        $info.removeClass('hideItem');
        $inputOption.addClass('hideItem');
        $info.html('Usunięcie wybranej metody płatności spowoduje usunięcie wydatków związanych z tą metodą!<br />Czy chcesz usunąć wybraną metodę płatności?');
        $settingsModalExpense.find('.btn').text('Usuń metodę płatności');
        $('#settingsExpenseModal').modal('show');
        $settingsModalExpense.find('form').attr('action', 'index.php?action=deleteOptionUsed&editionContent=paymentMethod&id=<?=$_SESSION['selectedOption']?>');
    });

</script>