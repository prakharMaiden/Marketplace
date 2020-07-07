<?php
require_once("./../config/config.php");
if(empty($_SESSION['supplier_id'])){
    header("location:auth/login.php");
}
$orders=mysqli_query($con,"select orders.transaction_status as transaction_status,order_details.price as price,orders.order_number as order_number,orders.id as order_id,products.name as product_name,products.id as product_id,order_details.color as color,order_details.size as size,orders.order_date as order_date,orders.shipment_date as shipment_date from orders left join order_details on orders.id = order_details.order_id left join products on order_details.product_id = products.id where products.supplier_id='$_SESSION[supplier_id]' order by orders.id desc limit 10") ;

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
                                            <th><b>Order&nbsp;Date</b></th>
                                            <th><b>Shipment&nbsp;Date</b></th>
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
                                            //echo'<pre>';print_r($order);die;
                                            $res=mysqli_query($con,"select * from order_details where order_id='$order[order_id]'") ;
                                            $orderDetail= mysqli_fetch_assoc($res);
                                            $result=mysqli_query($con,"select *,products.name AS prodname, suppliers.id AS supplier_id, products.description AS prod_description from products LEFT JOIN suppliers ON products.supplier_id =suppliers.id LEFT JOIN subcategory ON products.subcategory_id =subcategory.id  where products.id='$orderDetail[product_id]'") ;
                                            $product= mysqli_fetch_assoc($result);
                                            $image = (!empty($product['featured_image'])) ? 'img/seller/products/'.$product['featured_image'] : 'img/noimage.jpg';
                                            ?>
                                            <tr>
                                                <td><a href="<?php echo PATH;?>/seller/orders/index.php"><?php echo $order['order_number'] ?></a></td>
                                                <td><a href="<?php echo PATH;?>/seller/products/general/index.php"><?php echo  (strlen($order['product_name']) > 20) ? substr_replace($order['product_name'], '...', 17) : $order['product_name'];?></a></td>
                                                <td><?php echo date('d-m-Y',strtotime($order['order_date'])) ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($order['shipment_date'])) ?></td>
                                                <td><?php echo $order['price'] ?></td>
                                                <td><?php echo $order['size'] ?></td>
                                                <td><?php echo $order['color'] ?></td>
                                                <td><span class="badge badge-success"><?php echo $order['transaction_status'] ?></span></td>
                                                <td><a href="<?php echo PATH;?>/seller/orders/order.php?id=<?php echo $order['order_id'];?>">
                                                        <i class="fas fa fa-eye" title="Order Detail" style="font-size: 20px;color: #007bff;font-weight: bold"></i></a></td>
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

                                    $products=mysqli_query($con,"select * from products where (supplier_id='$_SESSION[supplier_id]')") ;
                                    foreach ($products as $product){
                                        ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <?php  if(!empty($product['featured_image'] )){?>
                                                    <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $product['featured_image'];?>" alt="" class="img-size-50">
                                                <?php }else {?>
                                                    <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="Product Image" class="img-size-50">
                                                <?php }?>
                                            </div>
                                            <div class="product-info">
                                                <a href="<?php echo PATH;?>/seller/products/general/index.php" class="product-title"><?php echo (strlen($product['name']) > 20) ? substr_replace($product['name'], '...', 17) : $product['name'];?>
                                                    <span class="badge badge-warning float-right">₹ <?php echo number_format($product['unit_price'], 2);?></span></a>
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