<?php


class InputSelectValidation
{
    private $selectedOption = null;
    private $arrayOptions = null;

    public function __construct($selectedOption, $arrayOptions)
    {
        $this -> selectedOption = $selectedOption;
        $this -> arrayOptions = $arrayOptions;
    }

    public function isValid()
    {
        foreach($this -> arrayOptions as $option) {
            if($this -> selectedOption != $option['id']){
                $optionOK = false; 
            } else {
                unset($_SESSION['errorCategory']);
                return true;
            }
        }
        
        if(!$optionOK) {
            return false;
        }
        
    }

    public function setSessionError($name, $info = ''){
        $name = ucfirst($name);
        $_SESSION['error'.$name] = $info;
    }

    public function unsetSessionError()
    {

    }

    
}