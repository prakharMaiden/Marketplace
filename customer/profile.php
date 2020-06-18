<?php
include_once("controller/profileController.php");
$profileData=new profileController();

if(isset($_POST['submit'])) {
    $response= $profileData->profileUpdate();
}
include("includes/header.php");
$result=mysqli_query($con,"select * from customers where id='$_SESSION[customer_id]'") ;
$customer= mysqli_fetch_assoc($result);
$res=mysqli_query($con,"select * from customer_detail where customer_id='$_SESSION[customer_id]'") ;
$customerDetail= mysqli_fetch_assoc($res);

?>
<style>
    .error{
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
</style>
<div class="ps-page--simple">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo PATH;?>/customer/index.php">Home</a></li>
                <li>Profile</li>
            </ul>
        </div>
    </div>
    <div class="ps-checkout ps-section--shopping">
        <div class="container">

            <div class="ps-section__header">
                <h1>Profile</h1>
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
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12  ">
                        <form class="ps-form--checkout" action="" id="profileForm" method="post">
                            <div class="ps-form__billing-info">
                                <h3 class="ps-form__heading">Profile </h3>
                                <div class="row">i
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control" type="text" value="<?php echo $customerDetail['first_name'] ?>" name="first_name" id="first_name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control" type="text" value="<?php echo $customerDetail['last_name'] ?>" name="last_name" id="last_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Flat, House no., Building, Company, Apartment<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control" type="text" value="<?php echo $customerDetail['address1'] ?>" name="address1" id="address1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Area, Colony, Street, Sector, Village<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control"  type="text" value="<?php echo $customerDetail['address2'] ?>" name="address2" id="address2" required>
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
                                                <input class="form-control" type="text" value="<?php echo $customerDetail['city'] ?>" name="city" id="city" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State / Province / Region<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control"  type="text" value="<?php echo $customerDetail['state'] ?>" name="state" id="state" required>
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
                                                <input class="form-control" type="text" value="<?php echo $customerDetail['country'] ?>" name="country" id="country" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Code<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control"  type="text" value="<?php echo $customerDetail['postal_code'] ?>" name="postal_code" id="postal_code" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control" type="text" value="<?php echo $customerDetail['address1'] ?>" name="address1" id="address1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>address2<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control"  type="text" value="<?php echo $customerDetail['address2'] ?>" name="address2" id="address2" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control" type="text" value="<?php echo $customerDetail['address1'] ?>" name="address1" id="address1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>address2<sup>*</sup>
                                            </label>
                                            <div class="form-group__content">
                                                <input class="form-control"  type="text" value="<?php echo $customerDetail['address2'] ?>" name="address2" id="address2" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group submtit">
                                    <button class="ps-btn"  type="submit" id="submit"  name="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script src="<?php echo PUBLIC_PATH;?>/css/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo PUBLIC_PATH;?>/css/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#profileForm').validate({
            rules: {
            },
            messages: {
            }
        });
        $(document).ready(function () {
            //called when key is pressed in textbox
            $("#mobile").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $(".error").html("Digits Only").show().fadeOut("slow");
                    return false;
                }
            });
        });
    });
</script>
