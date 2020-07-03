<?php

	if (isset($_POST['password']) && isset($_POST['passwordMatch'])) {
		
		$password = $_POST['password'];
		$passwordMatch = $_POST['passwordMatch'];


		if ($password == $passwordMatch) {
			echo "true";
		} else {
			echo "false";
		}

	}

?>