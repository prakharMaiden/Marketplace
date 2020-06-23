<?php

require_once("./../../../config/config.php");

class productController {

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
        $result=mysqli_query($this->db,"select * from products where (supplier_id='$_SESSION[supplier_id]')") ;
        return $result;


    }

    // Function for add
    public function add() {

        if(!empty($_FILES['featured_image']['name'])){
            if(file_exists($_FILES['featured_image']['tmp_name'])){

                $name = $_FILES['featured_image']['name'];
                getcwd();
                chdir("../../../public/img/seller/products/featured_image/");
                $target_dir = getcwd();
                $target_file = $target_dir . basename($_FILES["featured_image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $extensions_arr = array("png");
                if(in_array($imageFileType,$extensions_arr) ){
                    $image_base64 = base64_encode(file_get_contents($_FILES['featured_image']['tmp_name']) );
                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                    $imageName = date("ymdhis").'-'. $name;
                    move_uploaded_file($_FILES['featured_image']['tmp_name'],$imageName);


                }else{
                    $response = array(
                        "type" => "danger",
                        "message" => "Please choose png image only!"
                    );
                    return $response;

                }
            }
        }else{
            $imageName = '';
        }

        // File upload configuration
        getcwd();
        chdir("../../../public/img/seller/products/");
        $targetDir = getcwd();
        $allowTypes = array('jpg','png','jpeg');

        $insertValuesSQL = $errorUpload = $errorUploadType = '';
        $fileNames = array_filter($_FILES['images']['name']);
        if(!empty($fileNames)){
            foreach($_FILES['images']['name'] as $key=>$val){
                $fileName = basename($_FILES['images']['name'][$key]);
                $targetFilePath = $targetDir.'/' . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){
                        $insertValuesSQL .=  date('Y-m-d')."-". $fileName.",";
                    }else{
                        $errorUpload .= $_FILES['images']['name'][$key].' | ';
                    }
                }else{
                    $errorUploadType .= $_FILES['images']['name'][$key].' | ';
                }
            }
        }else{
            $insertValuesSQL='';
        }

        $result = "INSERT INTO products (name,supplier_id,category_id,subcategory_id,description,msrp,quantity_per_unit,sku,id_sku,unit_price,available_size,available_colors,size,color,discount,unit_weight,unit_in_stock,unit_on_order,reorder_level,product_available,size_url,discount_available,current_order,featured_image,images)
                   VALUES('$_REQUEST[name]','$_SESSION[supplier_id]','$_REQUEST[category_id]','$_REQUEST[subcategory_id]','$_REQUEST[description]','$_REQUEST[msrp]','$_REQUEST[quantity_per_unit]','$_REQUEST[sku]','$_REQUEST[id_sku]','$_REQUEST[unit_price]','$_REQUEST[available_size]','$_REQUEST[available_colors]','$_REQUEST[size]','$_REQUEST[color]','$_REQUEST[discount]','$_REQUEST[unit_weight]','$_REQUEST[unit_in_stock]','$_REQUEST[unit_on_order]','$_REQUEST[reorder_level]','$_REQUEST[product_available]','$_REQUEST[size_url]','$_REQUEST[discount_available]','$_REQUEST[current_order]','$imageName','$insertValuesSQL')";

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
        $result=mysqli_query($this->db,"select * from products where (supplier_id='$_SESSION[supplier_id]') and (id='$id')") ;
        $product= mysqli_fetch_assoc($result);
        return $product;

    }

    // Function for update
    public function update($id){
        $result=mysqli_query($this->db,"select * from products where (supplier_id='$_SESSION[supplier_id]') and (id='$id')") ;
        $productData = mysqli_fetch_assoc($result);
        getcwd();
        chdir("../../../public/img/seller/products/");
        $target_dir = getcwd();


        if(!empty($_FILES['featured_image']['name'])){
            if(file_exists($_FILES['featured_image']['tmp_name'])){
                $name = $_FILES['featured_image']['name'];
                $target_file = $target_dir . basename($_FILES["featured_image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $extensions_arr = array('jpg','png','jpeg');
                if(in_array($imageFileType,$extensions_arr) ){
                    $image_base64 = base64_encode(file_get_contents($_FILES['featured_image']['tmp_name']) );
                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                    $imageName = 'featured_image-'.date("ymdhis").'-'. $name;
                    move_uploaded_file($_FILES['featured_image']['tmp_name'],$imageName);
                }else{
                    $response = array(
                        "type" => "danger",
                        "message" => "Please choose jpg,jpeg,png image only!"
                    );
                    return $response;

                }
            }
        }else{
            $imageName = $productData['featured_image'];
        }

        if(!empty(array_filter($_FILES['images']['name']))){
            //echo'<pre>';print_r($_FILES);die;
        $allowTypes = array('jpg','png','jpeg');
        $insertValuesSQL = $errorUpload = $errorUploadType = '';
        $fileNames = array_filter($_FILES['images']['name']);
        if(!empty(($_FILES['images']['name']))){
            foreach($_FILES['images']['name'] as $key=>$val){
                $fileName = basename($_FILES['images']['name'][$key]);
                $targetFilePath = $target_dir.'/' . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], 'images-'.date("ymdhis").'-'. $fileName)){
                        $insertValuesSQL .=  'images-'.date('ymdhis')."-". $fileName.",";
                    }else{
                        $errorUpload .= $_FILES['images']['name'][$key].' | ';
                    }
                }else{
                    $errorUploadType .= $_FILES['images']['name'][$key].' | ';
                }
            }
        }
        }else{
            $insertValuesSQL= $productData['images'];
        }

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

        if(!empty($_REQUEST['active']))
            $active = $_REQUEST['active'];
        else
            $active = $productData['active'];

        $result = "UPDATE products SET  
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
                                           current_order='$current_order',
                                           active='$active',
                                            featured_image='$imageName',
                                           images='$insertValuesSQL'
                                             WHERE  id='$id'";
        if (mysqli_query($this->db, $result)) {
            $response = array(
                "type" => "success",
                "message" => "record updated successfully."
            );
            header("Location: index.php");
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
        $result = "UPDATE products SET active='1' where (supplier_id='$_SESSION[supplier_id]') and (id='$id')" ;
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
        $result = "UPDATE products SET active='0' where (supplier_id='$_SESSION[supplier_id]') and (id='$id')" ;
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