<?php
include_once '../config/config.php';
include_once '../config/functions.php';

$username = isset($_POST["username"]) ? sanitize($_POST["username"]) : null;
$id_user = isset($_POST["id_user"]) ? (int)sanitize($_POST["id_user"]) : null;
$fname = isset($_POST["fname"]) ? sanitize($_POST["fname"]) : null;
$lname = isset($_POST["lname"]) ? sanitize($_POST["lname"]) : null;
$email = isset($_POST["email"]) ? sanitize($_POST["email"]) : null;
$op = isset($_POST["op"]) ? sanitize($_POST["op"]) : null;

$aclass = 'alert alert-warning';
$statusResponse = 'error';
$message = 'Error!';

if (!empty($username) and !empty($id_user) and !empty($fname) and !empty($lname) and !empty($email) and $op === 'update' and is_ajax() ) {
    $aclass = 'alert alert-success';
    $statusResponse = 'success';

    if (updateUser($username, $id_user, $fname, $lname, $email, databaseConnect())) {
        $message = "User updated successfully!";
    } else {
        $message = "There were no changes";
    }
}

$data = array('status' => $statusResponse, 'message' => $message, 'aclass' => $aclass);
//header('Content-Type:application/json;charset=utf-8');
echo json_encode($data);

var_dump(updateUser($username, $id_user, $fname, $lname, $email, databaseConnect()));
