<?php

	include('../commons/connection.php');

	if(array_key_exists('attendanceOf', $_SESSION)){
		$attendanceOf =  $_SESSION['attendanceOf'];
	} else {
		$attendanceOf =  null;
	}

	if(array_key_exists('username', $_SESSION)){
		$username =  $_SESSION['username'];
	} else {
		$username =  null;
	}

	$designedAttendanceButtons = " ";

	$sql = "SELECT `COLUMN_NAME`,`COLUMN_COMMENT` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$username."' AND `TABLE_NAME`='".$attendanceOf."'";

	$result =  mysqli_query($link, $sql);

	$i = 1;
	$j = 1;
	$numberOfStudents = mysqli_num_rows($result) - 2;

	while($row = mysqli_fetch_assoc($result)) {
		

		if($j >= 3){

			${"sRoll" . $i} = substr($row["COLUMN_NAME"], 1);
			${"sName" . $i} = $row["COLUMN_COMMENT"];

			$designedAttendanceButtons .= '<button type="button" id="sb'.$i.'" onclick="switchValue(this.id);" class="btn btn-lg btn-success switchColor inputButtons"><input type="text" id="s'.$i.'" name="s'.$i.'" value="1">'.${"sRoll" . $i}.'. '.${"sName" . $i}.'</button>
						';
		
			$i++;
		
		}
		$j++;
	}

?>