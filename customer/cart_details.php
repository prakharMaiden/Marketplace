<?php
include_once("./../config/config.php");

	$output = '';

if(isset($_SESSION['customer_id'])){
		if(isset($_SESSION['cart'])){
			foreach($_SESSION['cart'] as $row){
				$stmt = mysqli_query($con,"SELECT *, COUNT(*) AS numrows FROM cart WHERE customer_id='$_SESSION[customer_id]' AND product_id='$row[product_id]'");
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
			$stmt = mysqli_query($con,"SELECT *, cart.id AS cart_id FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE cart.customer_id='$_SESSION[customer_id]'");
			foreach($stmt as $row){
				$image = (!empty($row['featured_image'])) ? 'img/seller/products/'.$row['featured_image'] : 'img/noimage.jpg';
				$subtotal = $row['unit_price']*$row['quantity'];
				$total += $subtotal;
				$output .= "
					<tr>
						<td><img src='".PUBLIC_PATH.'/'.$image."' width='30px' height='30px'></td>
						<td>".$row['name']."</td>
						<td>Rs.&nbsp;".number_format($row['unit_price'], 2)."</td>
						<td class='input-group'>
							<span class='input-group-btn'>
            					<button type='button' id='minus' class='btn btn-default btn-flat minus' data-id='".$row['cart_id']."'><i class='fa fa-minus'></i></button>
            				</span>
            				<input type='text' class='form-control' value='".$row['quantity']."' id='qty_".$row['cart_id']."'>
				            <span class='input-group-btn'>
				                <button type='button' id='add' class='btn btn-default btn-flat add' data-id='".$row['cart_id']."'><i class='fa fa-plus'></i>
				                </button>
				            </span>
						</td>
						<td>Rs.&nbsp;".number_format($subtotal, 2)."</td>
						<td><a type='button' data-id='".$row['cart_id']."' class='cart_delete'><i class='icon-cross'></i></a></td>						
					</tr>
				";
			}
			$output .= "
				<tr>
					<td colspan='4' align='right'><b>Total</b></td>
					<td><b>Rs.&nbsp;".number_format($total, 2)."</b></td>
				<tr>
			";

		}
		catch(PDOException $e){
			$output .= $e->getMessage();
		}

	}
	else{
		if(count($_SESSION['cart']) != 0){
			$total = 0;
			foreach($_SESSION['cart'] as $row){
				$stmt = mysqli_query($con,"SELECT *, products.name AS prodname, category.name AS catname FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.id='$row[product_id]'");
				$product = mysqli_fetch_assoc($stmt);
				$image = (!empty($row['featured_image'])) ? 'img/seller/products/'.$row['featured_image'] : 'img/noimage.jpg';
				$subtotal = $product['unit_price']*$row['quantity'];
				$total += $subtotal;
				$output .= "
					<tr>
					<td><img src='".PUBLIC_PATH.'/'.$image."' width='30px' height='30px'></td>
						<td>".$product['name']."</td>
						<td>&#36; ".number_format($product['unit_price'], 2)."</td>
						<td class='input-group'>
							<span class='input-group-btn'>
            					<button type='button' id='minus' class='btn btn-default btn-flat minus' data-id='".$row['product_id']."'><i class='fa fa-minus'></i></button>
            				</span>
            				<input type='text' class='form-control' value='".$row['quantity']."' id='qty_".$row['product_id']."'>
				            <span class='input-group-btn'>
				                <button type='button' id='add' class='btn btn-default btn-flat add' data-id='".$row['product_id']."'><i class='fa fa-plus'></i>
				                </button>
				            </span>
						</td>
						<td>&#36; ".number_format($subtotal, 2)."</td>
						<td><a type='button' data-id='".$row['product_id']."' class='cart_delete'><i class='fa fa-remove'></i></a></td>
					
					</tr>
				";
				
			}

			$output .= "
				<tr>
					<td colspan='5' align='right'><b>Total</b></td>
					<td><b>&#36; ".number_format($total, 2)."</b></td>
				<tr>
			";
		}

		else{
			$output .= "
				<tr>
					<td colspan='6' align='center'>Shopping cart empty</td>
				<tr>
			";
		}
		
	}
	echo json_encode($output);

?>

