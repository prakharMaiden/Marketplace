<?PHP

require_once("./../../config/config.php");

class loginController {

    //Create a new instance.
    function __construct() {
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
        $this->db=$con;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // Function for signUp
    public function signUp($first_name,$last_name,$mobile,$email,$password) {
        $result=mysqli_query($this->db,"select * from customers where (email='$email' or mobile='$mobile')") ;
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
            $result = "insert into customers(email,mobile,password) values('$email','$mobile','$password')";
            mysqli_query($this->db,$result) ;
            $customer_id = mysqli_insert_id($this->db);
            $res="insert into customer_detail(customer_id,first_name,last_name) values($customer_id,'$first_name','$last_name')";
            $customer_detail=mysqli_query($this->db,$res);
            if (mysqli_num_rows($customer_detail) > 0) {
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
        $result=mysqli_query($this->db,"select * from customers where (mobile='$login' OR email = '$login') and password='$password'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if($row['active']  == 1){
                $_SESSION['customer_id']= $row['id'];
                header("location:../dashboard.php");
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
}
?>