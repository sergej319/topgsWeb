<?php

if(!isset($_SESSION['user'])){
    header('location:/topgs/login.php');
}