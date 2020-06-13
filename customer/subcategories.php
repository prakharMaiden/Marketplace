<?php
include_once("./../config/config.php");
include("includes/header.php");
$id = $_GET['id'];
$result=mysqli_query($con,"select * from subcategory where id='$id'") ;
$subcategoryName= mysqli_fetch_assoc($result);
?>
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo PATH;?>/customer/index.php">Home</a></li>
                <li><?php echo ucfirst($subcategoryName['name'])?></li>
            </ul>
        </div>
    </div>
    <div class="ps-page--shop" id="shop-sidebar">
        <div class="container">
            <div class="ps-layout--shop">
                <div class="ps-layout__left">
                    <aside class="widget widget_shop">
                        <h4 class="widget-title">Categories</h4>
                        <ul class="ps-list--categories">
                            <?php
                            $categories=mysqli_query($con,"select * from category") ;
                            foreach ($categories as $category) {  ?>
                                <li class="current-menu-item <?php  if($category['child'] != 0){ ?> menu-item-has-children   <?php }?>">
                                    <a href="<?php echo PATH;?>/customer/categories.php?id=<?php echo $category['id']  ; ?>">
                                        <?php echo ucfirst($category['name'])  ; ?>
                                    </a>
                                    <?php  if($category['child'] != 0){ ?>
                                        <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                                        <ul class="sub-menu">
                                            <?php
                                            $subcategories=mysqli_query($con,"select * from subcategory where category_id='$category[id]'") ;
                                            foreach ($subcategories as $subcategory) {  ?>
                                                <li  class="current-menu-item "><a href="<?php echo PATH;?>/customer/subcategories.php?id=<?php echo $subcategory['id']  ; ?>"><?php echo ucfirst($subcategory['name'])  ; ?></a></li>
                                            <?php }?>


                                        </ul>
                                    <?php }?>
                                </li>
                            <?php }?>
                        </ul>
                    </aside>
                    <aside class="widget widget_shop">
                        <h4 class="widget-title">BY BRANDS</h4>
                        <form class="ps-form--widget-search" action="http://nouthemes.net/html/martfury/do_action" method="get">
                            <input class="form-control" type="text" placeholder="">
                            <button><i class="icon-magnifier"></i></button>
                        </form>
                        <figure class="ps-custom-scrollbar" data-height="250">
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-1" name="brand">
                                <label for="brand-1">Adidas (3)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-2" name="brand">
                                <label for="brand-2">Amcrest (1)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-3" name="brand">
                                <label for="brand-3">Apple (2)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-4" name="brand">
                                <label for="brand-4">Asus (19)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-5" name="brand">
                                <label for="brand-5">Baxtex (20)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-6" name="brand">
                                <label for="brand-6">Adidas (11)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-7" name="brand">
                                <label for="brand-7">Casio (9)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-8" name="brand">
                                <label for="brand-8">Electrolux (0)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-9" name="brand">
                                <label for="brand-9">Gallaxy (0)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-10" name="brand">
                                <label for="brand-10">Samsung (0)</label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="brand-11" name="brand">
                                <label for="brand-11">Sony (0)</label>
                            </div>
                        </figure>
                        <figure>
                            <h4 class="widget-title">By Price</h4>
                            <div class="ps-slider" data-default-min="13" data-default-max="1300" data-max="1311" data-step="100" data-unit="$"></div>
                            <p class="ps-slider__meta">Price:<span class="ps-slider__value ps-slider__min"></span>-<span class="ps-slider__value ps-slider__max"></span></p>
                        </figure>
                        <figure>
                            <h4 class="widget-title">By Price</h4>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-1" name="review">
                                <label for="review-1"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i></span><small>(13)</small></label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-2" name="review">
                                <label for="review-2"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i></span><small>(13)</small></label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-3" name="review">
                                <label for="review-3"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span><small>(5)</small></label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-4" name="review">
                                <label for="review-4"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span><small>(5)</small></label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-5" name="review">
                                <label for="review-5"><span><i class="fa fa-star rate"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span><small>(1)</small></label>
                            </div>
                        </figure>
                        <figure>
                            <h4 class="widget-title">By Color</h4>
                            <div class="ps-checkbox ps-checkbox--color color-1 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-1" name="size">
                                <label for="color-1"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-2 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-2" name="size">
                                <label for="color-2"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-3 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-3" name="size">
                                <label for="color-3"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-4 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-4" name="size">
                                <label for="color-4"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-5 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-5" name="size">
                                <label for="color-5"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-6 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-6" name="size">
                                <label for="color-6"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-7 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-7" name="size">
                                <label for="color-7"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-8 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-8" name="size">
                                <label for="color-8"></label>
                            </div>
                        </figure>
                        <figure class="sizes">
                            <h4 class="widget-title">BY SIZE</h4><a href="#">L</a><a href="#">M</a><a href="#">S</a><a href="#">XL</a>
                        </figure>
                    </aside>
                </div>
                <div class="ps-layout__right">
                    <div class="ps-page__header">
                        <h1><?php echo strtoupper($subcategoryName['name'])?></h1>
                        <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on"><a href="#"><img src="<?php echo PUBLIC_PATH;?>/img/slider/shop-sidebar/1.jpg" alt=""></a><a href="#"><img src="<?php echo PUBLIC_PATH;?>/img/slider/shop-sidebar/2.jpg" alt=""></a></div>
                    </div>
                    <div class="ps-block--shop-features">
                        <div class="ps-block__header">
                            <h3>Best Sale Items</h3>
                            <div class="ps-block__navigation"><a class="ps-carousel__prev" href="#bestsale"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#bestsale"><i class="icon-chevron-right"></i></a></div>
                        </div>
                        <div class="ps-block__content">
                            <div class="owl-slider" id="bestsale" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="2" data-owl-item-lg="3" data-owl-item-xl="4" data-owl-duration="1000" data-owl-mousedrag="on">
                                <?php
                                $products=mysqli_query($con,"select * from products where subcategory_id='$subcategoryName[id]' and discount != ''") ;
                                foreach ($products as $product) {
                                    $res= mysqli_query($con,"select * from suppliers where id='$product[supplier_id]'") ;
                                    $supplier= mysqli_fetch_assoc($res);
                                    ?>
                                    <div class="ps-product">
                                        <div class="ps-product__thumbnail">

                                            <a href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>">
                                                <?php  if(!empty($product['featured_image'] )){?>
                                                    <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $product['featured_image'];?>" alt="">

                                                <?php }else {?>
                                                    <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                                <?php }?>


                                            </a>
                                            <div class="ps-product__badge"><?php echo $product['discount'];?></div>

                                        </div>

                                        <div class="ps-product__container"><a class="ps-product__vendor" href="<?php echo PATH;?>/customer/vendor-store.php/?id=<?php echo $supplier['id']  ; ?>"><?php echo $supplier['company_name']?></a>
                                            <div class="ps-product__content"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $product['id']  ; ?>"><?php echo $product['name'];?></a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>01 Comment</span>
                                                </div>
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
                            <?php
                            $subCountProducts = mysqli_query($con, "select count(*) as Count,products.* from subcategory, products where products.subcategory_id='$subcategoryName[id]'   group by subcategory.name");
                            $subCountProduct= mysqli_fetch_assoc($subCountProducts);

                            ?>
                            <p><strong> <?php echo $subCountProduct['Count']?></strong> Products found</p>
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
                                <div class="ps-shopping-product">
                                    <div class="row">
                                        <?php
                                        $subcatproducts = mysqli_query($con, "select * from   products where products.subcategory_id='$subcategoryName[id]'");

                                        foreach ($subcatproducts as $subcatproduct){ ?>
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                                <div class="ps-product">
                                                    <div class="ps-product__thumbnail">

                                                        <a href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $subcatproduct['id']  ; ?>">
                                                            <?php  if(!empty($subcatproduct['featured_image'] )){?>
                                                                <img src="<?php echo PUBLIC_PATH;?>/img/seller/products//<?php echo $subcatproduct['featured_image'];?>" alt="">
                                                            <?php }else {?>
                                                                <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                                            <?php }?>
                                                        </a>
                                                        <div class="ps-product__badge"><?php echo $subcatproduct['discount'];?></div>
                                                          </div>

                                                    <div class="ps-product__container"><a class="ps-product__vendor" href="<?php echo PATH;?>/customer/vendor-store.php/?id=<?php echo $supplier['id']  ; ?>"><?php echo $supplier['company_name']?></a>
                                                        <div class="ps-product__content"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $subcatproduct['id']  ; ?>"><?php echo $subcatproduct['name'];?></a>
                                                            <div class="ps-product__rating">
                                                                <select class="ps-rating" data-read-only="true">
                                                                    <option value="1">1</option>
                                                                    <option value="1">2</option>
                                                                    <option value="1">3</option>
                                                                    <option value="1">4</option>
                                                                    <option value="2">5</option>
                                                                </select><span>01 Comment</span>
                                                            </div>
                                                            <p class="ps-product__price">Rs. <?php echo $subcatproduct['unit_price'];?></p>
                                                        </div>
                                                        <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $subcatproduct['id']  ; ?>"><?php echo $subcatproduct['name'];?></a>
                                                            <p class="ps-product__price">Rs. <?php echo $subcatproduct['unit_price'];?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="ps-tab" id="tab-2">
                                <div class="ps-shopping-product">
                                    <?php
                                    $subcatproducts = mysqli_query($con, "select * from   products where products.subcategory_id='$subcategoryName[id]'");

                                    foreach ($subcatproducts as $subcatproduct){ ?>
                                        <div class="ps-product ps-product--wide">
                                            <div class="ps-product__thumbnail">
                                                <a href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $subcatproduct['id']  ; ?>">
                                                    <?php  if(!empty($subcatproduct['featured_image'] )){?>
                                                        <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $subcatproduct['featured_image'];?>" alt="">
                                                    <?php }else {?>
                                                        <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                                    <?php }?>
                                                </a>
                                            </div>
                                            <div class="ps-product__container">
                                                <div class="ps-product__content"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $subcatproduct['id']  ; ?>"><?php echo $subcatproduct['name'];?></a>
                                                    <p class="ps-product__vendor">Sold by: <a href="<?php echo PATH;?>/customer/vendor-store.php/?id=<?php echo $supplier['id']  ; ?>"><?php echo $supplier['company_name']?></a></p>
                                                    <p class="ps-product__desc">
                                                        <?php echo $subcatproduct['description'];?>
                                                    </p>
                                                </div>
                                                <div class="ps-product__shopping">
                                                    <p class="ps-product__price"><?php echo $subcatproduct['unit_price'];?></p><a class="ps-btn" href="#">Add to cart</a>

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