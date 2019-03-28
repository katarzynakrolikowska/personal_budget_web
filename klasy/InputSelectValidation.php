<?php


class InputSelectValidation extends DataValidation
{
    private $arrayOptions = null;

    public function __construct($selectedOption, $fieldName, $arrayOptions)
    {
        parent:: __construct($selectedOption, $fieldName);
        $this -> arrayOptions = $arrayOptions;
    }

    public function isValid()
    {
        foreach($this -> arrayOptions as $option) {
            if($this -> data != $option['id']){
                $optionOK = false; 
            } else {
                return true;
            }
        }
        
        if (!$optionOK) {
            return false;
        }
        
    }

    /*public function setSessionError($name, $info = ''){
        $name = ucfirst($name);
        $_SESSION['error'.$name] = $info;
    }

    public function unsetSessionError()
    {

    }*/

    
}