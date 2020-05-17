<?php
include_once("./../../functions/seller/products/productFunctions.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../login.php");
}
error_reporting(E_ALL);
$productClass=new Product();
if(isset($_POST['submit'])) {
    $response=$productClass->add();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Krishna Golds Industries</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <style>
        .error{color:red;}
        h2{
            font-weight: bold;
            font-size: 50px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../dashboard.php">Krishna Golds Industries</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="../dashboard.php">Dashboard</a></li>
            <li><a href="../profile.php">Profile</a></li>
            <li class="active"><a href="products.php">Products</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <h2>Products</h2>
    <form class="form-horizontal" action='' id="productAddForm" method="POST">
        <?php if (!empty($response)) { ?>
            <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                <?php echo $response["message"]; ?>
            </div>
        <?php } ?>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="name">Name</label>
                <div class="controls">
                    <input type="text" id="name" name="name"  class="form-control"  required>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                    <input type="text" id="description" name="description"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="sku">SKU</label>
                <div class="controls">
                    <input type="text" id="sku" name="sku"   class="form-control" >
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="id_sku">ID SKU</label>
                <div class="controls">
                    <input type="text" id="id_sku" name="id_sku"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="category_id">Category</label>
                <div class="controls">
                    <select id="category_id" name="category_id" class="form-control"  required>
                        <option value="">Please select</option>
                        <?php
                        $categories=mysqli_query($con,"select * from category") ;
                        foreach ($categories as $category) {  ?>
                            <option value="<?php  echo $category['id'];?>" ><?php echo $category['name']  ; ?></option>
                        <?php  }  ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="subcategory_id">Sub Category</label>
                <div class="controls">
                    <select id="subcategory_id" name="subcategory_id" class="form-control" required>
                        <option value="">Please select</option>
                        <?php
                        $subcategories=mysqli_query($con,"select * from subcategory") ;
                        foreach ($subcategories as $subcategory) {  ?>
                            <option value="<?php  echo $subcategory['id'];?>" ><?php echo $subcategory['name']  ; ?></option>
                        <?php  }  ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="quantity_per_unit">Quantity Per Unit</label>
                <div class="controls">
                    <input type="text" id="quantity_per_unit" name="quantity_per_unit"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="unit_price">Unit price</label>
                <div class="controls">
                    <input type="text" id="unit_price" name="unit_price"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="msrp">MSRP</label>
                <div class="controls">
                    <input type="text" id="msrp" name="msrp"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="available_size">Available size</label>
                <div class="controls">
                    <input type="text" id="available_size" name="available_size"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="available_colors">Available colors</label>
                <div class="controls">
                    <input type="text" id="available_colors" name="available_colors"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="size">Size</label>
                <div class="controls">
                    <input type="text" id="size" name="size"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="color">Color</label>
                <div class="controls">
                    <input type="text" id="color" name="color"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="discount">Discount</label>
                <div class="controls">
                    <input type="text" id="discount" name="discount"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="unit_weight">Unit weight</label>
                <div class="controls">
                    <input type="text" id="unit_weight" name="unit_weight"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="unit_in_stock">Unit in stock</label>
                <div class="controls">
                    <input type="text" id="unit_in_stock" name="unit_in_stock"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="available_size">Available size</label>
                <div class="controls">
                    <input type="text" id="available_size" name="available_size"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="available_colors">Available colors</label>
                <div class="controls">
                    <input type="text" id="available_colors" name="available_colors"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="reorder_level">Reorder level</label>
                <div class="controls">
                    <input type="text" id="reorder_level" name="reorder_level"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="unit_on_order">Unit on order</label>
                <div class="controls">
                    <input type="text" id="unit_on_order" name="unit_on_order"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="product_available">Product available</label>
                <div class="controls">
                    <input type="text" id="product_available" name="product_available"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="discount_available">Discount available</label>
                <div class="controls">
                    <input type="text" id="discount_available" name="discount_available"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="current_order">Current order</label>
                <div class="controls">
                    <input type="text" id="current_order" name="current_order"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="size_url">Size Url</label>
                <div class="controls">
                    <input type="text" id="size_url" name="size_url"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="logo">Image</label>
                <div class="controls">
                    <input type="file" id="logo" name="logo[]"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12">
                <label class="control-label" for="active">Publish</label>
                <div class="controls">
                    <select id="active" name="active" class="form-control" >
                        <option value="">Please select</option>
                        <option value="1" >Active</option>
                        <option value="0" >De-active</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="form-group col-md-12">
                <button class="btn btn-success" type="submit" id="submit"  name="submit">Submit</button>
                <a class="btn btn-default" href="products.php">Cancel</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </form>
</div>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
    var validator = $("#productAddForm").validate();
</script>
</body>
</html>