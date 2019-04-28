<div class="row justify-content-sm-center mt-3 pt-5" id="rowSettings">
    <div class="col-12">
    </div>
    <nav class="col col-md-3 col-xl-2 px-0 colSettingsNav">
        <ul class="nav flex-column settingsNav">
            <li class="nav-item">
                <a class="nav-link <?=($editionContent === 'userData') ? 'active' : ''?> navLinkData" href="index.php?action=showSettings&editionContent=userData" id="userData"><i class="fas fa-user-edit"></i><span class="navTitleText"> Moje dane</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link navLinkIncome <?=$editionContent === 'income' ? 'active' : ''?>" href="index.php?action=showSettings&editionContent=income" id="incomeCategories"><i class="far fa-money-bill-alt"></i><i class="fas fa-pen iconPenIncome"></i><span class="navTitleText"> Moje przychody</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link navLinkExpense 
                <?php if($editionContent === 'expense' ||  $editionContent === 'paymentMethod') {
                    echo 'active';
                }
                ?>" href="index.php?action=showSettings&editionContent=expense" id="expenseOptions"><i class="fas fa-shopping-basket"></i><i class="fas fa-pen iconPenExpense"></i> <span class="navTitleText">Moje wydatki</span></a>
            </li>
        </ul>
    </nav>
    <div class="col-12 col-md-7 col-xl-6 px-0 colSettingsMain">

    