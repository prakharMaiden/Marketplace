<?php

include_once("./../../controller/products/productController.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../../auth/login.php");
}
$productClass=new productController();
$products=$productClass->listing();

include("../../includes/header.php");
?>
<style>
    #example1_paginate,#example1_filter{
        float: right;
    }
</style>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Products</h3>
                                <div class="card-tools">
                                    <a class="btn btn-success" href="add.php">Add Product</a>
                                </div>
                            </div>
                            <div class="card-body">
                        <table  id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Color</th>
                                <th>Discount</th>
                                <th>MSRP</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x =0;
                            foreach ($products as $product){
                                ++$x;
                                ?>
                                <tr>
                                    <td><?php  echo $x;?></td>
                                    <td><?php  echo $product['name'];?></td>
                                    <td><?php  echo $product['id_sku'].'-'.$product['sku'];?></td>
                                    <td><?php  echo $product['quantity_per_unit'];?></td>
                                    <td><?php  echo $product['unit_price'];?></td>
                                    <td><?php  echo $product['color'];?></td>
                                    <td><?php  echo $product['discount'];?>%</td>
                                    <td><?php  echo $product['msrp'];?></td>
                                    <td><?php  if($product['product_available'] == 0){
                                        ?>
                                        <span class="badge badge-danger">De-active</span>
                                        <?php
                                    }else {?>
                                        <span class="badge badge-success">Active</span>
                                        <?php }?></td>
                                    <td>
                                        <a href="edit.php?id=<?php  echo $product['id'];?>" ><i class="fas fa-edit" style="color:#3e8f3e;" aria-hidden="false"></i></a>
                                        <?php  if($product['product_available'] == 0){
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
<?php include("../../includes/footer.php");?>
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
