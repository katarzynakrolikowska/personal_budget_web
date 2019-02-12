<?php
session_start();

if(isset($_SESSION['loggedID'])) {
	unset($_SESSION['loggedID']);
	unset($_SESSION['username']);
	unset($_SESSION['email']);
} 

header('Location:index.php');
exit();

?>