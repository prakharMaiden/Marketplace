<?php
include_once("./../functions/customer/loginFunctions.php");
error_reporting(E_ALL);
$userData=new DB_con();
if(isset($_POST['submit'])) {
    $response=$userData->signUp($_POST['first_name'],$_POST['last_name'],$_POST['mobile'],$_POST['email'],md5($_POST['password']));
    //print_r($response);die;
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
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6Lep0vIUAAAAAJuq4uHJRPuuY3ik9SYNuUvMeiTu"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6Lep0vIUAAAAAJuq4uHJRPuuY3ik9SYNuUvMeiTu', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .error{color:red;}
        .login-form {
            width: 340px;
            margin: 50px auto;
        }
        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
            font-size: 30px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
        }
        .field-icon {
            float: right;
            margin-left: -25px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }


    </style>
</head>
<body>
<div class="login-form">
    <form class="form-horizontal" action='contact' id="registrationForm" method="POST">
        <h2 class="text-center">Sign Up</h2>
        <?php if (!empty($response)) { ?>
            <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                <?php echo $response["message"]; ?>
            </div>
        <?php } ?>
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
                <div class="input-group">
                    <span class="input-group-addon">
                        +91-</span><input type="text"  id="mobile" maxlength="10"  minlength="10" name="mobile" class="form-control" required>
                </div>
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
                <input id="password-field" type="password" class="form-control" name="password" placeholder="">
                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="confirm_password">Confirm Password</label>
            <div class="controls">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="" class="form-control" required>
            </div>
        </div>

        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" id="submit" onClick="validatePassword();"  name="submit">Register</button>
            <div class="controls">
                Already have a account? <a href="login.php">Login here</a>
            </div>


        </div>
    </form>
</div>
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
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    $(document).ready(function () {
        //called when key is pressed in textbox
        $("#mobile").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $(".error").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });
    });
</script>
</body>
</html>