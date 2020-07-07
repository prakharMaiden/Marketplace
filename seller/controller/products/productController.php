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
                   VALUES('$_POST[name]','$_SESSION[supplier_id]','$_POST[category_id]','$_POST[subcategory_id]','$_POST[description]','$_POST[msrp]','$_POST[quantity_per_unit]','$_POST[sku]','$_POST[id_sku]','$_POST[unit_price]','$_POST[available_size]','$_POST[available_colors]','$_POST[size]','$_POST[color]','$_POST[discount]','$_POST[unit_weight]','$_POST[unit_in_stock]','$_POST[unit_on_order]','$_POST[reorder_level]','$_POST[product_available]','$_POST[size_url]','$_POST[discount_available]','$_POST[current_order]','$imageName','$insertValuesSQL')";

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
        $description ='';
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
        if(!empty($_POST['description']))
            $description = $_POST['description'];

        if(!empty($_POST['active']))
            $active = $_POST['active'];
        else
            $active = $productData['active'];

        $result = "UPDATE products SET  
                                       category_id='$_POST[category_id]',
                                         subcategory_id='$_POST[subcategory_id]',
                                         name='$_POST[name]',
                                         description='$description',
                                         msrp='$_POST[msrp]',
                                         quantity_per_unit='$_POST[quantity_per_unit]',
                                         sku='$_POST[sku]',
                                         id_sku='$_POST[id_sku]',
                                         unit_price='$_POST[unit_price]',
                                         available_size='$_POST[available_size]',
                                         available_colors='$_POST[available_colors]',
                                         size='$_POST[size]',
                                         color='$_POST[color]',
                                         discount='$_POST[discount]',
                                         unit_weight='$_POST[unit_weight]',
                                         unit_in_stock='$_POST[unit_in_stock]',
                                         unit_on_order='$_POST[unit_on_order]',
                                         reorder_level='$_POST[reorder_level]',
                                          product_available='$_POST[product_available]',
                                          current_order='$_POST[current_order]',
                                           size_url='$_POST[size_url]',
                                           discount_available='$_POST[discount_available]',
                                           current_order='$_POST[current_order]',
                                           active='$active',
                                            featured_image='$imageName',
                                           images='$insertValuesSQL'
                                             WHERE  id='$id'";
        print_r($result);die;
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
            header("Location: add.php");
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