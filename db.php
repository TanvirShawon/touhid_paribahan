<?php
$host = "localhost";
$username = "touhidpa_touhidp";
$password = "IoQRsTK!@N6e";
$dbname = "touhidpa_paribahan";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

?>
