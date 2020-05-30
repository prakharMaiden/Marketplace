<?php

require_once("./../../config/config.php");

class stockManagementController {

    //Create a new instance.
    function __construct() {
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
        $this->db=$con;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // Function for listing
    public function listing() {
        $result=mysqli_query($this->db,"select * from stock_management where (supplier_id='$_SESSION[supplier_id]')") ;
        return $result;


    }

    // Function for add
    public function add() {
        $result = "INSERT INTO stock_management (supplier_id,category_id,subcategory_id,product_id,quantity,price_per_product,total_price,total_discount,date_in_stock,active)
                   VALUES('$_SESSION[supplier_id]','$_REQUEST[category_id]','$_REQUEST[subcategory_id]','$_REQUEST[product_id]','$_REQUEST[quantity]','$_REQUEST[price_per_product]','$_REQUEST[total_price]','$_REQUEST[total_discount]','$_REQUEST[date_in_stock]','$_REQUEST[active]')";

        if (mysqli_query($this->db, $result)) {
            header("location:index.php");
            $response = array(
                "type" => "success",
                "message" => "record added successfully."
            );
        } else {
            $response = array(
                "type" => "danger",
                "message" => "Something went wrong!"
            );
        }

        return $response;

    }

    // Function for edit
    public function edit($id){
        $result=mysqli_query($this->db,"select * from stock_management where (supplier_id='$_SESSION[supplier_id]') and (id='$id')") ;
        $product= mysqli_fetch_assoc($result);
        return $product;

    }

    // Function for update
    public function update($id){
        $result=mysqli_query($this->db,"select * from stock_management where (supplier_id='$_SESSION[supplier_id]') and (id='$id')") ;
        $productData = mysqli_fetch_assoc($result);
         if(!empty($_REQUEST['category_id']))
            $category_id = $_REQUEST['category_id'];
        else
            $category_id = $productData['category_id'];

        if(!empty($_REQUEST['subcategory_id']))
            $subcategory_id = $_REQUEST['subcategory_id'];
        else
            $subcategory_id = $productData['subcategory_id'];

        if(!empty($_REQUEST['product_id']))
            $product_id = $_REQUEST['product_id'];
        else
            $product_id = $productData['product_id'];

        if(!empty($_REQUEST['quantity']))
            $quantity = $_REQUEST['quantity'];
        else
            $quantity = $productData['quantity'];

        if(!empty($_REQUEST['price_per_product']))
            $price_per_product = $_REQUEST['price_per_product'];
        else
            $price_per_product = $productData['price_per_product'];

        if(!empty($_REQUEST['total_price']))
            $total_price = $_REQUEST['total_price'];
        else
            $total_price = $productData['total_price'];

        if(!empty($_REQUEST['total_discount']))
            $total_discount = $_REQUEST['total_discount'];
        else
            $total_discount = $productData['total_discount'];

        if(!empty($_REQUEST['date_in_stock']))
            $date_in_stock = $_REQUEST['date_in_stock'];
        else
            $date_in_stock= $productData['date_in_stock'];

        if(!empty($_REQUEST['active']))
            $active = $_REQUEST['active'];
        else
            $active = $productData['active'];


        $result = "UPDATE stock_management SET  
                                       category_id='$category_id',
                                         subcategory_id='$subcategory_id',
                                         product_id='$product_id',          
                                          quantity='$quantity',
                                          price_per_product='$price_per_product',
                                           total_price='$total_price',
                                           total_discount='$total_discount',
                                           date_in_stock='$date_in_stock,
                                           active='$active'
                                             WHERE  id='$id'";
        if (mysqli_query($this->db, $result)) {
            header("location:index.php");
            $response = array(
                "type" => "success",
                "message" => "record updated successfully."
            );
        } else {
            $response = array(
                "type" => "danger",
                "message" => "Something went wrong!"
            );
        }

        return $response;

    }


    // Function for active
    public function active($id){
        $result = "UPDATE stock_management SET active='1' where (supplier_id='$_SESSION[supplier_id]') and (id='$id')" ;
        if (mysqli_query($this->db, $result)) {
            header("location:index.php");

        } else {
            $response = array(
                "type" => "danger",
                "message" => "Something went wrong!"
            );
        }

        return $response;
    }

    // Function for deactive
    public function deactive($id){
        $result = "UPDATE stock_management SET active='0' where (supplier_id='$_SESSION[supplier_id]') and (id='$id')" ;
        if (mysqli_query($this->db, $result)) {
            header("location:index.php");

        } else {
            $response = array(
                "type" => "danger",
                "message" => "Something went wrong!"
            );
        }
        return $response;
    }
}
?>