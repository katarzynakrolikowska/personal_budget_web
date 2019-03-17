<?php

class Expense extends MoneyTransfer
{
    private $paymentMethod = null;

    public function __construct($amount = '', $date = '', $paymentMethod = '', $category = '',  $comment = '')
    {
        parent:: __construct($amount, $date, $category, $comment);
        $this -> paymentMethod = $paymentMethod;
    }

    public function getPaymentMethod()
    {
        return $this -> paymentMethod;
    }

    public function setPaymentMethod($paymentMethod)
    {
        if (isset($paymentMethod)) {
            $this -> paymentMethod = $paymentMethod;
        }
    }
}