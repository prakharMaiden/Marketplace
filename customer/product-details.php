<?php
include_once("./../config/config.php");
include("includes/header.php");
$id = $_GET['id'];
$result=mysqli_query($con,"select * from products where id='$id'") ;
$productName= mysqli_fetch_assoc($result);

$result=mysqli_query($con,"select * from subcategory where id='$productName[subcategory_id]'") ;
$subcategoryName= mysqli_fetch_assoc($result);

$result=mysqli_query($con,"select * from category where id='$productName[category_id]'") ;
$categoryName= mysqli_fetch_assoc($result);

$res= mysqli_query($con,"select * from suppliers where id='$productName[supplier_id]'") ;
$supplier= mysqli_fetch_assoc($res);

$stmt = mysqli_query($con,"select * from wishlist where product_id='$productName[id]' and customer_id='$_SESSION[customer_id]'") ;
$wishlist= mysqli_fetch_assoc($stmt);
?>
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="<?php echo PATH;?>/customer/index.php">Home</a></li>
                <li><a href="<?php echo PATH;?>/customer/categories.php?id=<?php echo $categoryName['id'] ?>"><?php echo strtolower($categoryName['name']) ?></a></li>
                <li><a href="<?php echo PATH;?>/customer/subcategories.php?id=<?php echo $subcategoryName['id'] ?>"><?php echo strtolower($subcategoryName['name']) ?></a></li>
                <li><?php echo strtolower($productName['name']) ?></li>
            </ul>
        </div>
    </div>
    <div class="ps-page--product">
        <div class="ps-container">
            <div class="alert" id="alert" style="display:none">
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                <span class="message"></span>
            </div>
            <div class="ps-page__container">
                <div class="ps-page__left">
                    <div class="ps-product--detail ps-product--fullwidth">
                        <div class="ps-product__header">
                            <div class="ps-product__thumbnail" data-vertical="true">
                                <figure>
                                    <div class="ps-wrapper">
                                        <div class="ps-product__gallery" data-arrow="true">
                                            <div class="item">
                                                <?php  if(!empty($productName['featured_image'] )){?>
                                                    <a href="<?php echo PUBLIC_PATH; ?>/img/seller/products/<?php echo $productName['featured_image'];?>">
                                                        <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $productName['featured_image'];?>" alt="">
                                                    </a>
                                                <?php }else {?>
                                                    <a href="<?php echo PUBLIC_PATH;?>/img/noimage.jpg">
                                                        <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                                    </a>
                                                <?php }?>
                                            </div>
                                            <?php  foreach (explode(",",$productName['images']) as $image){ ?>
                                                <div class="item">
                                                    <?php  if(!empty($image)){?>
                                                        <a href="<?php echo PUBLIC_PATH; ?>/img/seller/products/<?php echo $image;?>">
                                                            <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $image;?>" alt="">
                                                        </a>
                                                    <?php }else {?>
                                                        <a href="<?php echo PUBLIC_PATH;?>/img/noimage.jpg">
                                                            <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                                        </a>
                                                    <?php }?>
                                                </div>
                                            <?php }?>

                                        </div>
                                    </div>
                                </figure>
                                <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">

                                    <?php  //print_r((explode(",",$productName['images'])));die;
                                    foreach (explode(",",$productName['images']) as $image){ ?>
                                        <div class="item">
                                            <?php  if(!empty($image)){?>
                                                <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $image;?>" alt="">
                                            <?php }else {?>
                                                <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt="">
                                            <?php }?>
                                        </div>
                                    <?php }?> </div>
                            </div>
                            <div class="ps-product__info">
                                <h1><?php echo ucfirst($productName['name']) ?></h1>
                                <div class="ps-product__meta">
                                    <p>Category:<a href="<?php echo PATH;?>/customer/subcategories.php?id=<?php echo $subcategoryName['id'] ?>"><?php echo ucfirst($subcategoryName['name']) ?></a></p>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>(1 review)</span>
                                    </div>
                                </div>
                                <h4 class="ps-product__price">Rs. <?php echo number_format($productName['unit_price'], 2);?> <?php if(!empty($productName['msrp'])){ ?>  <del>Rs. <?php echo number_format($productName['msrp'], 2);?></del> <?php } ?></h4>
                                <div class="ps-product__desc">
                                    <p>Sold By:<a href="<?php echo PATH;?>/customer/vendor-store.php?id=<?php echo $supplier['id']  ; ?>"><strong><?php echo $supplier['company_name']?></strong></a></p>
                                    <p class="ps-list--dot">
                                        <?php echo ucfirst($productName['description']) ?>
                                    </p>
                                </div>
                                <div class="ps-product__variations">
                                    <figure>
                                        <figcaption>Color</figcaption>
                                        <div class="ps-variant ps-variant--color color--1"><span class="ps-variant__tooltip">Black</span></div>
                                        <div class="ps-variant ps-variant--color color--2"><span class="ps-variant__tooltip"> Gray</span></div>
                                    </figure>
                                </div>
                                <div class="ps-product__shopping">
                                    <form id="cartForm" method="post">
                                        <div class="form-group--number">
                                            <button  type="button" class="up" id="add"><i class="fa fa-plus"></i></button>
                                            <button  type="button" class="down" id="minus"><i class="fa fa-minus"></i></button>
                                            <input class="form-control" name="quantity" id="quantity" type="text" value="1">
                                            <input type="hidden" value="<?php echo $productName['id']; ?>" name="id">
                                        </div>
                                        <button type="submit" class="ps-btn ps-btn--black">Add to cart</button>

                                    </form>

                                    <a class="ps-btn" href="#">Buy Now</a>



                                                <?php if(isset($wishlist)){?>
                                                    <div class="ps-product__actions"><a href="#">
                                                            <i class="icon-heart" style="color: #fcb800;font-weight: bold" title="already in wishlist"></i></a></div>
<?php }else {?>
                                    <div class="ps-product__actions">
                                        <form id="wishlistForm" method="post">
                                            <div class="form-group--number">
                                                <input type="hidden" value="<?php echo $productName['id']; ?>" name="id">
                                            </div>
                                            <button  type="submit" class="btn btn-link" style="text-decoration: none;">
                                                    <i class="icon-heart" style="font-size: 35px;text-decoration: none; color: #999"></i>
                                            </button>

                                        </form>
                                    </div>
<?php }?>



                                </div>
                                <div class="ps-product__specification">
                                    <p><strong>SKU:</strong> <?php echo $productName['sku'] ?></p>
                                    <p class="categories"><strong> Categories:</strong>
                                        <a href="<?php echo PATH;?>/customer/categories.php?id=<?php echo $categoryName['id'] ?>"><?php echo ucfirst($categoryName['name']) ?></a>,<a href="<?php echo PATH;?>/customer/subcategories.php?id=<?php echo $subcategoryName['id'] ?>"> <?php echo ucfirst($subcategoryName['name']) ?></a></p>

                                    <!--<p class="tags"><strong> Tags</strong><a href="#">sofa</a>,<a href="#">technologies</a>,<a href="#">wireless</a></p>
                              -->  </div>
                                <div class="ps-product__sharing"><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-page__right">
                    <aside class="widget widget_product widget_features">
                        <p><i class="icon-network"></i> Shipping worldwide</p>
                        <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>
                        <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>
                        <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>
                    </aside>
                    <aside class="widget widget_sell-on-site">
                        <p><i class="icon-store"></i> Sell on Krishna Golds Industries?<a href="<?php echo PATH;?>/seller/auth/signup.php"> Register Now !</a></p>
                    </aside>
                    <aside class="widget widget_same-brand">
                        <h3>Same Brand</h3>
                        <div class="widget__content">
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="#"> <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt=""></a>
                                    <div class="ps-product__badge">-37%</div>
                                </div>
                            </div>
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="#"> <img src="<?php echo PUBLIC_PATH;?>/img/noimage.jpg" alt=""></a>
                                    <div class="ps-product__badge">-5%</div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="ps-section--default">
                <div class="ps-section__header">
                    <h3>Related products</h3>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">


                        <?php
                        $subcatproducts = mysqli_query($con, "select * from   products where products.supplier_id='$supplier[id]'");
                        foreach ($subcatproducts as $subcatproduct){ ?>
                            <div class="ps-product">
                                <div class="ps-product__thumbnail">
                                    <?php  if(!empty($subcatproduct['featured_image'] )){?>
                                        <a href="#">
                                            <img src="<?php echo PUBLIC_PATH;?>/img/seller/products/<?php echo $subcatproduct['featured_image'];?>" alt="">
                                        </a>
                                    <?php }else {?>
                                        <a href="#">
                                            <img src="<?php echo PUBLIC_PATH;?>/img/products/shop/1.jpg" alt="">
                                        </a>
                                    <?php }?>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor"  href="<?php echo PATH;?>/customer/vendor-store.php?id=<?php echo $supplier['id']  ; ?>"><?php echo $supplier['company_name']?></a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $subcatproduct['id']  ; ?>"><?php echo $subcatproduct['name'];?></a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>01</span>
                                        </div>
                                        <p class="ps-product__price">Rs. <?php echo number_format($subcatproduct['unit_price'], 2);?> <?php if(!empty($subcatproduct['msrp'])){ ?>  <del>Rs. <?php echo number_format($subcatproduct['msrp'], 2);?></del> <?php } ?></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo PATH;?>/customer/product-details.php?id=<?php echo $subcatproduct['id']  ; ?>"><?php echo $subcatproduct['name'];?></a>
                                        <p class="ps-product__price">Rs. <?php echo number_format($subcatproduct['unit_price'], 2);?> <?php if(!empty($subcatproduct['msrp'])){ ?>  <del>Rs. <?php echo number_format($subcatproduct['msrp'], 2);?></del> <?php } ?></p>
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