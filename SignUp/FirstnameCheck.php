<?php

	if (isset($_REQUEST['firstName'])) {
		$firstName = $_REQUEST['firstName'];
		$length = strlen($firstName);

		if ($length>=2) {
				echo "true";
		} else {
				echo "false";
		}
	}

?>