<?php

include '../config/config.php';
if(isset($_POST['submit'])) {
    $product_id=$_POST["product_id"];
    $customer_id=$_SESSION['customer_id'];
    $rating= $_POST["rating"];
    $review= $_POST["review"];
    $result = "INSERT INTO reviews (product_id,customer_id,rating,review)
                   VALUES('$product_id','$customer_id','$rating','$review')";

    if (mysqli_query($con, $result)) {
        $response = array(
            "type" => "success",
            "message" => "record added successfully."
        );
        return $response;
    } else {
        $response = array(
            "type" => "danger",
            "message" => "Something went wrong!"
        );
        return $response;
    }


}

?>