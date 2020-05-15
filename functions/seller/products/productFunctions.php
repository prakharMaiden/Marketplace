<?php

require_once("./../../config/config.php");
error_reporting(E_ALL);

class Product {
    function __construct() {
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
        $this->db=$con;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // Function for listing
    public function listing() {
        $result=mysqli_query($this->db,"select * from products where (supplier_id='$_SESSION[supplier_id]')") ;
        return $result;


    }

    // Function for add
    public function add() {

    }

    // Function for edit
    public function edit($id){
        $result=mysqli_query($this->db,"select * from products where (supplier_id='$_SESSION[supplier_id]') and (id='$id')") ;
        $productData = mysqli_fetch_assoc($result);
        if(!empty($_REQUEST['name']))
            $name = $_REQUEST['name'];
        else
            $name = $productData['name'];

        if(!empty($_REQUEST['category_id']))
            $category_id = $_REQUEST['category_id'];
        else
            $category_id = $productData['category_id'];

        if(!empty($_REQUEST['subcategory_id']))
            $subcategory_id = $_REQUEST['subcategory_id'];
        else
            $subcategory_id = $productData['subcategory_id'];

        if(!empty($_REQUEST['sku']))
            $sku = $_REQUEST['sku'];
        else
            $sku = $productData['sku'];

        if(!empty($_REQUEST['id_sku']))
            $id_sku = $_REQUEST['id_sku'];
        else
            $id_sku = $productData['id_sku'];

        if(!empty($_REQUEST['description']))
            $description = $_REQUEST['description'];
        else
            $description = $productData['description'];

        if(!empty($_REQUEST['quantity_per_unit']))
            $quantity_per_unit = $_REQUEST['quantity_per_unit'];
        else
            $quantity_per_unit = $productData['quantity_per_unit'];

        if(!empty($_REQUEST['unit_price']))
            $unit_price = $_REQUEST['unit_price'];
        else
            $unit_price = $productData['unit_price'];

        if(!empty($_REQUEST['msrp']))
            $msrp = $_REQUEST['msrp'];
        else
            $msrp = $productData['msrp'];

        if(!empty($_REQUEST['available_size']))
            $available_size = $_REQUEST['available_size'];
        else
            $available_size = $productData['available_size'];

        if(!empty($_REQUEST['available_colors']))
            $available_colors = $_REQUEST['available_colors'];
        else
            $available_colors = $productData['available_colors'];

        if(!empty($_REQUEST['size']))
            $size = $_REQUEST['size'];
        else
            $size = $productData['size'];

        if(!empty($_REQUEST['color']))
            $color = $_REQUEST['color'];
        else
            $color = $productData['color'];

        if(!empty($_REQUEST['discount']))
            $discount = $_REQUEST['discount'];
        else
            $discount = $productData['discount'];

        if(!empty($_REQUEST['unit_weight']))
            $unit_weight = $_REQUEST['unit_weight'];
        else
            $unit_weight = $productData['unit_weight'];

        if(!empty($_REQUEST['unit_in_stock']))
            $unit_in_stock = $_REQUEST['unit_in_stock'];
        else
            $unit_in_stock = $productData['unit_in_stock'];

        if(!empty($_REQUEST['unit_on_order']))
            $unit_on_order = $_REQUEST['unit_on_order'];
        else
            $unit_on_order = $productData['unit_on_order'];

        if(!empty($_REQUEST['reorder_level']))
            $reorder_level = $_REQUEST['reorder_level'];
        else
            $reorder_level = $productData['reorder_level'];

        if(!empty($_REQUEST['product_available']))
            $product_available = $_REQUEST['product_available'];
        else
            $product_available = $productData['product_available'];

        if(!empty($_REQUEST['discount_available']))
            $discount_available = $_REQUEST['discount_available'];
        else
            $discount_available = $productData['discount_available'];

        if(!empty($_REQUEST['current_order']))
            $current_order = $_REQUEST['current_order'];
        else
            $current_order = $productData['current_order'];

        if(!empty($_REQUEST['size_url']))
            $size_url = $_REQUEST['size_url'];
        else
            $size_url = $productData['size_url'];

        $result =   mysqli_query($this->db,"UPDATE products SET  
                                       category_id='$category_id',
                                         subcategory_id='$subcategory_id',
                                         name='$name',
                                         description='$description',
                                         msrp='$msrp',
                                         quantity_per_unit='$quantity_per_unit',
                                         sku='$sku',
                                         id_sku='$id_sku',
                                         unit_price='$unit_price',
                                         available_size='$available_size',
                                         available_colors='$available_colors',
                                         size='$size',
                                         color='$color',
                                         discount='$discount',
                                         unit_weight='$unit_weight',
                                         unit_in_stock='$unit_in_stock',
                                         unit_on_order='$unit_on_order',
                                         reorder_level='$reorder_level',
                                          product_available='$product_available',
                                          current_order='$current_order',
                                           size_url='$size_url',
                                           discount_available='$discount_available',
                                           current_order='$current_order'
                                             WHERE  id='$id'") ;

        if (mysqli_num_rows($result) > 0) {
            $response = array(
                "type" => "success",
                "message" => "You have registered successfully."
            );
        }else{
            $response = array(
                "type" => "danger",
                "message" => "Something went wrong!"
            );
        }
        return $response;

    }

    // Function for active
    public function active($id){
        mysqli_query($this->db,"UPDATE products SET active='1' where (supplier_id='$_SESSION[supplier_id]') and (id='$id')") ;
        header("location:products.php");
    }

    // Function for deactive
    public function deactive($id){
        mysqli_query($this->db,"UPDATE products SET active='0' where (supplier_id='$_SESSION[supplier_id]') and (id='$id')") ;
        header("location:products.php");
    }
}
?>