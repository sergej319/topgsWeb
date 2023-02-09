<?php
include "config/config.php";

$sql = "SELECT * from users";
$res = mysqli_query(databaseConnect(), $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $username = $row['username'];
}


if(isset($_GET['name'])){
    
}