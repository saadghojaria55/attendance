<?php 

	include('connection.php');

	if ($firstNameOK && $lastNameOK && $teacherPicOK && $genderOK && $emailOK && $phoneOK && $dobOK && $institutionNameOK && $institutionTypeOK && $addressOK && $usernameOK && $passwordOK && $passwordMatchOK) {

		$query = "INSERT INTO `usersdb`.`userlist`(`firstName`, `lastName`, `teacherPic`, `gender`, `email`, `phone`, `dob`, `institutionName`, `institutionType`, `address`, `username`, `password`) VALUES ('".mysqli_real_escape_string($link, $firstName)."', '".mysqli_real_escape_string($link, $lastName)."', '".mysqli_real_escape_string($link, $to_save_file)."','"  .$gender. "', '".mysqli_real_escape_string($link, $email)."', '".mysqli_real_escape_string($link, $phone)."', '".mysqli_real_escape_string($link, $dob)."','" .$institutionName. "','" .$institutionType. "', '".mysqli_real_escape_string($link, $address)."', '".mysqli_real_escape_string($link, $username)."', '".mysqli_real_escape_string($link, $password)."')";

	if (!mysqli_query($link, $query)){
		$unknownError = "<font color='#d9534f'>Could not sign you up.</font>";

	} else
	{
		$_SESSION['id'] = mysqli_insert_id($link);

		$query = "UPDATE `usersdb`.`userlist` SET password = '".md5(md5($_SESSION['id']).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

		mysqli_query($link, $query);

		$query = "CREATE DATABASE " .$username;

		mysqli_query($link, $query);

		//If uploads directory doesn't exist create directory 
		$dir = "../uploads";
		if (!file_exists($dir) && !is_dir($dir)) {
			mkdir($dir, 0700);
		}

//Put picture file in the directory
		move_uploaded_file($_FILES["teacherPic"]["tmp_name"], $to_save_file);

		header("Location: ../HomePage");

	}

	}

?>