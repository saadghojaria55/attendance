<?php 

if (array_key_exists('submit', $_POST)){

	$username = $_POST['username'];
	$password = $_POST['password'];

	if (strlen($username) < 1) {

		$errorUsername = "Please type a username.";
		$errorClassOfusername = "is-invalid";
	
	} else if (strlen($password) < 1) {

		$errorPassword = "Please type a password.";
		$errorClassOfpassword = "is-invalid";
	
	} else {


		$query = "SELECT * FROM `usersdb`.`userlist` WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."' LIMIT 1;";

		$result = mysqli_query($link, $query);

		$row = mysqli_fetch_array($result);

		if (isset($row)) {

			$hashedPassword = md5(md5($row['id']).$_POST['password']);

			if ($hashedPassword == $row['password']) {

				$userID = $row['id'];
				$_SESSION['id'] = $userID;

				if ($_POST['stayLoggedIn'] == '1'){

					setcookie("id", $userID, time() + 60*60*24*365, "/");
				}

				header("Location: ../HomePage");
				
				} else {

				$errorPassword = "Wrong username/password combination. Try again.";
				$errorClassOfpassword = "is-invalid";

				}
			} else {

			$errorUsername = "Username does not exist.";
			$errorClassOfusername = "is-invalid";
		}
	}
}
?>