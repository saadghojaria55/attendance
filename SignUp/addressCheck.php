<?php

	if (isset($_REQUEST['address'])) {
		$address = $_REQUEST['address'];
		$length = strlen($address);

		if ($length>=25) {
				echo "true";
		} else {
				echo "false";
		}
	}

	
?>