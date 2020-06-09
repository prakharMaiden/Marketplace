<?php
include_once("./../config/config.php");

	$output = array('list'=>'','count'=>0);

	if(isset($_SESSION['customer_id'])){
		try{
			$stmt = mysqli_query($con,"SELECT *, products.name AS prodname,products.featured_image AS feature_image, category.name AS catname FROM cart LEFT JOIN products ON products.id=cart.product_id LEFT JOIN category ON category.id=products.category_id WHERE cart.customer_id='$_SESSION[customer_id]'");
			//$row= mysqli_fetch_assoc($stmt);
			//print_r($stmt);die;
			foreach($stmt as $row){
				$output['count']++;
				$image = (!empty($row['feature_image'])) ? 'img/seller/products/'.$row['feature_image'] : 'img/noimage.jpg';
				$productname = (strlen($row['prodname']) > 30) ? substr_replace($row['prodname'], '...', 27) : $row['prodname'];
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
                                        <p> ".$row['catname']."</p><small>&times; ".$row['quantity']."</small>
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
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}

		if(empty($_SESSION['cart'])){
			$output['count'] = 0;
		}
		else{
			foreach($_SESSION['cart'] as $row){
				$output['count']++;
				$stmt =mysqli_query($con,"SELECT *, products.name AS prodname,products.featured_image AS feature_image, category.name AS catname FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.id='$id'");
				$product = mysqli_fetch_assoc($stmt);
				$image = (!empty($product['feature_image'])) ? 'img/seller/products/'.$product['feature_image'] : 'img/noimage.jpg';
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
                                    ".$product['prodname']."</a>
                                        <p> ".$product['catname']."</p><small>&times; ".$row['quantity']."</small>
                                    </div>
                                </div>
				";
				
			}
		}
	}
	echo json_encode($output);

?>

