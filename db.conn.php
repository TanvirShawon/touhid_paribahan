<?php
$sName = "localhost";
$uName = "touhidpa_touhidp";
$pass = "IoQRsTK!@N6e";
$db_name = "touhidpa_paribahan";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name",
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}
