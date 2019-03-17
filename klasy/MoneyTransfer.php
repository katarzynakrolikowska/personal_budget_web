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

    public function setAmount($amount)
    {
        if (isset($amount)) {
            $this -> amount = $amount;
        }
    }

    public function setTransferDate($date)
    {
        if (isset($date)) {
            $this -> date = $date;
        }
        
    }

    public function setCategory($category)
    {
        if (isset($category)) {
            $this -> category = $category;
        }
    }

    public function setComment($comment)
    {
        if (isset($comment)) {
            $this -> comment = $comment;
        } else {
            $this -> comment = '';
        }
    }
}