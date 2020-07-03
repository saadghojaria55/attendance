<?php 

	include('connection.php');
	if (isset($_POST['submit'])) {

		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		if(array_key_exists('teacherPic', $_POST)){
			$teacherPic = $_POST['teacherPic'];
		}
		if(array_key_exists('gender', $_POST)){
			$gender = $_POST['gender'];
		}
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$dobPlain = $_POST['dob'];
		$dob = date("Y-m-d", strtotime($dobPlain));
		$address = $_POST['address'];
		$institutionType = $_POST['institutionType'];
		$institutionName = $_POST['institutionName'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$passwordMatch = $_POST['passwordMatch'];

//Variables for checking if fields are properly filled
		$firstNameOK = true;
		$lastNameOK = true;
		$teacherPicOK = true;
		$genderOK = true;
		$emailOK = true;
		$phoneOK = true;
		$dobOK = true;
		$institutionNameOK = true;
		$institutionTypeOK = true;
		$addressOK = true;
		$usernameOK = true;
		$passwordOK = true;
		$passwordMatchOK = true;

//First Name checks
		$noSpecialCharOrNumbers = '/[^a-zA-Z.\s]/';
		$atleastOneAlphabet = '/[^a-zA-Z\s]+/';
		$noOnlySpaces = '/^[\s]+$/';

		print_r($_POST);

		if (strlen($firstName) == 0 || preg_match($noOnlySpaces, $firstName)) {

			$errorFirstName = "<font color='#d9534f'>Please fill first name.</font>";
			$firstNameOK = false;

		} elseif (strlen($firstName) <= 1) {

			$errorFirstName = "<font color='#d9534f'>First Name should be longer.</font>";
			$firstNameOK = false;

		} elseif (preg_match($noSpecialCharOrNumbers, $firstName) || preg_match($atleastOneAlphabet, $firstName)) {

			$errorFirstName = "<font color='#d9534f'>Enter a valid name.</font>";
			$firstNameOK = false;

		}

//Last Name checks
		if (strlen($lastName) == 0  || preg_match($noOnlySpaces, $lastName)) {

			$errorLastName = "<font color='#d9534f'>Please fill first name.</font>";
			$lastNameOK = false;

		} elseif (strlen($lastName) <= 1) {

			$errorLastName = "<font color='#d9534f'>Last Name should be longer.</font>";
			$lastNameOK = false;

		} elseif (preg_match($noSpecialCharOrNumbers, $lastName) || preg_match($atleastOneAlphabet, $lastName)) {

			$errorLastName = "<font color='#d9534f'>Enter a valid name.</font>";
			$lastNameOK = false;

		}

//Student picture checks
		$target_dir = "../uploads/";
		$file_name = basename($_FILES['teacherPic']['name']);
		$target_file = $target_dir.$file_name; 
		$file_size = $_FILES['teacherPic']['size'];
		$file_name_without_extension = pathinfo($target_file,PATHINFO_FILENAME);
		$file_extension_case_sensitive = pathinfo($target_file,PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension_case_sensitive);
		$to_save_file = $target_dir.$file_name_without_extension.time().".".$file_extension;

		if (!$file_extension) {

			$errorTeacherPic = "<font color='#d9534f'>Please choose a file.</font>";
			$teacherPicOK = false;

		}

		elseif ($file_extension != "gif" && $file_extension != "jpg" && $file_extension != "jpeg" && $file_extension != "png" && $file_extension != "bmp"){

			$errorTeacherPic = "<font color='#d9534f'>Sorry this extension is not valid, only jpg, jpeg, gif, png, bmp formats are accepted.</font>";
			$teacherPicOK = false;

		}
		elseif ($file_size < 100 && $file_size != 0) {

			echo $file_size;
			$errorTeacherPic = "<font color='#d9534f'>File is too small, could not upload.</font>";
			$teacherPicOK = false;

		}
		elseif ($file_size > 1000000 || $file_size == 0) {

			echo $file_size;
			$errorTeacherPic = "<font color='#d9534f'>File should'nt be larger than 1MB, could not upload.</font>";
			$teacherPicOK = false;

		}

//Gender checks
//http://stackoverflow.com/questions/418066/best-way-to-test-for-a-variables-existence-in-php-isset-is-clearly-broken

		if (!array_key_exists('gender', $GLOBALS)){

			$errorGender = "<font color='#d9534f'>Please select a gender.</font>";
			$genderOK = false;

		}

//Email checks
		if (strlen($email) == 0) {

			$errorEmail = "<font color='#d9534f'>Please fill email.</font>";
			$emailOK = false;

		} elseif (strlen($email) < 5 || !filter_var($email, FILTER_VALIDATE_EMAIL) === true) {

			$errorEmail = "<font color='#d9534f'>Email is invalid.</font>";
			$emailOK = false;

		} else {
			strtolower($email);
			$emailOK = true;
		}

//Phone checks
		if (strlen($phone) == 0) {
			$errorPhone = "<font color='#d9534f'>Please fill phone number.</font>";
			$phoneOK = false;


		} elseif (strlen($phone) < 10) {

			$errorPhone = "<font color='#d9534f'>Enter 10 digit number.</font>";
			$phoneOK = false;

		} elseif (!ctype_digit($phone) || $phone < 1000000000) {

			$errorPhone = "<font color='#d9534f'>Enter valid number.</font>";
			$phoneOK = false;

		}

//DOB checks

		$dateFormat = '/^[\d]{1,2}\/[\d]{1,2}\/[\d]{4}$/';

		if (strlen($dobPlain) == 0) {

			$errorDOB = "<font color='#d9534f'>Please fill DOB.</font>";
			$dobOK = false;

		} elseif (!preg_match($dateFormat, $dobPlain)){

			$errorDOB = "<font color='#d9534f'>Fill values in dd/mm/yyyy format.</font>";
			$dobOK = false;

		} elseif (preg_match($dateFormat, $dobPlain)) {

			$dobArray = explode('/', $dobPlain);
			$day = $dobArray[0];
			$month = $dobArray[1];
			$year = $dobArray[2];

			$result = checkdate ($month, $day, $year);

			if (!$result) {
				$errorDOB = "<font color='#d9534f'>Invalid date.</font>";
				$dobOK = false;

			}
		}

//Institution type checks

		if(strlen($institutionType) == 0){

			$errorInstitutionType = "<font color='#d9534f'>Please select institution type.</font>";
			$institutionTypeOK = false;

		}

//Institution name check

		if (strlen($institutionName) == 0){

			$errorInstitutionName = "<font color='#d9534f'>Please select institution name.</font>";
			$institutionNameOK = false;

		}

//Address check
		if(strlen($address) < 24){

			$errorAddress = "<font color='#d9534f'>Please fill full Address.</font>";
			$addressOK = false;

		}

//Username check
		if (strlen($username) == 0)
		{
			$errorUsername = "<font color='#d9534f'>Please fill username.</font>";
			$usernameOK = false;

		} else {
			
			$startsWithNumber = ctype_digit(substr($username, 0, 1));
			$pattern = '/[^a-zA-Z0-9_]/';
			$special = preg_match($pattern, $username);
			$length = strlen($username);
			$usernameQuery = "SELECT username FROM `usersdb`.`userlist` WHERE username = '".mysqli_real_escape_string($link, $username)."' LIMIT 1";
			$usernameResult = mysqli_query($link, $usernameQuery);

							

			if ($startsWithNumber)
			{
				$errorUsername = "<font color='#d9534f'>Username should not start with a number.</font>";
				$usernameOK = false;
		
			} else if ($length<6) {
				$errorUsername = "<font color='#d9534f'>Username should not be smaller than six characters.</font>";
				$usernameOK = false;
				
			} else if ($length>12) {
				$errorUsername = "<font color='#d9534f'>Username should not larger than twelve characters.</font>";
				$usernameOK = false;

			} else if($special){
				$errorUsername = "<font color='#d9534f'>Can't contain any special characters besides underscore.</font>";
				$usernameOK = false;

			} elseif (mysqli_num_rows($usernameResult) > 0) {
				$errorUsername = "<font color='#d9534f'>That username is already taken.</font>";
				$usernameOK = false;

			} else {
				strtolower($username);
				$usernameOK = true;
			}

		}

//Password check

		if (strlen($password) == 0)
		{
			$errorPassword = "<font color='#d9534f'>Please fill password.</font>";
			$passwordOK = false;

		} else if (strlen($password) < 6) {
			$errorPassword = "<font color='#d9534f'>Should be longer than 6 characters.</font>";
			$passwordOK = false;
		
		} else if (strlen($password) > 15) {
			$errorPassword = "<font color='#d9534f'>Should not be longer than 15 characters.</font>";
			$passwordOK = false;
		
		} else {
			$passwordOK = true;
		}

//Password match check

		if (strlen($passwordMatch) == 0)
		{
			$errorPasswordMatch = "<font color='#d9534f'>Please retype password.</font>";
			$passwordMatchOK = false;

		} else if (strlen($passwordMatch) < 6) {
			$errorPasswordMatch = "<font color='#d9534f'>Should be longer than 6 characters.</font>";
			$passwordMatchOK = false;
		
		} else if (strlen($passwordMatch) > 15) {
			$errorPasswordMatch = "<font color='#d9534f'>Should not be longer than 15 characters.</font>";
			$passwordMatchOK = false;
		
		} else if ($password != $passwordMatch) {		
			$errorPasswordMatch = "<font color='#d9534f'>Passwords don't match.";
			$passwordMatchOK = false;
		
		} else {
			$passwordMatchOK = true;
		}
		
		include('DBqueries.php');
	}


?>