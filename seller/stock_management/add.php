<?php
include_once("./../../functions/seller/stock_management/functions.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../login/login.php");
}
error_reporting(E_ALL);
$stockManagement=new stockManagement();
if(isset($_POST['submit'])) {
    $response=$stockManagement->add();
}
include("../includes/header.php");
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stock Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Stock Management</li>
                    </ol>
                </div>
            </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stock Management</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal"  enctype="multipart/form-data" action='' id="productAddForm" method="POST">
                                <?php if (!empty($response)) { ?>
                                    <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                                        <?php echo $response["message"]; ?>
                                    </div>
                                <?php } ?>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="product_id">Product</label>
                                            <div class="controls">
                                                <select id="product_id" name="product_id" class="form-control" required>
                                                    <option value="">Please select</option>
                                                    <?php
                                                    $products=mysqli_query($con,"select * from products") ;
                                                    foreach ($products as $product) {  ?>
                                                        <option value="<?php  echo $product['id'];?>" ><?php echo $product['name']  ; ?></option>
                                                    <?php  }  ?>
                                                </select></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="quantity">Quantity</label>
                                            <div class="controls">
                                                <select id="quantity" name="quantity" class="form-control" required>
                                                    <option value="">Please select</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="500">500</option>
                                                    <option value="1000">1000</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="price_per_product">Price per product</label>
                                            <div class="controls">
                                                <input type="text" id="price_per_product" name="price_per_product"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="total_price">Total Price</label>
                                            <div class="controls">
                                                <input type="text" id="total_price" name="total_price"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="total_discount">Total Discount</label>
                                            <div class="controls">
                                                <input type="text" id="total_discount" name="total_discount"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="date_in_stock">In stock date</label>
                                            <div class="controls">
                                                <input type="date" id="date_in_stock" name="date_in_stock"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-12">
                                            <button class="btn btn-success" type="submit" id="submit"  name="submit">Submit</button>
                                            <a class="btn btn-default" href="index.php">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include("../includes/footer.php");?>
<script>
    var validator = $("#productAddForm").validate();
</script>