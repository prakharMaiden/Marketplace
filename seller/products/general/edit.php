<?php
include_once("./../../../functions/seller/products/functions.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../../login/login.php");
}
error_reporting(E_ALL);
$id = $_GET['id'];
$productClass=new Product();
$product=$productClass->edit($id);
if(isset($_POST['submit'])) {
    $response=$productClass->update($id);
}

include("../../includes/header.php");
?><div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Products</h3>
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
                                            <label class="control-label" for="name">Name</label>
                                            <div class="controls">
                                                <input type="text" id="name" name="name" value="<?php echo $product['name']?>"  class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="description">Description</label>
                                            <div class="controls">
                                                <input type="text" id="description" value="<?php echo $product['description']?>" name="description"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="sku">SKU</label>
                                            <div class="controls">
                                                <input type="text" id="sku" name="sku" value="<?php echo $product['sku']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="id_sku">ID SKU</label>
                                            <div class="controls">
                                                <input type="text" id="id_sku" name="id_sku" value="<?php echo $product['id_sku']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
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
                                                        <option value="<?php  echo $category['id'];?>" <?php if($product['category_id'] == $category['id']){ echo'selected'; }?>><?php echo $category['name']  ; ?></option>
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
                                                        <option value="<?php  echo $subcategory['id'];?>"  <?php if($product['subcategory_id'] == $subcategory['id']){ echo'selected'; }?>><?php echo $subcategory['name']  ; ?></option>
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
                                            <label class="control-label" for="quantity_per_unit">Quantity Per Unit</label>
                                            <div class="controls">
                                                <input type="text" id="quantity_per_unit" name="quantity_per_unit" value="<?php echo $product['quantity_per_unit']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="unit_price">Unit price</label>
                                            <div class="controls">
                                                <input type="text" id="unit_price" name="unit_price" value="<?php echo $product['unit_price']?>" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="msrp">MSRP</label>
                                            <div class="controls">
                                                <input type="text" id="msrp" name="msrp" value="<?php echo $product['msrp']?>" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="available_size">Available size</label>
                                            <div class="controls">
                                                <input type="text" id="available_size" name="available_size" value="<?php echo $product['available_size']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="available_colors">Available colors</label>
                                            <div class="controls">
                                                <input type="text" id="available_colors" name="available_colors" value="<?php echo $product['available_colors']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="size">Size</label>
                                            <div class="controls">
                                                <input type="text" id="size" name="size" value="<?php echo $product['size']?>" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="color">Color</label>
                                            <div class="controls">
                                                <input type="text" id="color" name="color" value="<?php echo $product['color']?>" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="discount">Discount</label>
                                            <div class="controls">
                                                <input type="text" id="discount" name="discount" value="<?php echo $product['discount']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="unit_weight">Unit weight</label>
                                            <div class="controls">
                                                <input type="text" id="unit_weight" name="unit_weight" value="<?php echo $product['unit_weight']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="unit_in_stock">Unit in stock</label>
                                            <div class="controls">
                                                <input type="text" id="unit_in_stock" name="unit_in_stock" value="<?php echo $product['unit_in_stock']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="available_size">Available size</label>
                                            <div class="controls">
                                                <input type="text" id="available_size" name="available_size"  value="<?php echo $product['available_size']?>" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="available_colors">Available colors</label>
                                            <div class="controls">
                                                <input type="text" id="available_colors" name="available_colors" value="<?php echo $product['available_colors']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="reorder_level">Reorder level</label>
                                            <div class="controls">
                                                <input type="text" id="reorder_level" name="reorder_level" value="<?php echo $product['reorder_level']?>" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="unit_on_order">Unit on order</label>
                                            <div class="controls">
                                                <input type="text" id="unit_on_order" name="unit_on_order" value="<?php echo $product['unit_on_order']?>" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="product_available">Product available</label>
                                            <div class="controls">
                                                <input type="text" id="product_available" name="product_available" value="<?php echo $product['product_available']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="discount_available">Discount available</label>
                                            <div class="controls">
                                                <input type="text" id="discount_available" name="discount_available" value="<?php echo $product['discount_available']?>" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="current_order">Current order</label>
                                            <div class="controls">
                                                <input type="text" id="current_order" name="current_order" value="<?php echo $product['current_order']?>"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="size_url">Size Url</label>
                                            <div class="controls">
                                                <input type="text" id="size_url" name="size_url" value="<?php echo $product['size_url']?>" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                                    <option value="1" <?php if($product['active'] == '1') echo 'selected';?>>Active</option>
                                                    <option value="0"  <?php if($product['active'] == '0') echo'selected';?>>De-active</option>
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
<?php include("../../includes/footer.php");?>
<script>
    var validator = $("#productAddForm").validate();
</script>