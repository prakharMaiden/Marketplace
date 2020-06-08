<?php
include_once("./../config/config.php");
include("includes/header.php");
?>
    <div id="homepage-1">
        <div class="ps-home-banner ps-home-banner--1">
            <div class="ps-container">
                <div class="ps-section__left">
                    <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                        <div class="ps-banner"><a href="#"><img src="<?php echo PUBLIC_PATH;?>/img/slider/slide-1.jpg" alt=""></a></div>
                        <div class="ps-banner"><a href="#"><img src="<?php echo PUBLIC_PATH;?>/img/slider/slide-2.jpg" alt=""></a></div>
                        <div class="ps-banner"><a href="#"><img src="<?php echo PUBLIC_PATH;?>/img/slider/slide-3.jpg" alt=""></a></div>
                    </div>
                </div>
                <div class="ps-section__right"><a class="ps-collection" href="#"><img src="<?php echo PUBLIC_PATH;?>/img/slider/promotion-1.jpg" alt=""></a><a class="ps-collection" href="#"><img src="<?php echo PUBLIC_PATH;?>/img/slider/promotion-2.jpg" alt=""></a></div>
            </div>
        </div>
        <div class="ps-site-features">
            <div class="ps-container">
                <div class="ps-block--site-features">
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-rocket"></i></div>
                        <div class="ps-block__right">
                            <h4>Free Delivery</h4>
                            <p>For all oders over $99</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-sync"></i></div>
                        <div class="ps-block__right">
                            <h4>90 Days Return</h4>
                            <p>If goods have problems</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-credit-card"></i></div>
                        <div class="ps-block__right">
                            <h4>Secure Payment</h4>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                        <div class="ps-block__right">
                            <h4>24/7 Support</h4>
                            <p>Dedicated support</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-gift"></i></div>
                        <div class="ps-block__right">
                            <h4>Gift Service</h4>
                            <p>Support gift service</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-deal-of-day">
            <div class="ps-container">
                <div class="ps-section__header">
                    <div class="ps-block--countdown-deal">
                        <div class="ps-block__left">
                            <h3>Deals of the day</h3>
                        </div>
                    </div>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        <?php
                        $currentDate = date("Y-m-d");
                        $products=mysqli_query($con,"select * from products where date(created_at) ='$currentDate'  and discount != ''") ;
                        foreach ($products as $product) {  ?>
                            <div class="ps-product ps-product--inner">
                                <div class="ps-product__thumbnail">
                                    <a href="<?php echo PATH;?>/customer/product-details.php/?id=<?php echo $product['id']  ; ?>">
                                        <?php  if(!empty($product['featured_image'] )){?>
                                            <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $product['featured_image'];?>" alt="">

                                        <?php }else {?>
                                            <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                        <?php }?>


                                    </a>
                                    <div class="ps-product__badge"><?php echo $product['discount'];?></div>
                                    <ul class="ps-product__actions">
                                        <li><a href="<?php echo PATH;?>/customer/product-details.php/?id=<?php echo $product['id']  ; ?>" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target= "modal.php/?id=<?php echo $product['id']  ; ?>#product-quickview"><i class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container">
                                    <p class="ps-product__price sale">Rs. <?php echo $product['unit_price'];?> <?php if(!empty($product['msrp'])){ ?>  <del>Rs. <?php echo $product['msrp'];?></del> <?php } ?></p>
                                    <div class="ps-product__content"><a class="ps-product__title" href="#"><?php echo $product['name'];?></a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>01</span>
                                        </div>
                                        <div class="ps-product__progress-bar ps-progress" data-value="10">
                                            <div class="ps-progress__value"><span></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php }?>
                    </div>

                </div>
            </div>
        </div>

        <div class="ps-home-ads">
            <div class="ps-container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="<?php echo PUBLIC_PATH;?>/img/collection/1.jpg" alt=""></a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="<?php echo PUBLIC_PATH;?>/img/collection/2.jpg" alt=""></a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="<?php echo PUBLIC_PATH;?>/img/collection/3.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-top-categories">
            <div class="ps-container">
                <h3>Top categories of the month</h3>
                <div class="row">
                    <?php
                    $categories=mysqli_query($con,"select * from category") ;
                    foreach ($categories as $category) {  ?>

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 ">
                            <div class="ps-block--category">
                                <a class="ps-block__overlay" href="<?php echo PATH;?>/customer/categories.php/?id=<?php echo $category['id']  ; ?>"></a>
                                <?php  if(!empty($category['picture'] )){?>
                                    <img src="<?php echo PUBLIC_PATH;?>/img/seller/category/<?php echo $category['picture'];?>" alt="">

                                <?php }else {?>
                                    <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                <?php }?>
                                <p><?php echo ucfirst($category['name'])  ; ?></p>
                            </div>
                        </div>

                    <?php }?>
                </div>


            </div>
        </div>
        <?php
        $categories=mysqli_query($con,"select * from category") ;
        foreach ($categories as $category) {  ?>
            <div class="ps-product-list ps-clothings">
                <div class="ps-container">
                    <div class="ps-section__header">
                        <h3><?php echo strtoupper($category['name'])  ; ?></h3>
                    </div>
                    <div class="ps-section__content">
                        <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                            <?php
                            $subcatproducts = mysqli_query($con, "select * from   products where products.category_id='$category[id]'");
                            foreach ($subcatproducts as $subcatproduct){
                                $res= mysqli_query($con,"select * from suppliers where id='$subcatproduct[supplier_id]'") ;
                                $supplier= mysqli_fetch_assoc($res);
                                ?>

                                <div class="ps-product">
                                    <div class="ps-product__thumbnail">

                                        <a href="<?php echo PATH;?>/customer/product-details.php/?id=<?php echo $subcatproduct['id']  ; ?>">
                                            <?php  if(!empty($subcatproduct['featured_image'] )){?>
                                                <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $subcatproduct['featured_image'];?>" alt="">
                                            <?php }else {?>
                                                <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                            <?php }?>
                                        </a>
                                        <?php  if(!empty($subcatproduct['discount'] )){?>  <div class="ps-product__badge"><?php echo $subcatproduct['discount'];?></div> <?php }?>
                                        <ul class="ps-product__actions">
                                            <li><a href="<?php echo PATH;?>/customer/product-details.php/?id=<?php echo $subcatproduct['id']; ?>" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                            <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target= "modal.php/?id=<?php echo $subcatproduct['id']  ; ?>/#product-quickview"><i class="icon-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                        </ul>
                                    </div>

                                    <div class="ps-product__container"><a class="ps-product__vendor" href="<?php echo PATH;?>/customer/vendor-store.php/?id=<?php echo $supplier['id']  ; ?>"><?php echo $supplier['company_name']?></a>
                                        <div class="ps-product__content"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php/?id=<?php echo $subcatproduct['id']  ; ?>"><?php echo $subcatproduct['name'];?></a>
                                            <div class="ps-product__rating">
                                                <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select><span>01 Comment</span>
                                            </div>
                                            <p class="ps-product__price">Rs. <?php echo $subcatproduct['unit_price'];?> <?php if(!empty($subcatproduct['msrp'])){ ?>  <del>Rs. <?php echo $subcatproduct['msrp'];?></del> <?php } ?></p>
                                        </div>
                                        <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php/?id=<?php echo $subcatproduct['id']  ; ?>"><?php echo $subcatproduct['name'];?></a>
                                            <p class="ps-product__price">Rs. <?php echo $subcatproduct['unit_price'];?> <?php if(!empty($subcatproduct['msrp'])){ ?>  <del>Rs. <?php echo $subcatproduct['msrp'];?></del> <?php } ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>

        <div class="ps-home-ads">
            <div class="ps-container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="<?php echo PUBLIC_PATH;?>/img/collection/ad-1.jpg" alt=""></a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "><a class="ps-collection" href="#"><img src="<?php echo PUBLIC_PATH;?>/img/collection/ad-2.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-product-list ps-new-arrivals">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>Hot New Arrivals</h3>
                    <ul class="ps-section__links">
                        <?php
                        $categories=mysqli_query($con,"select * from category") ;
                        foreach ($categories as $category) {  ?>
                            <li><a href="<?php echo PATH;?>/customer/categories.php/?id=<?php echo $category['id']  ; ?>"><?php echo ucfirst( $category['name']);?></a></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        <?php
                        $products=mysqli_query($con,"select * from products") ;
                        foreach ($products as $product) {  ?>
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                                <div class="ps-product--horizontal">
                                    <div class="ps-product__thumbnail">
                                        <a href="<?php echo PATH;?>/customer/product-details.php/?id=<?php echo $product['id']  ; ?>">
                                            <?php  if(!empty($product['featured_image'] )){?>
                                                <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $product['featured_image'];?>" alt="">
                                            <?php }else {?>
                                                <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                            <?php }?>
                                        </a>
                                    </div>
                                    <div class="ps-product__content"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php/?id=<?php echo $product['id']  ; ?>"><?php echo ucfirst( $product['name']);?></a>
                                        <p class="ps-product__price">Rs. <?php echo $product['unit_price'];?> <?php if(!empty($product['msrp'])){ ?>  <del>Rs. <?php echo $product['msrp'];?></del> <?php } ?></p>
                                    </div>
                                </div>
                            </div>

                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php");?>