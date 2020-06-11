<?php
include_once("./../config/config.php");

if(isset($_SESSION['customer_id'])){

    $stmt = mysqli_query($con,"SELECT * FROM cart LEFT JOIN products on products.id=cart.product_id WHERE cart.customer_id='$_SESSION[customer_id]'");
    $total = 0;
    foreach($stmt as $row){
        $subtotal = $row['unit_price'] * $row['quantity'];
        $total += $subtotal;
    }

    echo json_encode($total);
}
?>