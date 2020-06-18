<?php
include_once("./../config/config.php");
include("includes/header.php");
$id = $_GET['id'];
$res= mysqli_query($con,"select * from suppliers where id='$id'") ;
$supplier= mysqli_fetch_assoc($res);

$result=mysqli_query($con,"select *,COUNT(*) AS product_count from products where supplier_id='$supplier[id]'") ;
$productName= mysqli_fetch_assoc($result);
?>

    <div class="ps-page--single">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="<?php echo PATH;?>/customer/index.php">Home</a></li>
                    <li>Vendor Store</li>
                </ul>
            </div>
        </div>
        <div class="ps-vendor-store">
            <div class="container">
                <div class="ps-section__container">
                    <div class="ps-section__left">
                        <div class="ps-block--vendor">
                            <div class="ps-block__thumbnail">
                                <?php  if(!empty($supplier['logo'] )){?>
                                    <a href="#">
                                        <img src="<?php echo PUBLIC_PATH;?>/img/seller/logo/<?php echo $supplier['logo'];?>"  title="Vendor Image" >
                                    </a>
                                <?php }else {?>
                                    <a href="#">
                                        <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" title="Vendor Image">
                                    </a>
                                <?php }?>
                                <img src="img/vendor/vendor-store.jpg" alt="">
                            </div>
                            <div class="ps-block__container">
                                <div class="ps-block__header">
                                    <h4><?php echo $supplier['company_name']; ?></h4>
                                </div><span class="ps-block__divider"></span>
                                <div class="ps-block__content">
                                    <p><?php echo $supplier['notes']; ?></p>
                                    <h5 style="color:#666;"><strong>Address:</strong> <?php echo $supplier['address1'].','.$supplier['address2'] ?><br/> <?php echo $supplier['city'].','.$supplier['state'] ?><br/> <?php echo $supplier['country'].'-'.$supplier['postal_code'] ?></h5>
                                    <figure>
                                        <figcaption>Follow us on social</figcaption>
                                        <ul class="ps-list--social-color">
                                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a class="feed" href="#"><i class="fa fa-feed"></i></a></li>
                                        </ul>
                                    </figure>
                                </div>
                                <div class="ps-block__footer">
                                    <p>Call us directly<strong>+91-<?php echo $supplier['phone']; ?></strong></p>
                                    <p>or Or if you have any question</p><a class="ps-btn ps-btn--fullwidth" href="#">Contact Seller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-section__right">
                        <div class="ps-block--vendor-filter">
                            <div class="ps-block__left">
                                <ul>
                                    <li class="active"><a href="#">Products</a></li>
                                </ul>
                            </div>
                            <div class="ps-block__right">
                                <form class="ps-form--search" action="l" method="post">
                                    <input class="form-control" type="text" placeholder="Search in this shop">
                                    <button><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="ps-vendor-best-seller">
                            <div class="ps-section__header">
                                <h3>Best Seller items</h3>
                                <div class="ps-section__nav"><a class="ps-carousel__prev" href="#vendor-bestseller"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#vendor-bestseller"><i class="icon-chevron-right"></i></a></div>
                            </div>
                            <div class="ps-section__content">
                                <div class="owl-slider" id="vendor-bestseller" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                                    <?php
                                    $products = mysqli_query($con, "select * from   products where supplier_id='$supplier[id]'");

                                    foreach ($products as $product){
                                        $ret=mysqli_query($con,"select *,COUNT(*) As review_count,SUM(rating) AS sum_rating from reviews where product_id='$product[id]'") ;
                                        $reviews= mysqli_fetch_assoc($ret);

                                        ?>
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail">

                                                    <a href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>">
                                                        <?php  if(!empty($product['featured_image'] )){?>
                                                            <img src="<?php echo PUBLIC_PATH;?>/img/seller/products//<?php echo $product['featured_image'];?>" alt="">
                                                        <?php }else {?>
                                                            <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                                        <?php }?>
                                                    </a>
                                                    <?php  if(isset($product['discount_available'] ) && $product['discount_available'] =='yes'){?>  <div class="ps-product__badge"><?php echo $product['discount'];?>%</div> <?php }?>
                                                    <?php if(isset($product['product_available']) && $product['product_available'] == 'no'){
                                                        echo "   <div class='ps-product__badge out-stock'>Out Of Stock</div>";
                                                    } ?>
                                                </div>

                                                <div class="ps-product__container"><a class="ps-product__vendor" href="<?php echo PATH;?>/customer/vendor-store.php/?id=<?php echo $supplier['id']  ; ?>"><?php echo $supplier['company_name']?></a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>"><?php echo $product['name'];?></a>
                                                        <?php if(isset($reviews['review_count']) && $reviews['review_count'] >0){ ?>
                                                            <div class="ps-product__rating">
                                                                <select class="ps-rating" data-read-only="true">
                                                                    <option value="<?php echo $reviews['sum_rating']/$reviews['review_count'] ?>"><?php echo $reviews['sum_rating']/$reviews['review_count'] ?></option>
                                                                    <option value="1">2</option>
                                                                    <option value="1">3</option>
                                                                    <option value="1">4</option>
                                                                    <option value="2">5</option>
                                                                </select><span><?php echo round($reviews['sum_rating']/$reviews['review_count'],2); ?> (<?php echo $reviews['review_count'] ?> review)</span>
                                                            </div>
                                                        <?php } else{?>
                                                            <div class="ps-product__rating">
                                                                <select class="ps-rating" data-read-only="true">
                                                                    <option value="1">1</option>
                                                                    <option value="1">2</option>
                                                                    <option value="1">3</option>
                                                                    <option value="1">4</option>
                                                                    <option value="1">5</option>
                                                                </select><span>(0 review)</span>
                                                            </div>
                                                        <?php }?>
                                                        <p class="ps-product__price">Rs. <?php echo $product['unit_price'];?></p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>"><?php echo $product['name'];?></a>
                                                        <p class="ps-product__price">Rs. <?php echo $product['unit_price'];?></p>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shopping ps-tab-root">
                            <div class="ps-shopping__header">
                                <p><strong> <?php echo $productName['product_count'] ?></strong> Products found</p>
                                <div class="ps-shopping__actions">
                                    <select class="ps-select" data-placeholder="Sort Items">
                                        <option>Sort by latest</option>
                                        <option>Sort by popularity</option>
                                        <option>Sort by average rating</option>
                                        <option>Sort by price: low to high</option>
                                        <option>Sort by price: high to low</option>
                                    </select>
                                    <div class="ps-shopping__view">
                                        <p>View</p>
                                        <ul class="ps-tab-list">
                                            <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                                            <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="ps-tabs">
                                <div class="ps-tab active" id="tab-1">
                                    <div class="row">
                                        <?php
                                        $products = mysqli_query($con, "select * from   products where supplier_id='$supplier[id]'");

                                        foreach ($products as $product){
                                            $ret=mysqli_query($con,"select *,COUNT(*) As review_count,SUM(rating) AS sum_rating from reviews where product_id='$product[id]'") ;
                                            $reviews= mysqli_fetch_assoc($ret);
                                            ?>
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                                <div class="ps-product">
                                                    <div class="ps-product__thumbnail">

                                                        <a href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>">
                                                            <?php  if(!empty($product['featured_image'] )){?>
                                                                <img src="<?php echo PUBLIC_PATH;?>/img/seller/products//<?php echo $product['featured_image'];?>" alt="">
                                                            <?php }else {?>
                                                                <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                                            <?php }?>
                                                        </a>
                                                        <?php  if(isset($product['discount_available'] ) && $product['discount_available'] =='yes'){?>  <div class="ps-product__badge"><?php echo $product['discount'];?>%</div> <?php }?>
                                                        <?php if(isset($product['product_available']) && $product['product_available'] == 'no'){
                                                            echo "   <div class='ps-product__badge out-stock'>Out Of Stock</div>";
                                                        } ?>
                                                    </div>

                                                    <div class="ps-product__container"><a class="ps-product__vendor" href="<?php echo PATH;?>/customer/vendor-store.php/?id=<?php echo $supplier['id']  ; ?>"><?php echo $supplier['company_name']?></a>
                                                        <div class="ps-product__content"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>"><?php echo $product['name'];?></a>
                                                            <?php if(isset($reviews['review_count']) && $reviews['review_count'] >0){ ?>
                                                                <div class="ps-product__rating">
                                                                    <select class="ps-rating" data-read-only="true">
                                                                        <option value="<?php echo $reviews['sum_rating']/$reviews['review_count'] ?>"><?php echo $reviews['sum_rating']/$reviews['review_count'] ?></option>
                                                                        <option value="1">2</option>
                                                                        <option value="1">3</option>
                                                                        <option value="1">4</option>
                                                                        <option value="2">5</option>
                                                                    </select><span><?php echo round($reviews['sum_rating']/$reviews['review_count'],2); ?> (<?php echo $reviews['review_count'] ?> review)</span>
                                                                </div>
                                                            <?php } else{?>
                                                                <div class="ps-product__rating">
                                                                    <select class="ps-rating" data-read-only="true">
                                                                        <option value="1">1</option>
                                                                        <option value="1">2</option>
                                                                        <option value="1">3</option>
                                                                        <option value="1">4</option>
                                                                        <option value="1">5</option>
                                                                    </select><span>(0 review)</span>
                                                                </div>
                                                            <?php }?>
                                                            <p class="ps-product__price">Rs. <?php echo $product['unit_price'];?></p>
                                                        </div>
                                                        <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>"><?php echo $product['name'];?></a>
                                                            <p class="ps-product__price">Rs. <?php echo $product['unit_price'];?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>
                                    </div>

                                </div>
                                <div class="ps-tab" id="tab-2">
                                   <?php
                                    $products = mysqli_query($con, "select * from   products where supplier_id='$supplier[id]'");

                                    foreach ($products as $product){ ?>
                                        <div class="ps-product ps-product--wide">
                                            <div class="ps-product__thumbnail">
                                                <a href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>">
                                                    <?php  if(!empty($product['featured_image'] )){?>
                                                        <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $product['featured_image'];?>" alt="">
                                                    <?php }else {?>
                                                        <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                                    <?php }?>
                                                </a>
                                            </div>
                                            <div class="ps-product__container">
                                                <div class="ps-product__content"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>"><?php echo $product['name'];?></a>
                                                    <p class="ps-product__vendor">Sold by: <a href="<?php echo PATH;?>/customer/vendor-store.php/?id=<?php echo $supplier['id']  ; ?>"><?php echo $supplier['company_name']?></a></p>
                                                    <p class="ps-product__desc">
                                                        <?php echo $product['description'];?>
                                                    </p>
                                                </div>
                                                <div class="ps-product__shopping">
                                                    <p class="ps-product__price">Rs. <?php echo number_format($product['unit_price'],2);?> <del><small>Rs. <?php echo number_format($product['msrp'],2);?></small></del></p>
                                                    <?php if(isset($product['product_available']) && $product['product_available'] == 'no'){
                                                        echo "<div class='ps-product__actions out-stock'><p  style='padding: 10px 20px;background: #000;margin-right: 20px;color:#fff;'>Out Of Stock</p></div>";
                                                    }else{ ?>
                                                        <a type="button" data-id="<?php echo $product['id']; ?>" class='ps-btn add_cart'>Add to cart</a>
                                            <?php }?>

                                                </div>
                                            </div>
                                        </div>

                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("includes/footer.php");?>
<script>
    $(function(){
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

                }
            });
        })

    });
</script>
