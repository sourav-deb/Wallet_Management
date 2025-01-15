<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wallet";

// $servername = "localhost";
// $username = "playgate_wallet";
// $password = "playgate_wallet";
// $dbname = "playgate_wallet";

error_reporting(E_ERROR | E_PARSE);

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "<script>console.log('Not Connected.');</script>";
    die("Connection failed: " . mysqli_connect_error());
}else {
    echo "<script>console.log('Connection successful');</script>";
}

session_start();

?>