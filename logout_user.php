<?php
session_start();

if(isset($_SESSION['loggedID'])) {
	unset($_SESSION['loggedID']);
	unset($_SESSION['username']);
} 

header('Location:index.php');
exit();

?>