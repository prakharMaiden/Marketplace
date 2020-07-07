<?php
include_once("./../../config/config.php");

$title=$_REQUEST["term"];


$result=mysqli_query($con,"SELECT name,featured_image,id FROM products where name like '%$title%' and active = 1");

if (mysqli_num_rows($result)> 0) {
    while($row=mysqli_fetch_array($result)){
        $image = (!empty($row['featured_image'])) ? 'img/seller/products/'.$row['featured_image'] : 'img/noimage.jpg';
        $product_name = (strlen($row['name']) > 30) ? substr_replace($row['name'], '...', 27) : $row['name'];

        echo "  <div class='ps-product--cart-mobile' style='border-bottom: 1px solid #f1f1f1;padding-bottom: 10px;'>
                                    <div class='ps-product__thumbnail'>
                                   <a href='".PATH."/customer/product-details.php?id=".$row['id']."'>
                                   
                                    <img src='".PUBLIC_PATH.'/'.$image."' class='thumbnail' style='width: 30px' alt='User Image'>
                                    </a>
                                    </div>
                                    <div class='ps-product__content'>
                                    <a href='".PATH."/customer/product-details.php?id=".$row['id']."'>
                                    ".$product_name."</a>
                                     </div>
                                </div>";
    }
}else{
    echo "<p>No record found</p>";
}

?>
