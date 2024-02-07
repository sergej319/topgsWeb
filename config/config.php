<?php

$api_key = '317875d9da97449bd31293b89a4d994e';

define("CONFPARAMS", ['localhost', 'root', '', 'topgs23']);
session_start();

function databaseConnect()
{
    global $connection;
    $connection = mysqli_connect(CONFPARAMS[0], CONFPARAMS[1], CONFPARAMS[2], CONFPARAMS[3]);

    if (!$connection) {
        die("Connection failed!");
    }

    mysqli_query($connection, "SET NAMES utf8") or die (mysqli_error($connection));
    mysqli_query($connection, "SET CHARACTER SET utf8") or die (mysqli_error($connection));
    mysqli_query($connection, "SET COLLATION_CONNECTION='utf8_general_ci'") or die (mysqli_error($connection));

    return $connection;
}




?>