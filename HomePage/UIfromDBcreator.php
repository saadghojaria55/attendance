<?php 

if (array_key_exists("id", $_COOKIE)) {
		$_SESSION['id'] = $_COOKIE['id'];
}

$query = "SELECT `firstName`,`teacherPic`,`username` FROM `usersdb`.`userlist` WHERE id = '" .$_SESSION['id']. "' LIMIT 1;";

$row = mysqli_fetch_array(mysqli_query($link,  $query));

$firstName = $row['firstName'];
$teacherPic = $row['teacherPic'];
$username = $row['username'];

$sql = "SHOW TABLES IN `".$username."`;";

$result =  mysqli_query($link, $sql);

$numberOfExistingClasses = mysqli_num_rows($result);
$i = 1;

while($row = mysqli_fetch_assoc($result)) {
	
	${"class" . $i} = $row["Tables_in_" . $username];
	$i++;

}

$designedMyClasses = " ";
$designedRollCallClasses = " ";
$designedRemoveClassClasses = " ";
$designedEditClass = " ";

if ($numberOfExistingClasses == 0) {
	
	$emptyAreaMessage = "<font color='#d9534f' size='4'>Please add classes first.</font>";
	$buttonDisabled = "disabled";
}


for ($i=1; $i <= $numberOfExistingClasses ; $i++) { 
	
	$designedMyClasses .='<div class="custom-control custom-radio">
													<input type="radio" id="myClass'.$i.'ID" name="historyOf" class="custom-control-input" checked="" value="'.${"class" . $i}.'">
													<label class="custom-control-label" for="myClass'.$i.'ID">'.${"class" . $i}.'</label>
												</div>
												';

	$designedRollCallClasses .='<div class="custom-control custom-radio">
													<input type="radio" id="attendanceClass'.$i.'ID" name="attendanceOf" class="custom-control-input" checked="checked" value="'.${"class" . $i}.'">
													<label class="custom-control-label" for="attendanceClass'.$i.'ID">'.${"class" . $i}.'</label>
												</div>
												';

	$designedRemoveClassClasses .= '<div class="custom-control custom-checkbox">
													<input class="custom-control-input" id="removeClass'.$i.'ID" name="removeClassName[]" type="checkbox" value="'.${"class" . $i}.'">
													<label class="custom-control-label" for="removeClass'.$i.'ID">'.${"class" . $i}.'</label>
												</div>
												';

	$designedEditClass .= '<div class="custom-control custom-radio">
													<input type="radio" id="editClass'.$i.'ID" name="editClassName" class="custom-control-input" checked="checked" value="'.${"class" . $i}.'">
													<label class="custom-control-label" for="editClass'.$i.'ID">'.${"class" . $i}.'</label>
												</div>
												';


}

?>