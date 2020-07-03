<?php

	if (isset($_REQUEST['phone'])) {
		$phone = $_REQUEST['phone'];
		$length = strlen($phone);

//ctype_digit returns TRUE if every character in the string text is a decimal digit 
		if (ctype_digit($phone) && $length==10 && $phone > 1000000000) {
				echo "true";
		} else {
				echo "false";
		}
	}

	
?>