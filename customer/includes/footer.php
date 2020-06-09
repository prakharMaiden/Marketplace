<footer class="ps-footer">
    <div class="ps-container">
        <div class="ps-footer__widgets">
            <aside class="widget widget_footer widget_contact-us">
                <h4 class="widget-title">Contact us</h4>
                <div class="widget_content">
                    <p>Call us 24/7</p>
                    <h3>1800 97 97 69</h3>
                    <p>502 New Design Str, Melbourne, Australia <br><a href="http://nouthemes.net/cdn-cgi/l/email-protection#20434f4e54414354604d415254465552590e434f"><span class="__cf_email__" data-cfemail="93f0fcfde7f2f0e7d3fef2e1e7f5e6e1eabdf0fc">[email&#160;protected]</span></a></p>
                    <ul class="ps-list--social">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Quick links</h4>
                <ul class="ps-list--link">
                    <li><a href="#">Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Return</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Company</h4>
                <ul class="ps-list--link">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Affilate</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Bussiness</h4>
                <ul class="ps-list--link">
                    <li><a href="#">Our Press</a></li>
                    <li><a href="#">Checkout</a></li>
                    <li><a href="#">My account</a></li>
                    <li><a href="#">Shop</a></li>
                </ul>
            </aside>
        </div>
        <div class="ps-footer__links">
            <?php
            $categories=mysqli_query($con,"select * from category ORDER BY id DESC  LIMIT 5") ;
            foreach ($categories as $category) {

                ?>
                <p><strong><?php echo ucfirst($category['name'])  ; ?></strong>
                    <?php  if($category['child'] != 0){
                        $subcategories=mysqli_query($con,"select * from subcategory where category_id='$category[id]'") ;
                        foreach ($subcategories as $subcategory) { ?>
                            <a href="#">
                                <?php echo ucfirst($subcategory['name'])  ; ?>
                            </a>
                        <?php }
                    }
                    ?>
                </p>
                <?php
            }
            ?>
        </div>
        <div class="ps-footer__copyright">
            <p>© <?php echo date("Y"); ?> Krishna Golds Industries. All Rights Reserved</p>
        </div>
    </div>
</footer>
<div id="back2top"><i class="pe-7s-angle-up"></i></div>
<div class="ps-site-overlay"></div>
<div id="loader-wrapper">
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
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


<script>
    $(function(){

        getCart();

        $('#productForm').submit(function(e){
            e.preventDefault();
            var product = $(this).serialize();
            console.log('swati',product);
            $.ajax({
                type: 'POST',
                url: 'cart_add.php',
                data: product,
                dataType: 'json',
                success: function(response){
                    //console.log("swati",response);
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

    });

    function getCart(){
        console.log('swatisdavhs');
        $.ajax({
            type: 'POST',
            url: 'cart_fetch.php',
            dataType: 'json',
            success: function(response){
                console.log('swati',response);
                $('#cart_menu').html(response.list);
                $('.cart_count').html(response.count);
            }
        });
    }
</script>

<script>
    $(function(){
        $('#add').click(function(e){
            e.preventDefault();
            var quantity = $('#quantity').val();
            quantity++;
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
</body>
</html>