<?php
header('Content-type: application/json; charset=utf-8');
include_once '../config/config.php';

// Prikazivanje svih PHP grešaka
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT * FROM logs";

$result = mysqli_query(databaseConnect(), $sql) or die("database error:" . mysqli_error(databaseConnect()));
$number = 1;

$data = [];

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $data[] = [
        $number,
        $row['ip_address'],
        $row['device_type'],
        $row['user_agent'],
        $row['date_time'],
        '<i class="bi bi-trash-fill deleteLog pointer" data-id="' . $row['id_log'] . '" data-name="' . $row['ip_address'] . '" title="Delete"></i> '
    ];
    $number++;
}

$json_data = [
    "draw" => 1,
    "data" => $data
];

echo json_encode($json_data);