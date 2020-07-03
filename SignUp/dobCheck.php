<?php

	if (isset($_REQUEST['dob'])) {
		$dob = $_REQUEST['dob'];

		$dobArray = explode('/', $dob);

		$day = $dobArray[0];
		$month = $dobArray[1];
		$year = $dobArray[2];

		$result = checkdate ($month, $day, $year);

		if ($result) {
				echo "true";
		} else {
				echo "false";
		}
	}

	
?>