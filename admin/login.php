<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ac.css">
    <title>Admin Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&700display=swap" rel="stylesheet">
</head>

<?php
require 'constants/header.php'; ?>

<div style="min-height: 80vh; display: flex; justify-content: center; align-items:center; " class=" form">
    <form style="background-color: white; opacity: 0.9; padding: 20px; border-radius: 15px; display: flex; flex-direction: column; max-width: 500px" id="log-form" action="" method="post">
        <h2>Login</h2>
        <span>Username:</span>
        <input type="text" name="username" class="input-field" style="margin-bottom: 20px">
        <span>Password:</span>
        <input type="password" name="password" class="input-field" style="margin-bottom: 20px">
        <input type="submit" name="submit" value="LOG IN" class="button" style="margin-bottom: 20px; background-color: #222; color: white;">
        <p>Don't have an account? <a href="register.php">Create one!</a></p>
    </form>
</div>


</form>

<?php include 'constants/footer.php'; ?>

<?php

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
?>