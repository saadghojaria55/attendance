<?php
	session_start();

	if (array_key_exists("id", $_COOKIE)) {
		$_SESSION['id'] = $_COOKIE['id'];
	}

	if (!array_key_exists("id", $_SESSION) && !array_key_exists("id", $_COOKIE)){

		header("Location: ../SignIn");
	
	}

//Unset last used variables
	unset($_SESSION['attendanceOf']);
	unset($_SESSION['numberOfStudents']);

	include('../commons/connection.php');
	include('UIfromDBcreator.php');
	include('formValidation.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Home</title>

		<link rel="stylesheet" href="../commons/API/Bootstrap 4.0/css/bootstrap-lumen.css">
		<link rel="stylesheet" href="HomePageCSS.css">
		<link rel="stylesheet" href="../commons/API/fontawesome/css/fontawesome-all.min.css">

		<script src="../commons/API/jquery-3.3.1.min.js"></script>
		<script src="../commons/API/popper.min.js"></script>
		<script src="../commons/API/Bootstrap 4.0/js/bootstrap.min.js"></script>
		<script src="HomePageJS.js"></script>
		<script type="text/javascript">
			<?php if(isset($modalToShow)){echo"$(document).ready(function() { $('#".$modalToShow."').modal('show'); });";} ?>
		</script>
	</head>
	<body>
		
		<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="../">Easy Attendance.com</a>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<form method="post">
								<button type="submit" class="btn btn-danger" name="logoutHomePage">Logout</button>
							</form>
						</li>
					</ul>
			</div>
		</nav>
		<div class="main-content" id="main-div">
			<br><br><br><br>
			<div class="container-fluid d-flex justify-content-center">
				<div id="form-div" class="col-xl-12">
						<div class="row">
							<div class="col-lg-8" id="headingDiv">
								<h1 id="heading" class="display-3">Welcome <?= $firstName ?>!</h1>
								<img src="<?=$teacherPic ?>" class="img-thumbnail profilePic">
							</div>
						</div>
						<br>
<!-- My classes  modal  -->
						<div class="modal fade" id="myClassesModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<form method="post">
										<div class="modal-header">
											<h3 class="modal-title">Select a class to view historical data</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<div class="emptyArea">
													<?php if(isset($emptyAreaMessage)){echo($emptyAreaMessage);}; ?>
												</div>
												<?=$designedMyClasses?></div>
												<div class="invalidText smallText">
													<?php if(isset($historyOfError)){echo($historyOfError);}; ?>
												</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="viewHistory" class="btn btn-primary" <?php if(isset($buttonDisabled)){echo($buttonDisabled);}; ?>>View History</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
						</div>
<!-- Roll call modal  -->
						<div class="modal fade" id="rollCallModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<form method="post">
										<div class="modal-header">
											<h3 class="modal-title">Select class to take attendance of </h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											  <span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<div class="emptyArea">
													<?php if(isset($emptyAreaMessage)){echo($emptyAreaMessage);}; ?>
												</div>
												<?= $designedRollCallClasses ?></div>
												<div class="invalidText smallText">
													<?php if(isset($attendanceOfError)){echo($attendanceOfError);}; ?>
												</div>
										</div>

										<div class="modal-footer">
											<button type="submit" name="takeAttendance" class="btn btn-primary" <?php if(isset($buttonDisabled)){echo($buttonDisabled);}; ?>>Take Attendance</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
						</div>
<!-- Remove class modal  -->
						<div class="modal fade" id="removeClassModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<form method="post" onsubmit="return confirm('Are you sure you remove this class?');">
										<div class="modal-header">
											<h3 class="modal-title">Select classes to remove</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<div class="emptyArea">
													<?php if(isset($emptyAreaMessage)){echo($emptyAreaMessage);}; ?>
												</div>
												<div class="custom-control custom-checkbox">
												<?= $designedRemoveClassClasses ?></div>
											</div>
											<div class="invalidText smallText">
												<?php if(isset($removeError)){echo($removeError);}; ?>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" name="removeClassButton" <?php if(isset($buttonDisabled)){echo($buttonDisabled);}; ?>>Remove class</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
						</div>
<!-- Remove class sucessful modal  -->
						<div class="modal fade" id="removeClassSuccessModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title">Successfully removed class!</h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
<!-- Add class modal  -->
						<div class="modal fade" id="addClassModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<form method="post">
										<div class="modal-header">
											<h3 class="modal-title">Add Class</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label class="col-form-label" for="inputDefault">Name of class:</label>
												<input type="text" class="form-control <?php if(isset($classNameErrorClass)){echo($classNameErrorClass);}; ?>" placeholder="Enter name of class" id="className" name="className" required="yes" minlength="2" maxlength="15">
												<div class="invalid-feedback smallText">
													<?php if(isset($errorMsgClassName)){echo($errorMsgClassName);}; ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-form-label" for="inputDefault">Number of students in class (max 120): </label>
												<input type="number" class="form-control <?php if(isset($numberOfStudentsErrorClass)){echo($numberOfStudentsErrorClass);}; ?>" placeholder="Enter number of students in class" id="numberOfStudents" name="numberOfStudents" min="1" max="120" required="yes" maxlength="3" oninput="this.value=this.value.slice(0,this.maxLength);" onkeyup="this.value = minmax(this.value, 1, 120);">
												<div class="invalid-feedback smallText">
													Students could be 1 to 120 in number.
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" name="addClass">Add class</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
						</div>
<!-- Edit class  modal  -->
						<div class="modal fade" id="editModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<form method="post">
										<div class="modal-header">
											<h3 class="modal-title">Add students to class</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body pl-4 pr-4">
											<div class="form-group">
												<div class="emptyArea">
													<?php if(isset($emptyAreaMessage)){echo($emptyAreaMessage);}; ?>
												</div>
											</div>
											<div class="form-group>
												<label class="col-form-label" for="inputDefault">Number of students to add: </label>
												<input type="number" class="form-control <?php if(isset($numberOfStudentstoAddErrorClass)){echo($numberOfStudentstoAddErrorClass);}; ?>" placeholder="Enter number of students to add" id="numberOfStudentstoAdd" name="numberOfStudentstoAdd" min="1" max="120" maxlength="3" oninput="this.value=this.value.slice(0,this.maxLength);" onkeyup="this.value = minmax(this.value, 1, 119);">
												<div class="invalid-feedback smallText">
													<?php if(isset($numberOfStudentstoAddError)){echo($numberOfStudentstoAddError);}; ?>
												</div>
											</div>
											<br><br>
											<div class="form-group">
												<h5>Select class to <span id="removeOrAddText">add</span> students <span id="fromOrInText">in</span></h5>
												<?=$designedEditClass?>
												<div class="invalidText smallText">
													<?php if(isset($editClassNameError)){echo($editClassNameError);}; ?>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="editClass" class="btn btn-primary" <?php if(isset($buttonDisabled)){echo($buttonDisabled);}; ?>><span id="addOrRemoveButtonText">Add</span> Students</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
						</div>


<!-- Support modal  -->
						<div class="modal fade" id="supportModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<form method="post">
										<div class="modal-header">
											<h3 class="modal-title">Contact Support</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label class="col-form-label" for="supportSubject">Subject:</label>
												<input type="text" id="supportSubject" name="supportSubject" class="form-control <?php if(isset($supportSubjectClass)){echo($supportSubjectClass);}; ?>" placeholder="Enter subject" value="<?php if(isset($supportSubject)){echo($supportSubject);}; ?>">
												<div class="invalid-feedback smallText">
													<?php if(isset($supportSubjectError)){echo($supportSubjectError);}; ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-form-label" for="supportMessage">Message: </label>
												<textarea class="form-control <?php if(isset($supportMessageClass)){echo($supportMessageClass);}; ?>" id="supportMessage" name="supportMessage" rows="4" placeholder="Report bugs, make enquiries, etc."><?php if(isset($supportMessage)){echo($supportMessage);}; ?></textarea>
												<div class="invalid-feedback smallText">
													<?php if(isset($supportMessageError)){echo($supportMessageError);}; ?>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" name="supportAsked">Send</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
						</div>
<!-- Support message sent modal  -->
						<div class="modal fade" id="supportMessageSentModal">
						  <div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h2 class="modal-title">Message succesfully sent!</h2>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
								<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							  </div>
							  </div>
							</div>
						  </div>
						 </form>
						<div class="row" id="contentDiv">
							<div class="col-lg-3 optionDivs rollCall responsiveButton" >
								<a data-toggle="modal" data-target="#rollCallModal"><span></span></a>
								<i class="fas fa-list-ol largeIcon"></i>
								<div class="bottomLabel rollCallLabel">Roll Call</div>
							</div>
							<div class="col-lg-3 optionDivs myClasses responsiveButton">
								<a data-toggle="modal" data-target="#myClassesModal"><span></span></a>
								<i class="fas fa-users largeIcon"></i>
								<div class="bottomLabel myClassesLabel">My Classes</div>
							</div>
							<div class="col-lg-3 optionDivs addClass responsiveButton">
								<a data-toggle="modal" data-target="#addClassModal"><span></span></a>
								<i class="fas fa-user-plus largeIcon"></i>
								<div class="bottomLabel addClassLabel">Add Class</div>
							</div>
							<div class="col-lg-3 optionDivs removeClass responsiveButton">
								<a data-toggle="modal" data-target="#removeClassModal"><span></span></a>
								<i class="fas fa-user-times largeIcon"></i>
								<div class="bottomLabel removeClassLabel">Remove Class</div>
							</div>
							<div class="col-lg-3 optionDivs editClass responsiveButton">
								<a data-toggle="modal" data-target="#editModal"><span></span></a>
								<i class="fas fa-edit largeIcon"></i>
								<div class="bottomLabel editClassLabel">Edit Class</div>
							</div>
							<div class="col-lg-3 optionDivs support responsiveButton">
								<a href="../contactus.html"><span></span></a>
								<i class="fas fa-medkit largeIcon"></i>
								<div class="bottomLabel supportLabel">Support</div>
							</div>
						</div>
					</div>
				</div>
				<br><br>
			</div>
		</div>
	</body>
</html>