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
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700&amp;subset=latin-ext" rel="stylesheet">
</head>

<body class="container-fluid p-0">
    <?php
    if (isset($_SESSION['loggedInUser'])) {
        require_once 'headerForLoginUser.php';
    } else {
        require_once 'headerForLogoutUser.php';
    }
    
    if (isset($messageOK)) {
        echo '<h4 class="my-5 text-center">'.$messageOK.'</h4>';
    }

    switch ($action):
        case 'showLoginForm':
            require_once 'templates/loginForm.php';
            break;
        case 'showRegistrationForm':
            require_once 'templates/registrationForm.php';
            break;
        case 'showMainForLoginUser':
            require_once 'templates/loginUserMainContent.php';
            break;
        case 'showIncomeAddForm':
            $_SESSION['incomeCategories'] = $portal -> getIncomeCategoriesAssignedToUser($portal -> loggedInUser);
            require_once 'templates/incomeAddForm.php';
            break;
        case 'showExpenseAddForm':
            $_SESSION['expenseCategories'] = $portal -> getExpenseCategoriesAssignedToUser($portal -> loggedInUser);
            $_SESSION['paymentMethods'] = $portal -> getPaymentMethodsAssignedToUser($portal -> loggedInUser);
            require_once 'templates/expenseAddForm.php';
            break;
        case 'showMain':
        default:
            require_once 'templates/startContent.php';
    endswitch;
    ?>

        <div class="row mx-0">
            <footer class="col footer text-center py-2 <?=$action === 'showLoginForm' ? 'footerLogin' : ''?>">
                <p class="text-muted">2018 &copy; fullWallet.pl</p>	
            </footer>	
        </div>
    </div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<?php
	if(!empty($_SESSION['expenses']) && isset($_SESSION['balance'])) {
		require_once('set_chart.php');
	}
?>

<script type="text/javascript" src="js/personalBudget.js"></script>
</body>

</html>