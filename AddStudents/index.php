<?php 

session_start();
include('../commons/connection.php');
include('UIcreator.php');




?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Add Students to Class</title>

		<link rel="stylesheet" href="../commons/API/Bootstrap 4.0/css/bootstrap-lumen.css">
		<link rel="stylesheet" href="AddStudentsCSS.css">
		<link rel="stylesheet" href="../commons/API/fontawesome/css/fontawesome-all.min.css">

		<script src="../commons/API/jquery-3.3.1.min.js"></script>
		<script src="../commons/API/popper.min.js"></script>
		<script src="../commons/API/Bootstrap 4.0/js/bootstrap.min.js"></script>
		<script src="AddStudentsJS.js"></script>
		<script type="text/javascript">
			<?php if(isset($successOrFailModal)){echo"$(document).ready(function() { $('#".$successOrFailModal."').modal('show'); });";} ?>
		</script>
	</head>
	<body>
		<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="../">Easy Attendance.com</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" style="cursor: pointer;" onclick="homeClicked();">Home</a>
						</li>
						<form method="post" onsubmit="return confirm('Students would not be added. Do you really want to logout?');">
							<button type="submit" class="btn btn-danger	ml-md-4" name="logoutAddStudents">Logout</button>
						</form>
					</ul>
				</div>
			</div>
		</nav>
		<div class="main-content" id="main-div">
			<br><br><br><br>
			<div class="container-fluid d-flex justify-content-center">
				<div id="form-div" class="col-xl-12">
					<div class="row">
						<div class="col-lg-12" id="headingDiv">
							<h1 id="heading" class="display-3">Add Students to TYBSCIT !</h1>
						</div>
					</div>
					<br>
<!-- Add students sucessful modal  -->
					<div class="modal fade" id="addStudentsSuccessModal">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h2 class="modal-title text-dark"><?php if(isset($successOrFailText)){echo $successOrFailText; }?></h2>
								</div>
								<div class="modal-footer">
							  	</div>
							</div>
						</div>
					</div>
					<form method="post">
						<div class="row" id="contentDiv">
							<?=$designedInputBoxes ?>
						</div>
						<div class="row" id="buttonDiv">
							<input type="submit" id="submitButton" name="submit" class="btn btn-primary btn-lg mx-auto d-block" value="Submit">
						</div>
					</form>
				</div>
			</div>
			<br><br>
		</div>
	</body>
</html>