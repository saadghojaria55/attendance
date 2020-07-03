<?php
	session_start();

	if (array_key_exists("id", $_COOKIE)) {
		$_SESSION['id'] = $_COOKIE['id'];
	}

	if (!array_key_exists("id", $_SESSION)){

		header("Location: ../SignIn");
	}

	if (array_key_exists("id", $_SESSION) && (!array_key_exists("username", $_SESSION) || !array_key_exists("historyOf", $_SESSION))){

		header("Location: ../HomePage");
	}

	include('../commons/connection.php');
	include('dataThrower.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Class History</title>

		<link rel="stylesheet" href="../commons/API/Bootstrap 4.0/css/bootstrap-lumen.css">
		<link rel="stylesheet" href="ArchiveCSS.css">

		<script src="../commons/API/jquery-3.3.1.min.js"></script>
		<script src="../commons/API/popper.min.js"></script>
		<script src="../commons/API/Bootstrap 4.0/js/bootstrap.min.js"></script>
		<script src="../commons/API/canvasjs.min.js"></script>
		<script src="ArchiveJS.js"></script>
		<script type="text/javascript">
			<?php if(isset($modalToShow)){echo"$(document).ready(function() { $('#".$modalToShow."').modal('show'); });";} ?>
		</script>
		<script src="ArchiveJQ.js"></script>
		<script>
		window.onload = function () {
		 
		
		CanvasJS.addColorSet("customColorSet", [ 
			"#e05850",
			"#9bbb58",
		]);

		var allStudentsInWeek = new CanvasJS.Chart("allStudentsInWeekChart", {
			animationEnabled: true,
			exportEnabled: true,

			theme: "theme2", // "light1", "light2", "dark1", "dark2"
			title:{
			},
			axisX: {
				labelFontSize: 14,
				title: "Roll Numbers",
				titleFontColor: "#065f66",
				titleFontSize: "23"
			},
			axisY: {
				labelFontSize: 14,
				title: "Percentage Of Days Present",
				suffix: "%",
				titleFontColor: "#065f66",
				titleFontSize: "20"

			},
			toolTip: {
				content:"{z} : {y}%",
				borderThickness: 0,
				cornerRadius: 0
			},
			data: [{
				type: "column", //change type to bar, line, area, pie, etc
				indexLabel: "{y}%", //Shows y value on all Data Points
				indexLabelFontColor: "#5A5757",
				indexLabelPlacement: "outside",   
				dataPoints: <?php echo json_encode($weekGraphData, JSON_NUMERIC_CHECK); ?>
			}]
		});
		allStudentsInWeek.render();
		  
		var averageStudentsInWeek = new CanvasJS.Chart("averageStudentsInWeekChart", {
			animationEnabled: true,
			theme: "theme2",
			colorSet: "customColorSet",
			exportEnabled: true,
			title:{
			},
			subtitles: [{
			}],
			 legend:{
				fontSize: 16,
			 },
			data: [{
				type: "pie",
				showInLegend: "true",
				legendText: "{label}",
				indexLabel: "{label} - #percent%",
				percentFormatString: "#0.##",
				toolTipContent: "{label} (#percent%)",
				indexLabelFontSize: 16,
				dataPoints: <?php echo json_encode($weekPieData, JSON_NUMERIC_CHECK); ?>
			}]
		});
		averageStudentsInWeek.render();

		var allStudentsInMonth = new CanvasJS.Chart("allStudentsInMonthChart", {
			animationEnabled: true,
			exportEnabled: true,

			theme: "theme2", // "light1", "light2", "dark1", "dark2"
			title:{
			},
			axisX: {
				labelFontSize: 14,
				title: "Roll Numbers",
				titleFontColor: "#065f66",
				titleFontSize: "23"
			},
			axisY: {
				labelFontSize: 14,
				title: "Percentage Of Days Present",
				suffix: "%",
				titleFontColor: "#065f66",
				titleFontSize: "20"

			},
			toolTip: {
				content:"{z} : {y}%",
				borderThickness: 0,
				cornerRadius: 0
			},
			data: [{
				type: "column", //change type to bar, line, area, pie, etc
				indexLabel: "{y}%", //Shows y value on all Data Points
				indexLabelFontColor: "#5A5757",
				indexLabelPlacement: "outside",   
				dataPoints: <?php echo json_encode($monthGraphData, JSON_NUMERIC_CHECK); ?>
			}]
		});
		allStudentsInMonth.render();

		var averageStudentsInMonth = new CanvasJS.Chart("averageStudentsInMonthChart", {
			animationEnabled: true,
			theme: "theme2",
			colorSet: "customColorSet",
			exportEnabled: true,
			title:{
			},
			subtitles: [{
			}],
			 legend:{
				fontSize: 16,
			 },
			data: [{
				type: "pie",
				showInLegend: "true",
				legendText: "{label}",
				indexLabel: "{label} - #percent%",
				percentFormatString: "#0.##",
				toolTipContent: "{label} (#percent%)",
				indexLabelFontSize: 16,
				dataPoints: <?php echo json_encode($monthPieData, JSON_NUMERIC_CHECK); ?>
			}]
		});
		averageStudentsInMonth.render();

		var allStudentsInYear = new CanvasJS.Chart("allStudentsInYearChart", {
			animationEnabled: true,
			exportEnabled: true,

			theme: "theme2", // "light1", "light2", "dark1", "dark2"
			title:{
			},
			axisX: {
				labelFontSize: 14,
				title: "Roll Numbers",
				titleFontColor: "#065f66",
				titleFontSize: "23"
			},
			axisY: {
				labelFontSize: 14,
				title: "Percentage Of Days Present",
				suffix: "%",
				titleFontColor: "#065f66",
				titleFontSize: "20"

			},
			toolTip: {
				content:"{z} : {y}%",
				borderThickness: 0,
				cornerRadius: 0
			},
			data: [{
				type: "column", //change type to bar, line, area, pie, etc
				indexLabel: "{y}%", //Shows y value on all Data Points
				indexLabelFontColor: "#5A5757",
				indexLabelPlacement: "outside",   
				dataPoints: <?php echo json_encode($yearGraphData, JSON_NUMERIC_CHECK); ?>
			}]
		});
		allStudentsInYear.render();

		var averageStudentsInYear = new CanvasJS.Chart("averageStudentsInYearChart", {
			animationEnabled: true,
			theme: "theme2",
			colorSet: "customColorSet",
			exportEnabled: true,
			title:{
			},
			subtitles: [{
			}],
			 legend:{
				fontSize: 16,
			 },
			data: [{
				type: "pie",
				showInLegend: "true",
				legendText: "{label}",
				indexLabel: "{label} - #percent%",
				percentFormatString: "#0.##",
				toolTipContent: "{label} (#percent%)",
				indexLabelFontSize: 16,
				dataPoints: <?php echo json_encode($yearPieData, JSON_NUMERIC_CHECK); ?>
			}]
		});
		averageStudentsInYear.render();
		}
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
							<a class="nav-link" href="../HomePage">Home</a>
						</li>
						<li class="nav-item">
							<form method="post">
								<button type="submit" class="btn btn-danger	ml-md-4" name="logoutArchive">Logout</button>
							</form>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="main-content" id="main-div">
		<br><br><br><br>
			<div class="container-fluid d-flex justify-content-center">
				<div id="contentDiv" class="col-xl-12">
//No records modal
					<div class="modal fade" id="noRecordsExist">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h2 class="modal-title text-dark">No records found for this class!</h2>
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
					<div class="row">
						<div class="col-lg-8">
							<h2 class="header">
								<span id="className" class="text-light"><?=$historyOf ?></span>
								<strong>This week</strong>
								<small class="text-muted"><?=$thisWeekName?></small>
							</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-3 mb-4" id="weekAttendanceDiv">
							<div class="card card-block">
								<h4 class="card-header">Attendance This Week</h4>
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-light text-center">
									  <?=$tableData?>
									
									</table>
								</div>
							</div>
						</div>
						<div class="col-xl-9" id="WeekChartsDiv">
							<div class="col-lg-12" id="allStudentsInWeekDiv">
								<div class="card card-block shadow" style="overflow: auto;">
									<h4 class="card-header">This Week's Percentage Attendance</h4>
									<div id="allStudentsInWeekChart" style="width: <?=$allStudentsInWeekChartWidth ?>px"></div>
								</div>
							</div>
							<br><br>
							<div class="col-lg-12" id="averageStudentsInWeekDiv">
								<div class="card card-block shadow">
									<h4 class="card-header">This Week's Average Attendance</h4>
									<div id="averageStudentsInWeekChart"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<h2 class="header">
								<strong>This month</strong>
								<small class="text-muted"><?=$thisMonthName?></small>
							</h2>
						</div>
					</div>
					<div class="row">
							<div class="col-lg-8" id="allStudentsInMonthDiv">
								<div class="card card-block shadow" style="overflow: auto;">
									<h4 class="card-header">This Month's Percentage Attendance</h4>
									<div id="allStudentsInMonthChart" style="width: <?=$allStudentsMonthChartWidth ?>px"></div>
								</div>
							</div>
							<br><br>
							<div class="col-lg-4" id="averageStudentsInMonthDiv">
								<div class="card card-block shadow">
									<h4 class="card-header">This Month's Average Attendance</h4>
									<div id="averageStudentsInMonthChart"></div>
								</div>
							</div>
					</div>
					<br><br>
					<div class="row">
						<div class="col-lg-8">
							<h2 class="header">
								<strong>This year</strong>
								<small class="text-muted"><?=$todayIsYear?></small>
							</h2>
						</div>
					</div>
					<div class="row">
							<div class="col-lg-8" id="allStudentsInYearDiv">
								<div class="card card-block shadow" style="overflow: auto;">
									<h4 class="card-header">This Year's Percentage Attendance</h4>
									<div id="allStudentsInYearChart" style="width: <?=$allStudentsYearChartWidth ?>px"></div>
								</div>
							</div>
							<br><br>
							<div class="col-lg-4" id="averageStudentsInYearDiv">
								<div class="card card-block shadow">
									<h4 class="card-header">This Year's Average Attendance</h4>
									<div id="averageStudentsInYearChart"></div>
								</div>
							</div>
					</div>
					<br>
				</div>
			</div>
			<br>
		</div>
		<?php if(isset($modalToShow)){ echo($modalToShow); } ?>
	</body>
</html>