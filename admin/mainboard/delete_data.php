<?php
require_once('../../database/mysqli.php');
extract($_POST);

$delete = $conn->query("DELETE FROM `task` where TaskID = '{$TaskID}'");
if ($delete) {
    $resp['status'] = 'success';
} else {
    $resp['status'] = 'failed';
    $resp['msg'] = 'An error occured: ' . $conn->error;
}

echo json_encode($resp);
