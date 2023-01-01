<?php
session_start();
// Set connection variables
$server = "localhost";
$username = "root";
$password = "";

// Create a database connection
$con = mysqli_connect($server, $username, $password);

mysqli_select_db($con, 'wia2003');

session_unset();
session_destroy();

header('location:../index.php');