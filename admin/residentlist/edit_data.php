<?php
# Connect and obtain data
require_once("../../database/mysqli.php");
extract($_POST);

# Update data
$update = $conn->query("UPDATE resident SET Name = '{$Name}', Block = '{$Block}', Unit = '{$Unit}', PhoneNumber = '{$PhoneNumber}',"
                        . " Email = '{$Email}', Username = '{$Username}', Password = '{$Password}', Age = '{$Age}',"
                        . " Nationality = '{$Nationality}', Occupation = '{$Occupation}' WHERE ResidentID = '{$ResidentID}'");

# Set results
if ($update) {
    $response["status"] = "success";
} else {
    $response["status"] = "failed";
    $response["msg"] = "An error occured: " . $conn->error;
}

# Return formatted response
echo json_encode($response);
?>