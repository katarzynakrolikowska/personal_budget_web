<?php

class TextValidation extends DataValidation
{
    public function isValid()
    {
        if ($this -> isTextIncludeValidChars()) {
            return true;
        } else {
            return false;
        }
    }
    
    private function isTextIncludeValidChars()
    {
        if(preg_match('/^[a-zA-ZąęćżźńłóśĄĘĆŻŹŁÓŃŚ\s]+$/', ($this -> data))) {
            return true; 
        } else {
            return false;
        }
    }
}