<?php
include_once("./../config/config.php");
include("includes/header.php");
?>
<style>
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
</style>
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo PATH;?>/customer/index.php">Home</a></li>
                <li>Shopping-cart</li>
            </ul>
        </div>
    </div>
    <div class="ps-section--shopping ps-shopping-cart">
        <div class="container">
            <div class="ps-section__header">
                <h1>Shopping Cart</h1>
            </div>

            <div class="ps-section__content">
                <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
                    <div class="table-responsive">
                        <table class="table ps-table--shopping-cart">
                            <thead>
                            <tr>

                                <th>Product</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>TOTAL</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-block--shopping-total">
                       <?php
                            if(isset($_SESSION['customer_id'])){?>
                        <div class="ps-block__header">
                            <p><b>Customer Details</b></p>
                        </div>
                            <?php }?>
                        <div class="ps-block__content">
                            <?php
                            if(isset($_SESSION['customer_id'])){
                            $result = mysqli_query($con, "select mobile from customers where id='$_SESSION[customer_id]'");
                            $customer = mysqli_fetch_assoc($result);

                            $stmt = mysqli_query($con, "select * from customer_detail where customer_id='$_SESSION[customer_id]'");
                            $customerDetail = mysqli_fetch_assoc($stmt);

                            ?>
                            <ul class="ps-block__product">
                                <li>
                                    <span class="ps-block__shop"><?php echo ucfirst($customerDetail['first_name']).' '.$customerDetail['last_name']?></span>
                                    <span class="ps-block__shop"><?php echo ucfirst($customerDetail['address1']).','.$customerDetail['address2']?></span>
                                    <span class="ps-block__shop"><?php echo ucfirst($customerDetail['city']).','.$customerDetail['state'].','.$customerDetail['postal_code']?></span>
                                    <span class="ps-block__shop"><?php echo ucfirst($customerDetail['country'])?></span>
                                    <span class="ps-block__shop"><?php echo ($customer['mobile'])?></span>
                                </li>
                            </ul>
                            <?php }?>
                            <h3>Total <span id="total_ammount"></span></h3>
                        </div>
                    </div>
                    <?php
                            if(isset($_SESSION['customer_id'])){?>
                    <a class="ps-btn ps-btn--fullwidth" href="<?php echo PATH ?>/customer/checkout.php">Proceed to checkout</a>
                            <?php }else{?>
                                <a class="ps-btn ps-btn--fullwidth" href="<?php echo PATH ?>/customer/auth/login.php">Login to proceed</a>
                            <?php }?>
                </div>
                </div>
                   </div>
        </div>
    </div>

<?php include("includes/footer.php");?>
<script>
    var total = 0;
    $(function(){

        $(document).on('click', '.cart_delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'cart_delete.php',
                data: {id:id},
                dataType: 'json',
                success: function(response){
                    if(!response.error){
                        //window.location.reload(true);
                        getDetails();
                        getCart();
                        getTotal();
                    }
                }
            });
        });

        $(document).on('click', '.down', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var qty = $('#qty_'+id).val();
            if(qty>1){
                qty--;
            }
            $('#qty_'+id).val(qty);
            $.ajax({
                type: 'POST',
                url: 'cart_update.php',
                data: {
                    id: id,
                    quantity: qty,
                },
                dataType: 'json',
                success: function(response){
                    if(!response.error){
                      //  window.location.reload(true);
                        getDetails();
                        getCart();
                        getTotal();
                    }
                }
            });
        });

        $(document).on('click', '.up', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var qty = $('#qty_'+id).val();
            qty++;
            $('#qty_'+id).val(qty);
            $.ajax({
                type: 'POST',
                url: 'cart_update.php',
                data: {
                    id: id,
                    quantity: qty,
                },
                dataType: 'json',
                success: function(response){
                    if(!response.error){

                      //window.location.reload(true);
                        getDetails();
                        getCart();
                        getTotal();
                    }
                }
            });
        });

        getDetails();
        getTotal();

    });

    function getDetails(){
        $.ajax({
            type: 'POST',
            url: 'cart_details.php',
            dataType: 'json',
            success: function(response){
                $('#tbody').html(response);

                var total_ammount1 =$('#total_ammount1').html();
                $('#total_ammount').html(total_ammount1);
                getCart();
            }
        });
    }

    function getTotal(){
        $.ajax({
            type: 'POST',
            url: 'cart_total.php',
            dataType: 'json',
            success:function(response){
                total = response;
            }
        });
    }
</script>
