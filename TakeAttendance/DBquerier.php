<?php

if(array_key_exists('submitCliked', $_POST)){

	for ($i=1; $i <= $numberOfStudents; $i++) { 

		${"s" . $i . "value"} = $_POST["s" . $i];

	}

	$getDate = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
	$todayDate = $getDate->format('Y-m-d');


	$sql = "SELECT `id` FROM `".$username."`.`".$attendanceOf."` WHERE dateofattendance='".$todayDate."';";

	$result =  mysqli_query($link, $sql);
	$attendanceOndate = mysqli_num_rows($result);

	if ($attendanceOndate >= 1) {

		$modalToShow = "attendanceSaveModal";
		$successOrErrorMessage = "Attendance already taken for this class for today.";
		header('Refresh: 2; URL=../HomePage');

	} else {


		$designedInsertIntoTableQuery = "INSERT INTO `".$username."`.`".$attendanceOf."`(`dateofattendance`, ";


		for ($i=1; $i <= $numberOfStudents; $i++) { 
		
			$designedInsertIntoTableQuery .= "`s" . $i . "`, ";
		
		}

		$designedInsertIntoTableQuery = substr($designedInsertIntoTableQuery, 0, -2);

		$designedInsertIntoTableQuery .= ") VALUES ('" . $todayDate . "', ";

		for ($i=1; $i <= $numberOfStudents; $i++) { 
		
			$designedInsertIntoTableQuery .= ${"s" . $i . "value"} . ", ";
		
		}

		$designedInsertIntoTableQuery = substr($designedInsertIntoTableQuery, 0, -2);

		$designedInsertIntoTableQuery .=  ");";

		$modalToShow = "attendanceSaveModal";
		
		if (mysqli_query($link, $designedInsertIntoTableQuery)) {

			$successOrErrorMessage = "Sucecessfully saved attendance!";
			unset($_SESSION['attendanceOf']);

			header('Refresh: 1; URL=../HomePage');

		} else {

			$successOrErrorMessage = "Could not save attendance!";
			unset($_SESSION['attendanceOf']);

			header('Refresh: 2; URL=../HomePage');

		}
	}
}

if(array_key_exists('logoutTakeAttendance', $_POST)){

	unset($_SESSION);
	unset($_COOKIE);
	setcookie(session_name(), "", time() - 60*60, "/");
	setcookie("id", "", time() - 60*60, "/");

	header("Location: ../Logout");


}

?>