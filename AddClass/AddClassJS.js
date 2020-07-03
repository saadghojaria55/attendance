function removeConfirmation()
{
	var txt = "Are you sure you remove this class?" ;

	if (confirm(txt)) {
		$('#removeClassModal').modal('hide');
		$('#removeClassSuccessModal').modal('show');
	}
}

function homeClicked()
{
	var txt = "Class would not be added. Are you sure you want to go to homepage?" ;

    if (confirm(txt)) {
    	window.location.href = "../HomePage";
    }
}