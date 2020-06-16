<?php
session_start(); // ready to go!

$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}

// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 3600;
//print_r(date('Y-m-d h:i:s',strtotime($_SESSION['discard_after'])));die;
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