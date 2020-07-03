<?php 

error_reporting(0);
ini_set('display_errors', 0);

if(!array_key_exists("id", $_SESSION) && !array_key_exists("historyOf", $_SESSION))
{

	header("Location: ../SignIn");

} else if ((array_key_exists("id", $_SESSION) && !array_key_exists("historyOf", $_SESSION)) || (array_key_exists("id", $_SESSION) && !array_key_exists("username", $_SESSION))) 
{

	header("Location: ../HomePage");

} else if (array_key_exists("id", $_SESSION) && array_key_exists("historyOf", $_SESSION) && array_key_exists("username", $_SESSION)) 
{

	$id = $_SESSION['id'];
	$historyOf = $_SESSION['historyOf'];
	$username = $_SESSION['username'];
	$_SESSION['className'] = $historyOf;

	$query = "SELECT count(*) FROM `".$username."`.`".$historyOf."`;";

	$result = mysqli_query($link, $query);

	$row = mysqli_fetch_assoc($result);

	if ($row['count(*)'] < 1) {

		$modalToShow =  "<script type='text/javascript'>$(document).ready(function() { $('#noRecordsExist').modal('show'); });</script>";
		header( "refresh:2; url=../HomePage" );

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
		$queryToGetNames = "SELECT `COLUMN_COMMENT` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$username."' AND `TABLE_NAME`='".$historyOf."'";

		$result = mysqli_query($link, $queryToGetNames);

		$x = 1;
		$y = 1;

		while($row = mysqli_fetch_assoc($result)) {
			

			if($y >= 3){

				${"s" . $x . "Name"} = $row["COLUMN_COMMENT"];

				$x++;
			}
			$y++;
		}


		$tableData = '<thead>
													<tr>
													  <th scope="col">#</th>
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


		$query = "SELECT COUNT(*) FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$username."' AND `TABLE_NAME`='".$historyOf."'";
		
		$result = mysqli_query($link, $query);

		$row = mysqli_fetch_assoc($result);
		$numberOfStudents = $row['COUNT(*)'] - 2;

		$querySelectWeekData = "SELECT `dateofattendance`,";

		for ($i=1; $i <= $numberOfStudents ; $i++) { 
			
			$querySelectWeekData .= "`s" . $i . "`, ";

		}

		$querySelectWeekData = substr($querySelectWeekData, 0, -2);

		$querySelectWeekData .= " FROM `".$username."`.`".$historyOf."` WHERE dateofattendance='".$todayDate."' OR dateofattendance='".$date1DayEarlier."' OR dateofattendance='".$date2DayEarlier."' OR dateofattendance='".$date3DayEarlier."' OR dateofattendance='".$date4DayEarlier."' OR dateofattendance='".$date5DayEarlier."' OR dateofattendance='".$date6DayEarlier."';";

		$result = mysqli_query($link, $querySelectWeekData);

		$numberOfdaysAttendanceTakenInWeek = mysqli_num_rows($result);

		while ($row = mysqli_fetch_assoc($result)) {
			
			for ($i=1; $i <= $numberOfdaysAttendanceTakenInWeek ; $i++) { 

				for ($j=1; $j <= $numberOfStudents ; $j++) { 

					$users[$row['dateofattendance']]['s'.$j] = $row['s'.$j];
				}
			}
		}

		for ($i=1; $i <= $numberOfStudents ; $i++) { 

			$tableData .= 	'
										<tr>
										  <th scope="row" data-toggle="tooltip" data-placement="top" title="'.${"s" . $i . "Name"}.'" data-original-title="'.${"s" . $i . "Name"}.'"><a href="../StudentHistory?sRoll='.$i.'">'.$i.'</th>';

			for ($j=1; $j <= 7; $j++) { 

				if ($j == 1) {
					$dateToPut = $todayDate;
				} else {
					$correctDate = $j - 1;
					$dateToPut = ${"date" .$correctDate. "DayEarlier"};
				}

				if (array_key_exists($dateToPut,$users)) {

					$tableData .= 	'
											<td>'.binaryToAlphabet($users[$dateToPut]["s".$i]).'</td>';
				
				} else{

					$tableData .= 	'
											<td></td>';

				}
				
			}

			$tableData .= '
										</tr>';
		}

		$tableData .= '
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


		$queryToGetWeekSum .= " FROM `".$username."`.`".$historyOf."` WHERE `dateofattendance`='".$todayDate."' OR `dateofattendance`='".$date1DayEarlier."' OR `dateofattendance`='".$date2DayEarlier."' OR `dateofattendance`='".$date3DayEarlier."' OR `dateofattendance`='".$date4DayEarlier."' OR `dateofattendance`='".$date5DayEarlier."' OR `dateofattendance`='".$date6DayEarlier."';";

		$queryForYear = $queryForMonth . " FROM `".$username."`.`".$historyOf."`  WHERE YEAR(`dateofattendance`) = ".$todayIsYear.";";
		
		$queryForMonth .= " FROM `".$username."`.`".$historyOf."`  WHERE MONTH(`dateofattendance`) = ".$todayIsMonthNumber." AND YEAR(`dateofattendance`) = ".$todayIsYear.";";


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
			$percentagesArrayWeek[] = $percentageI;
		}

		$maxPercentInWeek = max($percentagesArrayWeek);
		$minPercentInWeek = min($percentagesArrayWeek);

		for ($i=1; $i <= $numberOfStudents; $i++) {

			if ($maxPercentInWeek == ${'percentageS' .$i. 'week'}) {
				
				$weekGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'week'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Highest");

			} elseif ($minPercentInWeek == ${'percentageS' .$i. 'week'}) {

				$weekGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'week'}, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Lowest");


			} else {

				$weekGraphData[] = array("x"=> $i, "y"=> ${'percentageS' .$i. 'week'}, "z"=> ${"s" . $i . "Name"});

			}
		}

		if ($numberOfStudents > 20) {
			$extraStudents = $numberOfStudents - 20;
			$allStudentsInWeekChartWidth = 885 + (35*$extraStudents);
		} else {
			$allStudentsInWeekChartWidth = 885;
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

		$presentAverageForWeek =  round($sumForWeek/$numberOfdaysAttendanceTakenInWeek/$numberOfStudents*100);
		$absentAverageForWeek = 100 - $presentAverageForWeek;

		$weekPieData = array(
			array("label"=> "Absent", "y"=> $absentAverageForWeek),
			array("label"=> "Present", "y"=> $presentAverageForWeek)
		);

	//Month Graph

		$result = mysqli_query($link, $queryForMonth);
		$monthArray = mysqli_fetch_assoc($result);
		$numberOfdaysAttendanceTakenInMonth = $monthArray['count(*)'];
		$sumForMonth = 0;

		for ($i=1; $i <= $numberOfStudents; $i++) { 
			$percentageI = $monthArray['SUM(s'.$i.')'];
			$percentagesMonthArray[] = $percentageI;
			$sumForMonth += $monthArray['SUM(s'.$i.')'];
		}

		$maxPercentInMonth = max($percentagesMonthArray);
		$minPercentInMonth = min($percentagesMonthArray);

		for ($i=1; $i <= $numberOfStudents; $i++) {

			$percentageI = round($monthArray['SUM(s'.$i.')']/$numberOfdaysAttendanceTakenInMonth*100);

			if ($maxPercentInMonth == $monthArray['SUM(s'.$i.')']) {
				
				$monthGraphData[] = array("x"=> $i, "y"=> $percentageI, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Highest");

			} elseif ($minPercentInWeek == ${'percentageS' .$i. 'week'}) {

				$monthGraphData[] = array("x"=> $i, "y"=> $percentageI, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Lowest");

			} else {

				$monthGraphData[] = array("x"=> $i, "y"=> $percentageI, "z"=> ${"s" . $i . "Name"});

			}
		}

		
	//Month Pie

		$presentAverageForMonth =  round($sumForMonth/$numberOfdaysAttendanceTakenInMonth/$numberOfStudents*100);
		$absentAverageForMonth = 100 - $presentAverageForMonth;

		$monthPieData = array(
			array("label"=> "Absent", "y"=> $absentAverageForMonth),
			array("label"=> "Present", "y"=> $presentAverageForMonth)
		);


	//Year Graph

		$result = mysqli_query($link, $queryForYear);
		$yearArray = mysqli_fetch_assoc($result);
		$numberOfdaysAttendanceTakenInYear = $yearArray['count(*)'];
		$sumForYear = 0;

		for ($i=1; $i <= $numberOfStudents; $i++) { 
			$percentageI = $yearArray['SUM(s'.$i.')'];
			$percentagesYearArray[] = $percentageI;
			$sumForYear += $yearArray['SUM(s'.$i.')'];
		}

		$maxPercentInYear = max($percentagesYearArray);
		$minPercentInYear = min($percentagesYearArray);

		for ($i=1; $i <= $numberOfStudents; $i++) {

			$percentageI = round($yearArray['SUM(s'.$i.')']/$numberOfdaysAttendanceTakenInYear*100);

			if ($maxPercentInYear == $yearArray['SUM(s'.$i.')']) {
				
				$yearGraphData[] = array("x"=> $i, "y"=> $percentageI, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Highest");

			} elseif ($minPercentInWeek == ${'percentageS' .$i. 'week'}) {

				$yearGraphData[] = array("x"=> $i, "y"=> $percentageI, "z"=> ${"s" . $i . "Name"}, "indexLabel"=> "Lowest");

			} else {

				$yearGraphData[] = array("x"=> $i, "y"=> $percentageI, "z"=> ${"s" . $i . "Name"});

			}

		}
		
	//Year Pie

		$presentAverageForYear =  round($sumForYear/$numberOfdaysAttendanceTakenInYear/$numberOfStudents*100);
		$absentAverageForYear = 100 - $presentAverageForYear;

		$yearPieData = array(
			array("label"=> "Absent", "y"=> $absentAverageForYear),
			array("label"=> "Present", "y"=> $presentAverageForYear)
		);

	}
}


if (array_key_exists('logoutArchive', $_POST)){


	unset($_SESSION);
	unset($_COOKIE);
	setcookie(session_name(), "", time() - 60*60, "/");
	setcookie("id", "", time() - 60*60, "/");

	header("Location: ../Logout");

}