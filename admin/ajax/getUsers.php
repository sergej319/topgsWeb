<?php
header('Content-type: application/json; charset=utf-8');
include_once '../config/config.php';

$sql = "SELECT * FROM users";

$result = mysqli_query(databaseConnect(), $sql) or die("database error:" . mysqli_error($connection));
$number = 1;

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    $data[] = [$number, $row['username'], $row['email'], $row['fname'] . " " . $row['lname'], $row['active'], '<a class="text-dark" data-bs-toggle="modal" href="#userModal" ><i class="bi bi-pencil-fill editUser" data-id="' . $row['id_user'] . '" title="Edit"></i></a> &nbsp;<i class="bi bi-trash-fill deleteUser pointer" data-id="' . $row['id_user'] . '" data-name="' . $row['username'] . '" title="Delete"></i> '];
    $number++;
}

$json_data = [
    "draw" => 1,
    "data" => $data
];

echo json_encode($json_data);