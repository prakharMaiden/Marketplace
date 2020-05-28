<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Krishna Golds Industries</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH?>/css/style.css">
</head>
<body>
<header class="header header--1" data-sticky="true">
    <div class="header__top">
        <div class="ps-container">
            <div class="header__left">
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i><span> Shop by Department</span></div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            <?php
                            $categories=mysqli_query($con,"select * from category") ;
                            foreach ($categories as $category) {  ?>
                                <li <?php  if($category['child'] != 0){ ?>class="menu-item-has-children has-mega-menu" <?php }?>>

                                    <a href="<?php  echo $category['id'];?>"><i class="<?php echo $category['icon']  ; ?>"></i> <?php echo ucfirst($category['name'])  ; ?></a>
                                    <?php  if($category['child'] != 0){ ?>
                                        <div class="mega-menu">
                                            <div class="mega-menu__column">
                                                <h4><?php echo ucfirst($category['name'])  ; ?><span class="sub-toggle"></span></h4>
                                                <ul class="mega-menu__list">
                                                    <?php
                                                    $subcategories=mysqli_query($con,"select * from subcategory where category_id='$category[id]'") ;
                                                    foreach ($subcategories as $subcategory) {  ?>
                                                        <li><a href="#"><?php echo ucfirst($subcategory['name'])  ; ?></a></li>
                                                    <?php }?>
                                                </ul>
                                            </div>

                                        </div>
                                    <?php }?>
                                </li>
                            <?php  }  ?>

                        </ul>
                    </div>
                </div><a class="ps-logo" href="<?php echo PATH;?>/index.php"><h3>Krishna Golds Industries</h3></a>
            </div>
            <div class="header__center">
                <form class="ps-form--quick-search" action="" method="Post">
                    <div class="form-group--icon"><i class="icon-chevron-down"></i>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="all" selected="selected">All</option>
                            <?php
                            $categories=mysqli_query($con,"select * from category") ;
                            foreach ($categories as $category) {  ?>
                                <option value="<?php  echo $category['id'];?>" ><?php echo $category['name']  ; ?></option>
                            <?php  }  ?>
                        </select>
                    </div>
                    <input class="form-control" type="text" placeholder="I'm shopping for...">
                    <button>Search</button>
                </form>
            </div>
            <div class="header__right">
                <div class="header__actions"><a class="header__extra" href="#"><i class="icon-chart-bars"></i><span><i>0</i></span></a><a class="header__extra" href="#"><i class="icon-heart"></i><span><i>0</i></span></a>
                    <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>0</i></span></a>

                    </div>
                    <div class="ps-block--user-header">
                        <div class="ps-block__left"><i class="icon-user"></i></div>
                        <div class="ps-block__right"><a href="<?php echo PATH?>/customer/login/login.php">Login</a><a href="<?php echo PATH?>/customer/login/login.php">Register</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="ps-container">
            <div class="navigation__left">
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i><span> Shop by Department</span></div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            <?php
                            $categories=mysqli_query($con,"select * from category") ;
                            foreach ($categories as $category) {  ?>
                                <li <?php  if($category['child'] != 0){ ?>class="menu-item-has-children has-mega-menu" <?php }?>>

                                    <a href="<?php  echo $category['id'];?>"><i class="<?php echo $category['icon']  ; ?>"></i> <?php echo ucfirst($category['name'])  ; ?></a>
                                    <?php  if($category['child'] != 0){ ?>
                                        <div class="mega-menu">
                                            <div class="mega-menu__column">
                                                <h4><?php echo ucfirst($category['name'])  ; ?><span class="sub-toggle"></span></h4>
                                                <ul class="mega-menu__list">
                                                    <?php
                                                    $subcategories=mysqli_query($con,"select * from subcategory where category_id='$category[id]'") ;
                                                    foreach ($subcategories as $subcategory) {  ?>
                                                        <li><a href="#"><?php echo ucfirst($subcategory['name'])  ; ?></a></li>
                                                    <?php }?>
                                                </ul>
                                            </div>

                                        </div>
                                    <?php }?>
                                </li>
                            <?php  }  ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation__right">
                <ul class="menu">
                    <li class="current-menu-item menu-item-has-children" style="visibility: hidden">
                        <a href="../index.php">Home</a><span class="sub-toggle"></span>
                    </li>
                </ul>
                <ul class="navigation__extra">
                    <li><a href="#">Sell on Krishna Golds Industries</a></li>
                    <li><a href="#">Track your order</a></li>

                </ul>
            </div>
        </div>
    </nav>
</header>
<header class="header header--mobile" data-sticky="true">
    <div class="header__top">
        <div class="header__left">
        </div>
        <div class="header__right">
            <ul class="navigation__extra">
                <li><a href="#">Sell on Krishna Golds Industries</a></li>
                <li><a href="#">Track your order</a></li>
            </ul>
        </div>
    </div>
    <div class="navigation--mobile">
        <div class="navigation__left"><a class="ps-logo" href="#"><h3>Krishna <span style="color:#fcb800;font-weight: 700">Golds Industries</span></h3></a></div>
        <div class="navigation__right">
            <div class="header__actions">
                <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>0</i></span></a>

                </div>
                <div class="ps-block--user-header">
                    <div class="ps-block__left"><i class="icon-user"></i></div>
                    <div class="ps-block__right"><a href="<?php echo PATH?>/customer/login/login.php">Login</a><a href="<?php echo PATH?>/customer/login/login.php">Register</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-search--mobile">
        <form class="ps-form--search-mobile" action="" method="Post">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
</header>
<div class="ps-panel--sidebar" id="cart-mobile">
    <div class="ps-panel__header">
        <h3>Shopping Cart</h3>
    </div>
</div>
<div class="ps-panel--sidebar" id="navigation-mobile">
    <div class="ps-panel__header">
        <h3>Categories</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
            <?php
            $categories=mysqli_query($con,"select * from category") ;
            foreach ($categories as $category) {  ?>
                <li <?php  if($category['child'] != 0){ ?>class="menu-item-has-children has-mega-menu" <?php }?>>

                    <a href="<?php  echo $category['id'];?>"><i class="<?php echo $category['icon']  ; ?>"></i> <?php echo ucfirst($category['name'])  ; ?></a>
                    <?php  if($category['child'] != 0){ ?>
                        <div class="mega-menu">
                            <div class="mega-menu__column">
                                <h4><?php echo ucfirst($category['name'])  ; ?><span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                                    <?php
                                    $subcategories=mysqli_query($con,"select * from subcategory where category_id='$category[id]'") ;
                                    foreach ($subcategories as $subcategory) {  ?>
                                        <li><a href="#"><?php echo ucfirst($subcategory['name'])  ; ?></a></li>
                                    <?php }?>
                                </ul>
                            </div>

                        </div>
                    <?php }?>
                </li>
            <?php  }  ?>
        </ul>
    </div>
</div>
<div class="navigation--list">
    <div class="navigation__content"><a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu"></i><span> Menu</span></a><a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><i class="icon-list4"></i><span> Categories</span></a><a class="navigation__item ps-toggle--sidebar" href="#search-sidebar"><i class="icon-magnifier"></i><span> Search</span></a><a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-bag2"></i><span> Cart</span></a></div>
</div>
<div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header">
        <form class="ps-form--search-mobile" action="" method="POST">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
    <div class="navigation__content"></div>
</div>