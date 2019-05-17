
    <div class="row container-settings__header text-gray max-width mx-0 py-2 pl-3">
        <div class="col-10" >
            <h3>Kategorie przychodu</h3>
        </div>
        <div class="col-2">
            <div class="dropdown mr-1">
                <button class="fas fa-ellipsis-h dropdown-settings__icon-dots" data-toggle="dropdown"></button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalIncomeCategoryEdition" id="editIncomeCategoryLink">Edytuj</a>
                    <a class="dropdown-item" href="#" id="addIncomeCategoryLink" data-toggle="modal" data-target="#modalIncomeCategoryAddition">Dodaj</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalIncomeCategoryDeletion" id="deleteIncomeCategoryLink">Usuń</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 ml-1 js-row--income-categories-list">
        <div class="col-10 js-col--income-categories-list content-settings__list">	
            <?=$portal -> getHtmlOfIncomeCategoriesList()?>
        </div>
    </div>
</div>

<?=$portal -> getHtmlOfIncomeCategoryEditionModal()?>

<?=$portal -> getHtmlOfIncomeCategoryAdditionModal()?>

<?=$portal -> getHtmlOfIncomeCategoryDeletionModal()?>

