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

$sql2 = "INSERT INTO logs (ip_address, device_type, user_agent) VALUES('" . $ip . "','" . $deviceType . "','" . $_SERVER['HTTP_USER_AGENT'] . "')";

//var_dump($_POST)
$res = mysqli_query(databaseConnect(), $sql);
//var_dump($res);
$row = $res->fetch_assoc();
//var_dump($row);
//return;
if($row != NULL){
    $hash = $row['password'];

    if ($_POST['password']) {
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['user'] = $row['username'];
        mysqli_query(databaseConnect(), $sql2);
        header('Location:/topgs/index.php');
    } else {
        $_SESSION['login-msg'] = "Your login info is invalid";
        header('Location:/topgs/login.php');
    }
}




