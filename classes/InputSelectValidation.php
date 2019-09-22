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
        foreach ($this -> arrayOptions as $option) {
            if ($this -> data != $option['id']){
                $optionOK = false; 
            } else {
                return true;
            }
        }
       return false;
    }

    public function isSelectedOptionExistsInArrayOptions()
    {
        foreach ($this -> arrayOptions as $option) {
            if ($this -> data === $option['name']){
                return true;
            }
        }
        return false;
    }
}