<script type="text/javascript">
    var $limitInfo = $('.limitInfo');
    var $inputAmount = $('.expenseAmount');
    var $inputDate = $('.expenseDate');
    var $inputCategory = $('.expenseCatSelect');
    var catId;
    var dateOfExpense;
    $(function() {
        $inputCategory.on('change', function() {
           catId = $(this).val();
           dateOfExpense = $inputDate.val();
           showLimitInfo(catId, dateOfExpense);
        });

        $inputAmount.on('input', function() {
            if (!$limitInfo.is('.hideItem')) {
                var amount = $(this).val();
                setActualSum(amount);
            }
        });

        $inputDate.on('change', function() {
            catId = $inputCategory.val();
            dateOfExpense = $(this).val();
            showLimitInfo(catId, dateOfExpense);
        });
    });

    function showLimitInfo(catId, dateOfExpense) {
        $.get('index.php?action=getLimitInfo', {categoryId: catId, date: dateOfExpense}, function(data) {
            if (data.success) {
                if (data.limit) {
                    var amount = $inputAmount.val();
                    if (!amount) {
                        actualSum = Number(data.sum);
                    } else {
                        actualSum = getFloatSum(amount, data.sum);
                    }
                    setColor(actualSum, data.limit);
                    $limitInfo.removeClass('hideItem');
                    $limitInfo.find('.limitValue').text(data.limit);
                    $limitInfo.find('.sumExpenses').text(data.sum);
                    $limitInfo.find('.difference').text(data.diff.toFixed(2));
                    $limitInfo.find('.actualSum').text(actualSum.toFixed(2));
                } else {
                    $limitInfo.addClass('hideItem');
                }
            }
        });
    }

    function getFloatSum(addend1, addend2) {
        return parseFloat(addend1) + parseFloat(addend2);
    }

    function setColor(actualSum, limit) {
        if (actualSum > limit) {
            $limitInfo.addClass('limitOut');
        } else {
            $limitInfo.removeClass('limitOut');
        }
    }

    function setActualSum(inputAmount) {
        if (!inputAmount) {
            inputAmount = 0;
        }
        var expensesFromDb = $limitInfo.find('.sumExpenses').text();
        var limit = $limitInfo.find('.limitValue').text();
        var actualSum = getFloatSum(inputAmount, expensesFromDb);
        setColor(actualSum, limit);
        $limitInfo.find('.actualSum').text(actualSum.toFixed(2));
    }
</script>