<?php

class MoneyTransfer
{
    private $amount = null;
    private $date = null;
    private $category = null;
    private $comment = null;

    public function __construct($amount = '', $date = '', $category = '', $comment = '')
    {
        $this -> amount = $amount;
        $this -> date = $date;
        $this -> category = $category;
        $this -> comment = $comment;
    }

    public function getAmount()
    {
        return $this -> amount;
    }

    public function getTransferDate()
    {
        return $this -> date;
    }

    public function getCategory()
    {
        return $this -> category;
    }

    public function getComment()
    {
        return $this -> comment;
    }
}