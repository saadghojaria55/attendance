function getValueID(buttonID)
{
	var valueID = "s" + buttonID.substr(2);
	return valueID;
}
function makePresent (buttonID) {

	var valueID = getValueID(buttonID);
	document.getElementById(valueID).value = 1;
	document.getElementById(buttonID).className = "btn btn-lg btn-success largeFont inputButtons";
}

function makeAbsent (buttonID) {
	var valueID = getValueID(buttonID);
	document.getElementById(valueID).value = 0;
	document.getElementById(buttonID).className = "btn btn-lg btn-danger largeFont inputButtons";
		
}

function switchValue (buttonID) {

	var valueID = getValueID(buttonID);
	var present = document.getElementById(valueID).value;

	if (present == "0") {
		makePresent(buttonID);
	} else {
		makeAbsent(buttonID);
	}
}

function allAbsent (buttonID) {

	var checkboxChecked = document.getElementById("allAbsentOrPresent").checked;
	
	if (checkboxChecked) {
		
		for (var i = 1; i <= 100; i++) {
			
			var nameOfElement = "sb" + i;
			var exists = document.getElementById(nameOfElement);

			if (exists) {
				makeAbsent(nameOfElement);
			} else
			{
				return;
			}
		$("#allAbsentOrPresentLabel").tooltip('hide').attr('data-original-title', 'All Present').tooltip('show');
		}
	} else {
			for (var i = 1; i <= 100; i++) {
				
				var nameOfElement = "sb" + i;
				var exists = document.getElementById(nameOfElement);
				
				if (exists) {
					makePresent(nameOfElement);		
				}
		}
		$("#allAbsentOrPresentLabel").tooltip('hide').attr('data-original-title', 'All Absent').tooltip('show');
	}

}
function saveButtonClicked()
{
	var txt = "Are you sure you want save this attendance?" ;

    if (confirm(txt)) {
    	document.getElementById("mainForm").submit();
    	document.getElementById("saveButton").disabled = true;
    }
}
function closeButtonClicked()
{
	var txt = "Are you sure you want to cancel?" ;

    if (confirm(txt)) {
    	window.location.href = "../HomePage/";
    }
}