<?php

if(!isset($_SESSION['admin'])){
    header('location:/topgs/admin/login.php');
}