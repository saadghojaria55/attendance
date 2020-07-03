/*On load of page submit button will be disabled (this is done through javascript to make sure that it can be renabled through it)
window.onload = function(){
	document.getElementById("submit").className = "btn btn-primary offset-sm-4 disabled";
	document.getElementById("submit").disabled = true;
};*/


//First Name AJAX Check
function firstNameCheck (str) {
	var firstName = document.getElementById('firstName').value;

	if (firstName === "") {

		document.getElementById("firstNameDiv").className = "col-md-4";
		document.getElementById("firstName").className = "form-control";
		document.getElementById('firstNameFeedback').innerHTML = "";
		firstNameFilled = false;
		return;

	} else {

		var ajaxReq = new XMLHttpRequest();

		ajaxReq.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				if(ajaxReq.responseText === "true"){

					document.getElementById("firstNameDiv").className = "col-md-4 has-success";
					document.getElementById("firstName").className = "form-control form-control-success";
					document.getElementById('firstNameFeedback').innerHTML = "";
					firstNameFilled = true;

				} else{

					document.getElementById("firstNameDiv").className = "col-md-4 has-danger";
					document.getElementById("firstName").className = "form-control form-control-danger";
					document.getElementById('firstNameFeedback').innerHTML = "First Name should be longer.";
					firstNameFilled = false;

				}
			}
		};
		var url = "firstnameCheck.php?firstName=" + firstName;
		ajaxReq.open("GET",url,true);
		ajaxReq.send();
	}
}

//Last Name AJAX Check
function lastNameCheck (str) {
	var lastName = document.getElementById('lastName').value;

	if (lastName === "") {
		
		document.getElementById("lastName").className = "form-control";
		document.getElementById('lastNameFeedback').innerHTML = "";
		document.getElementById("lastNameDiv").className = "col-md-4";
		lastNameFilled = false;
		return;

	} else {

		var ajaxReq = new XMLHttpRequest();

		ajaxReq.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				if(ajaxReq.responseText === "true"){
					
					document.getElementById("lastNameDiv").className = "col-md-4 has-success";
					document.getElementById("lastName").className = "form-control form-control-success";
					document.getElementById('lastNameFeedback').innerHTML = "";
					lastNameFilled = true;
			
				} else{

					document.getElementById("lastNameDiv").className = "col-md-4 has-danger";
					document.getElementById("lastName").className = "form-control form-control-danger";
					document.getElementById('lastNameFeedback').innerHTML = "Last Name should be longer.";
					lastNameFilled = false;
				
				}
			}
		};
		var url = "lastnameCheck.php?lastName=" + lastName;
		ajaxReq.open("GET",url,true);
		ajaxReq.send();
	}
}

//Email AJAX Check
function emailCheck (str) {
	var email = document.getElementById('email').value;

	if (email === "") {

		document.getElementById("emailDiv").className = "col-sm-6";
		document.getElementById("email").className = "form-control";
		document.getElementById('emailFeedback').innerHTML = "";
		emailFilled = false;
		return;

	} else {

		var ajaxReq = new XMLHttpRequest();

		ajaxReq.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				if(ajaxReq.responseText === "true"){

					document.getElementById("emailDiv").className = "col-sm-6 has-success";
					document.getElementById("email").className = "form-control form-control-success";
					document.getElementById('emailFeedback').innerHTML = "";
					emailFilled = true;

				} else{

					document.getElementById("emailDiv").className = "col-sm-6 has-danger";
					document.getElementById("email").className = "form-control form-control-danger";
					document.getElementById('emailFeedback').innerHTML = "Email is invalid.";
					emailFilled = false;

				}
			}
		};
		var url = "emailCheck.php?email=" + email;
		ajaxReq.open("GET",url,true);
		ajaxReq.send();
	}
}

