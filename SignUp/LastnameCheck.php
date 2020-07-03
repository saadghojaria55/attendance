<?php

	if (isset($_REQUEST['lastName'])) {
		$lastName = $_REQUEST['lastName'];
		$length = strlen($lastName);

		if ($length>=2) {
				echo "true";
		} else {
				echo "false";
		}
	}

?>