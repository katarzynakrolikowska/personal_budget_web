<?php

class NameValidation extends DataValidation
{
    public function isValidName()
    {
        if ($this -> isValidLength(MIN_LENGTH_USERNAME, MAX_LENGTH_USERNAME) && $this -> isNameIncludeValidChars()) {
            return true;
        } else {
            return false;
        }
    }
    
    private function isNameIncludeValidChars()
    {
        if(preg_match('/^[a-zA-ZąęćżźńłóśĄĘĆŻŹŁÓŃŚ\s]+$/', ($this -> data))) {
            return true; 
        } else {
            return false;
        }
    }
    
    
}