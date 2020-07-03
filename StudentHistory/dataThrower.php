<?php

error_reporting(0);
ini_set('display_errors', 0);

if(!array_key_exists("id", $_SESSION) && !array_key_exists("teacherIDtoAccess", $_SESSION))
{

	header("Location: ../StudentFinder");

} else if ((!array_key_exists("sRoll", $_GET) || !array_key_exists("className", $_SESSION))  && (!array_key_exists("teacherIDtoAccess", $_SESSION) || !array_key_exists("classToAccess", $_SESSION) || !array_key_exists("sRollToAccess", $_SESSION)))
{

	header("Location: ../HomePage");


} else if ((array_key_exists("id", $_SESSION) && array_key_exists("className", $_SESSION) && array_key_exists("sRoll", $_GET)) || (array_key_exists("teacherIDtoAccess", $_SESSION) && array_key_exists("classToAccess", $_SESSION) && array_key_exists("sRollToAccess", $_SESSION)))
{

	if (array_key_exists("className", $_SESSION)) {

		$navCreation = '<li class="nav-item">
							<a class="nav-link" href="../HomePage">Home</a>
						</li>
						<form method="post">
							<button type="submit" class="btn btn-danger	ml-md-4" name="logoutStudentHistory">Logout</button>
						</form>';
		
		$id = $_SESSION['id'];
		$className = $_SESSION['className'];
		$sRoll = $_GET['sRoll'];

		$queryForMonth = "SELECT `username` FROM `usersdb`.`userlist` WHERE id=" .$id. ";" ;
		$result = mysqli_query($link, $queryForMonth);
		$usernameArray = mysqli_fetch_assoc($result);

		$username = $usernameArray['username'];
	
	} else if(array_key_exists("teacherIDtoAccess", $_SESSION)) {

		$id = $_SESSION['teacherIDtoAccess'];
		$className = $_SESSION['classToAccess'];
		$sRoll = $_SESSION['sRollToAccess'];

		$queryForMonth = "SELECT `username` FROM `usersdb`.`userlist` WHERE id=" .$id. ";" ;
		$result = mysqli_query($link, $queryForMonth);
		$usernameArray = mysqli_fetch_assoc($result);

		$username = $usernameArray['username'];

	}

	$query = "SELECT count(*) FROM `".$username."`.`".$className."`;";

	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);


	if ($row['count(*)'] < 1) {

		$modalToShow =  "<script type='text/javascript'>$(document).ready(function() { $('#noRecordsExist').modal('show'); });</script>";
		
		if ($_SESSION['id']) {
			header( "refresh:2; url=../HomePage" );
		} else {
			header( "refresh:2; url=../StudentFinder" );
		}

	} else {

		function binaryToAlphabet($value) {

			if ($value == 1) {
				return "<font color='#28a745'>P</font>";
			} else if ($value == 0) {
				return "<font color='#dc3545'>A</font>";
			}
		}

//Gettings dates and day
		$todayDateObject = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
		$todayDay = $todayDateObject->format('D');
		$todayDate = $todayDateObject->format('Y-m-d');


		$date1DayEarlierObject = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
		$date1DayEarlierObject->sub(new DateInterval('P1D'));
		$date1DayEarlier = $date1DayEarlierObject->format('Y-m-d');
		$day1DayEarlier = $date1DayEarlierObject->format('D');


		$date2DayEarlierObject = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
		$date2DayEarlierObject->sub(new DateInterval('P2D'));
		$date2DayEarlier = $date2DayEarlierObject->format('Y-m-d');
		$day2DayEarlier = $date2DayEarlierObject->format('D');


		$date3DayEarlierObject = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
		$date3DayEarlierObject->sub(new DateInterval('P3D'));
		$date3DayEarlier = $date3DayEarlierObject->format('Y-m-d');
		$day3DayEarlier = $date3DayEarlierObject->format('D');


		$date4DayEarlierObject = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
		$date4DayEarlierObject->sub(new DateInterval('P4D'));
		$date4DayEarlier = $date4DayEarlierObject->format('Y-m-d');
		$day4DayEarlier = $date4DayEarlierObject->format('D');


		$date5DayEarlierObject = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
		$date5DayEarlierObject->sub(new DateInterval('P5D'));
		$date5DayEarlier = $date5DayEarlierObject->format('Y-m-d');
		$day5DayEarlier = $date5DayEarlierObject->format('D');


		$date6DayEarlierObject = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
		$date6DayEarlierObject->sub(new DateInterval('P6D'));
		$date6DayEarlier = $date6DayEarlierObject->format('Y-m-d');
		$day6DayEarlier = $date6DayEarlierObject->format('D');

		$thisWeekStartMonth = $date6DayEarlierObject->format('M');
		$thisWeekStartDay = $date6DayEarlierObject->format('d');

		$thisWeekEndMonth = $todayDateObject->format('M');
		$thisWeekEndDay = $todayDateObject->format('d');

		$thisMonthName = $todayDateObject->format('F');
		$todayIsMonthNumber = $todayDateObject->format('m');
		$todayIsYear = $todayDateObject->format('Y');

		if ($thisWeekStartMonth == $thisWeekEndMonth) {
			$thisWeekName =  $thisWeekStartDay . "-" . $thisWeekEndDay . " " . $thisWeekEndMonth;
		} else {
			$thisWeekName = $thisWeekStartDay . " " . $thisWeekStartMonth . " - " . $thisWeekEndDay . " " . $thisWeekEndMonth;
		}


//Get names of students
		$queryToGetNames = "SELECT `COLUMN_COMMENT` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$username."' AND `TABLE_NAME`='".$className."'";

		$result = mysqli_query($link, $queryToGetNames);

		$x = 1;
		$y = 1;

		while($row = mysqli_fetch_assoc($result)) {
			

			if($y >= 3){

				${"s" . $x . "Name"} = $row["COLUMN_COMMENT"];

				
				if ($sRoll == $x) {

					$sRollName = $row["COLUMN_COMMENT"];

				}
				
				$x++;
			}
			$y++;
		}


		$tableData = '<thead>
													<tr>
													  <th scope="col">#</th>
													  <th scope="col" data-toggle="tooltip" data-placement="top" title="Unique Student ID" data-original-title="Unique Student ID">ID</th>
													  <th scope="col" data-toggle="tooltip" data-placement="top" title="'.$todayDate.'" data-original-title="'.$todayDate.'">Today</th>
													  <th scope="col" data-toggle="tooltip" data-placement="top" title="'.$date1DayEarlier.'" data-original-title="'.$date1DayEarlier.'">'.$day1DayEarlier.'</th>
													  <th scope="col" data-toggle="tooltip" data-placement="top" title="'.$date2DayEarlier.'" data-original-title="'.$date2DayEarlier.'">'.$day2DayEarlier.'</th>
													  <th scope="col" data-toggle="tooltip" data-placement="top" title="'.$date3DayEarlier.'" data-original-title="'.$date3DayEarlier.'">'.$day3DayEarlier.'</th>
													  <th scope="col" data-toggle="tooltip" data-placement="top" title="'.$date4DayEarlier.'" data-original-title="'.$date4DayEarlier.'">'.$day4DayEarlier.'</th>
													  <th scope="col" data-toggle="tooltip" data-placement="top" title="'.$date5DayEarlier.'" data-original-title="'.$date5DayEarlier.'">'.$day5DayEarlier.'</th>
													  <th scope="col" data-toggle="tooltip" data-placement="top" title="'.$date6DayEarlier.'" data-original-title="'.$date6DayEarlier.'">'.$day6DayEarlier.'</th>
													</tr>
												  </thead>
												  <tbody>';

		$query = "SELECT COUNT(*) FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$username."' AND `TABLE_NAME`='".$className."'";
		
		$result = mysqli_query($link, $query);

		$row = mysqli_fetch_assoc($result);
		$numberOfStudents = $row['COUNT(*)'] - 2;


		$querySelectWeekData = "SELECT `dateofattendance`,`s" . $sRoll . "` FROM `".$username."`.`".$className."` WHERE dateofattendance='".$todayDate."' OR dateofattendance='".$date1DayEarlier."' OR dateofattendance='".$date2DayEarlier."' OR dateofattendance='".$date3DayEarlier."' OR dateofattendance='".$date4DayEarlier."' OR dateofattendance='".$date5DayEarlier."' OR dateofattendance='".$date6DayEarlier."';";

		$result = mysqli_query($link, $querySelectWeekData);

		$numberOfdaysAttendanceTakenInWeek = mysqli_num_rows($result);

		while ($row = mysqli_fetch_assoc($result)){

			$users[$row['dateofattendance']] = $row['s'.$sRoll];

		}

		$tableData .= 	'
										<tr>
										  <th scope="row" data-toggle="tooltip" data-placement="top" title="'.${"s" . $sRoll . "Name"}.'" data-original-title="'.${"s" . $sRoll . "Name"}.'"><a href="../StudentHistory?sRoll='.$sRoll.'">'.$sRoll.'</th>';


		$IDsRoll = $id.$className.$sRoll;

		$tableData .= 	'
											<td>'.$IDsRoll.'</td>';

			for ($j=1; $j <= 7; $j++) { 

				if ($j == 1) {
					$dateToPut = $todayDate;
				} else {
					$correctDate = $j - 1;
					$dateToPut = ${"date" .$correctDate. "DayEarlier"};
				}

				if (array_key_exists($dateToPut,$users)) {

					$tableData .= 	'
											<td>'.binaryToAlphabet($users[$dateToPut]).'</td>';
				
				} else{

					$tableData .= 	'
											<td></td>';

				}
				
			}

			$tableData .= '
										</tr>
									  </tbody>';


//Week Graph

		$queryToGetWeekSum = "SELECT";
		$queryForMonth = "SELECT count(*),";

		for ($i=1; $i <= $numberOfStudents ; $i++) { 
			
			$queryToGetWeekSum .= " SUM(s" . $i . "), ";
			$queryForMonth .= " SUM(s" . $i . "), ";
		}

		$queryToGetWeekSum = substr($queryToGetWeekSum, 0, -2);
		$queryForMonth = substr($queryForMonth, 0, -2);


		$queryToGetWeekSum .= " FROM `".$username."`.`".$className."` WHERE `dateofattendance`='".$todayDate."' OR `dateofattendance`='".$date1DayEarlier."' OR `dateofattendance`='".$date2DayEarlier."' OR `dateofattendance`='".$date3DayEarlier."' OR `dateofattendance`='".$date4DayEarlier."' OR `dateofattendance`='".$date5DayEarlier."' OR `dateofattendance`='".$date6DayEarlier."';";

		$queryForYear = $queryForMonth . " FROM `".$username."`.`".$className."`  WHERE YEAR(`dateofattendance`) = ".$todayIsYear.";";
		
		$queryForMonth .= " FROM `".$username."`.`".$className."`  WHERE MONTH(`dateofattendance`) = ".$todayIsMonthNumber." AND YEAR(`dateofattendance`) = ".$todayIsYear.";";


		$sumForWeek = 0;

		$result = mysqli_query($link, $queryToGetWeekSum);

		while ($row = mysqli_fetch_assoc($result)) {

			for ($i=1; $i <= $numberOfStudents; $i++) {

				${'percentageS' .$i. 'week'} =  round(($row['SUM(s'.$i.')'])/$numberOfdaysAttendanceTakenInWeek*100);
				$sumForWeek += $row['SUM(s'.$i.')'];
			}

		}

		for ($i=1; $i <= $numberOfStudents; $i++) { 
			$percentageI = ${'percentageS' .$i. 'week'};
			$percentagesArrayWeek[$i] = $percentageI;
		}

		$maxPercentInWeek = max($percentagesArrayWeek);
		$minPercentInWeek = min($percentagesArrayWeek);

		for ($i=1; $i <= $numberOfStudents; $i++) {

			if ($i == $sRoll) {

				if ($maxPercentInWeek == ${'percentageS' .$i. 'week'}) {
					
					$weekGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'week'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Highest", "color"=> "#df7970");

				} elseif ($minPercentInWeek == ${'percentageS' .$i. 'week'}) {

					$weekGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'week'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Lowest", "color"=> "#df7970");


				} else {

					$weekGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'week'}, "z"=> ${"s" . $i . "Name"},  "color"=> "#df7970");

				}
			} else {

				if ($maxPercentInWeek == ${'percentageS' .$i. 'week'}) {
					
					$weekGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'week'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Highest");

				} elseif ($minPercentInWeek == ${'percentageS' .$i. 'week'}) {

					$weekGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'week'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Lowest");


				} else {

					$weekGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'week'}, "z"=> ${"s" . $i . "Name"});

				}
			}
		}

		if ($numberOfStudents > 20) {
			$extraStudents = $numberOfStudents - 20;
			$allStudentsInWeekChartWidth = 810 + (35*$extraStudents);
		} else {
			$allStudentsInWeekChartWidth = 810;
		}

		if ($numberOfStudents > 20) {
			$extraStudents = $numberOfStudents - 20;
			$allStudentsMonthChartWidth = 810 + (35*$extraStudents);
			$allStudentsYearChartWidth = 810 + (35*$extraStudents);
		} else {
			$allStudentsMonthChartWidth = 810;
			$allStudentsYearChartWidth = 810;
		}

		
