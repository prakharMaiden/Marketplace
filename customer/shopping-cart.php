<?php
include_once("./../config/config.php");
include("includes/header.php");
?>
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
                                <th>Image</th>
                                <th>Product name</th>
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
                    <div class="ps-section__cart-actions">
                        <a class="ps-btn" href="index.php"><i class="icon-arrow-left"></i> Back to Shop</a>
                        <a class="ps-btn ps-btn--outline" href="index.php"><i class="icon-sync"></i> Update cart</a>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-block--shopping-total">
                        <div class="ps-block__header">
                            <p>Subtotal <span> $683.49</span></p>
                        </div>
                        <div class="ps-block__content">
                            <ul class="ps-block__product">
                                <li><span class="ps-block__shop">YOUNG SHOP Shipping</span><span class="ps-block__shipping">Free Shipping</span><span class="ps-block__estimate">Estimate for <strong>Viet Nam</strong><a href="#"> MVMTH Classical Leather Watch In Black ×1</a></span></li>
                                <li><span class="ps-block__shop">ROBERT’S STORE Shipping</span><span class="ps-block__shipping">Free Shipping</span><span class="ps-block__estimate">Estimate for <strong>Viet Nam</strong><a href="#">Apple Macbook Retina Display 12” ×1</a></span></li>
                            </ul>
                            <h3>Total <span>$683.49</span></h3>
                        </div>
                    </div><a class="ps-btn ps-btn--fullwidth" href="checkout.php">Proceed to checkout</a>
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
                        getDetails();
                        getCart();
                        getTotal();
                    }
                }
            });
        });

        $(document).on('click', '.minus', function(e){
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
                    qty: qty,
                },
                dataType: 'json',
                success: function(response){
                    if(!response.error){
                        getDetails();
                        getCart();
                        getTotal();
                    }
                }
            });
        });

        $(document).on('click', '.add', function(e){
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
                    qty: qty,
                },
                dataType: 'json',
                success: function(response){
                    if(!response.error){
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
