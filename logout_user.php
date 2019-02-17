<?php
session_start();

if(isset($_SESSION['loggedID'])) {
	$_SESSION = array();
} 

header('Location:zapanuj-nad-wlasnymi-finansami');
exit();

?>