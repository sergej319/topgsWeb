<?php
include "../config/config.php";
include "../config/functions.php";

if (isset($_POST['id'])) {
    $id_log = (int)$_POST['id'];
    deleteLog( databaseConnect(), $id_log);
}