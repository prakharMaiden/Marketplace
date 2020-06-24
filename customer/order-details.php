<?php
include_once("./../config/config.php");
if(empty($_SESSION['customer_id'])){
    header("location:auth/login.php");
}
include("includes/header.php");
$orders=mysqli_query($con,"select * from orders where customer_id='$_SESSION[customer_id]'") ;


?>
    <style>
        .error, sup{
            color:red;
        }
        .ps-section--shopping .ps-section__header {
            text-align: center;
            padding-bottom: 50px;
        }
        .ps-section--shopping {
            padding: 50px 0 0 0;
        }
        small {
            font-size: 70%;
        }
        .ps-form__billing-info{
            padding: 20px;
        }.ps-form--checkout{
             background: #f1f1f1;
         }
        .form-control {
            outline: none;
            height: 50px;
            font-size: 14px;
            padding: 0 20px;
            border: none;
            height: 50px;
            background-color: #fff;
            border: 1px solid #dddddd;
            border-radius: 0;
            box-shadow: 0 0 rgba(0, 0, 0, 0);
            -webkit-transition: all .4s ease;
            transition: all .4s ease;
            box-shadow: 0 0 0 #000;
        }
        .widget--vendor{
            background: #f1f1f1;
            padding: 20px;
        }
        #example1_filter, #example1_paginate{
            float: right;
        }
        .dataTables_empty{
            text-align: center;
        }
    </style>
    <div class="ps-page--simple">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="<?php echo PATH;?>/customer/index.php">Home</a></li>
                    <li>Your Orders</li>
                </ul>
            </div>
        </div>
        <div class="ps-checkout ps-section--shopping">
            <div class="container">
                <div class="ps-section__header">
                    <h1>Your Orders</h1>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 ">
                            <aside class="widget widget--vendor">
                                <h3 class="widget-title">Your List </h3>
                                <ul class="ps-list--arrow">
                                    <li><a href="<?php echo PATH; ?>/customer/profile.php">Profile</a></li>
                                    <li><a href="<?php echo PATH; ?>/customer/orders.php">Orders</a></li>
                                    <li><a href="<?php echo PATH; ?>/customer/shopping-cart.php">Shopping-Cart</a></li>
                                    <li><a href="<?php echo PATH; ?>/customer/wishlist.php">Wishlist</a></li>
                                    <li><a href="<?php echo PATH; ?>/customer/auth/logout.php">Logout</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 ps-form--checkout">
                            <div class="table-responsive" style="margin: 20px 0 0 0">
                                <table  id="example1"  class="table table-striped table-bordered table-hover table-default" style="background: #fff;">
                                    <thead>
                                    <tr>
                                        <th><b>Order#</b></th>
                                        <th><b>Order&nbsp;placed</b></th>
                                        <th><b>Product</b></th>
                                        <th><b>Price</b></th>
                                        <th><b>Discount</b></th>
                                        <th><b>Total</b></th>
                                        <th><b>Status</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  foreach ($orders as $order){
                                        $res=mysqli_query($con,"select * from order_details where order_id='$order[id]'") ;
                                        $orderDetail= mysqli_fetch_assoc($res);
                                        $result=mysqli_query($con,"select * from products where id='$orderDetail[product_id]'") ;
                                        $product= mysqli_fetch_assoc($result);
                                        $resu=mysqli_query($con,"select * from suppliers where id='$product[supplier_id]'") ;
                                        $supplier= mysqli_fetch_assoc($resu);
                                        ?>
                                            <tr>
                                                <td><?php echo $order['order_number'];?></td>
                                                <td><?php echo date('d M Y', strtotime($order['order_date']));?></td>
                                                <td>
                                                    <div class="ps-product--cart-mobile">
                                                        <div class="ps-product__thumbnail">
                                                            <?php  if(!empty($product['featured_image'] )){?>
                                                                <a href="product-details.php?id=<?php echo $product['id'];?>">
                                                                    <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $product['featured_image'];?>" class="thumbnail">
                                                                </a>
                                                            <?php }else {?>
                                                                <a href="product-details.php?id=<?php echo $product['id'];?>">
                                                                    <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" class="thumbnail" alt="Image">
                                                                </a>
                                                            <?php }?>

                                                        </div>
                                                        <div class="ps-product__content">
                                                            <a href="product-details.php?id=2"><?php echo ucfirst($product['name']);?></a>
                                                            <p style="font-size: 12px;font-weight: bold;">Sold By:<small style="font-size: 12px;"> <?php echo $supplier['company_name'];?></small></p>
                                                        </div>
                                                    </div></td>
                                                <td><?php echo ($orderDetail['price']).'X'.$orderDetail['quantity'];?></td>

                                                <td><?php if(isset($orderDetail['discount'])) {  echo $orderDetail['discount'].'%'; }else{ echo'-';};?></td>
                                                <td><?php echo number_format($orderDetail['total'],2);?></td>
                                                <td><?php echo $order['transaction_status'];?></td>
                                            </tr>
                                        <?php }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>
<script src="<?php echo PUBLIC_PATH; ?>/css/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>/css/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>/css/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>/css/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>

