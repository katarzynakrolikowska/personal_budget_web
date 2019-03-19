<?php

class AmountValidation extends DataValidation
{
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
        
        $_SESSION['amount'] = AmountModifier::getNumberFormatWithoutSpace($this -> data);
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

    

    
}