//Week Pie

		$presentAverageForWeek =  round(${'percentageS' .$sRoll. 'week'});
		$absentAverageForWeek = 100 - $presentAverageForWeek;

		$weekPieData = array(
			array("label"=> "Absent", "y"=> $absentAverageForWeek),
			array("label"=> "Present", "y"=> $presentAverageForWeek)
		);

//Month Graph

		$result = mysqli_query($link, $queryForMonth);
		$sumForMonth = 0;

		while ($row = mysqli_fetch_assoc($result)) {

			$numberOfdaysAttendanceTakenInMonth = $row['count(*)'];

			for ($i=1; $i <= $numberOfStudents; $i++) {

				${'percentageS' .$i. 'month'} =  round(($row['SUM(s'.$i.')'])/$numberOfdaysAttendanceTakenInMonth*100);
				$sumForMonth += $row['SUM(s'.$i.')'];
			}

		}

		for ($i=1; $i <= $numberOfStudents; $i++) { 
			$percentageI = ${'percentageS' .$i. 'month'};
			$percentagesArrayMonth[$i] = $percentageI;
		}

		$maxPercentInMonth = max($percentagesArrayMonth);
		$minPercentInMonth = min($percentagesArrayMonth);

		for ($i=1; $i <= $numberOfStudents; $i++) {

			if ($i == $sRoll) {

				if ($maxPercentInMonth == ${'percentageS' .$i. 'month'}) {
					
					$monthGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'month'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Highest", "color"=> "#df7970");

				} elseif ($minPercentInMonth == ${'percentageS' .$i. 'month'}) {

					$monthGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'month'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Lowest", "color"=> "#df7970");

				} else {

					$monthGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'month'}, "z"=> ${"s" . $i . "Name"}, "color"=> "#df7970");
				}
			} else {

				if ($maxPercentInMonth == ${'percentageS' .$i. 'month'}) {
					
					$monthGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'month'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Highest");

				} elseif ($minPercentInMonth == ${'percentageS' .$i. 'month'}) {

					$monthGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'month'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Lowest");

				} else {

					$monthGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'month'}, "z"=> ${"s" . $i . "Name"});
				}
			}
		}

		
