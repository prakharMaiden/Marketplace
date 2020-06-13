<?php
include_once("./../config/config.php");

	$output = '';
if(isset($_SESSION['customer_id'])){
		if(isset($_SESSION['wishlist'])){
			foreach($_SESSION['wishlist'] as $row){
				$stmt = mysqli_query($con,"SELECT *, COUNT(*) AS numrows FROM wishlist WHERE customer_id='$_SESSION[customer_id]' AND product_id='$row[product_id]'");
				$crow =  mysqli_fetch_assoc($stmt);
				if($crow['numrows'] < 1){
					$stmt = mysqli_query($con,"INSERT INTO wishlist (customer_id, product_id) VALUES ('$_SESSION[customer_id]', '$row[product_id]')");
				mysqli_fetch_assoc($stmt);
				}
			}
			unset($_SESSION['wishlist']);
		}

		try{
			$total = 0;
			$stmt = mysqli_query($con,"SELECT *, wishlist.id AS wishlist_id FROM wishlist LEFT JOIN products ON products.id=wishlist.product_id WHERE wishlist.customer_id='$_SESSION[customer_id]' ORDER BY wishlist.id DESC");
			if (mysqli_num_rows($stmt) > 0) {
			foreach($stmt as $row){

					$stmt = mysqli_query($con,"SELECT * FROM suppliers WHERE id='$row[supplier_id]'");
					$supplier = mysqli_fetch_assoc($stmt);
					$image = (!empty($row['featured_image'])) ? 'img/seller/products/'.$row['featured_image'] : 'img/noimage.jpg';
					$subtotal = $row['unit_price'];
					$total += $subtotal;
					$output .= "
					<tr>
					<td><a type='button' data-id='".$row['wishlist_id']."' class='wishlist_delete'><i class='icon-cross'></i></a></td>
						<td><div class='ps-product--cart'>
    <div class='ps-product__thumbnail'><a href='product-details.php?id=".$row['id']."'><img src='".PUBLIC_PATH.'/'.$image."'></a></div>
    <div class='ps-product__content'><a href='product-details.php?id=".$row['id']."'>".$row['name']."</a>
        <p>Sold By:<strong> ".$supplier['company_name']."</strong></p>
    </div>
</div></td>
						<td>Rs.&nbsp;".number_format($row['unit_price'], 2)."</td>
						<td>
						<a type='button' data-id='".$row['id']."' class='ps-btn add_cart'>Add to cart</a>
						</td>						
					</tr>
				";
				}

			}else{
				$output .= "
					<tr>
					<td colspan='4' class='text-center'><b>No record Found</b></td>						
					</tr>
				";

			}

		}
		catch(PDOException $e){
			$output .= $e->getMessage();
		}

	}
	else{

		$output .= "
					<tr>
					<td colspan='5' class='text-center'><b>Login to proceed</b></td>				
					</tr>
				";
//		if(count($_SESSION['cart']) != 0){
//			$total = 0;
//			foreach($_SESSION['cart'] as $row){
//				$stmt = mysqli_query($con,"SELECT *, products.name AS prodname, category.name AS catname FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.id='$row[product_id]'");
//				$product = mysqli_fetch_assoc($stmt);
//				$stmt = mysqli_query($con,"SELECT * FROM suppliers WHERE id='$product[supplier_id]'");
//				$supplier = mysqli_fetch_assoc($stmt);
//				$image = (!empty($product['featured_image'])) ? 'img/seller/products/'.$product['featured_image'] : 'img/noimage.jpg';
//				$subtotal = $product['unit_price']*$row['quantity'];
//				$total += $subtotal;
//				$output .= "
//					<tr>
//					<td><div class='ps-product--cart'>
//    <div class='ps-product__thumbnail'><a href='product-details.php?id=".$product['id']."'><img src='".PUBLIC_PATH.'/'.$image."'></a></div>
//    <div class='ps-product__content'><a href='product-details.php?id=".$product['id']."'>".$product['prodname']."</a>
//        <p>Sold By:<strong> ".$supplier['company_name']."</strong></p>
//    </div>
//</div></td>
//						<td>Rs. ".number_format($product['unit_price'], 2)."</td>
//						<td>
//						<div class='form-group--number'>
//                                            <button class='up' data-id='".$row['product_id']."'>+</button>
//                                            <button class='down' data-id='".$row['product_id']."'>-</button>
//                                            <input class='form-control' type='text' placeholder='1' value='".$row['quantity']."' id='qty_".$row['product_id']."' min='1'>
//                                        </div>
//
//						</td>
//						<td>Rs. ".number_format($subtotal, 2)."</td>
//						<td><a type='button' data-id='".$row['product_id']."' class='cart_delete'><i class='icon-cross'></i></a></td>
//
//					</tr>
//				";
//
//			}
//
//			$output .= "
//				<tr>
//					<td colspan='5' align='right'><b>Total</b></td>
//					<td ><b id='total_ammount1'>Rs. ".number_format($total, 2)."</b></td>
//				<tr>
//			";
//		}
//
//		else{
//			$output .= "
//				<tr>
//					<td colspan='5' class='text-center'><b>Shopping cart empty</b></td>
//				<tr>
//			";
//		}
		
	}
	echo json_encode($output);

?>

