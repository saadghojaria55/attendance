<?php

include('commons/connection.php');


if (array_key_exists('createUsersDB', $_POST)) {

	$query = "CREATE DATABASE usersdb;";

	if (mysqli_query($link, $query)) {
		
		$createUsersDBOutput = "<font color='#28a745'>usersdb successfully created.</font>"; 

	} else {

		$createUsersDBOutput = "<font color='#dc3545'>Failed to create usersdb.</font>";

	}
}

if (array_key_exists('createUserlistTable', $_POST)) {

	$query = "CREATE TABLE `usersdb`.`userlist`(`id` INT NOT NULL AUTO_INCREMENT, `firstName` VARCHAR(20) NOT NULL, `lastName` VARCHAR(20) NOT NULL, `teacherPic` TEXT NOT NULL, `gender` VARCHAR(7) NOT NULL, `email` VARCHAR(30) NOT NULL, `phone` INT NOT NULL, `dob` DATE NOT NULL, `institutionName` VARCHAR(30) NOT NULL, `institutionType` VARCHAR(30) NOT NULL, `address` TEXT NOT NULL, `username` VARCHAR(15) NOT NULL, `password` VARCHAR(34) NOT NULL, PRIMARY KEY(`id`) ) ENGINE = InnoDB;";

	if (mysqli_query($link, $query)) {
		
		$createUserlistTableOutput = "<font color='#28a745'>Userlist table successfully created.</font>"; 

	} else {

		$createUserlistTableOutput = "<font color='#dc3545'>Failed to create userlist table.</font>"; 

	}
}

if (array_key_exists('createDemoUser', $_POST)) {

	$query = "INSERT INTO `usersdb`.`userlist`(`id`,`firstName`, `lastName`, `teacherPic`, `gender`, `email`, `phone`, `dob`, `institutionName`, `institutionType`, `address`, `username`, `password`) VALUES (1,'John', 'Doe','../uploads/demoToon.jpg','male','john@doe.com','9012345678','1990-01-01','OCM','Grauduate',' 445 Mount Eden Road, Mount Eden, Auckland', 'demouser', 'f290ca45b0dec2ec16cf3afcafbea6ac');";

	if (mysqli_query($link, $query)) {
		
		$query = 'CREATE DATABASE demouser;';
	
		if (mysqli_query($link, $query)) {

			$createDemoUserOutput = "<font color='#28a745'>Demo user created. username = <font size='6'>demouser</font>  password = <font size='6'>testing123</font> </font>"; 

		}else {

			$createDemoUserOutput = "<font color='#dc3545'>Failed to create demo user.</font>"; 

		}
	} else {

		$createDemoUserOutput = "<font color='#dc3545'>Failed to create demo user.</font>"; 
	}
}



