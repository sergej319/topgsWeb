<?php
require_once 'Mobile-Detect-2.8.39/Mobile_Detect.php';


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

//$ip = '103.14.26.0';

/*var_dump($_SERVER);
        var_dump($detect);*/



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/constants.css">
        <link rel="stylesheet" href="css/reg.css">
        <title>Cobra Weather</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&700display=swap" rel="stylesheet">
    </head>

    <?php
    require 'constants/header.php'; ?>
    <div class="form">
        <form id="log-form" action="formHandler/login_user.php" method="post" >
                <h2>Login</h2>
                <span>Username:</span>
                <input type="text" name="username" class="input-field">
                <span>Password:</span>
                <input type="password" name="password" class="input-field">
                <input type="submit" name="submit" value="LOG IN" class="button">
                <p>Don't have an account? <a href="register.php">Create one!</a></p>
            </form>
    </div>

    <?php
    if (!empty($_GET['m'])) {
        echo 'Please fill in the correct data.';
    }
    ?>

    </form>

    <?php include 'constants/footer.php'; ?>


