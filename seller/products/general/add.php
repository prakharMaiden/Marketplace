<?php
include_once("./../../controller/products/productController.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../../auth/login.php");
}
$productClass=new productController();
if(isset($_POST['submit'])) {
    $response=$productClass->add();
}
include("../../includes/header.php");
?>
<link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<div class="content-wrapper">
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
                                                <input type="text" id="name" name="name" placeholder="Name of the product" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="unit_price">Unit price</label>
                                            <div class="controls">
                                                <input type="text" id="unit_price" name="unit_price"   placeholder="Actual price of product" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="category_id">Category</label>
                                            <div class="controls">
                                                <select id="category_id" name="category_id" class="form-control"  required>
                                                    <option value="">Please select</option>
                                                    <?php
                                                    $categories=mysqli_query($con,"select * from category where active=1") ;
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

                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="featured_image">Featured image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="featured_image" name="featured_image" required>
                                                    <label class="custom-file-label" for="featured_image">Choose main image of product</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="images">Additional Images</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="images" name="images[]" multiple required>
                                                    <label class="custom-file-label" for="images">Choose multiple images of product</label>
                                                </div>
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
                                                <input type="text" id="sku" name="sku"   class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="id_sku">ID SKU</label>
                                            <div class="controls">
                                                <input type="text" id="id_sku" name="id_sku"  class="form-control">
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
                                                <input type="text" placeholder="Number of quantity allowed in per product" id="quantity_per_unit" name="quantity_per_unit"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="msrp">MRP</label>
                                            <div class="controls">
                                                <input type="text" placeholder="MRP price of product" id="msrp" name="msrp"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="available_size">Available sizes</label>
                                            <div class="controls">
                                                <input type="text" placeholder="Available sizes of the product comma(,) separated" id="available_size" name="available_size"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="size">Size</label>
                                            <div class="controls">
                                                <input type="text" id="size" placeholder="Available size of the product"  name="size"  class="form-control">
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
                                                <input type="text" id="available_colors" placeholder="Available colors of the product comma(,) separated" name="available_colors"  class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="color">Color</label>
                                            <div class="input-group my-colorpicker1">
                                                <input type="text" id="color" placeholder="Available color of the product" name="color" class="form-control">

                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="unit_in_stock">Unit in stock</label>
                                            <div class="controls">
                                                <input type="text" id="unit_in_stock" name="unit_in_stock"  placeholder="How many product in stock"   class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="unit_weight">Unit weight</label>
                                            <div class="controls">
                                                <input type="text" id="unit_weight" placeholder="Product weight" name="unit_weight" class="form-control">
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
                                                <input type="text" id="current_order" name="current_order"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="reorder_level">Reorder level</label>
                                            <div class="controls">
                                                <input type="text" id="reorder_level" name="reorder_level" placeholder=""   class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="unit_on_order">Unit on order</label>
                                            <div class="controls">
                                                <input type="text" id="unit_on_order" name="unit_on_order"   class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="size_url">Size Url</label>
                                            <div class="controls">
                                                <input type="text" id="size_url" name="size_url"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="discount_available">Discount available</label>
                                            <div class="controls">
                                                <select id="discount_available" name="discount_available" class="form-control">
                                                    <option value="">Please select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 discount" style="display: none;">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="discount">Discount</label>
                                            <div class="controls">
                                                <input type="text" id="discount" placeholder="Discount if any have (please not include %)"  name="discount"  class="form-control">
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
                                                <select id="product_available" name="product_available" class="form-control">
                                                    <option value="">Please select</option>
                                                    <option value="yes" >Yes</option>
                                                    <option value="no" >No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="description">Description</label>
                                            <div class="controls">
                                                <textarea type="text" id="description" name="description"  class="form-control"></textarea>
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
<script src="<?php echo PUBLIC_PATH?>/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script>
    $(function () {
        // Summernote
        $('#description').summernote();

        $('.my-colorpicker1').colorpicker();
        $('.my-colorpicker1').on('colorpickerChange', function(event) {
            $('.my-colorpicker1 .fa-square').css('color', event.color.toString());
        });
    })
</script>
<script>
    $('#productAddForm').validate({
        rules: {
            unit_price: {
                number: true,
                maxlength: 10
            },
            quantity_per_unit: {
                number: true,
                maxlength: 6
            },
            msrp: {
                number: true,
                maxlength: 11
            },
            unit_in_stock:{
                number: true,
                maxlength: 6
            },
            discount:{
                number: true,
                maxlength: 6
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var category_id = this.value;
            $.ajax({
                url: "category.php",
                type: "POST",
                data: {
                    category_id: category_id
                },
                cache: false,
                success: function(dataResult){
                    $("#subcategory_id").html(dataResult);
                }
            });
        });

        $('#discount_available').on('change', function() {
            var discount_available = this.value;
            if(discount_available == 'yes'){
                $(".discount").css({"display": "block"});
            }else{
                $(".discount").css({"display": "none"});
            }


        });
    });
</script>