//DOB AJAX Check
function dobCheck (str) {
	var dob = document.getElementById('dob').value;

	if (dob === "") {

		document.getElementById("dobDiv").className = "col-sm-4";
		document.getElementById("dob").className = "form-control";
		document.getElementById('dobFeedback').innerHTML = "";
		dobFilled = false;
		return;

	} else {

		var ajaxReq = new XMLHttpRequest();

		ajaxReq.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				if(ajaxReq.responseText === "true"){

					document.getElementById("dobDiv").className = "col-sm-4 has-success";
					document.getElementById("dob").className = "form-control form-control-success";
					document.getElementById('dobFeedback').innerHTML = "";
					dobFilled = true;

				} else{

					document.getElementById("dobDiv").className = "col-sm-4 has-danger";
					document.getElementById("dob").className = "form-control form-control-danger";
					document.getElementById('dobFeedback').innerHTML = "Date is invalid.";
					dobFilled = false;

				}
			}
		};
		var url = "dobCheck.php?dob=" + dob;
		ajaxReq.open("GET",url,true);
		ajaxReq.send();
	}
}

//Phone AJAX Check
function phoneCheck (str) {
	var phone = document.getElementById('phone').value;

	if (phone === "") {

		document.getElementById("phoneDiv").className = "col-sm-5";
		document.getElementById("phone").className = "form-control";
		document.getElementById('phoneFeedback').innerHTML = "";
		phoneFilled = false;
		return;

	} else {

		var ajaxReq = new XMLHttpRequest();

		ajaxReq.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				if(ajaxReq.responseText === "true"){

					document.getElementById("phoneDiv").className = "col-sm-5 has-success";
					document.getElementById("phone").className = "form-control form-control-success";
					document.getElementById('phoneFeedback').innerHTML = "";
					phoneFilled = true;

				} else{

					document.getElementById("phoneDiv").className = "col-sm-5 has-danger";
					document.getElementById("phone").className = "form-control form-control-danger";
					document.getElementById('phoneFeedback').innerHTML = "Phone number is invalid.";
					phoneFilled = false;

				}
			}
		};
		var url = "phoneCheck.php?phone=" + phone;
		ajaxReq.open("GET",url,true);
		ajaxReq.send();
	}
}

//Address AJAX Check
function addressCheck (str) {
	var address = document.getElementById('address').value;

	if (address === "") {

		document.getElementById("addressDiv").className = "col-md-10";
		document.getElementById("address").className = "form-control";
		document.getElementById('addressFeedback').innerHTML = "";
		addressFilled = false;
		return;

	} else {

		var ajaxReq = new XMLHttpRequest();

		ajaxReq.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				if(ajaxReq.responseText === "true"){

					document.getElementById("addressDiv").className = "col-md-10 has-success";
					document.getElementById("address").className = "form-control form-control-success";
					document.getElementById('addressFeedback').innerHTML = "";
					addressFilled = true;

				} else{

					document.getElementById("addressDiv").className = "col-md-10 has-danger";
					document.getElementById("address").className = "form-control form-control-danger";
					document.getElementById('addressFeedback').innerHTML = "Address is too short.";
					addressFilled = false;

				}
			}
		};
		var url = "addressCheck.php?address=" + address;
		ajaxReq.open("GET",url,true);
		ajaxReq.send();
	}
}

//Global Varibles
var ctrlDown = false;
var copyPasteHappening = false;

function keyDownCheckForCapitalize(e,textboxid, str){

	var code = (e.keyCode || e.which);

	var ctrlKey = 17;
	var cmdKey = 91;
	var vKey = 86;
	var cKey = 67;
	var xKey = 88;
	var aKey = 65;


	if (e.keyCode == ctrlKey || e.keyCode == cmdKey){
		ctrlDown = true;
	}

//e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey || REMOVED

	if (ctrlDown && (e.keyCode == aKey)){
		copyPasteHappening = true;
		return;
	}
}

//Capitalize
function keyUpCheckForCapitalize(e,textboxid, str) {

	var ctrlDown = false;

	var code = (e.keyCode || e.which);


//http://keycode.info/
// do nothing if it's an arrow key

	if (code == 20 || code == 17 || code == 16 || code == 37 || code == 38 || code == 39 || code == 40) {
		return;
	}
	if (!copyPasteHappening) {
		capitalize(textboxid, str);
	}
}

