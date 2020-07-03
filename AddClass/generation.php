<?php

$className = $_SESSION['className'];
$numberOfStudents = $_SESSION['numberOfStudents'];
$username = $_SESSION['username'];

$GLOBALS['allInputOkay'] = true;
$designedInputBoxes = " ";
$designedCreateTableQuery = "CREATE TABLE `".$username."`.`".$className."` ( `id` SMALLINT NOT NULL AUTO_INCREMENT , `dateofattendance` DATE NOT NULL ,";


if (!array_key_exists('submit', $_POST)){

	for ($i=1; $i <= $numberOfStudents; $i++) { 

		$designedInputBoxes .= '<div class="input-group col-md-4 littlepaddingBottom">
										<div class="input-group-prepend">
											<span class="input-group-text" id="s'.$i.'Rollcode">'.$i.'.</span>
										</div>
										<input type="text" id="s'.$i.'" name="s'.$i.'" class="form-control form-control-lg" placeholder="Student Full Name" aria-label="Username" aria-describedby="'.$i.'Rollcode" minlength="4" maxlength="20" required="yes" pattern="[A-Za-z]{4,20}">
									</div>
									';
	}
}



if (array_key_exists('submit', $_POST)){


	for ($i=1; $i <= $numberOfStudents; $i++) { 

		${"s" . $i} = $_POST["s" . $i];

		$designedInputBoxes .= '<div class="input-group col-md-4 littlepaddingBottom">
										<div class="input-group-prepend">
											<span class="input-group-text" id="s'.$i.'Rollcode">'.$i.'.</span>
										</div>
										<input type="text" id="s'.$i.'" name="s'.$i.'" class="form-control form-control-lg';

		if (strlen(${"s" . $i}) < 4 ||  strlen(${"s" . $i}) > 20)
		{
			${"s" . $i . "OK"} = false;	
			$designedInputBoxes .= ' is-invalid" placeholder="Student Full Name" aria-label="Username" aria-describedby=s'.$i.'Rollcode" minlength="4" maxlength="20" required="yes" pattern="[A-Za-z]{4,20}"';

			if(isset(${"s" . $i})){

				$designedInputBoxes .= 'value="' . ${"s" . $i} . '"';

			}
			$designedInputBoxes .='>
											<div class="invalid-feedback smallText">
												Class name should be atleast 4 to 20 characters long.
											</div>
											</div>
											';
		} else 
		{
			${"s" . $i . "OK"} = true;	
			$designedInputBoxes .= '" placeholder="Student Full Name" aria-label="Username" aria-describedby=s'.$i.'Rollcode" minlength="4" maxlength="20" required="yes" pattern="[A-Za-z]{4,20}" value="';

			if(isset(${"s" . $i})){

				$designedInputBoxes .= ${"s" . $i} . '"';

			}
			$designedInputBoxes .='>
											</div>
											';
		}




	}
//Check Content

	for ($i=1; $i <= $numberOfStudents; $i++) { 

		if (!${"s" . $i . "OK"}) {
		
			$GLOBALS['allInputOkay'] = false;
		
		} elseif ($GLOBALS['allInputOkay']) {
			
			for ($i=1; $i <= $numberOfStudents; $i++) { 

				$designedCreateTableQuery .= "`s".$i."` TINYINT(1) NOT NULL COMMENT '"  .${"s" . $i}.  "' , ";
			}

			$designedCreateTableQuery .= 'PRIMARY KEY (`id`)) ENGINE = InnoDB;';

			if (mysqli_query($link, $designedCreateTableQuery)) {

				$successModal = "addClassSuccessModal";

				header('Refresh: 2; URL=../HomePage');

			}
		}


	}
	
}

if (array_key_exists('logoutAddClass', $_POST)){


	unset($_SESSION);
	unset($_COOKIE);
	setcookie(session_name(), "", time() - 60*60, "/");
	setcookie("id", "", time() - 60*60, "/");

	header("Location: ../Logout");

}
?>