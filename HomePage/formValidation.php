<?php

//Add class 
if (array_key_exists('addClass', $_POST)){


	if(array_key_exists('className', $_POST)){
		$className =  $_POST['className'];
	}
	if(array_key_exists('numberOfStudents', $_POST)){
		$numberOfStudents =  $_POST['numberOfStudents'];
	}

//Variables for checking if fields are properly filled

	$classNameOK = true;
	$numberOfStudentsOK = true;

	if (array_key_exists('className', $_POST) && array_key_exists('numberOfStudents', $_POST) && array_key_exists('addClass', $_POST)) {
		
			$isAddClass = true;

	}

//Validations

	$sql = "SHOW TABLES FROM `".$username."` LIKE '".$className."'";
	$result =  mysqli_query($link, $sql);


	$row_count = mysqli_num_rows($result);

	mysqli_free_result($result);

	if ($row_count >= 1) {

		$sameNameClassExists = true;

	} elseif ($row_count == 0) {

		$sameNameClassExists = false;

	}

	if ($isAddClass) {

		if (strlen($className) < 2 ||  strlen($className) > 15) {
			$classNameOK = false;
			$classNameErrorClass = "is-invalid";
			$modalToShow = "addClassModal";

				if (strlen($className) < 2)
				{
					$errorMsgClassName = "Class name should be atleast 2 characters long.";
				}
				if (strlen($className) > 15)
				{
					$errorMsgClassName = "Class name should be not longer than 15 characters.";
				}

		} elseif ($numberOfStudents < 1 || $numberOfStudents > 120) {
			$numberOfStudentsOK = false;
			$numberOfStudentsErrorClass = "is-invalid";
			$modalToShow = "addClassModal";
	
		} elseif ($sameNameClassExists) {
			$classNameOK = false;
			$classNameErrorClass = "is-invalid";
			$modalToShow = "addClassModal";
			$errorMsgClassName = "Class name exists. Please choose another name.";
		}

		 elseif ($classNameOK && $numberOfStudentsOK && !$sameNameClassExists) {

			$_SESSION['username'] = $username;
			$_SESSION['className'] = $className;
			$_SESSION['numberOfStudents'] = $numberOfStudents;

			header("Location: ../AddClass");

		}
	}
}

//My classes history
if (array_key_exists('viewHistory', $_POST)){


	if(array_key_exists('historyOf', $_POST)){
		$historyOf =  $_POST['historyOf'];
	}

//Variables for checking if fields are properly filled
	$historyOfOK = true;

	if (strlen($historyOf) < 1) {

		$historyOfOK = false;
		$historyOfError = "Please choose atleast one class.";
		$modalToShow = "myClassesModal";
	}

	if ($historyOfOK) {

		$_SESSION['historyOf'] = $historyOf;
		$_SESSION['username'] = $username;

		header("Location: ../Archive");

	}
}


//Roll Call

if (array_key_exists('takeAttendance', $_POST)){

//Variables for checking if fields are properly filled
	$attendanceOfOK = false;

	if(array_key_exists('attendanceOf', $_POST)){
		$attendanceOf =  $_POST['attendanceOf'];
	} else {
		$attendanceOf =  null;
		$attendanceOfOK = false;
	}

	if (strlen($attendanceOf) < 1) {

		$attendanceOfOK = false;
		$attendanceOfError = "Please choose atleast one class.";
		$modalToShow = "rollCallModal";
	}

	$getDate = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
	$date = $getDate->format('Y-m-d');

	$sql = "SELECT `id` FROM `".$username."`.`".$attendanceOf."` WHERE dateofattendance='".$date."';";

	$result =  mysqli_query($link, $sql);
	$row_count = mysqli_num_rows($result);

	if ($row_count >= 1) {

		$attendanceOf = false;
		$modalToShow = "rollCallModal";
		$attendanceOfError = "Attendance already taken for this class for today.";

	}

	if (strlen($attendanceOf) >= 1) {

		$sql = "SHOW TABLES FROM `".$username."` LIKE '".$attendanceOf."'";
		$result =  mysqli_query($link, $sql);

		$row_count = mysqli_num_rows($result);

		if ($row_count == 1) {

			$attendanceOfOK = true;
		
		} else {

			$modalToShow = "rollCallModal";
			$attendanceOfError = "Please choose atleast one class.";
		}
	}

	if ($attendanceOfOK) {

		$_SESSION['attendanceOf'] = $attendanceOf;
		$_SESSION['username'] = $username;
		header("Location: ../TakeAttendance");

	}
}

//Remove Class

