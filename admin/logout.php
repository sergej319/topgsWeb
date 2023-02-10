<?php

require "config/config.php";
require "config/functions.php";

session_destroy();
header('location:/topgs/admin/login.php');