<script type="text/javascript">
    
    $(function(){
        var $inputSelectOption = $('#settingsIncomeSelect');
        var $inputOption = $('.inputOption');
        var $settingsModal = $('#settingsIncomeModal');
        var $info = $settingsModal.find('#info');

        $settingsModal.find('h5').text('Usuń kategorię przychodu');
        $inputOption.addClass('hideItem');
        $inputSelectOption.addClass('hideItem');
        $info.removeClass('hideItem');
        $info.html('Usunięcie wybranej kategorii spowoduje usunięcie przychodów związanych z tą kategorią!<br />Czy chcesz usunąć wybraną kategorię?');
        $settingsModal.find('.btn').text('Usuń kategorię');
        $('#settingsIncomeModal').modal('show');
        $settingsModal.find('form').attr('action', 'index.php?action=deleteOptionConfirmed&editionContent=income&id=<?=$_SESSION['selectedOption']?>');
    });

</script>