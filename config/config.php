<?php

session_start();
error_reporting(1);
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'kgi');
define("PATH", "http://localhost/kgi");
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>