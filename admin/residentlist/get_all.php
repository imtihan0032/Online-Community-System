<?php
# Connect and obtain data
require_once("../../database/mysqli.php");
extract($_POST);

# Builds the search query when the admin filter the entries
$search_where = "";
if (!empty($search)) {
    $search_where = " WHERE ";
    $search_where .= " Name LIKE '%{$search['value']}%' ";
}

# For specified order
$columns_arr = array(
    "Name",
    "PhoneNumber",
    "Block",
    "Unit"
);

# Get total number of rows
$recordsTotal = $conn->query("SELECT * FROM resident")->num_rows;

# Get filtered total number of rows
$recordsFiltered = $conn->query("SELECT * FROM resident {$search_where}")->num_rows;

# Get all data rows
$query = $conn->query("SELECT * FROM resident {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start}");

# Processes data
$data = array();
while ($row = $query->fetch_assoc()) {
    $data[] = $row;
}

// Returns the response in JSON format
echo json_encode(
    array(
        "draw" => $draw,
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    )
);
