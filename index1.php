<!DOCTYPE html>
<html>
<head>
	<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
</head>
<body>
<div class="header" style="background-color:black;margin-top: -22px;margin-left: -8px;">
	<h1>This is header section</h1>
</div>
<div class="leftside" >
	<a href="index.php"><img src="LOC/LOC with API.png" alt="This is image" align="left" style="margin-left: -8px;margin-top: -22px;width: 50%"></a>
</div>
<div id="num"></div>
</body>
<script type="text/javascript">
	window.onload=function () {

	var i;
	for ( i=0; i <= 10; i++) {
		if (i%2==0) 
		{
	document.getElementById('num').value='<p>Numbers are</p>' +i;
	}
}
}
</script>
</html>