//Month Pie

		$presentAverageForMonth =  $percentagesArrayMonth[$sRoll];
		$absentAverageForMonth = 100 - $presentAverageForMonth;

		$monthPieData = array(
			array("label"=> "Absent", "y"=> $absentAverageForMonth),
			array("label"=> "Present", "y"=> $presentAverageForMonth)
		);


//Year Graph

		$result = mysqli_query($link, $queryForYear);
		$sumForYear = 0;

		while ($row = mysqli_fetch_assoc($result)) {

			$numberOfdaysAttendanceTakenInYear = $row['count(*)'];

			for ($i=1; $i <= $numberOfStudents; $i++) {

				${'percentageS' .$i. 'year'} =  round(($row['SUM(s'.$i.')'])/$numberOfdaysAttendanceTakenInYear*100);
				$sumForYear += $row['SUM(s'.$i.')'];
			}

		}

		for ($i=1; $i <= $numberOfStudents; $i++) { 
			$percentageI = ${'percentageS' .$i. 'year'};
			$percentagesArrayYear[$i] = $percentageI;
		}

		$maxPercentInYear = max($percentagesArrayYear);
		$minPercentInYear = min($percentagesArrayYear);

		for ($i=1; $i <= $numberOfStudents; $i++) {

			if ($i == $sRoll) {

				if ($maxPercentInYear == ${'percentageS' .$i. 'year'}) {
					
					$yearGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'year'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Highest", "color"=> "#df7970");

				} elseif ($minPercentInYear == ${'percentageS' .$i. 'year'}) {

					$yearGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'year'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Lowest", "color"=> "#df7970");

				} else {

					$yearGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'year'}, "z"=> ${"s" . $i . "Name"}, "color"=> "#df7970");
				}
			} else {

				if ($maxPercentInYear == ${'percentageS' .$i. 'year'}) {
					
					$yearGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'year'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Highest");

				} elseif ($minPercentInYear == ${'percentageS' .$i. 'year'}) {

					$yearGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'year'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Lowest");

				} else {

					$yearGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'year'}, "z"=> ${"s" . $i . "Name"});
				}
			}
		}
		
//Year Pie

		$presentAverageForYear =  $percentagesArrayYear[$sRoll];
		$absentAverageForYear = 100 - $presentAverageForYear;

		$yearPieData = array(
			array("label"=> "Absent", "y"=> $absentAverageForYear),
			array("label"=> "Present", "y"=> $presentAverageForYear)
		);
	}
}
if (array_key_exists('logoutStudentHistory', $_POST)){


	unset($_SESSION);
	unset($_COOKIE);
	setcookie(session_name(), "", time() - 60*60, "/");
	setcookie("id", "", time() - 60*60, "/");

	header("Location: ../Logout");

}