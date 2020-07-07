<?php

include_once("./../controller/orders/ordersController.php");
if(empty($_SESSION['supplier_id'])){
    header("location:../auth/login.php");
}
$id = $_GET['id'];
$ordersController=new ordersController();
$order=$ordersController->order($id);
$res=mysqli_query($con,"select customer_detail.*,customers.id as custom_id,customers.email as email,customers.mobile as mobile from customers LEFT JOIN customer_detail ON customers.id =customer_detail.customer_id  where customers.id='$order[customer_id]'") ;
$customerDetail= mysqli_fetch_assoc($res);
$res=mysqli_query($con,"select * from payment where id='$order[payment_id]'") ;
$payment= mysqli_fetch_assoc($res);

$res=mysqli_query($con,"select * from order_details where order_id='$order[id]'") ;
$orderDetail= mysqli_fetch_assoc($res);
$result=mysqli_query($con,"select *,products.name AS prodname, subcategory.id AS subcategory_id, subcategory.name AS subcategory_name from products LEFT JOIN suppliers ON products.supplier_id =suppliers.id LEFT JOIN subcategory ON products.subcategory_id =subcategory.id  where products.id='$orderDetail[product_id]'") ;
$product= mysqli_fetch_assoc($result);
$image = (!empty($product['featured_image'])) ? 'img/seller/products/'.$product['featured_image'] : 'img/noimage.jpg';

include("../includes/header.php");
?>
    <link rel="stylesheet" type="text/css" href="<?php echo PUBLIC_PATH;?>/style.css" class="">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div id="page-wrap">

                            <div id="header">Order (<?php echo $order['order_number'] ?>)</div>

                            <div id="identity">

                                <div id="address">
                                    <b><?php echo ucfirst($customerDetail['first_name'].' '.$customerDetail['last_name']); ?></b><br/>
                                    <b>Phone: </b><?php echo ($customerDetail['mobile']);?><br/>
                                        <b>Email: </b><?php echo ($customerDetail['email']);?><br/>
                                    <?php if(!empty($customerDetail['shipping_address1']) && !empty($customerDetail['shipping_address2']) && !empty($customerDetail['shipping_city']) && !empty($customerDetail['shipping_region'])){?>
                                        <?php echo ucfirst($customerDetail['shipping_address1']); ?><br/>
                                        <?php echo ucfirst($customerDetail['shipping_address2']); ?><br/>
                                        <?php echo ucfirst($customerDetail['shipping_city'].','.$customerDetail['shipping_region']); ?><br/>
                                        <?php echo ucfirst($customerDetail['shipping_country'].','.$customerDetail['shipping_postal_code']); ?>
                                    <?php }else{?>
                                        <?php echo ucfirst($customerDetail['address1']); ?><br/>
                                        <?php echo ucfirst($customerDetail['address2']); ?><br/>
                                        <?php echo ucfirst($customerDetail['city'].','.$customerDetail['state']); ?><br/>
                                        <?php echo ucfirst($customerDetail['country'].','.$customerDetail['postal_code']); ?>
                                    <?php }?>
                                </div>

                                <div id="logo">
                                    <h3>Krishna Gold Industries</h3>
                                </div>

                            </div>

                            <div style="clear:both"></div>

                            <div id="customer">

                                <table id="meta">
                                    <tr>
                                        <td class="meta-head">Order #</td>
                                        <td><div><?php echo $order['order_number'] ?></div></td>
                                    </tr>
                                    <tr>

                                        <td class="meta-head">Order Date</td>
                                        <td><div id="date"><?php echo date('M d, Y', strtotime($order['order_date']));?></div></td>
                                    </tr>
                                    <tr>
                                        <td class="meta-head">Amount</td>
                                        <td><div class="due">₹ &nbsp;<?php echo number_format($orderDetail['total'],2);?></div></td>
                                    </tr>

                                </table>

                            </div>

                            <table id="items">

                                <tr>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Unit Cost</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Price</th>
                                </tr>

                                <tr class="item-row">
                                    <td class="item-name"><div class="delete-wpr"><div><?php echo ucfirst($product['prodname']);?></div></div></td>
                                    <td class="item-name"><div><?php echo ucfirst($product['subcategory_name']);?></div></td>
                                    <td><div class="cost">₹ &nbsp;<?php echo number_format($orderDetail['price'],2);?></div></td>
                                    <td><div class="qty"><?php echo ($orderDetail['quantity']);?></div></td>
                                    <td><div class="qty"><?php if(isset($orderDetail['discount'])) {  echo $orderDetail['discount'].'%'; }else{ echo'-';};?></div></td>
                                    <td><div class="qty"><?php if(isset($orderDetail['size'])) {  echo ucfirst($orderDetail['size']); }else{ echo'-';};?></div></td>
                                    <td><div class="qty"><?php if(isset($orderDetail['color'])) {  echo ucfirst($orderDetail['color']); }else{ echo'-';};?></div></td>
                                    <td><span class="price">₹ &nbsp;<?php echo number_format($orderDetail['total'],2);?></span></td>
                                </tr>

                                <tr>
                                    <td colspan="5" class="blank"> </td>
                                    <td colspan="2" class="total-line">Subtotal</td>
                                    <td class="total-value"><div id="subtotal">₹ &nbsp;<?php echo number_format($orderDetail['price'],2);?> x <?php echo ($orderDetail['quantity']);?></div></td>
                                </tr>
                                <tr>

                                    <td colspan="5" class="blank"> </td>
                                    <td colspan="2" class="total-line">Total</td>
                                    <td class="total-value"><div id="total">₹ &nbsp;<?php echo number_format($orderDetail['total'],2);?></div></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="blank"> </td>
                                    <td colspan="2" class="total-line">Amount Paid</td>

                                    <td class="total-value"><div id="paid">₹ &nbsp;<?php echo number_format($orderDetail['total'],2);?></div></td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php include("../includes/footer.php");?>