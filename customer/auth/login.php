<?php
include_once("../controller/loginController.php");
$loginData=new loginController();
if(isset($_POST['submit'])) {
    $response= $loginData->signIn($_POST['auth'],md5($_POST['password']));
}
if(isset($_POST['register_submit'])) {
    $response=$loginData->signUp($_POST['first_name'],$_POST['last_name'],$_POST['mobile'],$_POST['email'],md5($_POST['password']));
}
include("../includes/login_header.php");
?>
<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="../index.php">Home</a></li>
                <li>My account</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <div class="ps-form--account ps-tab-root">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#sign-in">Login</a></li>
                    <li><a href="#register">Register</a></li>
                </ul>

                <div class="ps-tabs">
                    <div class="ps-tab active" id="sign-in">
                        <div class="ps-form__content">
                            <h5>Log In Your Account</h5>
                            <form class="form-horizontal"  action='' id="loginForm" method="POST">
                                <?php if (!empty($response)) { ?>
                                    <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                                        <?php echo $response["message"]; ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <input class="form-control" type="text" id="login"  name="login" placeholder="Username or email address" required>
                                </div>
                                <div class="form-group form-forgot">
                                    <input class="form-control" type="password" id="password"  name="password" placeholder="Password" required>
                                    <a href="#">Forgot?</a>
                                </div>
                                <div class="form-group">
                                    <div class="ps-checkbox">
                                        <input class="form-control" type="checkbox" id="remember-me" name="remember-me">
                                        <label for="remember-me">Rememeber me</label>
                                    </div>
                                </div>
                                <div class="form-group submtit">
                                    <button class="ps-btn ps-btn--fullwidth"  type="submit" id="submit"  name="submit">Login</button>
                                </div>

                            </form>
                        </div>

                        <div class="ps-form__footer">
                        </div>
                    </div>

                    <div class="ps-tab" id="register">
                        <div class="ps-form__content">
                            <h5>Register An Account</h5>
                            <form class="form-horizontal"  action='' id="registrationForm" method="POST">
                                <?php if (!empty($response)) { ?>
                                    <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                                        <?php echo $response["message"]; ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <input type="text" id="first_name" name="first_name" placeholder="First Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" id="mobile" maxlength="10" placeholder="Mobile" minlength="10" name="mobile" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <input type="email" id="email" name="email" placeholder="Email Address" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control" name="password" placeholder="Password">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>

                                <div class="form-group">
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>
                                </div>
                                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                                <div class="form-group submtit">
                                    <button class="ps-btn ps-btn--fullwidth" type="submit" id="register_submit"  name="register_submit">Register</button>
                                </div>
                            </form>
                        </div>
                        <div class="ps-form__footer">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<style>
    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -30px;
        position: relative;
        z-index: 2;
    }
    .error{color:red;}
</style>
<?php include("../includes/login_footer.php");?>
<script src="https://www.google.com/recaptcha/api.js?render=6Lep0vIUAAAAAJuq4uHJRPuuY3ik9SYNuUvMeiTu"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6Lep0vIUAAAAAJuq4uHJRPuuY3ik9SYNuUvMeiTu', { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>
<script src="<?php echo PUBLIC_PATH;?>/css/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo PUBLIC_PATH;?>/css/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#loginForm').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6
                },
            },
            messages: {
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                }
            }
        });
        $("#registrationForm").validate({
            rules: {
                password: {required: true,minlength: 6},
                confirm_password: {equalTo: "#password-field"}
            },
            messages: {
                password: " Password must be at least 6 character",
                confirm_password: "Both passwords must be same."
            }
        });
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
    });
</script>