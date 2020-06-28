<script src="<?php echo PUBLIC_PATH?>/plugins/jquery-1.12.4.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/popper.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/bootstrap4/js/bootstrap.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/masonry.pkgd.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/isotope.pkgd.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/jquery.matchHeight-min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/slick/slick/slick.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/slick-animation.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/sticky-sidebar/dist/sticky-sidebar.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/jquery.slimscroll.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/plugins/gmap3.min.js"></script>
<script src="<?php echo PUBLIC_PATH?>/js/main.js"></script>
<script src="<?php echo PUBLIC_PATH?>/js/jquery.payform.min.js" charset="utf-8"></script>
<script>
    $(function(){

        getCart();
        getWishlist();

        $('#cartForm').submit(function(e){
            e.preventDefault();
            var product = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'cart_add.php',
                data: product,
                dataType: 'json',
                success: function(response){
                    $('.alert').show();
                    $('.message').html(response.message);
                    if(response.error){
                        $('.alert ').removeClass('alert-success').addClass('alert-danger');
                    }
                    else{
                        $('.alert ').removeClass('alert-danger').addClass('alert-success');
                        getCart();
                    }
                }
            });
        });

        $(document).on('click', '.close', function(){
            $('.alert').hide();
        });

        $('#wishlistForm').submit(function(e){
            e.preventDefault();
            var product = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'wishlist_add.php',
                data: product,
                dataType: 'json',
                success: function(response){
                    $('.alert').show();
                    $('.message').html(response.message);
                    if(response.error){
                        $('.alert ').removeClass('alert-success').addClass('alert-danger');
                        $(".icon-heart").css({"color": "999", "font-weight": "bold", "font-size": "35px"});
                    }
                    else{
                        $('.alert ').removeClass('alert-danger').addClass('alert-success');
                        $(".icon-heart").css({"color": "fcb800", "font-weight": "bold", "font-size": "35px"});
                        getWishlist();
                    }
                }
            });
        });

    });

    function getCart(){
        $.ajax({
            type: 'POST',
            url: 'cart_fetch.php',
            dataType: 'json',
            success: function(response){
                $('#cart_menu').html(response.list);
                $('.cart_count').html(response.count);
            }
        });
    }

    function getWishlist(){
        $.ajax({
            type: 'POST',
            url: 'wishlist_fetch.php',
            dataType: 'json',
            success: function(response){
                $('#wishlist_menu').html(response.list);
                $('.wishlist_count').html(response.count);
            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.ps-form--quick-search input[type="text"]').on("keyup input", function(){

            var inputVal = $("#text_search").val();
            var resultDropdown = $(".search-box").children(".result");
            if(inputVal.length){
                $.get("search.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                    console.log($(this));
                });
            } else{
                resultDropdown.empty();
            }
        });
    });
</script>

<script>
    $(function(){
        $('#add').click(function(e){
            e.preventDefault();
            var quantity = $('#quantity').val();
            var quantity_maxlength =$('#quantity').attr('maxLength');
            if(quantity < 10){
                quantity++;

            }


            $('#quantity').val(quantity);
        });
        $('#minus').click(function(e){
            e.preventDefault();
            var quantity = $('#quantity').val();
            if(quantity > 1){
                quantity--;
            }
            $('#quantity').val(quantity);
        });

    });
</script>