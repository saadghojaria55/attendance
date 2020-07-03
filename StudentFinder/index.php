<?php
	
	include('../commons/connection.php');
	include('DBqueries.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Student's Attendance Finder</title>

		<link rel="stylesheet" href="../commons/API/Bootstrap 4.0/css/bootstrap.min.css">
		<script src="../commons/API/jquery-3.3.1.min.js"></script>
		<script src="../commons/API/Bootstrap 4.0/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="StudentFinderCSS.css">

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
							<a class="nav-link" href="../">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../SignUp">Sign Up</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../SignIn">Sign In</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger active">Student's</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="main-content" id="main-div">
			<br><br><br><br><br><br>
			<div class="container-fluid d-flex justify-content-center">
				<div id="form-div" class="col-lg-8">
					<h1 id="heading" class="display-3">Attendance Finder</h1><br>
					<form class="offset-lg-2" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<div class="row nomarginleft">
								<div id="studentID" class="col-lg-8">
									<label for="studentID">Student ID:</label>
									<input type="text" class="form-control <?php if(isset($errorClassOfStudentID)){echo($errorClassOfStudentID);}; ?>" id="studentID" name="studentID" placeholder="Enter Student ID" minlength="3" maxlength="25" required="yes" value="<?php if(isset($studentID)){echo($studentID);}; ?>">
									<div class="form-control-feedback invalid-feedback smallText" id="studentIDFeedback">
										<?php if(isset($errorStudentID)){echo($errorStudentID);}; ?>
									</div>
								</div>
								<br>
							</div>
						</div>
						<br><br>
						<div class="form-group row">
    						<div class="col-lg-8">
								<input type="submit" id="submitButton" name="submit" class="btn btn-primary btn-lg offset-sm-5" value="Submit">
							</div>
						</div>

					</form>
					<br>
				</div>
			</div>
		</div>
	</body>
</html>