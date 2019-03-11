<?php

class DataValidation
{
    protected $text = null;

    public function __construct($text)
    {
        $this -> text = $text;
    }

    public function isValidLength($minLength, $maxLength)
    {
        if ($this -> isValidMinLength($minLength) && $this -> isValidMaxLength($maxLength)) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidMinLength($minLength)
    {
        $textLength = mb_strlen($this -> text);

        if ($textLength >= $minLength) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidMaxLength($maxLength)
    {
        $textLength = mb_strlen($this -> text);

        if ($textLength <= $maxLength) {
            return true;
        } else {
            return false;
        }
    }

    public function getSanitizeValue()
    {
        return htmlspecialchars(trim($this -> text), ENT_QUOTES, 'UTF-8');
    }
    
}