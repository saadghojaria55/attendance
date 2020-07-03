<?php
	session_start();

	if (array_key_exists("id", $_COOKIE)) {
		$_SESSION['id'] = $_COOKIE['id'];
	}

	if (!array_key_exists("id", $_SESSION)){

		header("Location: ../SignIn");
	}

	if (array_key_exists("id", $_SESSION) && (!array_key_exists("username", $_SESSION) || !array_key_exists("attendanceOf", $_SESSION))){

		header("Location: ../HomePage");
	}

	include('../commons/connection.php');
	include('UIcreator.php');
	include('DBquerier.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Take Attendance</title>

		<link rel="stylesheet" href="../commons/API/Bootstrap 4.0/css/bootstrap-lumen.css">
		<link rel="stylesheet" href="TakeAttendance.css">

		<script src="../commons/API/jquery-3.3.1.min.js"></script>
		<script src="../commons/API/popper.min.js"></script>
		<script src="../commons/API/Bootstrap 4.0/js/bootstrap.min.js"></script>
		<script src="TakeAttendanceJS.js"></script>
		<script src="TakeAttendanceJQ.js"></script>
		<script type="text/javascript">
			<?php if(isset($modalToShow)){echo"$(document).ready(function() { $('#".$modalToShow."').modal('show'); });";} ?>
		</script>
	</head>
	<body>
		<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="../">Easy Attendance.com</a>
					<ul class="navbar-nav ml-auto">
						<form method="post" onsubmit="return confirm('Attendance would not be saved. Are you sure you want to logout?');">
							<button type="submit" class="btn btn-danger" name="logoutTakeAttendance">Logout</button>
						</form>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Attendance sucessful modal  -->
		<div class="modal fade" id="attendanceSaveModal">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title text-dark">
							<?php if(isset($successOrErrorMessage)){echo($successOrErrorMessage);}; ?>
						</h2>
					</div>
					<div class="modal-footer">
				  	</div>
				</div>
			</div>
		</div>


		<div class="main-content" id="main-div">
			<br><br><br><br>
			<div class="container-fluid d-flex justify-content-center">
				<div id="form-div" class="col-xl-12">
					<div class="form-group">	
						<div class="row nomarginleft">
							<div class="col-lg-8" id="headingDiv">
								<h1 id="heading" class="display-3 offset-md-1">Attendance of <?=$attendanceOf?></h1><br>
							</div>
							<div class="col-lg-4" id="toolbox">
								<input type="checkbox" name="allAbsentOrPresent" id="allAbsentOrPresent" onchange="allAbsent(this.id);">
								<label id="allAbsentOrPresentLabel" for="allAbsentOrPresent"  class="responsiveButton" style="color: white;" data-toggle="tooltip" data-placement="top" title="" data-original-title="All Absent"></label>
								<input type="email" class="spacer">
								<label id="saveButtonLabel" for="saveButton" style="color: white;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Save">
									<input type="image" name="saveButton" id="saveButton" class="saveAndCloseIcons responsiveButton" src="../commons/images/save.svg" onclick="saveButtonClicked();">
								</label>
								<input type="email" class="spacer">
								<label id="closeButtonLabel" for="closeButton" style="color: white;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel">
								<input type="image" name="closeButton" id="closeButton" class="saveAndCloseIcons responsiveButton" src="../commons/images/close.svg" onclick="closeButtonClicked();">
								</label>
							</div>
						</div>
					</div>

					<form id="mainForm" method="post">

						<?=$designedAttendanceButtons?></div>
						
						<input type="hidden" name="submitCliked">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>