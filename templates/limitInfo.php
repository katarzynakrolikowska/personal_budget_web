<script type="text/javascript">
    var $limitInfo = $('.js-container-limit');
    var $inputAmount = $('.js-amount-expense');
    var $inputDate = $('.js-date-expense');
    var $inputCategory = $('.js-category-expense');
    var catId;
    var dateOfExpense;
    $(function() {
        $inputCategory.on('change', function() {
           catId = $(this).val();
           dateOfExpense = $inputDate.val();
           showLimitInfo(catId, dateOfExpense);
        });

        $inputAmount.on('input', function() {
            if (!$limitInfo.is('.item-hide')) {
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
                    $limitInfo.removeClass('item-hide');
                    $limitInfo.find('.js-limit-value').text(data.limit);
                    $limitInfo.find('.js-expenses-sum').text(data.sum);
                    $limitInfo.find('.js-difference').text(data.diff.toFixed(2));
                    $limitInfo.find('.js-actual-sum').text(actualSum.toFixed(2));
                } else {
                    $limitInfo.addClass('item-hide');
                }
            }
        });
    }

    function getFloatSum(addend1, addend2) {
        return parseFloat(addend1) + parseFloat(addend2);
    }

    function setColor(actualSum, limit) {
        if (actualSum > limit) {
            $limitInfo.addClass('bg-lightred').removeClass('bg-lightgreen');
        } else {
            $limitInfo.removeClass('bg-lightred').addClass('bg-lightgreen');
        }
    }

    function setActualSum(inputAmount) {
        if (!inputAmount) {
            inputAmount = 0;
        }
        var expensesFromDb = $limitInfo.find('.js-expenses-sum').text();
        var limit = $limitInfo.find('.js-limit-value').text();
        var actualSum = getFloatSum(inputAmount, expensesFromDb);
        setColor(actualSum, limit);
        $limitInfo.find('.js-actual-sum').text(actualSum.toFixed(2));
    }
</script>