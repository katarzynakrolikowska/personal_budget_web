<?php

class HtmlGenerator
{
    public static function getHtmlOfOptionsWithSelectedOption($dataArray, $selectedItem)
    {
        $html = '';
        foreach($dataArray as $item) {
            if (isset($selectedItem) && 
            ($selectedItem == $item['id'])) {
                $html .= '<option value='.$item['id'].' selected>'.$item['name'].'</option>';
                unset($selectedItem);
            } else {
                $html .= '<option value='.$item['id'].'>'.$item['name'].'</option>';
            }
        }
        return $html;
    }

    public static function getHtmlOfDataArrayList($dataArray)
    {
        $html = '<ul>';
        foreach($dataArray as $item) {
            $html .= '<li>'.$item['name'].'</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}