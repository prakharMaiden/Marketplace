<?php
include_once("./../../functions/seller/products/productFunctions.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../login.php");
}
error_reporting(E_ALL);
$productClass=new Product();

$products=$productClass->listing();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Krishna Golds Industries</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
<style>
    .error{color:red;}
    h2{
        font-weight: bold;
        font-size: 50px;
    }
</style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../dashboard.php">Krishna Golds Industries</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="../dashboard.php">Dashboard</a></li>
            <li><a href="../profile.php">Profile</a></li>
            <li class="active"><a href="products.php">Products</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <h2>Products</h2>

    <table class="table table-bordered table-striped">
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
            <td><?php  echo $product['discount'];?></td>
            <td><?php  echo $product['msrp'];?></td>
            <td>
                <a href="edit.php?id=<?php  echo $product['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </td>
         </tr>
        <?php  }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>