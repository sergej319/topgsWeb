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
include 'constants/header.php';
if (isset($_SESSION['user'])) {
    header('location:/topgs/index.php');
}
?>
<div class="form">

    <form id="reg-form" method="POST" action="register_user.php">
        <?php if (isset($_SESSION['reg-msg'])) { ?>
            <div>
                <p><?php echo $_SESSION['reg-msg']; ?></p>
            </div>
        <?php

            unset($_SESSION['reg-msg']);
        } ?>
        <h2>Sign up</h2>
        <span>First name:</span>
        <input type="text" name="fname" class="input-field">
        <span>Last name:</span>
        <input type="text" name="lname" class="input-field">
        <span>Username:</span>
        <input type="text" name="username" class="input-field">
        <?php
        if (isset($_GET['m'])) {
            echo 'Username already exists';
        }
        ?>
        <span>Email:</span>
        <input type="text" name="email" class="input-field">
        <span>Password:</span>
        <input type="password" name="password" class="input-field">
        <span>Confirm password:</span>
        <input type="password" name="confirm_password" class="input-field">
        <input type="submit" name="submit" value="CREATE ACCOUNT" class="button">
        <p>Already have an account? <a href="login.php">Log in!</a></p>
    </form>
</div>
<?php
include 'constants/footer.php'; ?>