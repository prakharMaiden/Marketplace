<?php

include_once("./../controller/stock_management/stockManagementController.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../auth/login.php");
}
$stockManagement=new stockManagementController();
$stocks=$stockManagement->listing();

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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stock Management</h3>
                            <div class="card-tools">
                                <a class="btn btn-success" href="add.php">Add Stock Management</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table  id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price per product</th>
                                    <th>Total Price</th>
                                    <th>Total Discount</th>
                                    <th>In stock date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $x =0;
                                foreach($stocks as $stock){
                                    $products = mysqli_query($con, "select * from products where (id='$stock[product_id]')");
                                    $product = mysqli_fetch_assoc($products);
                                    ++$x;
                                    ?>
                                    <tr>
                                        <td><?php  echo $x;?></td>
                                        <td><?php  echo $product['name'];?></td>
                                        <td><?php  echo $stock['quantity'];?></td>
                                        <td><?php  echo $stock['price_per_product'];?></td>
                                        <td><?php  echo $stock['total_price'];?></td>
                                        <td><?php if(isset($stock['total_discount'])) {  echo $stock['total_discount'].'%'; }else{ echo'-';};?></td>

                                        <td><?php  echo date("d-m-Y",strtotime($stock['date_in_stock']));?></td>
                                        <td><?php  if($stock['active'] == 0){
                                                ?>
                                                <span class="badge badge-danger">De-active</span>
                                                <?php
                                            }else {?>
                                                <span class="badge badge-success">Active</span>
                                            <?php }?></td>
                                        <td>
                                            <a href="edit.php?id=<?php  echo $stock['id'];?>" ><i class="fas fa-edit" style="color:#3e8f3e;" aria-hidden="false"></i></a>
                                            <?php  if($stock['active'] == 0){
                                                ?>
                                                <i class="fas fa-toggle-off" style="color:#dc3545;cursor: pointer;"></i>
                                                <?php
                                            }else {?>
                                                <i class="fas fa-toggle-on"    style="color:#3e8f3e;cursor: pointer;"></i>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php  }
                                ?>
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