if (array_key_exists('removeClassButton', $_POST)){

	if(!empty($_POST['removeClassName'])){
		
		foreach($_POST['removeClassName'] as $toRemoveClassName){

			if (strlen($toRemoveClassName) > 0){ 
				
				$sql = "DROP TABLE `".$username."`.`".$toRemoveClassName."`";

				if (mysqli_query($link, $sql)) {

					$modalToShow = "removeClassSuccessModal";

				} else {

					$removeError = "Class could not be removed.";
					exit();
				}
			}
		}
		
		header("Refresh:1");
	} else {

		$modalToShow = "removeClassModal";
		$removeError = "Please choose atleast one class.";
	}
}

if (array_key_exists('supportAsked', $_POST)){


	if(array_key_exists('supportSubject', $_POST)){
		$supportSubject =  $_POST['supportSubject'];
		$supportSubjectOK = true;
	}
	if(array_key_exists('supportMessage', $_POST)){
		$supportMessage =  $_POST['supportMessage'];
		$supportMessageOK = true;
	}

	if (strlen($supportSubject) < 5 ) {
		
		$modalToShow = "supportModal";
		$supportSubjectClass = "is-invalid";
		$supportSubjectError = "Subject should be at least 5 characters long.";
		$supportSubjectOK = false;

	} else if (strlen($supportSubject) > 60 ) {
		
		$modalToShow = "supportModal";
		$supportSubjectClass = "is-invalid";
		$supportSubjectError = "Subject could be at most 60 characters long.";
		$supportSubjectOK = false;

	}

	if (strlen($supportMessage) < 10 ) {
		
		$modalToShow = "supportModal";
		$supportMessageClass = "is-invalid";
		$supportMessageError = "Message should at least be 10 characters long.";
		$supportMessageOK = false;

	} else if (strlen($supportMessage) > 300 ) {
		
		$modalToShow = "supportModal";
		$supportMessageClass = "is-invalid";
		$supportMessageError = "Message could at least be 300 characters long.";
		$supportMessageOK = false;

	}

	if ($supportSubjectOK && $supportMessageOK) {
		
		include('../commons/API/PHPMailer/class.phpmailer.php');

		$fromAddress  = "ghojariasaad@gmail.com";
		$toAddress = "ghojariasaad@gmail.com";

		$mail=new PHPMailer();
		$mail->Host = "smtp.gmail.com";
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Username = $fromAddress;
		$mail->Password = "collegeproject";
		$mail->SMTPSecure = "ssl";
		$mail->Port = 465;
		
		$mail->Subject = $supportSubject;
		$mail->Body = $supportMessage;

		$mail->setFrom($fromAddress, 'Easy Support');
		
		$mail->AddAddress($toAddress);

		if($mail->Send()) {

		  $modalToShow = "supportMessageSentModal";

		}
	}
}
//Edit Class

if (array_key_exists('editClass', $_POST)){

		$numberOfStudentstoAddOK = true;
		$sumTotalStudentsOK = true;
		$editClassNameInAddOK = true;

		if (strlen($_POST['numberOfStudentstoAdd']) < 1)
		{
			$modalToShow = "editModal";
			$numberOfStudentstoAddErrorClass = "is-invalid";
			$numberOfStudentstoAddError = "Please type number of students you want to add";
			$numberOfStudentstoAddOK = false;
		}

		if (!array_key_exists('editClassName', $_POST)){

			$modalToShow = "editModal";
			$editClassNameError = "Please select a class to add students to";
			$editClassNameInAddOK = true;
		}

		if ($editClassNameInAddOK && $numberOfStudentstoAddOK) {

			$sql = "SELECT count(*) FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$username."' AND `TABLE_NAME`='".$_POST['editClassName']."'";

			$result =  mysqli_query($link, $sql);
			$row = mysqli_fetch_array($result);
			$totalColumns = $row['count(*)'];
			$numberOfExistingStudents = $totalColumns - 2;
			$sumTotal = $_POST['numberOfStudentstoAdd'] + $numberOfExistingStudents;

			if ($sumTotal > 120) {

				$modalToShow = "editModal";
				$numberOfStudentstoAddErrorClass = "is-invalid";
				$numberOfStudentstoAddError = "Total number of students in a class can not be more than 120.";
				$sumTotalStudentsOK = false;
			
			}

		}

		if ($editClassNameInAddOK && $numberOfStudentstoAddOK && $sumTotalStudentsOK) {
			
			$_SESSION['username'] = $username;
			$_SESSION['editClassName'] = $_POST['editClassName'];
			$_SESSION['numberOfStudentstoAdd'] = $_POST['numberOfStudentstoAdd'];

			header("Location: ../AddStudents");
		}
}


if (array_key_exists('logoutHomePage', $_POST)){


	unset($_SESSION);
	unset($_COOKIE);
	setcookie(session_name(), "", time() - 60*60, "/");
	setcookie("id", "", time() - 60*60, "/");

	header("Location: ../Logout");

}

?>