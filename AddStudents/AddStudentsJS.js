function homeClicked()
{
	var txt = "Class would not be added. Are you sure you want to go to homepage?" ;

    if (confirm(txt)) {
    	window.location.href = "../HomePage";
    }
}