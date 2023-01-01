<?php
require_once('../../database/mysqli.php');

session_start();
extract($_POST);

$query = $conn->query("INSERT INTO `task` (`AdminID`,`Task`,`Description`,`Deadline`) VALUE ('{$_SESSION['AdminID']}','{$Task}','{$Description}','{$Deadline}')");
if ($query) {
    $resp['status'] = 'success';
} else {
    $resp['status'] = 'failed';
    $resp['msg'] = 'An error occured: ' . $conn->error;
}

echo json_encode($resp);