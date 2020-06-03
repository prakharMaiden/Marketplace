<?php
include_once("./../config/config.php");
include("includes/header.php");
?>
    <div class="ps-page--simple">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="<?php echo PATH;?>/customer/index.php">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
        <div class="ps-compare ps-section--shopping">
            <div class="container">
                <div class="ps-section__header">
                    <h1>Compare Product</h1>
                </div>
                <div class="ps-section__content">
                    <div class="table-responsive">
                        <table class="table ps-table--compare">
                            <tbody>
                            <tr>
                                <td class="heading" rowspan="2">Product</td>
                                <td><a href="#">Remove</a></td>
                                <td><a href="#">Remove</a></td>
                                <td><a href="#">Remove</a></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ps-product--compare">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/electronic/1.jpg" alt=""></a></div>
                                        <div class="ps-product__content"><a href="product-default.html">Marshall Kilburn Wireless Bluetooth Speaker, Black (A4819189)</a></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="ps-product--compare">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/electronic/3.jpg" alt=""></a></div>
                                        <div class="ps-product__content"><a href="product-default.html">Harman Kardon Onxy Studio 2.0 Wireless Bluetooth Speaker</a></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="ps-product--compare">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/electronic/8.jpg" alt=""></a></div>
                                        <div class="ps-product__content"><a href="product-default.html">ACHEER 25W Bluetooth Speaker (A320)</a></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="heading">Rating</td>
                                <td>
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="heading">Price</td>
                                <td>
                                    <h4 class="price sale">$235,35 <del>$299.99</del> <small>(-20%)</small></h4>
                                </td>
                                <td>
                                    <h4 class="price">$209.39</h4>
                                </td>
                                <td>
                                    <h4 class="price">$79.39</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="heading">Availability</td>
                                <td><span class="in-stock">In Stock</span></td>
                                <td><span class="in-stock">In Stock</span></td>
                                <td><span class="out-stock">Out of Stock</span></td>
                            </tr>
                            <tr>
                                <td class="heading">Shipping</td>
                                <td>Free Shipping</td>
                                <td>Free Shipping</td>
                                <td>Free Shipping</td>
                            </tr>
                            <tr>
                                <td class="heading">Sold By</td>
                                <td><a class="sold-by" href="#">DigitalWorld Us</a></td>
                                <td><a class="sold-by" href="#">Harman Kadon</a></td>
                                <td><a class="sold-by" href="#">Amazon</a></td>
                            </tr>
                            <tr>
                                <td class="heading">Connect Technology</td>
                                <td>Wireless & BlueTooth</td>
                                <td>Wireless & BlueTooth</td>
                                <td>BlueTooth</td>
                            </tr>
                            <tr>
                                <td class="heading">Item Dimensions</td>
                                <td>5.51x5.51x9.53 In</td>
                                <td>7.52 x 12.05 x 5.08 in</td>
                                <td>11.14 x 16.54 x 9.25 in</td>
                            </tr>
                            <tr>
                                <td class="heading">Item Weight</td>
                                <td>6.61 lbs</td>
                                <td>5.61 lbs</td>
                                <td>3.87 lbs</td>
                            </tr>
                            <tr>
                                <td class="heading">Power Source</td>
                                <td>AC Battery</td>
                                <td>--</td>
                                <td>Plug-in Electric</td>
                            </tr>
                            <tr>
                                <td class="heading"></td>
                                <td><a class="ps-btn" href="#">Add To Cart</a></td>
                                <td><a class="ps-btn" href="#">Add To Cart</a></td>
                                <td><a class="ps-btn" href="#">Add To Cart</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>