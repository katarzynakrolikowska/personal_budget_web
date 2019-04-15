<script type="text/javascript">
    
    $(function(){
        var $inputSelectOption = $('#settingsIncomeSelect');
        var $inputOption = $('.inputOption');
        var $settingsIncomeModal = $('#settingsIncomeModal');
        var $info = $settingsIncomeModal.find('#info');

        $settingsIncomeModal.find('h5').text('Usuń kategorię przychodu');
        $inputOption.addClass('hideItem');
        $inputSelectOption.addClass('hideItem');
        $info.removeClass('hideItem');
        $info.html('Usunięcie wybranej kategorii spowoduje usunięcie przychodów związanych z tą kategorią!<br />Czy chcesz usunąć wybraną kategorię?');
        $settingsIncomeModal.find('.btn').text('Usuń kategorię');
        $('#settingsIncomeModal').modal('show');
        $settingsIncomeModal.find('form').attr('action', 'index.php?action=deleteOptionUsed&editionContent=income&id=<?=$_SESSION['selectedOption']?>');
    });

</script>