<?php
# Connect and obtain data
require_once("../../database/mysqli.php");
extract($_POST);

# Delete data
$delete = $conn->query("DELETE FROM resident WHERE ResidentID = '{$ResidentID}'");

# Set results
if ($delete) {
    $response["status"] = "success";
} else {
    $response["status"] = "failed";
    $response["msg"] = "An error occured: " . $conn->error;
}

# Return formatted response
echo json_encode($response);
?>