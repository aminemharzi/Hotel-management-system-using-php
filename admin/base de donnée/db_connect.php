<?php

$serverName = "sql312.epizy.com";
$dBUserName = "epiz_29789461";
$dBPassword = "Ng7prdrx481";
$dBName = "epiz_29789461_mydb";

$conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);
if (!$conn) {
	die('Connection failed: '.mysqli_connect_error());
}
?>