//Copy Paste variable is reseted on blur
function copyPasteHappeningReset(e){

	ctrlKey = 17;
	cmdKey = 91;
	aKey = 65;

	var ctrlDown = false;

	if (e.keyCode == ctrlKey || e.keyCode == cmdKey){
		ctrlDown = true;
	}

	if (ctrlDown && (e.keyCode == aKey)){
		copyPasteHappening = true;
		return;
	}

	if (e.keyCode != ctrlKey || e.keyCode != cmdKey) {
		copyPasteHappening = false;
	}

}

function capitalize(textboxid, str) {

	if (str && str.length >= 1){

		var firstChar = str.charAt(0);
		var remainingStr = str.slice(1);
		remainingStr = remainingStr.toLowerCase();
		str = firstChar.toUpperCase() + remainingStr;
		
	}

	document.getElementById(textboxid).value = str;
	return str;
}

//Check if input is not a number
function preventNonNum(e) {

	var keyCode = (e.keyCode ? e.keyCode : e.which);
	if (keyCode > 31 && (keyCode < 48 || keyCode > 57) && keyCode != 37 && keyCode != 38 && keyCode != 39 && keyCode != 40) {
		e.preventDefault();
	}
}

function preventNonAlphabets(e) {

/*
	97 - 122 (a-z)
	65 - 90 (A-Z)
	48 - 57 (0-9)


	alert(e.keyCode);


9 = tab, 8 = backspace, 32 = spacebar
46,190,110 are probable period(.) key codes
37-40 are arrow keys
16 = shift
17 = ctrl

*/

	var keyCode = (e.keyCode ? e.keyCode : e.which);

	var validKey = keyCode == 9 || keyCode == 8 || keyCode == 32 || keyCode == 46 || keyCode == 110 || keyCode == 190 || keyCode == 37 || keyCode == 38 || keyCode == 39 || keyCode == 40 ||  keyCode == 16 || keyCode == 17 ||  (keyCode > 96 && keyCode < 123) || (keyCode > 64 && keyCode < 91);

	if (!validKey) {
		e.preventDefault();
	}
}

//Only alphabets are pasted, special characters and numbers removed
function preventNonAlphabetPaste(e,textboxid) {

	e.preventDefault();
	var pastedText = '';

// Internet Explorer
	if (window.clipboardData && window.clipboardData.getData) {
		pastedText = window.clipboardData.getData('Text');
	}

//Other Browsers
	else if (e.clipboardData && e.clipboardData.getData) {
		pastedText = e.clipboardData.getData('text/plain');
	}

//Regex for replacing special characters and alphabets with nothing 
	var regexCutStr = pastedText.replace(/[^A-Za-z\.]+/g, '');

//Length of textbox
	strLength = document.getElementById(textboxid).value.length;

//To be pasted string is cut to remaining length
	remainingLength = 15 - strLength;
	var contentCutToFifteen = regexCutStr.substring(0, remainingLength);
	document.getElementById(textboxid).value += contentCutToFifteen;

	var str = document.getElementById(textboxid).value;
//Running the function capitalize with the value to be replaced
	capitalize(textboxid,str);

}

//Only numbers are pasted, special characters and alphabets removed
function preventNonNumPaste(e,textboxid) {

	e.preventDefault();
	var pastedText = '';

// Internet Explorer
	if (window.clipboardData && window.clipboardData.getData) {
		pastedText = window.clipboardData.getData('Text');
	}

//Other Browsers
	else if (e.clipboardData && e.clipboardData.getData) {
		pastedText = e.clipboardData.getData('text/plain');
	}

//Regex for replacing special characters and alphabets with nothing
	var regexCutStr;
	if (textboxid == "phone"){
		regexCutStr = pastedText.replace(/[^0-9]+/g, '');
	} else if(textboxid == "dob"){
		regexCutStr = pastedText.replace(/[^0-9\/]+/g, '');
	}
//Length of textbox
	strLength = document.getElementById(textboxid).value.length;

//To be pasted string is cut to remaining length
	remainingLength = 10 - strLength;
	var contentCutToTen = regexCutStr.substring(0, remainingLength);
	document.getElementById(textboxid).value += contentCutToTen;

}

