<?php
include_once("./../functions/seller/loginFunctions.php");
error_reporting(E_ALL);
$userData=new DB_con();
if(isset($_POST['submit'])) {
    $response=$userData->signUp($_POST['company_name'],$_POST['first_name'],$_POST['last_name'],$_POST['mobile'],$_POST['email'],md5($_POST['password']));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Krishna Golds Industries</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
<div class="login-form">
    <form class="form-horizontal" action='' id="registrationForm" method="POST">
        <h2 class="text-center">Seller Panel</h2>
        <?php if (!empty($response)) { ?>
            <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                <?php echo $response["message"]; ?>
            </div>
        <?php } ?>
        <div class="form-group">
            <label class="control-label" for="company_name">Company Name</label>
            <div class="controls">
                <input type="text" id="company_name" name="company_name" placeholder="" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="first_name">First name</label>
            <div class="controls">
                <input type="text" id="first_name" name="first_name" placeholder="" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="last_name">Last name</label>
            <div class="controls">
                <input type="text" id="last_name" name="last_name" placeholder="" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="mobile">Mobile Number</label>
            <div class="controls">
                <input type="number" id="mobile" maxlength="10"  minlength="10" name="mobile" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="email" id="email" name="email" placeholder="" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input id="password" type="password" class="form-control" name="password" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="confirm_password">Confirm Password</label>
            <div class="controls">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" id="submit" onClick="validatePassword();"  name="submit">Register</button>
            <div class="controls">
                Already have a account? <a href="login.php">Login here</a>
            </div>


        </div>
    </form>
</div>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
    function validatePassword() {
        var validator = $("#registrationForm").validate({
            rules: {
                password: {required: true,minlength: 6},
                confirm_password: {equalTo: "#password"}
            },
            messages: {
                password: " Password must be at least 6 character",
                confirm_password: "Both passwords must be same."
            }
        });
    }
</script>
</body>
</html>