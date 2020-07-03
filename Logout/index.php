<?php 

	unset($_SESSION);
	setcookie("id", "", time() - 60*60);
	$_COOKIE["id"] = "";

	header("Location: ../SignIn");



?>