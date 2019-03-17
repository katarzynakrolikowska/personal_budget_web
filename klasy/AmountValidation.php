<?php

class AmountValidation extends DataValidation
{
    /*public function __construct($amount)
    {
        parent:: __construct($amount);
    }

    /*private function getValidAmountNotation()
    {
        return str_replace([',', ' '], ['.', ''], $this -> data);
    }*/

    public function isValid()
    {
        if ($this -> isEmpty()) {
            return false;
        }
        
        if (!$this -> isFloatNumber()) {
            return false;
        }
        
        if (!$this -> isPositiveNumber()) {
            return false;
        }
        
        $_SESSION['amount'] = $this -> getNumberFormatWithoutSpace();
        return true;
    }

    private function isFloatNumber()
    {
        if (filter_var($this -> data, FILTER_VALIDATE_FLOAT)) {
            return true;
        } else {
            return false;
        }
    }

    private function isPositiveNumber()
    {
        if ((float)$this -> data > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getNumberFormatWithoutSpace()
    {
        return number_format($this -> data, 2, '.', '');
    }

    
}