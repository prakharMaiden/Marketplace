<?php
include_once("./../config/config.php");
	$id = $_POST['id'];
	$quantity = $_POST['quantity'];

	if(isset($_SESSION['customer_id'])){
		$stmt = mysqli_query($con,"SELECT *, COUNT(*) AS numrows FROM cart WHERE customer_id='$_SESSION[customer_id]' And product_id='$id' And quantity='$quantity'");
        $row= mysqli_fetch_assoc($stmt);
        if($row['numrows'] < 1){
			try{
				$stmt =mysqli_query($con,"INSERT INTO cart (customer_id, product_id, quantity) VALUES ('$_SESSION[customer_id]', '$id', '$quantity')");
				$output['message'] = 'Item added to cart';
				
			}
			catch(PDOException $e){
				$output['error'] = true;
				$output['message'] = $e->getMessage();
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Product already in cart';
		}
	}
	else{
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}

		$exist = array();

		foreach($_SESSION['cart'] as $row){
			array_push($exist, $row['product_id']);
		}

		if(in_array($id, $exist)){
			$output['error'] = true;
			$output['message'] = 'Product already in cart';
		}
		else{
			$data['product_id'] = $id;
			$data['quantity'] = $quantity;

			if(array_push($_SESSION['cart'], $data)){
				$output['message'] = 'Item added to cart';
			}
			else{
				$output['error'] = true;
				$output['message'] = 'Cannot add item to cart';
			}
		}

	}
	echo json_encode($output);

?>