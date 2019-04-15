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
            $html .= '<li>'.$item['name'].'</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public static function getHtmlOfSummedIncomesTableRow($income, $index)
    { 
        $incomeAmount = AmountModifier::getNumberFormatWithSpace($income['iSum']);
        $html = '<tr class="incomeSumRow">
                    <td class="category"><b>'.$income['name'].'</b></td>
                    <td class="text-right"><b>'.$incomeAmount.' PLN</b></td>
                    <td class="cellArrowsIcon text-center" title="Pokaż szczegóły"><span class="arrow" id="arrowI'.$index.'"><i class=" fas fa-angle-double-down" ></i></span>
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
                $html .= '<tr class="incomeDetailedRow arrowI'.$index.'">
                            <td colspan="2">
                                <span class="date">'.$income['date'].'</span> | 
                                <span class="amount">'.$incomeAmount.'</span> PLN | 
                                <span class="comment">'.$income['comment'].'</span>
                            </td>
                            <td class="cellArrowsIcon">'.self::getHtmlOfMenuDots($income['id'], 'Income').'</td>
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
                    <td><b>RAZEM</b></td>
                    <td class="text-right"><b>'.$sum.' PLN</b></td>
                    <td class="cellArrowsIcon"></td>
                </tr>';
        return $html;
    }

    private static function getHtmlOfMenuDots($id, $actionContent)
    {
        $html = '<div class="dropdown">
                    <i class="fas fa-ellipsis-h menuDotsBalance" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item edit'.$actionContent.'Link" id="'.$id.'" href="#" data-toggle="modal" data-target="#balanceModal">Edytuj</a>
                        <a class="dropdown-item" href="index.php?action=delete'.$actionContent.'&itemId='.$id.'">Usuń</a>
                    </div>
                </div>';

        return $html;
    }

    public static function getHtmlOfSummedExpensesTableRow($expense, $index)
    { 
        $expenseAmount = AmountModifier::getNumberFormatWithSpace($expense['eSum']);
        $html = '<tr class="expenseSumRow">
                    <td class="category"><b>'.$expense['name'].'</b></td>
                    <td class="text-right"><b>'.$expenseAmount.' PLN</b></td>
                    <td class="cellArrowsIcon text-center" title="Pokaż szczegóły"><span class="arrow" id="arrowE'.$index.'"><i class=" fas fa-angle-double-down" ></i></span>
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
                $html .= '<tr class="expenseDetailedRow arrowE'.$index.'">
                            <td colspan="2">
                                <span class="date">'.$expense['date'].'</span> |
                                <span class="amount">'.$expenseAmount.'</span> PLN | 
                                <span class="payment">'.$expense['payment'].'</span> |
                                <span class="comment">'.$expense['comment'].'</span>
                            </td>
                            <td class="cellArrowsIcon">'.self::getHtmlOfMenuDots($expense['id'], 'Expense').'</td>
                        </tr>';
            }
            return $html;
        } else {
            return null;
        }
    }
}