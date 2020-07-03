<?php 

if (array_key_exists('editClassName', $_SESSION) && array_key_exists('username', $_SESSION) && array_key_exists('numberOfStudentstoAdd', $_SESSION))
{

	$className = $_SESSION['editClassName'];
	$numberOfStudents = $_SESSION['numberOfStudentstoAdd'];
	$username = $_SESSION['username'];

	$sql = "SELECT count(*) FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$username."' AND `TABLE_NAME`='".$className."'";

	$result =  mysqli_query($link, $sql);
	$row = mysqli_fetch_array($result);
	$totalColumns = $row['count(*)'];
	$lastStudent = $totalColumns - 2;
	$nextRollNumber = $totalColumns - 1;

	$GLOBALS['allInputOkay'] = true;
	$designedInputBoxes = " ";

	$designedCreateTableQuery = "ALTER TABLE `".$username."`.`".$className."`";

	if (!array_key_exists('submit', $_POST)){

		for ($i=1; $i <= $numberOfStudents; $i++) { 

			$designedInputBoxes .= '<div class="input-group col-md-4 littlepaddingBottom">
											<div class="input-group-prepend">
												<span class="input-group-text" id="s'.$nextRollNumber.'Rollcode">'.$nextRollNumber.'.</span>
											</div>
											<input type="text" id="s'.$nextRollNumber.'" name="s'.$nextRollNumber.'" class="form-control form-control-lg" placeholder="Student Full Name" aria-label="Username" aria-describedby="'.$nextRollNumber.'Rollcode">
										</div>
										';
										//minlength="4" maxlength="20" required="yes" pattern="[A-Za-z]{4,20}"
			$nextRollNumber++;
		}
	}



	if (array_key_exists('submit', $_POST)){

		$nextRollNumber = $totalColumns - 1;

		for ($i=1; $i <= $numberOfStudents; $i++) {

			${"s" . $nextRollNumber} = $_POST["s" . $nextRollNumber];

			$designedInputBoxes .= '<div class="input-group col-md-4 littlepaddingBottom">
											<div class="input-group-prepend">
												<span class="input-group-text" id="s'.$nextRollNumber.'Rollcode">'.$nextRollNumber.'.</span>
											</div>
											<input type="text" id="s'.$nextRollNumber.'" name="s'.$nextRollNumber.'" class="form-control form-control-lg';

			if (strlen(${"s" . $nextRollNumber}) < 4 ||  strlen(${"s" . $nextRollNumber}) > 20)
			{
				${"s" . $nextRollNumber . "OK"} = false;	
				$designedInputBoxes .= ' is-invalid" placeholder="Student Full Name" aria-label="Username" aria-describedby=s'.$i.'Rollcode" minlength="4" maxlength="20" required="yes" pattern="[A-Za-z]{4,20}"';

				if(isset(${"s" . $nextRollNumber})){

					$designedInputBoxes .= 'value="' . ${"s" . $nextRollNumber} . '"';

				}
				$designedInputBoxes .='>
												<div class="invalid-feedback smallText">
													Class name should be atleast 4 to 20 characters long.
												</div>
												</div>
												';
			} else 
			{
				${"s" . $nextRollNumber . "OK"} = true;
				$designedInputBoxes .= '" placeholder="Student Full Name" aria-label="Username" aria-describedby=s'.$nextRollNumber.'Rollcode" minlength="4" maxlength="20" required="yes" pattern="[A-Za-z]{4,20}" value="';

				if(isset(${"s" . $nextRollNumber})){

					$designedInputBoxes .= ${"s" . $nextRollNumber} . '"';

				}
				$designedInputBoxes .='>
												</div>
												';
			}

			$nextRollNumber++;

		}
	//Check Content

		for ($i=1; $i <= $numberOfStudents; $i++) { 

			$nextRollNumber = $totalColumns - 1;

			if (!${"s" . $nextRollNumber . "OK"}) {
			
				$GLOBALS['allInputOkay'] = false;
			
			} elseif ($GLOBALS['allInputOkay']) {
				
				for ($i=0; $i < $numberOfStudents; $i++) { 

					$studentRollHere = $nextRollNumber + $i;

					$designedCreateTableQuery .= "ADD COLUMN `s".$studentRollHere."` TINYINT(1) NOT NULL COMMENT '"  .${"s" . $studentRollHere}.  "' , ";
				}

				$designedCreateTableQuery = substr($designedCreateTableQuery, 0, -2);


				$designedCreateTableQuery .= ";";

				if (mysqli_query($link, $designedCreateTableQuery)) {

					$successOrFailModal = "addStudentsSuccessModal";
					$successOrFailText = "Successfully added these students to class!";

					header('Refresh: 2; URL=../HomePage');

				} else {

					$successOrFailModal = "addStudentsSuccessModal";
					$successOrFailText = "Failed to added these students to class!";

					header('Refresh: 2; URL=../HomePage');

				}

			}
			$nextRollNumber++;
		}
		
	}	
} else if (array_key_exists('id', $_SESSION) || array_key_exists('id', $_COOKIE)) {
	
	header("Location: ../HomePage");

} else
{
	header("Location: ../SignIn");

}

if (array_key_exists('logoutAddStudents', $_POST)){


		unset($_SESSION);
		unset($_COOKIE);
		setcookie(session_name(), "", time() - 60*60, "/");
		setcookie("id", "", time() - 60*60, "/");

		header("Location: ../Logout");

}


?>