        
        
        
        
        <div class="row container-settings__header text-gray max-width mx-0 py-2 pl-3">
            <div class="col-10" >
                <h3>Metody płatności</h3>
            </div>
            <div class="col-2">
                <div class="dropdown mr-1">
                    <button class="fas fa-ellipsis-h dropdown-settings__icon-dots" data-toggle="dropdown"></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalPaymentMethodEdition" id="editMethodLink">Edytuj</a>
                        <a class="dropdown-item" href="#" id="addMethodLink" data-toggle="modal" data-target="#modalPaymentMethodAddition">Dodaj</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalPaymentMethodDeletion" id="deleteMethodLink">Usuń</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-4 ml-1 js-row--payment-methods-list">
            <div class="col-10 content-settings__list js-col--payment-methods-list">	
                <?=$portal -> getHtmlOfPaymentMethodsList()?>
            </div>
        </div>

        <div class="row container-settings__header text-gray max-width mx-0 py-2 pl-3">
            <div class="col-10" >
                <h3>Kategorie wydatku</h3>
            </div>
            <div class="col-2">
                <div class="dropdown mr-1">
                    <button class="fas fa-ellipsis-h dropdown-settings__icon-dots" data-toggle="dropdown"></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalExpenseCategoryLimit" id="limitExpenseCategoryLink">Ustaw limit</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalExpenseCategoryEdition" id="editExpenseCategoryLink">Edytuj</a>
                        <a class="dropdown-item" href="#" id="addExpenseCategoryLink" data-toggle="modal" data-target="#modalExpenseCategoryAddition">Dodaj</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalExpenseCategoryDeletion" id="deleteExpenseCategoryLink">Usuń</a>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-3 mb-4 ml-1 js-row--expense-categories-list">
            <div class="col-10 content-settings__list js-col--expense-categories-list">	
                <?=$portal -> getHtmlOfExpenseCategoriesList()?>
            </div>
        </div>
    
    </div>

    <?=$portal -> getHtmlOfPaymentMethodEditionModal()?>
    <?=$portal -> getHtmlOfPaymentMethodAdditionModal()?>
    <?=$portal -> getHtmlOfPaymentMethodDeletionModal()?>

    <?=$portal -> getHtmlOfExpenseCategorySettingsLimitModal()?>
    <?=$portal -> getHtmlOfExpenseCategoryEditionModal()?>
    <?=$portal -> getHtmlOfExpenseCategoryAdditionModal()?>
    <?=$portal -> getHtmlOfExpenseCategoryDeletionModal()?>
         