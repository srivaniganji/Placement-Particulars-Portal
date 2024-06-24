<?php

$sname= "sql112.infinityfree.com";
$unmae= "if0_35127122";
$password = "Govardhani";

$db_name = "if0_35127122_rgu_p";

$con = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$con) {
	echo "Connection failed!";
}
?>

