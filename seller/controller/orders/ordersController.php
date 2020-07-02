<?php

require_once("./../../config/config.php");

class ordersController {

    //Create a new instance.
    function __construct() {
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
        $this->db=$con;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // Function for listing
    public function listing() {
        $result = mysqli_query($this->db,"select orders.transaction_status as transaction_status,order_details.price as price,orders.order_number as order_number,orders.id as order_id,products.name as product_name,products.id as product_id,order_details.color as color,order_details.size as size,orders.order_date as order_date,orders.shipment_date as shipment_date from orders left join order_details on orders.id = order_details.order_id left join products on order_details.product_id = products.id where products.supplier_id='$_SESSION[supplier_id]' order by orders.id desc") ;
        return $result;
    }

    // Function for orderShow
    public function order($id){
        $result=mysqli_query($this->db,"select orders.* from orders left join order_details on orders.id = order_details.order_id left join products on order_details.product_id = products.id where (products.supplier_id='$_SESSION[supplier_id]') and (orders.id='$id')") ;
        $order= mysqli_fetch_assoc($result);
        //echo'<pre>';print_r($order);die;
        return $order;

    }
}
?>