<?PHP

require_once("./../config/config.php");
error_reporting(E_ALL);

class DB_con {
    function __construct() {
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
        $this->db=$con;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // Function for signUp
    public function signUp($company_name,$first_name,$last_name,$mobile,$email,$password) {
        $result=mysqli_query($this->db,"select * from suppliers where (email='$email' or phone='$mobile')") ;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if($email == $row['email']) {
                $response = array(
                    "type" => "danger",
                    "message" => "Email already exists in our records."
                );
            }elseif ($mobile == $row['mobile']){
                $response = array(
                    "type" => "danger",
                    "message" => "Mobile number already exists in our records."
                );
            }
        }else{
            $result =   mysqli_query($this->db,"insert into suppliers(company_name,contact_fname,contact_lname,email,phone,password) values('$company_name','$first_name','$last_name','$email','$mobile','$password')") ;
            if (mysqli_num_rows($result) > 0) {
                $response = array(
                    "type" => "success",
                    "message" => "You have registered successfully."
                );
            }else{
                $response = array(
                    "type" => "danger",
                    "message" => "Something went wrong!"
                );
            }
        }
        return $response;

    }

    // Function for signIn
    public function signIn($login,$password) {
        $result=mysqli_query($this->db,"select * from suppliers where (phone='$login' OR email = '$login') and password='$password'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if($row['active']  == 1){
                $_SESSION['supplier_id']= $row['id'];
                if($row['city'] == Null && $row['state'] == Null){
                    header("location:profile.php");
                }else{
                    header("location:dashboard.php");
                }
            }else{
                $response = array(
                    "type" => "danger",
                    "message" => "This user is not active. Please contact admin."
                );
            }


        }else{
            $response = array(
                "type" => "danger",
                "message" => "We have no records of your inputs."
            );
        }
        return $response;
    }



    // Function for profileUpdate
    public function profileUpdate()
    {
        $result = mysqli_query($this->db,"select * from suppliers where (id='$_SESSION[supplier_id]')");
        $supplierData = mysqli_fetch_assoc($result);

        if(!empty($_REQUEST['company_name']))
            $company_name = $_REQUEST['company_name'];
        else
            $company_name = $supplierData['company_name'];

        if(!empty($_REQUEST['contact_fname']))
            $contact_fname = $_REQUEST['contact_fname'];
        else
            $contact_fname = $supplierData['contact_fname'];

        if(!empty($_REQUEST['contact_lname']))
            $contact_lname = $_REQUEST['contact_lname'];
        else
            $contact_lname = $supplierData['contact_lname'];

        if(!empty($_REQUEST['contact_title']))
            $contact_title = $_REQUEST['contact_title'];
        else
            $contact_title = $supplierData['contact_title'];

        if(!empty($_REQUEST['customer_id']))
            $customer_id = $_REQUEST['customer_id'];
        else
            $customer_id = $supplierData['customer_id'];

        if(!empty($_REQUEST['address1']))
            $address1 = $_REQUEST['address1'];
        else
            $address1 = $supplierData['address1'];

        if(!empty($_REQUEST['address2']))
            $address2 = $_REQUEST['address2'];
        else
            $address2 = $supplierData['address2'];

        if(!empty($_REQUEST['city']))
            $city = $_REQUEST['city'];
        else
            $city = $supplierData['city'];

        if(!empty($_REQUEST['state']))
            $state = $_REQUEST['state'];
        else
            $state = $supplierData['state'];

        if(!empty($_REQUEST['postal_code']))
            $postal_code = $_REQUEST['postal_code'];
        else
            $postal_code = $supplierData['postal_code'];

        if(!empty($_REQUEST['country']))
            $country = $_REQUEST['country'];
        else
            $country = $supplierData['country'];

        if(!empty($_REQUEST['phone']))
            $phone = $_REQUEST['phone'];
        else
            $phone = $supplierData['phone'];

        if(!empty($_REQUEST['fax']))
            $fax = $_REQUEST['fax'];
        else
            $fax = $supplierData['fax'];

        if(!empty($_REQUEST['email']))
            $email = $_REQUEST['email'];
        else
            $email = $supplierData['email'];

        if(!empty($_REQUEST['url']))
            $url = $_REQUEST['url'];
        else
            $url = $supplierData['url'];

        if(!empty($_REQUEST['payment_methods']))
            $payment_methods = $_REQUEST['payment_methods'];
        else
            $payment_methods = $supplierData['payment_methods'];

        if(!empty($_REQUEST['discount_type']))
            $discount_type = $_REQUEST['discount_type'];
        else
            $discount_type = $supplierData['discount_type'];

        if(!empty($_REQUEST['type_goods']))
            $type_goods = $_REQUEST['type_goods'];
        else
            $type_goods = $supplierData['type_goods'];

        if(!empty($_REQUEST['current_order']))
            $current_order = $_REQUEST['current_order'];
        else
            $current_order = $supplierData['current_order'];

        if(!empty($_REQUEST['discount_available']))
            $discount_available = $_REQUEST['discount_available'];
        else
            $discount_available = $supplierData['discount_available'];

        if(!empty($_REQUEST['notes']))
            $notes = $_REQUEST['notes'];
        else
            $notes = $supplierData['notes'];

        if(!empty($_REQUEST['size_url']))
            $size_url = $_REQUEST['size_url'];
        else
            $size_url = $supplierData['size_url'];

        if(!empty($_REQUEST['password']))
            $password = md5($_REQUEST['password']);
        else
            $password = $supplierData['password'];

        $result =   "UPDATE suppliers SET  
                                       customer_id='$customer_id',
                                         company_name='$company_name',
                                         contact_fname='$contact_fname',
                                         contact_lname='$contact_lname',
                                         contact_title='$contact_title',
                                         address1='$address1',
                                         address2='$address2',
                                         city='$city',
                                         state='$state',
                                         postal_code='$postal_code',
                                         country='$country',
                                         phone='$phone',
                                         fax='$fax',
                                         email='$email',
                                          url='$url',
                                          payment_methods='$payment_methods',
                                           size_url='$size_url',
                                           notes='$notes',
                                           discount_type='$discount_type',
                                           discount_available='$discount_available',
                                           current_order='$current_order',
                                            type_goods='$type_goods',
                                             password='$password'
                                             WHERE  id='$_SESSION[supplier_id]'" ;

        if (mysqli_query($this->db, $result)) {
            $response = array(
                "type" => "success",
                "message" => "You have registered successfully."
            );
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