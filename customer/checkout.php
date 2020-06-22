<?php
include_once("controller/profileController.php");
$profileData=new profileController();
//print_r($_SESSION);die;
if(empty($_SESSION['customer_id'])){
    header("location:auth/login.php");
}
if(isset($_POST['submit'])) {
    $response= $profileData->profileUpdate();
}
include("includes/header.php");
$result=mysqli_query($con,"select * from customers where id='$_SESSION[customer_id]'") ;
$customer= mysqli_fetch_assoc($result);
$res=mysqli_query($con,"select * from customer_detail where customer_id='$_SESSION[customer_id]'") ;
$customerDetail= mysqli_fetch_assoc($res);
if(isset($_POST['total_amount'])){
    $_SESSION['total_amount']= $_POST['total_amount'];
}

//print_r($_POST['total_amount']);die;

$carts=mysqli_query($con,"SELECT *, cart.id AS cart_id FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE cart.customer_id='$_SESSION[customer_id]' ORDER BY cart.id DESC");
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
        }.checkout-form,  .checkout-form2{
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
    </style>
    <div class="ps-page--simple">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="<?php echo PATH;?>/customer/index.php">Home</a></li>
                    <li>Checkout</li>
                </ul>
            </div>
        </div>
        <div class="ps-checkout ps-section--shopping">
            <div class="container">
                <div class="ps-section__header">
                    <h1>Checkout</h1>
                </div>
                <div class="ps-section__content">
                            <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12 pull-left checkout-form" style="border-right:8px solid #fff">

                                    <div class="ps-form__billing-info">
                                    <h3 class="ps-form__heading">Billing Details</h3>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" placeholder="First name" type="text" value="<?php echo $customerDetail['first_name'] ?>" name="first_name" id="first_name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="text" placeholder="Last name"  value="<?php echo $customerDetail['last_name'] ?>" name="last_name" id="last_name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="text" placeholder="Phone number" value="<?php echo $customer['mobile'] ?>" name="mobile" id="mobile" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control"  type="email" placeholder="Email address" value="<?php echo $customer['email'] ?>" name="email" id="email" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="ps-form__heading">Billing Address</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Flat, House no., Building, Company, Apartment<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="text" placeholder="Flat, House no., Building, Company, Apartment" value="<?php echo $customerDetail['address1'] ?>" name="address1" id="address1" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Area, Colony, Street, Sector, Village<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control"  type="text" placeholder="Area, Colony, Street, Sector, Village" value="<?php echo $customerDetail['address2'] ?>" name="address2" id="address2" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Town/City<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="text" placeholder="Town/City" value="<?php echo $customerDetail['city'] ?>" name="city" id="city" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State / Province / Region<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control"  type="text" placeholder="State / Province / Region" value="<?php echo $customerDetail['state'] ?>" name="state" id="state" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="text" placeholder="Country" value="<?php echo $customerDetail['country'] ?>" name="country" id="country" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Postal Code<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" pattern="^[0-9]{6}(?:-[0-9]{4})?$" placeholder="Postal Code" type="text" value="<?php echo $customerDetail['postal_code'] ?>" name="postal_code" id="postal_code" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="ps-checkbox">
                                            <input class="form-control" type="checkbox" id="cb01">
                                            <label for="cb01">Ship to a different address?</label>
                                        </div>
                                    </div>
                                    <div id="shipping_address">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php if (!empty($response)) { ?>
                                                    <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                                                        <?php echo $response["message"]; ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <form class="ps-form--checkout"  action="" id="profileForm" method="post">
                                    <div class="row">
                                        <div class="col-md-12"><h3 class="ps-form__heading">Shipping Address</h3></div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Flat, House no., Building, Company, Apartment<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="text" placeholder="Flat, House no., Building, Company, Apartment" value="<?php echo $customerDetail['shipping_address1'] ?>" name="shipping_address1" id="shipping_address1" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Area, Colony, Street, Sector, Village<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control"  type="text" placeholder="Area, Colony, Street, Sector, Village" value="<?php echo $customerDetail['shipping_address2'] ?>" name="shipping_address2" id="shipping_address2" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Town/City<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="text" placeholder="Town/City" value="<?php echo $customerDetail['shipping_city'] ?>" name="shipping_city" id="shipping_city" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State / Province / Region<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control"  type="text" placeholder="State / Province / Region" value="<?php echo $customerDetail['shipping_region'] ?>" name="shipping_region" id="shipping_region" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="text" placeholder="Country" value="<?php echo $customerDetail['shipping_country'] ?>" name="shipping_country" id="shipping_country" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Postal Code<sup>*</sup>
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" pattern="^[0-9]{6}(?:-[0-9]{4})?$" placeholder="Postal Code" type="text" value="<?php echo $customerDetail['shipping_postal_code'] ?>" name="shipping_postal_code" id="shipping_postal_code" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group submtit">
                                            <button class="ps-btn"  type="submit" id="submit"  name="submit">Submit</button>
                                        </div>
                                    </div>

                                </div>
                                </form>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-md-12 col-sm-12  pull-left checkout-form2 ">
                               <div class="ps-form__billing-info"><div class="ps-form__total">
                                       <h3 class="ps-form__heading">Your Order</h3>
                                       <div class="content">
                                           <div class="ps-block--checkout-total">
                                               <div class="ps-block__content">
                                                   <table class="table ps-block__products">
                                                       <thead>
                                                       <tr>
                                                           <th>Product</th>
                                                           <th>Price</th>
                                                           <th>Total</th>
                                                       </tr>
                                                       </thead>
                                                       <tbody>
                                                       <?php foreach ($carts as $cart){
                                                           $stmt = mysqli_query($con,"SELECT * FROM suppliers WHERE id='$cart[supplier_id]'");
                                                           $supplier = mysqli_fetch_assoc($stmt);
                                                           ?>
                                                           <tr>
                                                               <td><a href="#"><?php echo $cart['name']; ?> ×<?php echo $cart['quantity']; ?></a>
                                                                   <p>Sold By:<strong><?php echo $supplier['company_name']; ?></strong></p>
                                                               </td>
                                                               <td><?php echo $cart['unit_price']; ?></td>
                                                               <td><?php echo $cart['unit_price']*$cart['quantity'] ?></td>
                                                           </tr>
                                                       <?php }?>
                                                       </tbody>
                                                   </table>
                                                   <h3>Total <span><?php if(isset($_SESSION['total_amount'])){ echo $_SESSION['total_amount']; } ?></span></h3>
                                               </div>
                                               <div class="ps-block__content">
                                                   <?php
                                                   if(isset($_SESSION['customer_id'])){?>
                                                       <form action="<?php echo PATH ?>/customer/checkout.php" method="post">
                                                           <input type="hidden" name="total_amount" id="checkout_totalamount" value="">
                                                           <button type="submit" id="submit" name="submit" class="ps-btn ps-btn--fullwidth">Proceed to pay</button>
                                                       </form>
                                                   <?php }else{?>
                                                       <a class="ps-btn ps-btn--fullwidth" href="<?php echo PATH ?>/customer/auth/login.php">Login to proceed</a>
                                                   <?php }?>
                                               </div>
                                           </div>
                                       </div>
                                   </div></div>
                            </div>
                        </div>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>

<?php include("includes/footer.php"); ?>


<script src="<?php echo PUBLIC_PATH;?>/css/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#profileForm').validate();


    });
</script>
<script>
    $("#shipping_address").hide();
    $("#cb01").click(function() {
        if($(this).is(":checked")) {
            $("#shipping_address").show(300);
        } else {
            $("#shipping_address").hide(200);
        }
    });
</script>
