<?php

include_once("./../controller/orders/ordersController.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../auth/login.php");
}
$id = $_GET['id'];
$ordersController=new ordersController();
$order=$ordersController->order($id);
$res=mysqli_query($con,"select * from order_details where order_id='$order[id]'") ;
$orderDetail= mysqli_fetch_assoc($res);
$result=mysqli_query($con,"select *,products.name AS prodname, suppliers.id AS supplier_id, products.description AS prod_description from products LEFT JOIN suppliers ON products.supplier_id =suppliers.id LEFT JOIN subcategory ON products.subcategory_id =subcategory.id  where products.id='$orderDetail[product_id]'") ;
$product= mysqli_fetch_assoc($result);
$image = (!empty($product['featured_image'])) ? 'img/seller/products/'.$product['featured_image'] : 'img/noimage.jpg';

include("../includes/header.php");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
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
                            <h3 class="card-title">Order</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <td><b>Order Number</b></td>
                                    <td><?php echo $order['order_number'] ?></td>

                                </tr>
                                <tr>
                                    <td><b>Product Name</b></td>
                                    <td><?php echo $order['order_number'] ?></td>
                                          </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include("../includes/footer.php");?>
