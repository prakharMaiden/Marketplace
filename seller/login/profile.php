<?php
include_once("./../../functions/seller/loginFunctions.php");
if(empty($_SESSION['supplier_id'])){
    header("location:login.php");

}
error_reporting(E_ALL);
$userClass=new DB_con();
if(isset($_POST['submit'])) {
    $response=$userClass->profileUpdate();
}

$result = mysqli_query($con,"select * from suppliers where (id='$_SESSION[supplier_id]')");
$supplierData = mysqli_fetch_assoc($result);
?>
<?php include("../includes/header.php");?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Profile Update</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact" data-toggle="tab">Contact information</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact2" data-toggle="tab">Other information</a></li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="profile" class="tab-pane active">
                        <form class="form-horizontal" action='' id="profileForm" method="POST">
                            <?php if (!empty($response)) { ?>
                                <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                                    <?php echo $response["message"]; ?>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label class="control-label" for="contact_fname">First name</label>
                                <div class="controls">
                                    <input type="text" id="contact_fname" name="contact_fname" value="<?php echo $supplierData["contact_fname"]; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="contact_lname">Last name</label>
                                <div class="controls">
                                    <input type="text" id="contact_lname" name="contact_lname" value="<?php echo $supplierData["contact_lname"]; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="phone">phone Number</label>
                                <div class="controls">
                                    <input type="number" id="phone" maxlength="10" value="<?php echo $supplierData["phone"]; ?>"  minlength="10" name="phone" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="email">E-mail</label>
                                <div class="controls">
                                    <input type="email" id="email" name="email" value="<?php echo $supplierData["email"]; ?>" readonly class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <div class="controls">
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="confirm_password">Confirm Password</label>
                                <div class="controls">
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" id="submit" onClick="validatePassword();"  name="submit">Update</button>
                            </div>
                        </form>
                    </div>
                    <div id="address" class="tab-pane ">
                        <form class="form-horizontal" action='' id="addressForm" method="POST">

                            <div class="form-group">
                                <label class="control-label" for="address1">Address 1</label>
                                <div class="controls">
                                    <input type="text" id="address1" name="address1" value="<?php echo $supplierData["address1"]; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="address2">Address 2</label>
                                <div class="controls">
                                    <input type="text" id="address2" name="address2" value="<?php echo $supplierData["address2"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="country">Country</label>
                                <div class="controls">
                                    <input type="text" id="country" name="country" value="<?php echo $supplierData["country"]; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="state">State</label>
                                <div class="controls">
                                    <input type="text" id="state" name="state" value="<?php echo $supplierData["state"]; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="city">City</label>
                                <div class="controls">
                                    <input type="text" id="city" name="city" value="<?php echo $supplierData["city"]; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="postal_code">Postal code</label>
                                <div class="controls">
                                    <input type="text" id="postal_code" name="postal_code" value="<?php echo $supplierData["postal_code"]; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" id="submit"  name="submit">Update</button>
                            </div>
                        </form>
                    </div>
                    <div id="contact" class="tab-pane ">
                        <form class="form-horizontal"  enctype="multipart/form-data" action='' id="addressForm" method="POST">

                            <div class="form-group">
                                <label class="control-label" for="contact_title">Contact title</label>
                                <div class="controls">
                                    <input type="text" id="contact_title" name="contact_title" value="<?php echo $supplierData["contact_title"]; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="company_name">Company Name</label>
                                <div class="controls">
                                    <input type="text" id="company_name" name="company_name" value="<?php echo $supplierData["company_name"]; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="customer_id">Customer</label>
                                <div class="controls">
                                    <select id="customer_id" name="customer_id" class="form-control" required>
                                        <option>Please select</option>
                                        <?php

                                        $results=mysqli_query($con,"select * from customers") ;
                                        foreach ($results as $result){
                                            $id = $result['id'];
                                            $customer=mysqli_query($con,"select * from customer_detail where (customer_id='$id')") ;
                                            $customerData = mysqli_fetch_assoc($customer);
                                            // print_r($customer);die;
                                            ?>
                                            <option value="<?php  echo $customerData['customer_id'];?>" <?php if($id == $customerData['customer_id']) echo 'selected';?>><?php echo $customerData['first_name'].' '.$customerData['last_name']  ; ?></option>

                                        <?php  }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="current_order">Current order</label>
                                <div class="controls">
                                    <input type="text" id="current_order" name="current_order" value="<?php echo $supplierData["current_order"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="size_url">Size url</label>
                                <div class="controls">
                                    <input type="text" id="size_url" name="size_url" value="<?php echo $supplierData["size_url"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="logo">Logo</label>
                                <div class="controls">
                                    <input type="file" id="logo" name="logo" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" id="submit"   name="submit">Update</button>
                            </div>
                        </form>
                    </div>
                    <div id="contact2" class="tab-pane ">
                        <form class="form-horizontal" action="" id="address2Form" method="POST">
                            <div class="form-group">
                                <label class="control-label" for="fax">Fax</label>
                                <div class="controls">
                                    <input type="text" id="fax" name="fax" value="<?php echo $supplierData["fax"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="url">Url</label>
                                <div class="controls">
                                    <input type="text" id="url" name="url" value="<?php echo $supplierData["url"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="payment_methods">Payment methods</label>
                                <div class="controls">
                                    <input type="text" id="payment_methods" name="payment_methods" value="<?php echo $supplierData["payment_methods"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="discount_type">Discount type</label>
                                <div class="controls">
                                    <input type="text" id="discount_type" name="discount_type" value="<?php echo $supplierData["discount_type"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="type_goods">Type goods</label>
                                <div class="controls">
                                    <input type="text" id="type_goods" name="type_goods" value="<?php echo $supplierData["type_goods"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="discount_available">Discount available</label>
                                <div class="controls">
                                    <input type="text" id="discount_available" name="discount_available" value="<?php echo $supplierData["discount_available"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="notes">Notes</label>
                                <div class="controls">
                                    <input type="text" id="notes" name="notes" value="<?php echo $supplierData["notes"]; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" id="submit" name="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include("../includes/footer.php");?>
<script>
    function validatePassword() {
        var validator = $("#profileForm").validate({
            rules: {
                confirm_password: {equalTo: "#password"}
            },
            messages: {
                confirm_password: "Both passwords must be same."
            }
        });
    }
</script>
</body>
</html>