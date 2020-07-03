<?php

	session_start();

	if (!array_key_exists("id", $_SESSION)){

		header("Location: ../SignIn");
	}

	if (array_key_exists("id", $_SESSION) && (!array_key_exists("username", $_SESSION) || !array_key_exists("className", $_SESSION) || !array_key_exists("numberOfStudents", $_SESSION))){

		header("Location: ../HomePage");
	}

	include('../commons/connection.php');
	include('generation.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Home</title>

		<link rel="stylesheet" href="../commons/API/Bootstrap 4.0/css/bootstrap-lumen.css">
		<link rel="stylesheet" href="AddClassCSS.css">

		<script src="../commons/API/jquery-3.3.1.min.js"></script>
		<script src="../commons/API/popper.min.js"></script>
		<script src="../commons/API/Bootstrap 4.0/js/bootstrap.min.js"></script>
		<script src="AddClassJS.js"></script>
		<script src="AddClassJQ.js"></script>
		<script type="text/javascript">
			<?php if(isset($successModal)){echo"$(document).ready(function() { $('#".$successModal."').modal('show'); });";} ?>
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
						<form method="post" onsubmit="return confirm('Class would not be added. Do you really want to logout?');">
							<button type="submit" class="btn btn-danger	ml-md-4" name="logoutAddClass">Logout</button>
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
							<div class="col-lg-8" id="headingDiv">
								<h1 id="heading" class="display-3">Add Students in <?=$className ?>!</h1>
							</div>
						</div>
						<br>
<!-- Add class sucessful modal  -->
						<div class="modal fade" id="addClassSuccessModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title text-dark">Successfully added class!</h2>
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
		</div>
	</body>
</html>