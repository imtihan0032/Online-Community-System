<?php
# Connect and obtain data
require_once("../../database/mysqli.php");
extract($_POST);

# Insert data 
$query = $conn->query("INSERT INTO resident (Name, Block, Unit, PhoneNumber, Email, Username, Password, Age, Nationality, Occupation, Image) VALUE " .
"('{$Name}', '{$Block}', '{$Unit}', '{$PhoneNumber}', '{$Email}', '{$Username}', '{$Password}', '{$Age}', '{$Nationality}', '{$Occupation}', 'default-avatar.jpg')");

# Set results
if ($query) {
	$response["status"] = "success";
} else {
	$response["status"] = "failed";
	$response["msg"] = "An error occured: " . $conn->error;
}

# Return formatted response
echo json_encode($response);
?>