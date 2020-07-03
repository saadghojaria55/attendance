<?php 

if (array_key_exists('submit', $_POST)){

	$studentID = $_POST['studentID'];

	$regexForSpecialCharacter = '/[^a-zA-Z\s0-9_.]/';
	$hasAspecialCharacter  = preg_match($regexForSpecialCharacter,$studentID); 

	if (strlen($studentID) < 1) {

		$errorStudentID = "Please type a student ID.";
		$errorClassOfStudentID = "is-invalid";
	
	} elseif ($hasAspecialCharacter) {

		$errorStudentID = "Invalid student ID.";
		$errorClassOfStudentID = "is-invalid";

	} else {

		$regexForNumbersAtStart = '/^[\d]*/';
		$regexForNumbersAtLast = '/[\d]*$/';
		$regexForAlphabetsAtMiddle = '/[^0-9]+([A-Za-z\s])*/';

		preg_match($regexForNumbersAtStart, $studentID, $startID);
		preg_match($regexForAlphabetsAtMiddle, $studentID, $midRoll);
		preg_match($regexForNumbersAtLast, $studentID, $endRoll);

		$teacherIDtoAccess = $startID[0];
		$classToAccess = $midRoll[0];
		$sRollToAccess = $endRoll[0];

		echo $teacherIDtoAccess;
		echo "<br>";
		echo $classToAccess;
		echo "<br>";
		echo $sRollToAccess;
		echo "<br>";

		$query = "SELECT `username` FROM `usersdb`.`userlist` WHERE id = '".mysqli_real_escape_string($link, $teacherIDtoAccess)."' LIMIT 1;";

		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
		$numRows = mysqli_num_rows($result);
		$usernameToAccess = $row['username'];

		if ($numRows === 0) {

			$errorStudentID = "Invalid student ID.";
			$errorClassOfStudentID = "is-invalid";

		} else {


			$query = "SELECT `s".mysqli_real_escape_string($link, $sRollToAccess)."` FROM `".mysqli_real_escape_string($link, $usernameToAccess)."`.`".mysqli_real_escape_string($link, $classToAccess)."` LIMIT 1;";

			$result = mysqli_query($link, $query);

			if (!$result) {

				$errorStudentID = "Invalid student ID.";
				$errorClassOfStudentID = "is-invalid";

			} else {

				session_start();
				
				$_SESSION["teacherIDtoAccess"] = $teacherIDtoAccess;
				$_SESSION["classToAccess"] = $classToAccess;
				$_SESSION["sRollToAccess"] = $sRollToAccess;

				header("Location: ../StudentHistory");

			}
		}
	}
}
?>