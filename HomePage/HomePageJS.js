function removeConfirmation()
{
	var txt = "Are you sure you remove this class?" ;

	if (confirm(txt)) {
	}
}

function minmax(value, min, max) 
{
	if (value === "")
	{
		return;
	}
	if(parseInt(value) < min || isNaN(parseInt(value))) 
		return 1; 
	else if(parseInt(value) > max) 
		return max;
	else return value;
}