<?php
require_once('config/config.php');
if($_REQUEST["action"] == "logout" ) {
    unset($_SESSION['user_type']);
    session_unset();
    session_destroy();
}
if(empty($_SESSION['customer_id'])) {
    header("location:".PATH."/seller/login/signup.php");
    exit;
}
?>
