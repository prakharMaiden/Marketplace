<?php
include_once("./../config/config.php");

	$output = array('error'=>false);
	$id = $_POST['id'];

	if(isset($_SESSION['customer_id'])){
		try{
			$stmt = mysqli_query($con,"DELETE FROM cart WHERE id='$id'");
            $customer = mysqli_fetch_assoc($stmt);
			$output['message'] = 'Deleted';
			
		}
		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}
	}
	else{
		foreach($_SESSION['cart'] as $key => $row){
			if($row['product_id'] == $id){
				unset($_SESSION['cart'][$key]);
				$output['message'] = 'Deleted';
			}
		}
	}
	echo json_encode($output);

?>