<?php

include_once("./../config/config.php");
if(isset($_POST['review_submit'])) {
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
        header("Location: product-details.php?id=".$product_id."#tab-4");

    } else {
        $response = array(
            "type" => "danger",
            "message" => "Something went wrong!"
        );

    }
    return $response;

}

?>