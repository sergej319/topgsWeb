<?php
include "../config/config.php";
$sql3 = "DELETE FROM favorites WHERE id_city='" . $_POST['id_city'] . "' AND id_user='" . $_SESSION['id_user'] . "'";
mysqli_query(databaseConnect(), $sql3);
header("location:/topgs/profile.php");