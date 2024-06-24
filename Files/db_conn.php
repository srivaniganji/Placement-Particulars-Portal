<?php

$host = 'sql112.infinityfree.com';
$user = 'if0_35127122';
$password = 'Govardhani';
$database = 'if0_35127122_rgu_p';

// Attempt to connect to MySQL
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// If you reach this point, the connection was successful
//echo "Connected successfully to database!";
