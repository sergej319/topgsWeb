<?php
include('config/config.php');
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * from admins WHERE username='$username' AND password='$password'";

    $res = mysqli_query(databaseConnect(), $sql);
    $row = $res->fetch_assoc();

    if (!empty($row)) {
        $_SESSION['admin'] = $row['username'];
        $_SESSION['id_admin'] = $row['id_admin'];
        header('location:/topgs/admin/index.php');
    } else {
        header('location:/topgs/admin/login.php');
    }
}
