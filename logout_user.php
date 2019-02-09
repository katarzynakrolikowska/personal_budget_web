<?php
session_start();

if(isset($_SESSION['loggedID'])) {
	unset($_SESSION['loggedID']);
} 

header('Location:index.php');
exit();




?>