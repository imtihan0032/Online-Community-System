<?php
require_once('../../database/mysqli.php');
extract($_POST);

$update = $conn->query(
    "UPDATE `task` set `Task` = '{$Task}', `Description` = '{$Description}' ,`Deadline` = '{$Deadline}' where TaskID = '{$TaskID}'"
);
if ($update) {
    $resp['status'] = 'success';
} else {
    $resp['status'] = 'failed';
    $resp['msg']    = 'An error occured: ' . $conn->error;
}

echo json_encode($resp);
