<?php
include_once("./../../../functions/seller/products/functions.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../../login/login.php");
}
error_reporting(E_ALL);
$productClass=new Product();
if(isset($_POST['submit'])) {
    $response=$productClass->add();
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                                    $categories=mysqli_query($con,"select * from category ") ;
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

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="subcategory_id">Sub Category 1</label>
                                            <div class="controls">
                                                <select id="subcategory_id1" name="subcategory_id" class="form-control" required>
                                                    <option value="">Please select</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="subcategory_id">Sub Category 2</label>
                                            <div class="controls">
                                                <select id="subcategory_id2" name="subcategory_id" class="form-control" required>
                                                    <option value="">Please select</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="attrDiv" class="row"></div>
                                </div>
                                <!--
                                <div class="clearfix"></div>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
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
                                                    <option value="1" >Active</option>
                                                    <option value="0" >De-active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>-->
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
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var parent_id = this.value;
            $.ajax({
                url: "subCategory.php",
                type: "POST",
                data: {
                    parent_id: parent_id,
                    level : 1
                },
                cache: false,
                success: function(dataResult){
                    $("#subcategory_id").html(dataResult);
                }
            });


        });
        $('#subcategory_id').on('change', function() {
            var parent_id = this.value;
            $.ajax({
                url: "subCategory.php",
                type: "POST",
                data: {
                    parent_id: parent_id,
                    level : 2
                },
                cache: false,
                success: function(dataResult){
                    $("#subcategory_id1").html(dataResult);
                }
            });


        });
        $('#subcategory_id1').on('change', function() {
            var parent_id = this.value;
            $.ajax({
                url: "subCategory.php",
                type: "POST",
                data: {
                    parent_id: parent_id,
                    level : 3
                },
                cache: false,
                success: function(dataResult){
                    //console.log(data);
                    $("#subcategory_id2").html(dataResult);
                }
            });


        });
        $('#subcategory_id2').on('change', function() {
            var parent_id = this.value;
            $.ajax({
                url: "attributes.php",
                type: "POST",
                data: {
                    id: parent_id,
                    level : 3
                },
                cache: false,
                success: function(dataResult){
                    console.log(dataResult);
                    var str="";
                   
                                          
                    var data =JSON.parse(dataResult);
                    data=data[0];
                   // console.log(data);
                    Object.keys(data).forEach(function(key) {
                        var str1="";
                        str1+='<div class="col-md-3"><div class="form-group col-md-12">';
                        str1+='<div class="controls">';
                        str1+='<label>'+ key +'</label><input type="text" />';
                        str1+='</div></div></div>';
                        str+=str1;
                        //str1="";
                        //console.log('Key : ' + key + ', Value : ' + data[key])
                        })
                        console.log(str);
                        
                    document.getElementById("attrDiv").innerHTML=str;
                    //$("#subcategory_id2").html(dataResult);
                }
            });


        });
    });
</script>