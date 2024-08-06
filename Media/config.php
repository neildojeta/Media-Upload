<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "media"; 


$conn = mysqli_connect($host, $username, $password) or die(mysqli_error());
$conn->set_charset("utf8");
mysqli_select_db($conn,$database) or die(mysqli_error());
?>