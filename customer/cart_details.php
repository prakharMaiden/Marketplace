<?php
include_once("./../config/config.php");

	$output = '';
if(isset($_SESSION['customer_id'])){
		if(isset($_SESSION['cart'])){
			foreach($_SESSION['cart'] as $row){
				$stmt = mysqli_query($con,"SELECT *, COUNT(*) AS numrows FROM cart WHERE customer_id='$_SESSION[customer_id]' AND product_id='$row[product_id]' ORDER BY cart.id DESC");
				$crow =  mysqli_fetch_assoc($stmt);
				if($crow['numrows'] < 1){
					$stmt = mysqli_query($con,"INSERT INTO cart (customer_id, product_id, quantity) VALUES ('$_SESSION[customer_id]', '$row[product_id]', '$row[quantity]')");
				mysqli_fetch_assoc($stmt);
				}
				else{
					$stmt = mysqli_query($con,"UPDATE cart SET quantity='$row[quantity]' WHERE customer_id='$_SESSION[customer_id]' AND product_id='$row[product_id]'");
				}
			}
			unset($_SESSION['cart']);
		}

		try{
			$total = 0;
			$stmt = mysqli_query($con,"SELECT *, cart.id AS cart_id ,suppliers.id as supplier_id FROM cart LEFT JOIN products ON products.id=cart.product_id LEFT JOIN suppliers ON suppliers.id=products.supplier_id WHERE cart.customer_id='$_SESSION[customer_id]' ORDER BY cart.id DESC");

			foreach($stmt as $row){
				//print_r($row);die;
				$image = (!empty($row['featured_image'])) ? 'img/seller/products/'.$row['featured_image'] : 'img/noimage.jpg';
				$subtotal = $row['unit_price']*$row['quantity'];
				$total += $subtotal;
				$output .= "
					<tr>
						<td><div class='ps-product--cart'>
    <div class='ps-product__thumbnail'><a href='product-details.php?id=".$row['product_id']."'><img src='".PUBLIC_PATH.'/'.$image."'></a></div>
    <div class='ps-product__content'><a href='product-details.php?id=".$row['product_id']."'>".$row['name']."</a>
        <p>Sold By:<strong> ".$row['company_name']."</strong></p>
    </div>
</div></td>
						<td>Rs.&nbsp;".number_format($row['unit_price'], 2)."</td>
						<td>
						
						<div class='form-group--number'>
                                            <button class='up' data-id='".$row['cart_id']."'>+</button>
                                            <button class='down' data-id='".$row['cart_id']."'>-</button>
                                            <input class='form-control' type='text' placeholder='1' value='".$row['quantity']."' id='qty_".$row['cart_id']."' min='1'>
                                        </div>
						
							
						</td>
						<td>Rs.&nbsp;".number_format($subtotal, 2)."</td>
						<td><a type='button' data-id='".$row['cart_id']."' class='cart_delete'><i class='icon-cross'></i></a></td>						
					</tr>
				";
			}
			$output .= "
				<tr>
					<td colspan='4' align='right'><b>Total</b></td>
					<td><b  id='total_ammount1'>Rs.&nbsp;".number_format($total, 2)."</b></td>
				<tr>
			";

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

