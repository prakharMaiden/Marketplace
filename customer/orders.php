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
                                        <th><b>View</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  foreach ($orders as $order){
                                        $res=mysqli_query($con,"select * from order_details where order_id='$order[id]'") ;
                                        $orderDetail= mysqli_fetch_assoc($res);
                                        $result=mysqli_query($con,"select *,products.name AS prodname, suppliers.id AS supplier_id, products.description AS prod_description from products LEFT JOIN suppliers ON products.supplier_id =suppliers.id LEFT JOIN subcategory ON products.subcategory_id =subcategory.id  where products.id='$orderDetail[product_id]'") ;
                                        $product= mysqli_fetch_assoc($result);
                                        $ret=mysqli_query($con,"select *,COUNT(*) As review_count,SUM(rating) AS sum_rating from reviews where product_id='$product[id]'") ;
                                        $reviews= mysqli_fetch_assoc($ret);

                                        $image = (!empty($product['featured_image'])) ? 'img/seller/products/'.$product['featured_image'] : 'img/noimage.jpg';
                                        ?>
                                            <tr>
                                                <td><?php echo $order['order_number'];?></td>
                                                <td><?php echo date('d M Y', strtotime($order['order_date']));?></td>
                                                <td>
                                                    <div class="ps-product--cart-mobile">
                                                        <div class="ps-product__thumbnail">
                                                            <?php  if(!empty($product['featured_image'] )){?>
                                                                <a href="product-details.php?id=<?php echo $product['id'];?>">
                                                                    <img src="<?php echo PUBLIC_PATH.'/'.$image;?>" class="thumbnail">
                                                                </a>
                                                            <?php }else {?>
                                                                <a href="product-details.php?id=<?php echo $product['id'];?>">
                                                                    <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" class="thumbnail" alt="Image">
                                                                </a>
                                                            <?php }?>

                                                        </div>
                                                        <div class="ps-product__content">
                                                            <a href="product-details.php?id=<?php echo $product['id']; ?>"><?php echo ucfirst($product['prodname']);?></a>
                                                            <p style="font-size: 12px;font-weight: bold;">Sold By:<small style="font-size: 12px;"> <?php echo $product['company_name'];?></small></p>
                                                        </div>
                                                    </div></td>
                                                <td><?php echo ($orderDetail['price']).'X'.$orderDetail['quantity'];?></td>

                                                <td><?php if(isset($orderDetail['discount'])) {  echo $orderDetail['discount'].'%'; }else{ echo'-';};?></td>
                                                <td><?php echo number_format($orderDetail['total'],2);?></td>
                                                <td><?php echo $order['transaction_status'];?></td>
                                                <td><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview<?php echo $order['id'];?>"><i class="icon-eye" title="Order Detail" style="font-size: 20px;color: #007bff;font-weight: bold"></i></a></td>




                                                <div class="modal fade" id="product-quickview<?php echo $order['id'];?>" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">

                                                        <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2" style="float: right;padding: 5px;"></i></span>
                                                            <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                                                                <div class="ps-product__header">
                                                                    <div class="ps-product__thumbnail">
                                                                                <img src="<?php echo PUBLIC_PATH.'/'.$image;?>">
                                                                    </div>
                                                                    <div class="ps-product__info">
                                                                        <h1><?php echo $product['prodname']?></h1>
                                                                        <div class="ps-product__meta">
                                                                            <p>Sub-category:<a href="#"><?php echo $product['name']?></a></p>
                                                                            <?php if(isset($reviews['review_count']) && $reviews['review_count'] >0){ ?>
                                                                                <div class="ps-product__rating">
                                                                                    <select class="ps-rating" data-read-only="true">

                                                                                        <?php
                                                                                        if (isset($reviews['review_count']) && $reviews['review_count'] > 0) {
                                                                                            if($reviews['sum_rating']/$reviews['review_count'] == 5){
                                                                                                ?>
                                                                                                <option value="1">1</option>
                                                                                                <option value="1">2</option>
                                                                                                <option value="1">3</option>
                                                                                                <option value="1">4</option>
                                                                                                <option value="1">5</option>
                                                                                            <?php }      else if($reviews['sum_rating']/$reviews['review_count'] == 4){?>
                                                                                                <option value="1">1</option>
                                                                                                <option value="1">2</option>
                                                                                                <option value="1">3</option>
                                                                                                <option value="1">4</option>
                                                                                                <option value="2">5</option>
                                                                                            <?php } elseif($reviews['sum_rating']/$reviews['review_count'] == 3){?>
                                                                                                <option value="1">1</option>
                                                                                                <option value="1">2</option>
                                                                                                <option value="1">3</option>
                                                                                                <option value="2">4</option>
                                                                                                <option value="2">5</option>
                                                                                            <?php } elseif($reviews['sum_rating']/$reviews['review_count'] == 2){?>
                                                                                                <option value="1">1</option>
                                                                                                <option value="1">2</option>
                                                                                                <option value="2">3</option>
                                                                                                <option value="2">4</option>
                                                                                                <option value="2">5</option>
                                                                                            <?php } else{?>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="2">3</option>
                                                                                                <option value="2">4</option>
                                                                                                <option value="2">5</option>
                                                                                                <?php
                                                                                            }
                                                                                        } else{ ?>
                                                                                            <option value="0">0</option>
                                                                                            <option value="1">1</option>
                                                                                            <option value="2">2</option>
                                                                                            <option value="3">3</option>
                                                                                            <option value="4">4</option>
                                                                                            <option value="5">5</option>
                                                                                        <?php }?>
                                                                                    </select><span><?php echo round($reviews['sum_rating']/$reviews['review_count'],2); ?> (<?php echo $reviews['review_count'] ?> review)</span>
                                                                                </div>
                                                                            <?php } else{?>
                                                                                <div class="ps-product__rating">
                                                                                    <select class="ps-rating" data-read-only="true">
                                                                                        <option value="0">0</option>
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="4">4</option>
                                                                                        <option value="5">5</option>
                                                                                    </select><span>(0 review)</span>
                                                                                </div>
                                                                            <?php }?>
                                                                        </div>
                                                                        <h4 class="ps-product__price">Price: Rs. <?php echo number_format($orderDetail['price'], 2);?><br/> <?php if(!empty($orderDetail['total'])){ ?> Total:  Rs. <?php echo number_format($orderDetail['total'], 2);?> <?php } ?></h4>
                                                                        <div class="ps-product__variations">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                        <?php
                                                                                        if (isset($orderDetail['quantity'])){ ?>
                                                                                            <div class="">Quantity: <?php echo $orderDetail['quantity']; ?></div>
                                                                                        <?php }?>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                        <?php
                                                                                        if (isset($orderDetail['color'])){ ?>
                                                                                            <p>Color:</p>  <div class="ps-variant ps-variant--color" style="background-color: <?php echo $orderDetail['color']; ?>">
                                                                                                <span class="ps-variant__tooltip"><?php echo $orderDetail['color']; ?></span></div>
                                                                                        <?php }?>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <?php
                                                                                    if (isset($orderDetail['size'])){ ?>
                                                                                            <div class="">Size: <?php echo $orderDetail['size']; ?></div>
                                                                                    <?php }?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="ps-product__desc">
                                                                            <p>Sold By:<a href=""><strong><?php echo $product['company_name']?></strong></a></p>
                                                                            <ul class="ps-list--dot">
                                                                                <?php echo $product['prod_description']?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </article>
                                                        </div>
                                                    </div>
                                                </div>
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

