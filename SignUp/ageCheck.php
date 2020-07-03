<?php

	if (isset($_REQUEST['age'])) {
		$age = $_REQUEST['age'];

		if ($age>5) {
				echo "<font color = 'green'>&nbsp;&nbsp;&nbsp;&#10004;</font>";
		} else {
				echo "<font color = 'red'>&nbsp;&nbsp;&nbsp;&#10060;</font>";
		}
	}

?>