<?php

	if (isset($_REQUEST['email'])) {
		$email = $_REQUEST['email'];

		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				echo "true";
		} else {
				echo "false";
		}
	}

?>