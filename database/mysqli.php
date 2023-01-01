<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "wia2003";

$conn = new mysqli($host, $username, $password, $database);
if(!$conn){
    echo "Database connection failed. Error:".$conn->error;
    exit;
}
?>