//Image preview
function readFile(input) {

//Image is set to the size of the full label element which was made clickable
	var width = document.getElementById('fileLabel').clientWidth  + "px";
	var height = document.getElementById('fileLabel').clientHeight + "px";

	var fileDivWidth = document.getElementById('fileDiv').clientWidth  + "px";
	var fileDivHeight = document.getElementById('fileDiv').clientHeight + "px";

	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {

			var size;
		    if(window.ActiveXObject){
		        var fobj = new ActiveXObject("Scripting.FileSystemObject");
		        size = fobj.getFile(document.getElementById('teacherPic').value).size;
		    }else{
		        size = document.getElementById('teacherPic').files[0].size;
		    }

		    if (size > 1048576) {
		    	alert("File too large. Should be less than 1MB");
		    	return;
		    }

		    if (size < 100) {
		    	alert("File too small.");
		    	return;
		    }

//http://stackoverflow.com/questions/6582171/javascript-regex-for-matching-extracting-file-extension

			var fileName = input.files[0].name;
			var fileNameLowercase = fileName.toLowerCase();
			var regex= /\.[\w]+$/;

			var fileExtension = fileNameLowercase.match(regex);

			
			if (fileExtension != ".gif" && fileExtension != ".jpg" && fileExtension != ".jpeg" && fileExtension != ".png" && fileExtension != ".bmp") {
				alert('Invalid picture selected. Only jpg, jpeg, gif, png, bmp formats are accepted.');
				return;
			}


			document.getElementById('filePreview').src = e.target.result;
			document.getElementById('filePreview').style.width = width;
			document.getElementById('filePreview').style.height = height;


		};

		document.getElementById("fileHelp").style.visibility = "hidden";
		document.getElementById("filePreview").style.visibility = "visible";
		reader.readAsDataURL(input.files[0]);

//Sometimes height of client width increases on showing file upload preview, to maintain it... 
		document.getElementById('fileDiv').style.width = fileDivWidth;
		document.getElementById('fileDiv').style.height = fileDivHeight;

		photoFilled = true;
	}
}
function insertSlashes(e,textboxid,str){
	var code = (e.keyCode || e.which);

	if(code == 8 || code == 46) { 
		return;
	}

	var numChars = str.length;
	if(numChars == 2 || numChars == 5){
		str += '/';
		document.getElementById(textboxid).value = str;           
	}
}

//Global Varibles
var firstNameFilled = false;
var lastNameFilled = false;
var photoFilled = false;
var genderFilled = false;
var emailFilled = false;
var phoneFilled = false;
var dobFilled = false;
var languagesFilled = false;
var educationFilled = false;
var addressFilled = false;
var courseFilled = false;
var complementaryFilled = false;
var usernameFilled = false;
var	passwordMatchFilled = false;
var Namefilled;

function filledOrNot(textboxid, value){
	if (value === "") {
		Namefilled = textboxid + "Filled";

//http://stackoverflow.com/questions/5117127/use-dynamic-variable-names-in-javascript
//By using window.var global scope variable with that name would get effected(not the one inside the function)

		window[Namefilled] = false;

	} else{
		Namefilled = textboxid + "Filled";
		window[Namefilled] = true;
	}
}

