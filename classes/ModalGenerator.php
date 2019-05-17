<?php

class ModalGenerator
{
    public static function getHtmlOfIncomeCategoryEditionModal($options)
    {
        $id = 'modalIncomeCategoryEdition';
        $title = 'Edytuj kategorię przychodu';
        $url = 'index.php?action=editOption&editionContent=income';
        $disabledOption = 'Wybierz kategorię przychodu';
        $dataContentSelect = 'Wybierz kategorię, którą chcesz edytować.'; 
        $placeholder = 'Wpisz nową kategorię';
        $btnValue = 'Zapisz';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        $html .= self::getHtmlOfContainerSelectOption($disabledOption, $options, $dataContentSelect);
        $html .= self::getHtmlOfContainerInputOption($placeholder);
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }

    public static function getHtmlOfIncomeCategoryAdditionModal()
    {
        $id = 'modalIncomeCategoryAddition';
        $title = 'Dodaj kategorię przychodu';
        $url = 'index.php?action=addOption&editionContent=income';
        $placeholder = 'Wpisz nową kategorię';
        $btnValue = 'Dodaj';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        
        $html .= self::getHtmlOfContainerInputOption($placeholder);
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }

    public static function getHtmlOfIncomeCategoryDeletionModal($options)
    {
        $id = 'modalIncomeCategoryDeletion';
        $title = 'Usuń kategorię przychodu';
        $url = 'index.php?action=deleteOption&editionContent=income';
        $disabledOption = 'Wybierz kategorię przychodu';
        $dataContentSelect = 'Wybierz kategorię, którą chcesz usunąć.'; 
        $btnValue = 'Usuń';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        $html .= self::getHtmlOfContainerSelectOption($disabledOption, $options, $dataContentSelect);
        $html .= self::getHtmlOfContainerInfo();
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }

    private static function getHtmlOfModalStart($id)
    {
        $html = '<div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog"                           aria-labelledby="'.$id.'Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">';

        return $html;
    }

    private static function getHtmlOfModalHeader($title)
    {
        $html = '<div class="modal-header pl-4 py-2">
                    <h4 class="modal-title">'.$title.'</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

        return $html;
    }

    private static function getHtmlOfModalBodyStart($url)
    {
        $html = '<div class="modal-body px-4">
                    <form method="post" action="'.$url.'">';

        return $html;
    }

    private static function getHtmlOfContainerSelectOption($disabledOption, $options, $dataContent)
    {
        $html = '<div class="input-group mb-3 js-container-select-category">
                    <select class="custom-select" name="selectedOption">
                        <option disabled selected value="0">'.$disabledOption.'</option>'.$options.'
                    </select>
                    <a class="input-group-prepend" data-toggle="popover" data-content="'.$dataContent.'">
                        <span class="input-group-text cursor-pointer rounded-right">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </a>
                </div>';

        return $html;
    }

    private static function getHtmlOfContainerInputOption($placeholder)
    {
        $html = '<div class="input-group mb-1 js-container-input-category">
                    <input type="text" class="form-control" autocomplete="off" placeholder="'.$placeholder.'"  name="newOption">
                    <a class="input-group-prepend" data-toggle="popover" data-content="Dozwolone są małe i duże litery.">
                        <span class="input-group-text cursor-pointer rounded-right">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </a>
                </div>';

        return $html;
    }

    private static function getHtmlOfContainerInfo()
    {
        return '<div class="js-info-option-used text-red p-2 rounded"></div>';
    }

    private static function getHtmlOfModalFooter($btnValue)
    {
                    $html = '<div class="modal-footer mt-4">
                                <a href="#" class="btn btn-primary" data-dismiss="modal">Anuluj</a>
                                <button type="submit" class="btn btn-primary form-settings__btn--submit">'.$btnValue.'</button>
                            </div>
                        </form>     
                    </div>
                </div>
            </div>
        </div>';

        return $html;
    }

    public static function getHtmlOfPaymentMethodEditionModal($options)
    {
        $id = 'modalPaymentMethodEdition';
        $title = 'Edytuj metodę płatności';
        $url = 'index.php?action=editOption&editionContent=paymentMethod';
        $disabledOption = 'Wybierz metodę płatności';
        $dataContentSelect = 'Wybierz metodę płatności, którą chcesz edytować.'; 
        $placeholder = 'Wpisz nową metodę płatności';
        $btnValue = 'Zapisz';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        $html .= self::getHtmlOfContainerSelectOption($disabledOption, $options, $dataContentSelect);
        $html .= self::getHtmlOfContainerInputOption($placeholder);
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }

