<?php
require_once("../../database/mysqli.php");

session_start();
extract($_POST);

$totalCount = $conn->query("SELECT * FROM `task` WHERE AdminID = '{$_SESSION['AdminID']}'")->num_rows;

$search_where = "";
if (!empty($search)) {
    $search_where = " where ";
    $search_where .= " Task LIKE '%{$search['value']}%' ";
    $search_where .= " OR Description LIKE '%{$search['value']}%' ";
    $search_where .= " OR date_format(Deadline,'%M %d, %Y') LIKE '%{$search['value']}%' ";
}

$columns_arr = array(
    "Task",
    "Description",
    "unix_timestamp(Deadline)"
);

$query = $conn->query("SELECT * FROM `task` {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");

$data = array();
$i = 1 + $start;
$recordsFilterCount = 0;
while ($row = $query->fetch_assoc()) {
    if ($row['AdminID'] === $_SESSION['AdminID']) {
        $row['Index'] = $i++;
        $row['Deadline'] = date("F d, Y", strtotime($row['Deadline']));
        $data[] = $row;
        $recordsFilterCount++;
    }
}
$recordsTotal = $totalCount;
$recordsFiltered = $recordsFilterCount;

echo json_encode(
    array(
        'draw' => $draw,
        'recordsTotal' => $recordsTotal,
        'recordsFiltered' => $recordsFiltered,
        'data' => $data
    )
);
