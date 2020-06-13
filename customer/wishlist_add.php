<?php
include_once("./../config/config.php");
	$id = $_POST['id'];

	if(isset($_SESSION['customer_id'])){
		$stmt = mysqli_query($con,"SELECT *, COUNT(*) AS numrows FROM wishlist WHERE customer_id='$_SESSION[customer_id]' And product_id='$id'");
        $row= mysqli_fetch_assoc($stmt);
        if($row['numrows'] < 1){
			try{
				$stmt =mysqli_query($con,"INSERT INTO wishlist (customer_id, product_id) VALUES ('$_SESSION[customer_id]', '$id')");
				$output['message'] = 'Item added to wishlist';
				
			}
			catch(PDOException $e){
				$output['error'] = true;
				$output['message'] = $e->getMessage();
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Product already in wishlist';
		}
	}
	else{
		if(!isset($_SESSION['wishlist'])){
			$_SESSION['wishlist'] = array();
		}

		$exist = array();

		foreach($_SESSION['wishlist'] as $row){
			array_push($exist, $row['product_id']);
		}

		if(in_array($id, $exist)){
			$output['error'] = true;
			$output['message'] = 'Product already in wishlist';
		}
		else{
			$data['product_id'] = $id;

			if(array_push($_SESSION['wishlist'], $data)){
				$output['message'] = 'Item added to wishlist';
			}
			else{
				$output['error'] = true;
				$output['message'] = 'Cannot add item to wishlist';
			}
		}

	}
	echo json_encode($output);

?>