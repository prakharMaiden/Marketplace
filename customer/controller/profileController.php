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

        if(!empty($_REQUEST['company_name']))
            $company_name = $_REQUEST['company_name'];
        else
            $company_name = $customerData['company_name'];

        if(!empty($_REQUEST['contact_fname']))
            $contact_fname = $_REQUEST['contact_fname'];
        else
            $contact_fname = $customerData['contact_fname'];

        if(!empty($_REQUEST['contact_lname']))
            $contact_lname = $_REQUEST['contact_lname'];
        else
            $contact_lname = $customerData['contact_lname'];

        if(!empty($_REQUEST['contact_title']))
            $contact_title = $_REQUEST['contact_title'];
        else
            $contact_title = $customerData['contact_title'];

        if(!empty($_REQUEST['customer_id']))
            $customer_id = $_REQUEST['customer_id'];
        else
            $customer_id = $customerData['customer_id'];

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

        if(!empty($_REQUEST['phone']))
            $phone = $_REQUEST['phone'];
        else
            $phone = $customerData['phone'];

        if(!empty($_REQUEST['fax']))
            $fax = $_REQUEST['fax'];
        else
            $fax = $customerData['fax'];

        if(!empty($_REQUEST['email']))
            $email = $_REQUEST['email'];
        else
            $email = $customerData['email'];

        if(!empty($_REQUEST['url']))
            $url = $_REQUEST['url'];
        else
            $url = $customerData['url'];

        if(!empty($_REQUEST['payment_methods']))
            $payment_methods = $_REQUEST['payment_methods'];
        else
            $payment_methods = $customerData['payment_methods'];

        if(!empty($_REQUEST['discount_type']))
            $discount_type = $_REQUEST['discount_type'];
        else
            $discount_type = $customerData['discount_type'];

        if(!empty($_REQUEST['type_goods']))
            $type_goods = $_REQUEST['type_goods'];
        else
            $type_goods = $customerData['type_goods'];

        if(!empty($_REQUEST['current_order']))
            $current_order = $_REQUEST['current_order'];
        else
            $current_order = $customerData['current_order'];

        if(!empty($_REQUEST['discount_available']))
            $discount_available = $_REQUEST['discount_available'];
        else
            $discount_available = $customerData['discount_available'];

        if(!empty($_REQUEST['notes']))
            $notes = $_REQUEST['notes'];
        else
            $notes = $customerData['notes'];

        if(!empty($_REQUEST['size_url']))
            $size_url = $_REQUEST['size_url'];
        else
            $size_url = $customerData['size_url'];

        if(!empty($_REQUEST['password']))
            $password = md5($_REQUEST['password']);
        else
            $password = $customerData['password'];

        if(!empty($_REQUEST['active']))
            $active = $_REQUEST['active'];
        else
            $active = $customerData['active'];

        if(!empty($_FILES['logo'])){
            if(file_exists($_FILES['logo']['tmp_name'])){

                $name = $_FILES['logo']['name'];
                getcwd();
                chdir("../../public/img/seller/logo/");
                $target_dir = getcwd();
                $target_file = $target_dir . basename($_FILES["logo"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $extensions_arr = array("png");
                if(in_array($imageFileType,$extensions_arr) ){
                    $image_base64 = base64_encode(file_get_contents($_FILES['logo']['tmp_name']) );
                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                    $imageName = date("ymdhis").'-'. $name;
                    move_uploaded_file($_FILES['logo']['tmp_name'],$imageName);


                }else{
                    $response = array(
                        "type" => "danger",
                        "message" => "Please choose png image only!"
                    );
                    return $response;

                }
            }
        }else{
            $imageName = $customerData['logo'];
        }

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
                                             password='$password',
                                             active='$active',
                                             logo='$imageName'
                                             WHERE  id='$_SESSION[supplier_id]'" ;

        if (mysqli_query($this->db, $result)) {
            $response = array(
                "type" => "success",
                "message" => "Profile updated successfully."
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