<?PHP

require_once("./../config/config.php");

class profileController {

    //Create a new instance.
    function __construct() {
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
        $this->db=$con;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // Function for profileUpdate
    public function profileUpdate()
    {
        $result = mysqli_query($this->db,"select * from customers where (id='$_SESSION[customer_id]')");
        $customer = mysqli_fetch_assoc($result);

        $res=mysqli_query($this->db,"select * from customer_detail where customer_id='$_SESSION[customer_id]'") ;
        $customerData= mysqli_fetch_assoc($res);

        if(!empty($_REQUEST['mobile']))
            $phone = $_REQUEST['mobile'];
        else
            $phone = $customer['mobile'];

        if(!empty($_REQUEST['email']))
            $email = $_REQUEST['email'];
        else
            $email = $customer['email'];

        if(!empty($_REQUEST['first_name']))
            $first_name = $_REQUEST['first_name'];
        else
            $first_name = $customerData['first_name'];

        if(!empty($_REQUEST['last_name']))
            $last_name = $_REQUEST['last_name'];
        else
            $last_name = $customerData['last_name'];

        if(!empty($_REQUEST['address1']))
            $address1 = $_REQUEST['address1'];
        else
            $address1 = $customerData['address1'];

        if(!empty($_REQUEST['address2']))
            $address2 = $_REQUEST['address2'];
        else
            $address2 = $customerData['address2'];

        if(!empty($_REQUEST['city']))
            $city = $_REQUEST['city'];
        else
            $city = $customerData['city'];

        if(!empty($_REQUEST['state']))
            $state = $_REQUEST['state'];
        else
            $state = $customerData['state'];

        if(!empty($_REQUEST['postal_code']))
            $postal_code = $_REQUEST['postal_code'];
        else
            $postal_code = $customerData['postal_code'];

        if(!empty($_REQUEST['country']))
            $country = $_REQUEST['country'];
        else
            $country = $customerData['country'];


       if(!empty($_REQUEST['card_name']))
           $card_name = $_REQUEST['card_name'];
        else
            $card_name = $customerData['card_name'];

        if(!empty($_REQUEST['card_number']))
            $card_number = $_REQUEST['card_number'];
        else
            $card_number = $customerData['card_number'];

        if(!empty($_REQUEST['card_exp1']))
            $card_exp = $_REQUEST['card_exp1'].'/'.$_REQUEST['card_exp2'];
        else
            $card_exp = $customerData['card_exp'];

        if(!empty($_REQUEST['card_cvv']))
            $card_cvv = $_REQUEST['card_cvv'];
        else
            $card_cvv = $customerData['card_cvv'];

       if(!empty($_REQUEST['password']))
            $password = md5($_REQUEST['password']);
        else
            $password = $customerData['password'];



        $result =   "UPDATE customers SET  
                                        mobile='$phone',
                                         email='$email',
                                         password='$password'                                         
                                             WHERE  id='$_SESSION[customer_id]'" ;
        $result ="UPDATE customer_detail SET  
                                        first_name='$first_name',
                                         last_name='$last_name',  
                                         address1='$address1',
                                         address2='$address2',  
                                         city='$city',
                                         state='$state', 
                                         postal_code='$postal_code',
                                         country='$country',  
                                         card_name='$card_name',
                                         card_number='$card_number',  
                                         card_exp='$card_exp',
                                         card_cvv='$card_cvv'                                             
                                             WHERE  id='$_SESSION[customer_id]'" ;

        if (mysqli_query($this->db, $result)) {
            $response = array(
                "type" => "success",
                "message" => "Profile updated successfully."
            );
           // header("Location: profile.php");
        }else{
            $response = array(
                "type" => "danger",
                "message" => "Something went wrong!"
            );
        }
        return $response;

    }
}
?>