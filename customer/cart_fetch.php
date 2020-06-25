<?php
include_once("./../config/config.php");

	$output = array('list'=>'','count'=>0);

	if(isset($_SESSION['customer_id'])){
		try{
			$stmt = mysqli_query($con,"SELECT *, products.name AS prodname,products.featured_image AS feature_image , products.unit_price AS unit_price,cart.id As cart_id  FROM cart LEFT JOIN products ON products.id=cart.product_id LEFT JOIN suppliers ON suppliers.id=products.supplier_id   WHERE cart.customer_id='$_SESSION[customer_id]' ORDER BY cart.id DESC");
			foreach($stmt as $row){
				//echo'<pre>';print_r($row);die;
				$output['count']++;
				$image = (!empty($row['feature_image'])) ? 'img/seller/products/'.$row['feature_image'] : 'img/noimage.jpg';
				$productname = (strlen($row['prodname']) > 30) ? substr_replace($row['prodname'], '...', 27) : $row['prodname'];
				$output['list'] .= "
					 <div class='ps-product--cart-mobile'>
                                    <div class='ps-product__thumbnail'>
                                   <a href='product-details.php?id=".$row['product_id']."'>
                                   
                                    <img src='".PUBLIC_PATH.'/'.$image."' class='thumbnail' alt='User Image'>
                                    </a>
                                    </div>
                                    <div class='ps-product__content'>
                                    <a class='ps-product__remove' href='#'>
                                    <i class='icon-cross'></i></a>
                                    <a href='product-details.php?id=".$row['product_id']."'>
                                    ".$productname."</a>
                                        <p>Sold By:<small> ".$row['company_name']."</small><br/><small>".$row['quantity']."&times;  Rs.".number_format($row['unit_price'],2)."</small>
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
			$output['list'] .= "
					<div class='ps-product--cart-mobile'>
					<tr>
					<td colspan='5' class='text-center'><b>Login to proceed</b></td>				
					</tr>
					 </div>
				";
		}
	}
	echo json_encode($output);

?>

