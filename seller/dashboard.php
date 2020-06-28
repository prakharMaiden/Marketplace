<?php
require_once("./../config/config.php");
if(empty($_SESSION['supplier_id'])){
    header("location:auth/login.php");
}
$orders=mysqli_query($con,"select *,orders.id as order_id from orders left join order_details on orders.id = order_details.order_id left join products on order_details.product_id = products.id where products.supplier_id='$_SESSION[supplier_id]'") ;
//1print_r($orders);die;
//print_r($_SESSION['supplier_id']);die;
?>
<?php include("includes/header.php");?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">CPU Traffic</span>
                                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sales</span>
                                <span class="info-box-number">760</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">New Members</span>
                                <span class="info-box-number">2,000</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                        <tr>
                                            <th><b>Order#</b></th>
                                            <th><b>Product</b></th>
                                            <th><b>Order&nbsp;placed</b></th>
                                            <th><b>Shipment Date</b></th>
                                            <th><b>Price</b></th>
                                            <th><b>Size</b></th>
                                            <th><b>Color</b></th>
                                            <th><b>Status</b></th>
                                            <th><b>View</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($orders as $order){
                                              $image = (!empty($order['featured_image'])) ? 'img/seller/products/'.$order['featured_image'] : 'img/noimage.jpg';
                                        ?>
                                        <tr>
                                            <td><a href="#"><?php echo $order['order_number'] ?></a></td>
                                            <td><?php echo $order['name'] ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($order['order_date'])) ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($order['shipment_date'])) ?></td>
                                            <td><?php echo $order['price'] ?></td>
                                            <td><?php echo $order['size'] ?></td>
                                            <td><?php echo $order['color'] ?></td>
                                            <td><span class="badge badge-success"><?php echo $order['transaction_status'] ?></span></td>
                                            <td><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview<?php echo $order['id'];?>"><i class="fas fa fa-eye" title="Order Detail" style="font-size: 20px;color: #007bff;font-weight: bold"></i></a></td>




                                            <div class="modal fade" id="product-quickview<?php echo $order['id'];?>" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">

                                                    <div class="modal-content">
                                                        <span class="modal-close" data-dismiss="modal">
                                                            <i class="icon-cross2" style="float: right;padding: 5px;"></i></span>
                                                        <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                                                         <table>
                                                             <tr>
                                                                 <td>sdhgas</td>
                                                                 <td>savdhgfasdgh</td>
                                                             </tr>
                                                         </table>
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

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recently Added Products</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <?php

                                    $orders=mysqli_query($con,"select * from products where (supplier_id='$_SESSION[supplier_id]')") ;
                                    foreach ($orders as $order){
                                    ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <?php  if(!empty($order['featured_image'] )){?>
                                                    <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $order['featured_image'];?>" alt="" class="img-size-50">
                                                <?php }else {?>
                                                    <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="Product Image" class="img-size-50">
                                                <?php }?>
                                            </div>
                                            <div class="product-info">
                                                <a href="<?php echo PATH;?>/seller/products/general/index.php" class="product-title"><?php echo $order['name'] ?>
                                                    <span class="badge badge-warning float-right"><?php echo $order['unit_price'] ?></span></a>
                                                <span class="product-description">
                        <?php echo (strlen($order['description']) > 30) ? substr_replace($order['description'], '...', 27) : $order['description']; ?>
                      </span>
                                            </div>
                                        </li>
                                        <?php }?>

                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo PATH;?>/seller/products/general/index.php" class="uppercase">View All Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php include("includes/footer.php");?>