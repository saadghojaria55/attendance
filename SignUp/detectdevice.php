<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<p id="details"></p>
		
		<script type="text/javascript">
			
			var screenWidth = screen.width;
			document.getElementById('details').innerHTML = "Screen Width : " + screenWidth + "<br>";

			var screenHeight = screen.height;
			document.getElementById('details').innerHTML += "Screen Height : " + screenHeight + "<br>";

			var availableScreenWidth = document.documentElement.clientWidth;
			document.getElementById('details').innerHTML += "Availabe Screen Width : " + availableScreenWidth + "<br>";

			var availableScreenHeight = document.documentElement.clientHeight;
			document.getElementById('details').innerHTML += "Availabe Screen Height : " + availableScreenHeight + "<br>";

		</script>
	</body>
</html>

<?php

    $user_agent = urlencode($_SERVER['HTTP_USER_AGENT']);
//    echo $_SERVER['HTTP_USER_AGENT'];
//http://www.useragentstring.com/pages/api.php

    $urlToSend = "http://www.useragentstring.com/?uas=".$user_agent."&getJSON=all";

    $dataReceived = file_get_contents($urlToSend);
    $dataArray = json_decode($dataReceived, true);
//        print_r($dataArray);
    echo "<b>Browser: </b>" . $dataArray['agent_name'] ." ". $dataArray['agent_version'];
    echo "<br><b>Operating System: </b>" . $dataArray['os_name'];


  function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
	
//	$ip = "103.42.192.112";
	$ip = get_client_ip();
	echo "<br><b>Your IP: </b>" . $ip;


//http://ip-api.com/docs/api:json

	$urlToSend1 = "http://ip-api.com/json/" . $ip;
    $dataReceived1 = file_get_contents($urlToSend1);

    $dataArray1 = json_decode($dataReceived1, true);
//    print_r($dataArray1);

    if ($dataArray1['status'] == "success") {
    	echo "<br><b>Your Location: </b> " . $dataArray1['city'] . ", " . $dataArray1['regionName'];
    } else{
    	echo "<br><b>Your Location: </b> Unknown";
    }

	
//http://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php
//http://stackoverflow.com/questions/3003145/how-to-get-the-client-ip-address-in-php
?>