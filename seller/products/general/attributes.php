<?php
include '../../../config/config.php';
$id=$_POST["id"];
$result = mysqli_query($con,"SELECT attributes FROM subcategory where id=$id");

while($row = mysqli_fetch_array($result)) {
    echo $row['attributes'];
}
?>
