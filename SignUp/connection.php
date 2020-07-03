<?php

$servername = "localhost";
$loginname = "root";
$pass = "";

$link = new mysqli($servername, $loginname, $pass);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

?>