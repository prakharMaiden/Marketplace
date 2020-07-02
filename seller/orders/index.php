<?php

include_once("./../controller/orders/ordersController.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../auth/login.php");
}
$ordersController=new ordersController();
$orders=$ordersController->listing();

include("../includes/header.php");
?>
<style>
    #example1_paginate,#example1_filter{
        float: right;
    }
    .dataTables_empty{
        text-align: center;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Listing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order Listing</li>
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
                            <h3 class="card-title">Order Listing</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <table  id="example1" class="table table-bordered table-striped">
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
                                    ?>
                                    <tr>
                                        <td><a href="<?php echo PATH;?>/seller/orders/order.php?id=<?php echo $order['order_id'];?>"><?php echo $order['order_number'] ?></a></td>
                                        <td><a href="<?php echo PATH;?>/seller/products/general/index.php"><?php echo $order['product_name'] ?></a></td>
                                        <td><?php echo date('d-m-Y',strtotime($order['order_date'])) ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($order['shipment_date'])) ?></td>
                                        <td><?php echo $order['price'] ?></td>
                                        <td><?php echo $order['size'] ?></td>
                                        <td><?php echo $order['color'] ?></td>

                                        <td>
                                            <?php if(isset( $order['transaction_status']) &&  $order['transaction_status'] == 'Order placed'){?>
                                            <span class="badge badge-info"><?php echo $order['transaction_status'] ?></span>
                                            <?php }elseif(isset( $order['transaction_status']) &&  $order['transaction_status'] == 'In-process'){ ?>
                                            <span class="badge badge-warning"><?php echo $order['transaction_status'] ?></span>
                                            <?php }elseif(isset( $order['transaction_status']) &&  $order['transaction_status'] == 'Return'){ ?>
                                            <span class="badge badge-danger"><?php echo $order['transaction_status'] ?></span>
                                             <?php }elseif(isset( $order['transaction_status']) &&  $order['transaction_status'] == 'Delivered'){ ?>
                                                <span class="badge badge-success"><?php echo $order['transaction_status'] ?></span>
                                            <?php }?>
                                        </td>

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
        </div>
    </section>
</div>
<?php include("../includes/footer.php");?>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
