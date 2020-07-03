<?php
	include('connection.php');

	if (isset($_POST['username'])) {
		$username = $_POST['username'];
		$length = strlen($username);
		$startsWithNumber = ctype_digit(substr($username, 0, 1));
		$pattern = '/[^a-zA-Z0-9_]/';
		$special = preg_match($pattern, $username);
		$usernameCheckQuery = "SELECT username FROM `usersdb`.`userlist` WHERE username = '".mysqli_real_escape_string($link, $username)."' LIMIT 1";
		$usernameCheckResult = mysqli_query($link, $usernameCheckQuery);

		if ($startsWithNumber) {
			echo "number";
		} else if ($length<6) {
			echo "small";
		} else if ($length>12) {
			echo "large";
		} else if ($special) {
			echo "special";
		} elseif (mysqli_num_rows($usernameCheckResult) > 0) {
			echo "taken";
		} else {
			echo "ok";
		}

	}

?>