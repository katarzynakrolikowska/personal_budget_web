<?php

class HtmlGenerator
{
    public static function getHtmlOfOptionsForIncomeCategories($categories)
    {
        if (!isset($_SESSION['category'])) {
            $_SESSION['category'] = null;
        }
        $html = self::getHtmlOfOptionsWithSelectedOption($categories, $_SESSION['category']);
        
        unset($_SESSION['category']);

        return $html;
    }

    public static function getHtmlOfOptionsForExpenseCategories($categories)
    {
        if (!isset($_SESSION['category'])) {
            $_SESSION['category'] = null;
        }
        $html = self::getHtmlOfOptionsWithSelectedOption($categories, $_SESSION['category']);
        
        unset($_SESSION['category']);

        return $html;
    }

    public static function getHtmlOfOptionsForPaymentMethods($methods)
    {
        if (!isset($_SESSION['paymentMethod'])) {
            $_SESSION['paymentMethod'] = null;
        }
        $html = self::getHtmlOfOptionsWithSelectedOption($methods, $_SESSION['paymentMethod']);
        
        unset($_SESSION['paymentMethod']);

        return $html;
    }

    public static function getHtmlOfOptionsWithSelectedOption($dataArray, $selectedItem)
    {
        $html = '';
        foreach($dataArray as $item) {
            if (isset($selectedItem) && 
            ($selectedItem == $item['id'])) {
                $html .= '<option value='.$item['id'].' selected>'.$item['name'].'</option>';
                unset($selectedItem);
            } else {
                $html .= '<option value='.$item['id'].'>'.$item['name'].'</option>';
            }
        }
        return $html;
    }

    public static function getHtmlOfDataArrayList($dataArray)
    {
        $html = '<ul>';
        foreach($dataArray as $item) {
            $html .= '<li>'.$item['name'];
            if (isset($item['monthly_limit'])) {
                $html .= '<small> (limit: '.$item['monthly_limit'].' PLN)</small>';
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public static function getHtmlOfSummedIncomesTableRow($income, $index)
    { 
        $incomeAmount = AmountModifier::getNumberFormatWithSpace($income['iSum']);
        $html = '<tr class="js-table-incomes__row-general">
                    <td class="js-table-balance__category-name border-top-green"><b>'.$income['name'].'</b></td>
                    <td class="text-right nowrap border-top-green" id="sumRow'.$index.'"><b>'.$incomeAmount.' PLN</b></td>
                    <td class="text-center border-top-green" title="Pokaż szczegóły"><span class="table-balance__icon-arrow js-table-balance__icon-arrow" id="arrowI'.$index.'"><i class="fas fa-angle-down"></i></span>
                    </td>
                </tr>';
        return $html;
    }

    public static function getHtmlOfDetailedIncomesRows($detailedIncomes, $index)
    {
        $html = '';
        if ($detailedIncomes) {
            foreach ($detailedIncomes as $income) {
                $incomeAmount = AmountModifier::getNumberFormatWithSpace($income['amount']);
                $html .= '<tr class="js-table-incomes__row-detail item-hide arrowI'.$index.'">
                            <td colspan="2" class="border-top-green">
                                <span class="js-row-detail__date">'.$income['date'].'</span> | 
                                <span class="js-row-detail__amount">'.$incomeAmount.'</span> PLN | 
                                <span class="js-row-detail__comment">'.$income['comment'].'</span>
                            </td>
                            <td class="text-center border-top-green">'.self::getHtmlOfMenuDots($income['id'], 'Income').'</td>
                        </tr>';
            }
            return $html;
        } else {
            return null;
        }
    }

    public static function getHtmlOfSummaryRow($sum)
    {
        $html = '<tr>
                    <td class="border-top-green"><b>RAZEM</b></td>
                    <td colspan=2 class="text-center border-top-green"><b>'.$sum.' PLN</b></td>
                </tr>';
        return $html;
    }

    private static function getHtmlOfMenuDots($id, $actionContent)
    {
        $html = '<div class="dropdown">
                    <i class="fas fa-ellipsis-h table-balance__icon-dots" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item js-link-edit-'.$actionContent.'" id="'.$id.'" href="#" data-toggle="modal" data-target="#balanceEditionModal">Edytuj</a>
                        <a class="dropdown-item" href="index.php?action=delete'.$actionContent.'&itemId='.$id.'">Usuń</a>
                    </div>
                </div>';

        return $html;
    }

    public static function getHtmlOfSummedExpensesTableRow($expense, $index)
    { 
        $expenseAmount = AmountModifier::getNumberFormatWithSpace($expense['eSum']);
        $html = '<tr class="js-table-expenses__row-general">
                    <td class="js-table-balance__category-name border-top-green"><b>'.$expense['name'].'</b></td>
                    <td class="text-right nowrap border-top-green"><b>'.$expenseAmount.' PLN</b></td>
                    <td class="text-center border-top-green" title="Pokaż szczegóły"><span class="table-balance__icon-arrow js-table-balance__icon-arrow" id="arrowE'.$index.'"><i class="fas fa-angle-down"></i></span>
                    </td>
                </tr>';
        return $html;
    }

    public static function getHtmlOfDetailedExpensesRows($detailedExpenses, $index)
    {
        $html = '';
        if ($detailedExpenses) {
            foreach ($detailedExpenses as $expense) {
                $expenseAmount = AmountModifier::getNumberFormatWithSpace($expense['amount']);
                $html .= '<tr class="js-table-expenses__row-detail item-hide arrowE'.$index.'">
                            <td colspan="2" class="border-top-green">
                                <span class="js-row-detail__date">'.$expense['date'].'</span> |
                                <span class="js-row-detail__amount">'.$expenseAmount.'</span> PLN |
                                <span class="js-row-detail__payment">'.$expense['payment'].'</span> |
                                <span class="js-row-detail__comment">'.$expense['comment'].'</span>
                            </td>
                            <td class="text-center border-top-green">'.self::getHtmlOfMenuDots($expense['id'], 'Expense').'</td>
                        </tr>';
            }
            return $html;
        } else {
            return null;
        }
    }
}