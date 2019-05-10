<?php if(!isset($portal)) exit();?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatiable" content="IE-edge,chrome=1" />
	<title>fullWallet - zapanuj nad własnymi finansami!</title>
    <meta name="keywords" content="budżet osobisty, budżet domowy, finanse, rachunki, przychody, wydatki, bilans, oszczędzać, pieniądze"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <link rel="stylesheet" href="css/fontello.css" type="text/css" />
    <link rel="shortcut icon" href="img/wallet.ico" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round:400&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700&amp;subset=latin-ext" rel="stylesheet">
</head>

<body class="container-fluid p-0">
    <?php
    if (isset($portal -> loggedInUser)) {
        require_once 'headerForLogInUser.php';
    } else {
        require_once 'headerForLogOutUser.php';
    }
    
    if (isset($messageOK)) {
        echo '<h4 class="my-4 text-center js-message--result">'.$messageOK.'<i class="fas fa-times-circle ml-4 message--result__icon--close js-message--result__icon--close"></i></h4>';
    }
   
    if (isset($messageError)) {
        echo '<h6 class="text-center text-red my-4 js-message--result">'.$messageError.'<i class="fas fa-times-circle ml-4 message--result__icon--close js-message--result__icon--close"></i></h6>';
    }           
   

    
    switch ($action):
        case 'showLoginForm':
            require_once 'templates/loginForm.php';
            break;
        case 'showRegistrationForm':
            require_once 'templates/registrationForm.php';
            break;
        case 'showMainForLoginUser':
            require_once 'templates/mainSiteForLoggedInUser.php';
            break;
        case 'showIncomeAddForm':
            require_once 'templates/incomeAddForm.php';
            break;
        case 'showExpenseAddForm':
            require_once 'templates/expenseAddForm.php';
            break;
        case 'showBalanceForSelectedPeriod':
            require_once 'templates/balanceSite.php';
            break;
        case 'showSettings':
            require_once 'templates/settingsMenu.php';
            switch ($editionContent):
                case 'income':
                    $htmlOfOptions = $portal -> getHtmlOfOptionsForIncomeCategories();
                    require_once 'templates/incomeCategoriesSettingsForm.php';
                    break;
                case 'paymentMethod':
                case 'expense':
                    $htmlOfPaymentMethods = $portal -> getHtmlOfOptionsForPaymentMethods();
                    $htmlOfExpenseCategories = $portal -> getHtmlOfOptionsForExpenseCategories();
                    require_once 'templates/expenseOptionsSettingsForm.php';
                    break;
                case 'userData':
                default:
                    require_once 'templates/userDataSettingsForm.php';
                    break;
            endswitch;
            break;
        case 'showMain':
        default:
            require_once 'templates/startContent.php';
    endswitch;
    
    ?>
    </div>
    <div class="row mx-0 footer mb-0">
        <footer class="col text-center text-lightgray pt-3">
            <p class="text-muted">2018 &copy; fullWallet.pl</p>	
        </footer>	
    </div>

    <?php
    require_once 'templates/modalActionResult.php';
    ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<?php
    switch ($action):
        case 'showBalanceForSelectedPeriod':
            if ($portal -> getHtmlOfExpensesTableRows()) {
                echo '<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>';
                echo '<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-colorschemes@latest/dist/chartjs-plugin-colorschemes.min.js"></script>';
                require_once('chartSettings.php');
            }
            break;
        case 'showExpenseAddForm':
            require_once('templates/limitInfo.php');
            break;
    endswitch;
?>
<script type="text/javascript" src="js/personalBudget.js"></script>
</body>

</html>