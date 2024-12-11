<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "wallet";

error_reporting(E_ERROR | E_PARSE);

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else {
    echo "<script>console.log('Connection successful');</script>";
}

session_start();

?>