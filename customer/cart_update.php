<?php

include_once("./../config/config.php");
$output = array('error'=>false);
$id = $_POST['id'];
$quantity = $_POST['quantity'];

if(isset($_SESSION['customer_id'])){
    try{
        $stmt = mysqli_query($con,"UPDATE cart SET quantity='$quantity' WHERE id='$id'");
        $output['message'] = 'Updated';
    }
    catch(PDOException $e){
        $output['message'] = $e->getMessage();
    }
}
else{
    foreach($_SESSION['cart'] as $key => $row){
        if($row['product_id'] == $id){
            $_SESSION['cart'][$key]['quantity'] = $quantity;
            $output['message'] = 'Updated';
        }
    }
}
echo json_encode($output);

?>