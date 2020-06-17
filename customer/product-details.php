<?php
include_once("./../config/config.php");
include("includes/header.php");

$id = $_GET['id'];
$result=mysqli_query($con,"select * from products where id='$id'") ;
$productName= mysqli_fetch_assoc($result);

$ret=mysqli_query($con,"select *,COUNT(*) As review_count,SUM(rating) AS sum_rating from reviews where product_id='$productName[id]'") ;
//print_r($ret);die;
$reviews= mysqli_fetch_assoc($ret);

$result=mysqli_query($con,"select * from subcategory where id='$productName[subcategory_id]'") ;
$subcategoryName= mysqli_fetch_assoc($result);

$result=mysqli_query($con,"select * from category where id='$productName[category_id]'") ;
$categoryName= mysqli_fetch_assoc($result);

$res= mysqli_query($con,"select * from suppliers where id='$productName[supplier_id]'") ;
$supplier= mysqli_fetch_assoc($res);

if(isset($_SESSION['customer_id'])){
    $stmt = mysqli_query($con,"select * from wishlist where product_id='$productName[id]' and customer_id='$_SESSION[customer_id]'") ;
    $wishlist= mysqli_fetch_assoc($stmt);
}

?>
    <style>
        .ps-product--detail .ps-product__desc ul {
            list-style-type: disc;
        }
        .ps-product--detail .ps-product__desc p a {
            text-transform: capitalize;
            font-weight: 600;
            color: #09c;
            font-size: 16px;
        }
    </style>
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
                                <?php if(isset($productName['product_available']) && $productName['product_available'] == 'no'){
                                    echo "<div class='ps-product__actions out-stock' style='width: 30%;'><p  style='padding: 10px 20px;background: #000;margin-right: 20px;color:#fff;'>Out Of Stock</p></div>";
                                } ?>
                                <div class="ps-product__meta">

                                    <br/><p>Sub-category: <a href="<?php echo PATH;?>/customer/subcategories.php?id=<?php echo $subcategoryName['id'] ?>"><?php echo ucfirst($subcategoryName['name']) ?></a></p>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="<?php echo $reviews['sum_rating']/$reviews['review_count'] ?>"><?php echo $reviews['sum_rating']/$reviews['review_count'] ?></option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span><?php echo $reviews['sum_rating']/$reviews['review_count'] ?> (<?php echo $reviews['review_count'] ?> review)</span>
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
                                    <?php
                                    if (isset($productName['size'])){ ?>
                                        <figure>
                                            <figcaption>Sizes</figcaption>


                                            <div class="">
                                                <?php echo $productName['size']; ?></div>


                                            <div class="">
                                                <select id="size" name="size" class="form-control col-md-4">
                                                    <option value="">Please select</option>
                                                    <?php


                                                    if (isset($productName['available_size'])) {
                                                        foreach (explode(",",$productName['available_size']) as $available_size){ ?>
                                                            <option value="<?php echo $available_size; ?>"><?php echo $available_size; ?></option>
                                                        <?php } }?>
                                                </select></div>


                                        </figure>
                                    <?php }?>

                                    <figure>
                                        <figcaption>Colors</figcaption>
                                        <?php
                                        if (isset($productName['color'])){ ?>
                                            <div class="ps-variant ps-variant--color" style="background-color: <?php echo $productName['color']; ?>">
                                                <span class="ps-variant__tooltip">Selected Color</span></div>
                                        <?php }?>
                                        <?php
                                        if (isset($productName['available_colors'])){
                                            foreach (explode(",",$productName['available_colors']) as $available_color){ ?>

                                                <div class="ps-variant ps-variant--color" style="background-color: <?php echo $available_color; ?>">
                                                    <span class="ps-variant__tooltip">Available Colors</span></div>
                                            <?php }
                                        }?>
                                    </figure>

                                </div>
                                <div class="ps-product__shopping">
                                    <?php if(isset($productName['product_available']) && $productName['product_available'] == 'yes'){?>
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
                                    <?php } ?>
                                    <?php if(isset($wishlist)){?>
                                        <div class="ps-product__actions">
                                            <i class="icon-heart" style="color: #fcb800;font-weight: bold;cursor: no-drop;font-size: 35px;" title="Already added in wishlist"></i></div>
                                    <?php }else { ?>
                                        <div class="ps-product__actions">
                                            <form id="wishlistForm" method="post">
                                                <div class="form-group--number">
                                                    <input type="hidden" value="<?php echo $productName['id']; ?>" name="id">
                                                </div>
                                                <button  type="submit" class="btn btn-link" style="text-decoration: none;">
                                                    <i class="icon-heart" title="Add to wishlist"  style="font-size: 35px;text-decoration: none; color: #999"></i>
                                                </button>

                                            </form>
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="ps-product__specification">
                                    <p><strong>SKU:</strong> <?php echo $productName['sku'] ?></p>
                                    <p class="categories"><strong> Categories:</strong>
                                        <a href="<?php echo PATH;?>/customer/categories.php?id=<?php echo $categoryName['id'] ?>"><?php echo ucfirst($categoryName['name']) ?></a>,<a href="<?php echo PATH;?>/customer/subcategories.php?id=<?php echo $subcategoryName['id'] ?>"> <?php echo ucfirst($subcategoryName['name']) ?></a></p>
                                </div>
                                <div class="ps-product__sharing"><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></div>
                            </div>
                        </div>
                        <div class="ps-product__content ps-tab-root">
                            <ul class="ps-tab-list">
                                <li class="active"><a href="#tab-1">Description</a></li>
                                <li><a href="#tab-2">Specification</a></li>
                                <li><a href="#tab-3">Vendor</a></li>
                                <li><a href="#tab-4">Reviews (<?php echo $reviews['review_count']; ?>)</a></li>
                                <li><a href="#tab-5">More Offers</a></li>
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab active" id="tab-1">
                                    <div class="ps-document">
                                        <?php echo $productName['description'] ?>
                                    </div>
                                </div>
                                <div class="ps-tab" id="tab-2">
                                    <div class="table-responsive">
                                        <table class="table table-bordered ps-table ps-table--specification">
                                            <tbody>
                                            <tr>
                                                <?php if(isset($productName['available_colors'])){?>
                                                <td colspan="2">Available Colors</td>
                                                <td><?php echo $productName['available_colors'] ?></td>
                                            </tr>
                                            <?php } if(isset($productName['available_size'])){?>
                                                <tr>
                                                    <td colspan="2">Available Size</td>
                                                    <td><?php echo $productName['available_size'] ?></td>
                                                </tr>
                                            <?php } if(isset($productName['unit_weight'])){?>
                                                <tr>
                                                    <td colspan="2">Weight</td>
                                                    <td><?php echo $productName['unit_weight'] ?></td>
                                                </tr>
                                            <?php }?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="ps-tab" id="tab-3">
                                    <h4><?php echo ucfirst($supplier['company_name']); ?></h4>
                                    <p><?php echo ucfirst($supplier['notes']); ?></p>
                                </div>
                                <div class="ps-tab" id="tab-4">
                                    <div class="row">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">
                                            <div class="ps-block--average-rating">
                                                <div class="ps-block__header">
                                                    <h3><?php echo $reviews['sum_rating']/$reviews['review_count'] ?></h3>
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span><?php echo $reviews['review_count']; ?> Review</span>
                                                </div>
                                                <?php
                                                 if($reviews['sum_rating']/$reviews['review_count'] == 5){?>
                                                <div class="ps-block__star"><span>5 Star</span>
                                                    <div class="ps-progress" data-value="100"><span></span></div><span></span>
                                                </div>
                                                <?php }      else if($reviews['sum_rating']/$reviews['review_count'] == 4){?>
                                                <div class="ps-block__star"><span>4 Star</span>
                                                    <div class="ps-progress" data-value="80"><span></span></div><span></span>
                                                </div>
                                                      <?php } elseif($reviews['sum_rating']/$reviews['review_count'] == 3){?>
                                                <div class="ps-block__star"><span>3 Star</span>
                                                    <div class="ps-progress" data-value="60"><span></span></div><span></span>
                                                </div>
                                                 <?php } elseif($reviews['sum_rating']/$reviews['review_count'] == 2){?>
                                                <div class="ps-block__star"><span>2 Star</span>
                                                    <div class="ps-progress" data-value="25"><span></span></div><span></span>
                                                </div>
                                                 <?php } else{?>
                                                <div class="ps-block__star"><span>1 Star</span>
                                                    <div class="ps-progress" data-value="0"><span></span></div><span></span>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                            <form class="ps-form--review" action="review_submit.php" method="post">
                                                <h4>Submit Your Review <small  style="text-transform: initial;">All fields are required <sup style="color: red;font-weight: bold">*</sup></small></h4>
                                                <p></p>
                                                <div class="form-group form-group__rating">
                                                    <label>Your rating of this product</label>
                                                    <select class="ps-rating" name="rating" id="rating"  data-read-only="false">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="6" name="review" id="review" placeholder="Write your review here"></textarea>
                                                </div>
                                                <input type="hidden" value="<?php echo $productName['id']; ?>" name="product_id">
                                                <input type="hidden" value="<?php echo $_SESSION['customer_id']; ?>" name="customer_id">

                                                <div class="form-group submit">
                                                    <button class="ps-btn" type="submit" name="submit" id="submit">Submit Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="ps-tab active" id="tab-5">
                                    <p>Sorry no more offers available</p>
                                </div>
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