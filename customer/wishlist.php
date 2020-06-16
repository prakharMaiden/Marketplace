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
<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo PATH;?>/customer/index.php">Home</a></li>
                    <li>Wishlist</li>
                </ul>
            </div>
        </div>
        <div class="ps-section--shopping ps-whishlist">
            <div class="container">
                <div class="ps-section__header">
                    <h1>Wishlist</h1>
                </div>
                <div class="ps-section__content">
                    <div class="table-responsive">
                        <table class="table ps-table--whishlist">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product name</th>
                                    <th>Unit Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("includes/footer.php");?>

<script>
    $(function(){
        getDetails();
        $(document).on('click', '.add_cart', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var qty = 1;
            $.ajax({
                type: 'POST',
                url: 'cart_add.php',
                data: {
                    id: id,
                    quantity: qty,
                },
                dataType: 'json',
                success: function(){
                    $.ajax({
                        type: 'POST',
                        url: 'wishlist_cart_delete.php',
                        data: {id:id},
                        dataType: 'json',
                        success: function(){
                            getDetails();
                            window.location.reload(true);
                        }
                    });
                }
            });
        })


        $(document).on('click', '.wishlist_delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'wishlist_delete.php',
                data: {id:id},
                dataType: 'json',
                success: function(){
                    getDetails();
                }
            });
        });

    });

    function getDetails(){
        $.ajax({
            type: 'POST',
            url: 'wishlist_details.php',
            dataType: 'json',
            success: function(response){
                $('#tbody').html(response);
            }
        });
    }
</script>
