<?php 
session_start();

//destroy session
session_destroy();
header("location: login.php");
 ?>
