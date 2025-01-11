<?php
include '../../auth.php';
session_start();
session_unset();
session_destroy();
header("Location: ./../../retailer_login.php");
exit();
?>
