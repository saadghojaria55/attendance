<?php

	if (isset($_POST['password'])) {
		
		$password = $_POST['password'];
		$length = strlen($password);

		if ($length>=6) {
			echo "true";
		} else {
			echo "false";
		}
	}

?>