//Username AJAX Check
function usernameCheck(value)
{
		if (value === "") {

		document.getElementById("usernameDiv").className = "col-sm-5";
		document.getElementById("username").className = "form-control";
		document.getElementById('usernameFeedback').innerHTML = "";
		usernameFilled = false;
		return;

	} else {

		var ajaxReq = new XMLHttpRequest();

		ajaxReq.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				if(ajaxReq.responseText === "ok"){

					document.getElementById("usernameDiv").className = "col-sm-5 has-success";
					document.getElementById("username").className = "form-control form-control-success";
					document.getElementById('usernameFeedback').innerHTML = "";
					usernameFilled = true;

				} else{

					document.getElementById("usernameDiv").className = "col-sm-5 has-danger";
					document.getElementById("username").className = "form-control form-control-danger";
					usernameFilled = false;

					if(ajaxReq.responseText === "number"){

						document.getElementById('usernameFeedback').innerHTML = "Username should not start with a number.";
					}
					else if(ajaxReq.responseText === "small"){

						document.getElementById('usernameFeedback').innerHTML = "Username should not be smaller than 6 characters.";
					}
					else if(ajaxReq.responseText === "large"){

						document.getElementById('usernameFeedback').innerHTML = "Username should not larger than twelve characters.";
					}
					else if(ajaxReq.responseText === "special"){

						document.getElementById('usernameFeedback').innerHTML = "Can't contain any special characters besides underscore.";
					} else if(ajaxReq.responseText === "taken"){

						document.getElementById('usernameFeedback').innerHTML = "That username is already taken.";
					}
				}
			}
		};
		var url = "usernameCheck.php";
		ajaxReq.open("POST",url,true);
		ajaxReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var params = "username=" + value;
		ajaxReq.send(params);
	}
}
//Password AJAX Check
function passwordCheck(value)
{
		if (value === "") {

		document.getElementById("passwordDiv").className = "col-sm-3";
		document.getElementById("password").className = "form-control";
		document.getElementById('passwordFeedback').innerHTML = "";
		passwordFilled = false;
		return;

	} else {

		var ajaxReq = new XMLHttpRequest();

		ajaxReq.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {

				if(ajaxReq.responseText === "true"){

					document.getElementById("passwordDiv").className = "col-sm-3 has-success";
					document.getElementById("password").className = "form-control form-control-success";
					document.getElementById('passwordFeedback').innerHTML = "";
					passwordFilled = true;

				} else{

					document.getElementById("passwordDiv").className = "col-sm-3 has-danger";
					document.getElementById("password").className = "form-control form-control-danger";
					document.getElementById('passwordFeedback').innerHTML = "Should be longer than 6 characters.";
					passwordFilled = false;

					}
				}
			}
		};
		var url = "passwordCheck.php";
		ajaxReq.open("POST",url,true);
		ajaxReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var params = "password=" + value;
		ajaxReq.send(params);

}

//Password matching AJAX Check
function passwordMatchCheck(passwordMatchvalue)
{
		passwordValue = document.getElementById("password").value;

		if (passwordMatchvalue === "") {

		document.getElementById("passwordMatchDiv").className = "col-sm-3";
		document.getElementById("passwordMatch").className = "form-control";
		document.getElementById('passwordMatchFeedback').innerHTML = "";
		passwordMatchFilled = false;
		return;

	} else {

		var ajaxReq = new XMLHttpRequest();

		ajaxReq.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {

				if(ajaxReq.responseText === "true"){

					document.getElementById("passwordMatchDiv").className = "col-sm-3 has-success";
					document.getElementById("passwordMatch").className = "form-control form-control-success";
					document.getElementById('passwordMatchFeedback').innerHTML = "";
					passwordMatchFilled = true;

				} else{

					document.getElementById("passwordMatchDiv").className = "col-sm-3 has-danger";
					document.getElementById("passwordMatch").className = "form-control form-control-danger";
					document.getElementById('passwordMatchFeedback').innerHTML = "Passwords don't match.";
					passwordMatchFilled = false;

					}
				}
			}
		};
		var url = "passwordMatchCheck.php";
		ajaxReq.open("POST",url,true);
		ajaxReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var params = "password=" + passwordValue + "&passwordMatch=" + passwordMatchvalue;
		ajaxReq.send(params);

}