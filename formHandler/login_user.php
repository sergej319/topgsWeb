<?php  
include "../config/config.php";
require_once '../Mobile-Detect-2.8.39/Mobile_Detect.php';
$detect = new Mobile_Detect();

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

if (!filter_var($ip, FILTER_VALIDATE_IP)) {
    $ip = "unknown";
}
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');


$sql = "SELECT * FROM users WHERE username='".$_POST['username']."' LIMIT 1";

$sql2 = "INSERT INTO logs (ip_address, device_type, user_agent, date_time) VALUES('" . $ip . "','" . $deviceType . "','" . $_SERVER['HTTP_USER_AGENT'] . "' , '" . date('h:i:s D.m.Y') . "');";

//var_dump($_POST)
$res = mysqli_query(databaseConnect(), $sql);
$row = $res->fetch_assoc();

if(!empty($row)){
    $hash = $row['password'];

    if (password_verify($_POST['password'], $hash)) {
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['user'] = $row['username'];
        mysqli_query(databaseConnect(), $sql2);
        header('location:/topgs/index.php');
    } else {
        $_SESSION['login-msg'] = "Your login info is invalid";
        header('location:/topgs/login.php');
    }
}




