<?php
include_once("./../config/config.php");

	$output = array('list'=>'','count'=>0);

	if(isset($_SESSION['customer_id'])){
		try{
			$stmt = mysqli_query($con,"SELECT *, products.name AS product_name,products.featured_image AS featured_image, category.name AS catname FROM wishlist LEFT JOIN products ON products.id=wishlist.product_id LEFT JOIN category ON category.id=products.category_id WHERE wishlist.customer_id='$_SESSION[customer_id]'");
			foreach($stmt as $row){
				$output['count']++;
				$image = (!empty($row['featured_image'])) ? 'img/seller/products/'.$row['featured_image'] : 'img/noimage.jpg';
				$productname = (strlen($row['product_name']) > 30) ? substr_replace($row['product_name'], '...', 27) : $row['product_name'];
				$output['list'] .= "
					 <div class='ps-product--cart-mobile'>
                                    <div class='ps-product__thumbnail'>
                                   <a href='product-details.php?id=".$row['id']."'>
                                   
                                    <img src='".PUBLIC_PATH.'/'.$image."' class='thumbnail' alt='User Image'>
                                    </a>
                                    </div>
                                    <div class='ps-product__content'><a class='ps-product__remove' href='#'>
                                    <i class='icon-cross'></i></a>
                                    <a href='product-details.php?id=".$row['id']."'>
                                    ".$productname."</a>
                                        <p> ".$row['catname']."</p>
                                    </div>
                                </div>
				";
			}
		}
		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}
	}
	else{
		if(!isset($_SESSION['wishlist'])){
			$_SESSION['wishlist'] = array();
		}

		if(empty($_SESSION['wishlist'])){
			$output['count'] = 0;
		}
		else{
			foreach($_SESSION['wishlist'] as $row){
				$output['count']++;
				$stmt =mysqli_query($con,"SELECT *, products.name AS product_name,products.featured_image AS featured_image, category.name AS catname FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.id='$id'");
				$product = mysqli_fetch_assoc($stmt);
				$image = (!empty($product['featured_image'])) ? 'img/seller/products/'.$product['featured_image'] : 'img/noimage.jpg';
				$output['list'] .= "
					
					 <div class='ps-product--cart-mobile'>
                                    <div class='ps-product__thumbnail'>
                                   <a href='product-details.php?id=".$product['id']."'>
                                    <img src='".PUBLIC_PATH.'/'.$image."' class='thumbnail' alt='User Image'>
                                    </a>
                                    </div>
                                    <div class='ps-product__content'><a class='ps-product__remove' href='#'>
                                    <i class='icon-cross'></i></a>
                                    <a href='product-details.php?id=".$row['id']."'>
                                    ".$product['product_name']."</a>
                                        <p> ".$product['catname']."</p>
                                    </div>
                                </div>
				";
				
			}
		}
	}
	echo json_encode($output);

?>

