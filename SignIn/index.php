<?php
	
	session_start();

	if (array_key_exists("id", $_COOKIE)) {
		$_SESSION['id'] = $_COOKIE['id'];
	}

	if (array_key_exists("id", $_SESSION) || array_key_exists("id", $_COOKIE)){

		header("Location: ../HomePage");
	}
	
	include('../commons/connection.php');
	include('DBqueries.php');


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Teacher Sign In</title>

		<link rel="stylesheet" href="../commons/API/Bootstrap 4.0/css/bootstrap.min.css">
		<script src="../commons/API/jquery-3.3.1.min.js"></script>
		<script src="../commons/API/Bootstrap 4.0/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="SignInCSS.css">

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
							<a class="nav-link activeLink" href="">Sign In</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="main-content" id="main-div">
			<br><br><br><br><br><br>
			<div class="container-fluid d-flex justify-content-center">
				<div id="form-div" class="col-lg-8">
					<h1 id="heading" class="display-3">Teacher Sign In</h1><br>
					<form class="offset-lg-2" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<div class="row nomarginleft">
								<div id="username" class="col-lg-8">
									<label for="username">Username:</label>
									<input type="text" class="form-control <?php if(isset($errorClassOfusername)){echo($errorClassOfusername);}; ?>" id="username" name="username" placeholder="Username" minlength="6" maxlength="50" required="yes" value="<?php if(isset($username)){echo($username);}; ?>">
									<div class="form-control-feedback invalid-feedback smallText" id="usernameFeedback">
										<?php if(isset($errorUsername)){echo($errorUsername);}; ?>
									</div>
								</div>
								<br>
							</div>
						</div>
						<div class="form-group">
							<div class="row nomarginleft">
								<div class="col-lg-8" id="passwordDiv">
									<label class="hiddenLabel" id="passwordLabel" for="password">Password:</label>
									<input type="password" class="form-control <?php if(isset($errorClassOfpassword)){echo($errorClassOfpassword);}; ?>" id="password" name="password" placeholder="Password" minlength="6" maxlength="15" required="yes">
									<div class="form-control-feedback invalid-feedback smallText" id="passwordFeedback">
										<?php if(isset($errorPassword)){echo($errorPassword);}; ?>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group row offset-sm-2">
							<div class="col-lg-8">
								<div class="custom-control custom-checkbox">
									<div class="custom-control custom-checkbox checkboxDiv">
										<input class="custom-control-input" id="stayLoggedIn" name="stayLoggedIn" type="checkbox" value="1">
										<label class="custom-control-label" for="stayLoggedIn">
											Stay Logged In
										</label>
									</div>
								</div>
							</div>
						</div>
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
		 <script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-database.js"></script>
    <script src="signinapp.js"></script>
	</body>
</html>