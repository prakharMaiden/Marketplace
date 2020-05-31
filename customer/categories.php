<?php
include_once("./../config/config.php");
include("includes/header.php");
$id = $_GET['id'];
$result=mysqli_query($con,"select * from category where id='$id'") ;
$categoryName= mysqli_fetch_assoc($result);
?>
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><?php echo ucfirst($categoryName['name'])?></li>
            </ul>
        </div>
    </div>
    <div class="ps-page--shop" id="shop-categories">
        <div class="container">
            <div class="ps-catalog-top">
                <div class="row">
                    <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--menu-categories" data-mh="catalog-top">
                            <div class="ps-block__header">
                                <h3>Categories</h3>
                            </div>
                            <div class="ps-block__content">
                                <ul class="ps-list--menu-cateogories">
                                    <?php
                                    $categories=mysqli_query($con,"select * from category") ;
                                    foreach ($categories as $category) {  ?>
                                        <li <?php  if($category['child'] != 0){ ?> class="menu-item-has-children" <?php }?>>
                                            <a  href="categories.php/?id=<?php echo $category['id']  ; ?>"><?php echo strtoupper($category['name'])?></a>
                                            <?php  if($category['child'] != 0){?>
                                                <ul class="sub-menu">
                                                    <?php
                                                    $subcategories=mysqli_query($con,"select * from subcategory where category_id='$category[id]'") ;
                                                    foreach ($subcategories as $subcategory) {  ?>
                                                        <li><a href="<?php echo PATH;?>/customer/subcategories.php/?id=<?php echo $subcategory['id']  ; ?>"><?php echo ucfirst($subcategory['name'])  ; ?></a></li>
                                                    <?php }?>
                                                </ul>
                                            <?php }?>
                                        </li>

                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--categories-grid" data-mh="catalog-top">

                            <?php
                            $categories=mysqli_query($con,"select * from category") ;
                            foreach ($categories as $category) {  ?>
                                <div class="ps-block--category-2" data-mh="categories">
                                    <div class="ps-block__thumbnail">
                                        <?php  if(!empty($category['picture'] )){?>
                                            <img src="<?php echo PUBLIC_PATH;?>/img/seller/category/<?php echo $category['picture'];?>" alt="">

                                        <?php }else {?>
                                            <img src="<?php echo PUBLIC_PATH;?>/img/categories/shop/1.jpg" alt="">
                                        <?php }?>
                                    </div>
                                    <div class="ps-block__content">
                                        <h4><?php echo ucfirst($category['name'])  ; ?></h4>
                                        <?php  if($category['child'] != 0){?>
                                            <ul>
                                                <?php
                                                $subcategories=mysqli_query($con,"select * from subcategory where category_id='$category[id]' limit 5") ;
                                                foreach ($subcategories as $subcategory) {  ?>
                                                    <li><a href="<?php echo PATH;?>/customer/subcategories.php/?id=<?php echo $subcategory['id']  ; ?>"><?php echo ucfirst($subcategory['name'])  ; ?></a></li>
                                                <?php }?>

                                            </ul>
                                        <?php }?>
                                    </div>
                                </div>
                            <?php }?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-block--categories-box">
                <div class="ps-block__header">
                    <h3><?php echo ucfirst($categoryName['name'])?></h3>
                </div>

                <div class="ps-block__content">
                    <?php

                    $subcategories=mysqli_query($con,"select * from subcategory where category_id='$categoryName[id]'") ;
                    foreach ($subcategories as $subcategoryName) {
                        ?>
                        <div class="ps-block__item">
                            <a class="ps-block__overlay" href="#"></a>
                            <?php  if(!empty($category['picture'] )){?>
                                <img src="<?php echo PUBLIC_PATH;?>/img/seller/subcategory/<?php echo $subcategoryName['picture'];?>" alt="">

                            <?php }else {?>
                                <img src="<?php echo PUBLIC_PATH;?>/img/categories/electronic/1.jpg" alt="">
                            <?php }?>
                            <p> <?php echo ucfirst($subcategoryName['name'])?> </p>
                            <?php $products = mysqli_query($con,"select COUNT(*) from products where subcategory_id='$subcategoryName[id]'") ;?>
                            <span><?php print_r(count($products));die;echo ($products)?> Items</span>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php");?>