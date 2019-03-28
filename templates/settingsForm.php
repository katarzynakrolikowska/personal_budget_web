<div class="row justify-content-sm-center my-5 mx-0 pt-5 " id="rowSettings">
		
    <div class="col col-md-3 col-xl-2 px-0 colSettingsNav">
        <ul class="nav flex-column settingsNav">
            <li class="nav-item">
                <a class="nav-link <?=($editionContent === 'userData') ? 'active' : ''?> navLinkData" href="index.php?action=showSettings&editionContent=userData"><i class="fas fa-user-edit"></i><span class="navTitleText"> Moje dane</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link navLinkIncome <?=$editionContent === 'income' ? 'active' : ''?>" href="index.php?action=showSettings&editionContent=income"><i class="far fa-money-bill-alt"></i><i class="fas fa-pen iconPenIncome"></i><span class="navTitleText"> Moje przychody</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link navLinkExpense <?=$editionContent === 'expense' ? 'active' : ''?>" href="index.php?action=showSettings&editionContent=expense"><i class="fas fa-shopping-basket"></i><i class="fas fa-pen iconPenExpense"></i> <span class="navTitleText">Moje wydatki</span></a>
            </li>
        </ul>
    </div>
    <div class="col-12 col-md-7 col-xl-6 px-0 colSettingsMain">
        <?php
        switch ($editionContent):
            case 'income':
                require_once 'incomesSettingsForm.php';
                break;
            case 'expense':
                 require_once 'expensesSettingsForm.php';
                 break;
            case 'userData':
            default:
                require_once 'userDataSettingsForm.php';
                break;
        endswitch;
        ?>
		
    </div>
</div>

		
		
<div class="modal fade " id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body m-auto">
                <p></p>
            </div>
            
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="buttonOK" data-dismiss="modal">OK</a>
            </div>
            
        </div>
    </div>
</div>