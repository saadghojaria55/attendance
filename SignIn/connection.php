<?php

$servername = "mysql.hostinger.com";
$loginname = "u977017150_attendance";
$pass = "bani@123";
$databases = "u977017150_bani";
$link = new mysqli($servername, $loginname, $pass, $databases);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

?>