if (array_key_exists('addDemoData', $_POST)) {

	$query = "CREATE TABLE `demouser`.`tybsc` ( `id` INT NOT NULL AUTO_INCREMENT , `dateofattendance` DATE NOT NULL , `s1` TINYINT(1) NOT NULL COMMENT 'Asad Sheikh' , `s2` TINYINT(1) NOT NULL COMMENT 'Saquib Alam' , `s3` TINYINT(1) NOT NULL COMMENT 'Sejal Trekar' , `s4` TINYINT(1) NOT NULL COMMENT 'Kavita Sahu' , `s5` TINYINT(1) NOT NULL COMMENT 'Prathamesh Parab' , `s6` TINYINT(1) NOT NULL COMMENT 'Anuj Singh' , `s7` TINYINT(1) NOT NULL COMMENT 'Atif Alam' , `s8` TINYINT(1) NOT NULL COMMENT 'Raman Kumar' , `s9` TINYINT(1) NOT NULL COMMENT 'Treyan Fernandes' , `s10` TINYINT(1) NOT NULL COMMENT 'Ghanshayam Yadav' , `s11` TINYINT(1) NOT NULL COMMENT 'Fatima Navarpalli' , `s12` TINYINT(1) NOT NULL COMMENT 'Saba Parween' , `s13` TINYINT(1) NOT NULL COMMENT 'Schezan Mansuri' , `s14` TINYINT(1) NOT NULL COMMENT 'Shubham Parab' , `s15` TINYINT(1) NOT NULL COMMENT 'Fehad Lone' ,  PRIMARY KEY (`id`)) ENGINE = InnoDB;";

	if (mysqli_query($link, $query)) {

		$random30dayDataInsertionQuery = "INSERT INTO `demouser`.`tybsc`(`dateofattendance`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `s7`, `s8`, `s9`, `s10`, `s11`, `s12`, `s13`, `s14`, `s15`) VALUES (";

		for ($i=30; $i >= 1 ; $i--) { 

			$dateObject = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
			$dateObject->sub(new DateInterval('P'.$i.'D'));
			$date = $dateObject->format('Y-m-d');

			$random30dayDataInsertionQuery .= "'".$date."'";

			for ($j=1; $j <= 15; $j++) { 
				
				$num = rand ( 0 , 1 );

				$random30dayDataInsertionQuery .= "," . $num ;

			}

			$random30dayDataInsertionQuery .= "),(" ;

		}
		
		$random30dayDataInsertionQuery = substr($random30dayDataInsertionQuery, 0, -2);

		$random30dayDataInsertionQuery .= ";" ;

		if (mysqli_query($link, $random30dayDataInsertionQuery)) {

			$addDemoDataOutput = "<font color='#28a745'>Random 30 days of data successfully inserted.</font>"; 

		} else {

			$addDemoDataOutput = "<font color='#dc3545'>Failed to insert data.</font>"; 

		}

	} else {

		$addDemoDataOutput = "<font color='#dc3545'>Failed to insert data.</font>"; 
	}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Initialiser</title>

		<link rel="stylesheet" href="commons/API/Bootstrap 4.0/css/bootstrap-lumen.css">

		<script src="commons/API/jquery-3.3.1.min.js"></script>
		<script src="commons/API/Bootstrap 4.0/js/bootstrap.min.js"></script>
		<style type="text/css">
			input[type="submit"]
			{
				font-size: 2em;
				width: 550px;
				margin-bottom: 40px;
			}
			p{
				font-size: 20px;
			}
		</style>
	</head>
	<body style="background-color: #212529;">
		<div class="main-content" id="main-div">
			<br><br>
			<div class="container-fluid d-flex justify-content-center">
				<div id="form-div" class="col-xl-12">
						<div class="row">
							<div class="col-lg-8" id="headingDiv">
								<h1 id="heading" class="display-3 text-light">Initialise Databases</h1>
							</div>
						</div>
						<br>
						<form method="post">
							<div class="row" id="usersDBdiv">
								<input type="submit" id="createUsersDB" name="createUsersDB" class="btn btn-primary mx-auto d-block" value="Create Users Database">
							</div>
							<div class="row" id="userlistdiv">
								<input type="submit" id="createUserlistTable" name="createUserlistTable" class="btn btn-primary mx-auto d-block" value="Create User List Table">
							</div>
							<div class="row" id="demoUserdiv">
								<input type="submit" id="createDemoUser" name="createDemoUser" class="btn btn-primary mx-auto d-block" value="Create Demo User">
							</div>
							<div class="row" id="userlistdiv">
								<input type="submit" id="addDemoData" name="addDemoData" class="btn btn-primary mx-auto d-block" value="Add Demo Data">
							</div>
							<div class="row" id="successOrErrordiv">
								<div class="createUsersDBOutputfeedback">
									<p><?php if(isset($createUsersDBOutput)){ echo $createUsersDBOutput; } ?></p>	
								</div>
								<div class="createUsersDBfeedback">
									<p><?php if(isset($createUsersDBfeedback)){ echo $createUsersDBfeedback; } ?></p>	
								</div>
								<div class="createUserlistTablefeedback">
									<p><?php if(isset($createUserlistTableOutput)){ echo $createUserlistTableOutput; } ?></p>	
								</div>
								<div class="createDemoUserfeedback">
									<p><?php if(isset($createDemoUserOutput)){ echo $createDemoUserOutput; }?></p>	
								</div>
								<div class="addDemoDatafeedback">
									<p><?php if(isset($addDemoDataOutput)){ echo $addDemoDataOutput; } ?></p>	
								</div>
							</div>
						</form>
					</div>
				</div>
				<br><br>
			</div>
		</div>
	</body>
</html>