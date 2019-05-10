

<div class="row justify-content-sm-center mt-3 pt-5">
    <div class="col-12">
    </div>
    <nav class="col col-md-3 col-xl-2 px-0">
        <ul class="nav flex-column nav-settings__list js-nav-settings__list">
            <li class="nav-item max-width">
                <a class="nav-link m-0 rounded-0 site_settings--bg-green <?=($editionContent === 'userData') ? 'active' : ''?> nav-link-userdata" href="index.php?action=showSettings&editionContent=userData" id="userData"><i class="fas fa-user-edit"></i><span class="ml-1 nav-link__name"> Moje dane</span></a>
            </li>
            <li class="nav-item max-width">
                <a class="nav-link m-0 rounded-0 nav-link-income site_settings--bg-green <?=$editionContent === 'income' ? 'active' : ''?>" href="index.php?action=showSettings&editionContent=income"><i class="far fa-money-bill-alt"></i><i class="fas fa-pen nav-link-income__icon-pen"></i><span class="ml-1 nav-link__name"> Moje przychody</span></a>
            </li>
            <li class="nav-item max-width">
                <a class="nav-link m-0 rounded-0 site_settings--bg-green nav-link-expense 
                <?php if($editionContent === 'expense' ||  $editionContent === 'paymentMethod') {
                    echo 'active';
                }
                ?>" href="index.php?action=showSettings&editionContent=expense"><i class="fas fa-shopping-basket"></i><i class="fas fa-pen nav-link-expense__icon-pen"></i> <span class="ml-1 nav-link__name">Moje wydatki</span></a>
            </li>
        </ul>
    </nav>
    <div class="col-12 col-md-7 col-xl-6 px-0 mb-5 content-settings">

    