    public static function getHtmlOfPaymentMethodAdditionModal()
    {
        $id = 'modalPaymentMethodAddition';
        $title = 'Dodaj metodę płatności';
        $url = 'index.php?action=addOption&editionContent=paymentMethod';
        $placeholder = 'Wpisz nową metodę płatności';
        $btnValue = 'Dodaj';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        
        $html .= self::getHtmlOfContainerInputOption($placeholder);
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }

    public static function getHtmlOfPaymentMethodDeletionModal($options)
    {
        $id = 'modalPaymentMethodDeletion';
        $title = 'Usuń metodę płatności';
        $url = 'index.php?action=deleteOption&editionContent=paymentMethod';
        $disabledOption = 'Wybierz metodę płatności';
        $dataContentSelect = 'Wybierz metodę płatności, którą chcesz usunąć.'; 
        $btnValue = 'Usuń';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        $html .= self::getHtmlOfContainerSelectOption($disabledOption, $options, $dataContentSelect);
        $html .= self::getHtmlOfContainerInfo();
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }

    public static function getHtmlOfExpenseCategorySettingsLimitModal($options)
    {
        $id = 'modalExpenseCategoryLimit';
        $title = 'Ustaw miesięczny limit dla kategorii wydatku';
        $url = 'index.php?action=setLimit&editionContent=expense';
        $disabledOption = 'Wybierz kategorię wydatku';
        $dataContentSelect = 'Wybierz kategorię, dla której chcesz ustawić limit.';
        $btnValue = 'Zapisz';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        $html .= self::getHtmlOfContainerSelectOption($disabledOption, $options, $dataContentSelect);
        $html .= self::getHtmlOfContainerInputLimit();
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }

    private static function getHtmlOfContainerInputLimit()
    {
        return '<div class="input-group mb-3 js-container-input-limit">
                    <input type="number" autocomplete="off" class="form-control" step="0.01" lang="en" placeholder="Wpisz kwotę limitu" name="limitAmount">
                    <a class="input-group-prepend" data-toggle="popover" data-content="Wpisz liczbę większą od zera.">
                        <span class="input-group-text cursor-pointer rounded-right">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </a>
                </div>';
    }

    public static function getHtmlOfExpenseCategoryEditionModal($options)
    {
        $id = 'modalExpenseCategoryEdition';
        $title = 'Edytuj kategorię wydatku';
        $url = 'index.php?action=editOption&editionContent=expense';
        $disabledOption = 'Wybierz kategorię wydatku';
        $dataContentSelect = 'Wybierz kategorię, którą chcesz edytować.'; 
        $placeholder = 'Wpisz nową kategorię';
        $btnValue = 'Zapisz';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        $html .= self::getHtmlOfContainerSelectOption($disabledOption, $options, $dataContentSelect);
        $html .= self::getHtmlOfContainerInputOption($placeholder);
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }

    public static function getHtmlOfExpenseCategoryAdditionModal()
    {
        $id = 'modalExpenseCategoryAddition';
        $title = 'Dodaj kategorię wydatku';
        $url = 'index.php?action=addOption&editionContent=expense';
        $placeholder = 'Wpisz nową kategorię';
        $btnValue = 'Dodaj';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        
        $html .= self::getHtmlOfContainerInputOption($placeholder);
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }

    public static function getHtmlOfExpenseCategoryDeletionModal($options)
    {
        $id = 'modalExpenseCategoryDeletion';
        $title = 'Usuń kategorię wydatku';
        $url = 'index.php?action=deleteOption&editionContent=expense';
        $disabledOption = 'Wybierz kategorię wydatku';
        $dataContentSelect = 'Wybierz kategorię, którą chcesz usunąć.'; 
        $btnValue = 'Usuń';
        $html = self::getHtmlOfModalStart($id);
        $html .= self::getHtmlOfModalHeader($title);
        $html .= self::getHtmlOfModalBodyStart($url);
        $html .= self::getHtmlOfContainerSelectOption($disabledOption, $options, $dataContentSelect);
        $html .= self::getHtmlOfContainerInfo();
        $html .= self::getHtmlOfModalFooter($btnValue);

        return $html;
    }
}