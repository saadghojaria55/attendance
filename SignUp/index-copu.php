<?php
	session_start();

	if (array_key_exists("id", $_COOKIE)) {
		$_SESSION['id'] = $_COOKIE['id'];
	}

	if (array_key_exists("id", $_SESSION) || array_key_exists("id", $_COOKIE)){

		header("Location: ../HomePage");
	}
	
	include('formValidation.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Teacher Registration Form</title>

		<link rel="stylesheet" href="../commons/API/Bootstrap 4 alpha6/css/bootstrap.min.css">
		<link rel="stylesheet" href="../commons/API/jquery-ui.min.css">
		
		   
		<script src="../commons/API/jquery-3.3.1.min.js"></script>
		<script src="../commons/API/Tether/tether.min.js"></script>
		<script src="../commons/API/Bootstrap 4 alpha6/js/bootstrap.min.js"></script>
		
		<script src="../commons/API/jquery-ui.min.js" type="text/javascript"></script>

		<script src="SignUpJQ.js"></script>
		<script src="SignUpJS.js"></script>

		<link rel="stylesheet" href="SignUpCSS.css">
		</head>
	<body>
		<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top" id="mainNav">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand js-scroll-trigger" href="../">Easy Attendance.com</a>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					
					<li class="nav-item">
						<a class="nav-link" href="../">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="">Sign Up</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../SignIn">Sign In</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="main-content" id="main-div">
			<br><br><br><br>
			<div class="container-fluid d-flex justify-content-center">
				<div id="form-div" class="col-xl-11">
					<h1 id="heading" class="display-3 offset-md-1">Teacher Registration</h1><br>
					<form method="post" id="mainform" enctype="multipart/form-data" >
						<div class="form-group">	
							<div class="row nomarginleft">
								<div id="firstNameDiv" class="col-md-4">
									<label for="firstName">Name:</label>
									<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" maxlength="15" onblur="firstNameCheck(this.value);" onkeydown="copyPasteHappeningReset(event); keyDownCheckForCapitalize(event,this.id, this.value);" onkeyup="javascript:keyUpCheckForCapitalize(event,this.id, this.value);" onkeypress="preventNonAlphabets(event)" onpaste="preventNonAlphabetPaste(event, this.id);" value="<?php if(isset($firstName)){echo($firstName);}; ?>">
									<div class="form-control-feedback smallText" id="firstNameFeedback">
										<?php if(isset($errorFirstName)){echo($errorFirstName);}; ?>
									</div>
								</div>
								<div class="col-md-4" id="lastNameDiv">
									<label class="hiddenLabel" id="lastNameLabel" for="lastName">Last Name</label>
									<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" maxlength="15" onblur="lastNameCheck(this.value)" onkeydown="copyPasteHappeningReset(event); keyDownCheckForCapitalize(event,this.id, this.value);" onkeyup="javascript:keyUpCheckForCapitalize(event,this.id, this.value);" onkeypress="preventNonAlphabets(event)" onpaste="preventNonAlphabetPaste(event, this.id);" value="<?php if(isset($lastName)){echo($lastName);}; ?>">
									<div class="form-control-feedback smallText" id="lastNameFeedback">
										<?php if(isset($errorLastName)){echo($errorLastName);}; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" id="fileDiv">
							<label id="fileLabel" class="custom-file-upload" for="teacherPic">
								<img class="form-group" id="filePreview"> 
								<small id="fileHelp" class="form-text text-muted"><br><br>&nbsp;&nbsp;&nbsp;Select a recent passport size&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;photograph of the teacher.</small>
								<input type="file" class="form-control-file" id="teacherPic" name="teacherPic" aria-describedby="fileHelp" accept="image/gif, image/jpeg, image/jpg, image/png" onchange="readFile(this);">
							</label>
							<div class="form-control-feedback smallText" id="teacherPicFeedback">
								<?php if(isset($errorTeacherPic)){echo($errorTeacherPic);}; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="row nomarginleft">
								<div class="col-sm-5">
									<label><span>Gender: </span></label><br>
									<div class="form-radio-buttons form-check-inline">
										<label class="custom-control custom-radio">
										    <input type="radio" class="custom-control-input" name="gender" id="male" value="male" onchange="filledOrNot('gender', this.value)" <?php if(isset($gender)){ if($gender == "male"){ echo 'checked'; }}; ?> >
										    <span class="custom-control-indicator"></span>
										    <span class="custom-control-description">Male</span>
										</label>

										<label class="custom-control custom-radio">
										    <input type="radio" class="custom-control-input" name="gender" id="female" value="female" onchange="filledOrNot('gender', this.value);" <?php if(isset($gender)){ if($gender == "female"){ echo 'checked'; }}; ?> >
										    <span class="custom-control-indicator"></span>
										    <span class="custom-control-description">Female</span>
										</label>

									</div>
									<div class="form-control-feedback smallText" id="genderFeedback">
										<?php if(isset($errorGender)){echo($errorGender);}; ?>
									</div>
								</div>



								<div class="col-sm-6" id="emailDiv">
									<label for="email">Email: </label>
									<input type="email" class="form-control" id="email" name="email" maxlength="25" placeholder="someone@example.com" style="text-transform:lowercase;"  onblur="emailCheck(this.value);" value="<?php if(isset($email)){echo($email);}; ?>">
									<div class="form-control-feedback smallText" id="emailFeedback">
										<?php if(isset($errorEmail)){echo($errorEmail);}; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row nomarginleft">
								<div class="col-sm-5" id="phoneDiv">
									<label for="phone">Phone: </label>
									<input type="tel" name="phone" id="phone" class="form-control" maxlength="10" placeholder="9548522475" onkeypress="preventNonNum(event)" onpaste="preventNonNumPaste(event, this.id);" onblur="phoneCheck(this.value);" value="<?php if(isset($phone)){echo($phone);}; ?>">
									<div class="form-control-feedback smallText" id="phoneFeedback">
										<?php if(isset($errorPhone)){echo($errorPhone);}; ?>
									</div>
								</div>
								<div class="col-sm-4" id="dobDiv">
									<label for="dob">Date Of Birth: </label>
									<input type="text" name="dob" id="dob" class="form-control" maxlength="10" placeholder="dd/mm/yyyy" onkeydown="insertSlashes(event,this.id, this.value)" onkeyup="insertSlashes(event,this.id, this.value)" onpaste="preventNonNumPaste(event, this.id); dobCheck(this.value);" onchange="dobCheck(this.value);"  value="<?php if(isset($dobPlain)){echo($dobPlain);}; ?>">
									<div class="form-control-feedback smallText" id="dobFeedback">
										<?php if(isset($errorDOB)){echo($errorDOB);}; ?>
									</div>
								</div>
							</div>
						</div>

						<div id="addressDiv" class="form-group col-md-10">
							<label for="address">Address: </label>
							<textarea class="form-control" id="address" name="address" rows="3" maxlength="150" placeholder="A-79A, Ground Floor, Hotel Savoy Suites, DSC Marg, Sector 16, Noida, Uttar Pradesh 201301"  onblur="addressCheck(this.value);"><?php if(isset($address)){echo($address);}; ?></textarea>
							<div class="form-control-feedback smallText" id="addressFeedback">
								<?php if(isset($errorAddress)){echo($errorAddress);}; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="row nomarginleft">
								<div class="col-sm-5" id="institutionTypeDiv">
									<label for="institutionType">Institution Type: </label>
									<select class="form-control" id="institutionType" name="institutionType" onchange="filledOrNot(this.id, this.value)">
										<option selected value="">Select Institution Type</option>
										<option value="School" <?php if(isset($institutionType)){ if($institutionType == "School"){ echo 'selected'; }}; ?>>Primary School</option>
										<option value="High School" <?php if(isset($institutionType)){ if($institutionType == "High School"){ echo 'selected'; }}; ?>>High School</option>
										<option value="SSC" <?php if(isset($institutionType)){ if($institutionType == "SSC"){ echo 'selected'; }}; ?>>Senior Secondary</option>
										<option value="Grauduate" <?php if(isset($institutionType)){ if($institutionType == "Grauduate"){ echo 'selected'; }}; ?>>Grauduation</option>
										<option value="Post Graduate" <?php if(isset($institutionType)){ if($institutionType == "Post Graduate"){ echo 'selected'; }}; ?>>Post Graduation</option>
									</select>

									<div class="form-control-feedback smallText" id="institutionTypeFeedback">
										<?php if(isset($errorInstitutionType)){echo($errorInstitutionType);}; ?>
									</div>
								</div>
								<div class="col-sm-5" id="institutionNameDiv">
									<label for="institutionName">Institution Name: </label>
									
									<select class="form-control" id="institutionName" name="institutionName" onchange="filledOrNot(this.id, this.value)">
										<option selected value="">Select Institution Name</option>
										<option value="OCM" <?php if(isset($institutionName)){ if($institutionName == "OCM"){ echo 'selected'; }}; ?>>OCM</option>
										<option value="Walia College" <?php if(isset($institutionName)){ if($institutionName == "Walia College"){ echo 'selected'; }}; ?>>Walia College</option>
									</select>
									<div class="form-control-feedback smallText" id="institutionFeedback">
										<?php if(isset($errorInstitutionName)){echo($errorInstitutionName);}; ?>
									</div>
								</div>
							</div>
						</div>
						<br><br><br>
						<div class="form-group">
							<div class="row nomarginleft">
								<div class="col-sm-5" id="usernameDiv">
									<label for="username">Set your username: </label>
									<input type="text" class="form-control" id="username" name="username" maxlength="12" placeholder="eg. rajesh123, priya99, etc." style="text-transform:lowercase;" onblur="usernameCheck(this.value);"  value="<?php if(isset($username)){echo($username);}; ?>">
									<div class="form-control-feedback smallText" id="usernameFeedback">
										<?php if(isset($errorUsername)){echo($errorUsername);}; ?>
									</div>
								</div>
								<div class="col-sm-3" id="passwordDiv">
									<label for="password">Set password:</label>
									<input type="password" class="form-control" id="password" name="password" maxlength="15" placeholder="Password" onblur="passwordCheck(this.value);">
									<div class="form-control-feedback smallText" id="passwordFeedback">
										<?php if(isset($errorPassword)){echo($errorPassword);}; ?>
									</div>
								</div>
								<div class="col-sm-3" id="passwordMatchDiv">
									<label for="passwordMatch">Retype password:</label>
									<input type="password" class="form-control" id="passwordMatch" name="passwordMatch" maxlength="15" placeholder="Retype password" onblur="passwordMatchCheck(this.value);">
									<div class="form-control-feedback smallText" id="passwordMatchFeedback">
										<?php if(isset($errorPasswordMatch)){echo($errorPasswordMatch);}; ?>
									</div>
								</div>
							</div>
						</div>
						<br>
					<div class="form-control-feedback smallText" id="$unknownError">
						<?php if(isset($unknownError)){echo($unknownError);}; ?>
					</div>
						<input type="submit" id="submitButton" name="submit" class="btn btn-primary btn-lg offset-sm-5" onclick="this.value='Submitting ..'; this.form.submitbtn(); this.disabled='disabled';" value="Submit">