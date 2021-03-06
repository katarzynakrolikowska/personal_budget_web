<?php

class TextTransformation
{
    public static function getUppercaseFirstLetterAndLowercaseOtherLetters($text)
    {
        return mb_strtoupper(mb_substr($text, 0, 1)).mb_strtolower(mb_substr($text,1));
    }

    public static function getHashText($text)
    {
        return password_hash($text, PASSWORD_DEFAULT);
    }
}