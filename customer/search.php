<?php
include_once("./../config/config.php");
$title=$_POST["title"];


$result=mysqli_query($con,"SELECT * FROM products where name like '%$title%' and active=1");
$found=mysqli_num_rows($result);

if($found>0){
    while($row=mysqli_fetch_array($result)){
        echo "<li>$row[name]</br></li>";
    }
}else{
    echo "<li>No Tutorial Found<li>";
}
?>
