<?php
session_start();
error_reporting(E_ALL);
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'kgi');
define('CWD', getcwd());
define("PATH", "http://localhost/Marketplace");
define("PUBLIC_PATH","http://localhost/Marketplace/public");
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>