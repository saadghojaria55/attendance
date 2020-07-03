function preventNonAlphabets(e) {

	var keyCode = (e.keyCode ? e.keyCode : e.which);

	var validKey = keyCode == 9 || keyCode == 8 || keyCode == 32 || keyCode == 46 || keyCode == 110 || keyCode == 190 || keyCode == 37 || keyCode == 38 || keyCode == 39 || keyCode == 40 ||  keyCode == 16 || keyCode == 17 ||  (keyCode > 96 && keyCode < 123) || (keyCode > 64 && keyCode < 91);

	if (!validKey) {
		e.preventDefault();
	}
}


$(document).ready(function() {
  $(document.body).keypress(function(e) {
    preventNonAlphabets(e);
  });
});
