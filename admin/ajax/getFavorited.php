<?php
header('Content-type: application/json; charset=utf-8');
include_once '../config/config.php';

$sql = "SELECT * FROM statistics ORDER BY favorited DESC";

$result = mysqli_query(databaseConnect(), $sql) or die("database error:" . mysqli_error($connection));
$number = 1;

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    $data[] = [$number, $row['city_name'], $row['favorited']];
    $number++;
}

$json_data = [
    "draw" => 1,
    "data" => $data
];

echo json_encode($json_data);
