<?php
include_once("./../controller/stock_management/stockManagementController.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../auth/login.php");
}
$stockManagement=new ordersController();
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
                    <div class="card card-primary">
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
                                                <input type="text"    id="price_per_product" name="price_per_product"  class="form-control" placeholder="Price per product">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label class="control-label" for="total_price">Total Price</label>
                                            <div class="controls">
                                                <input type="text"  id="total_price" name="total_price"  class="form-control" placeholder="Total Price">
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
                                                <input type="text"  id="total_discount" name="total_discount"  class="form-control" placeholder="Total Discount">
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
                                                    <option value="1" >Yes</option>
                                                    <option value="0" >No</option>
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
    var validator = $("#productAddForm").validate({
        rules: {
            price_per_product: {
                number: true,
                maxlength: 10
            },
            total_discount: {
                number: true,
                maxlength: 3
            },
            total_price: {
                number: true,
                maxlength: 11
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
</script>