<?php

class Expense extends MoneyTransfer
{
    private $paymentMethod = null;

    public function __construct($amount, $date, $category, $paymentMethod, $comment = null)
    {
        parent:: __construct($amount, $date, $category, $comment = null);
        $this -> paymentMethod = $paymentMethod;
    }
}