<?php

class AmountModifier
{
    public static function getNumberFormatWithoutSpace($amount)
    {
        return number_format($amount, 2, '.', '');
    }

    public static function getNumberFormatWithSpace($amount)
    {
        return number_format($amount, 2, '.', ' ');
    }
}