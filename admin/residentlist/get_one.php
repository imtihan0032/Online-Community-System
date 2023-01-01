<?php
# Connect and obtain data
require_once("../../database/mysqli.php");
extract($_POST);

# Get one data row
$query = $conn->query("SELECT * FROM resident WHERE ResidentID = '{$id}'");

# Set results
if ($query) {
    $response["status"] = "success";
    $response["data"] = $query->fetch_array();
} else {
    $response["status"] = "success";
    $response["error"] = "An error occured: " . $conn->error;
}

# Return formatted response
echo json_encode($response);
?>