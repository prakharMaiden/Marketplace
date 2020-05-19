<?php
include_once("./../functions/seller/loginFunctions.php");
error_reporting(E_ALL);
$userData=new DB_con();
if(isset($_POST['submit'])) {
    $response=$userData->signUp($_POST['company_name'],$_POST['first_name'],$_POST['last_name'],$_POST['mobile'],$_POST['email'],md5($_POST['password']));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Krishna Golds Industries</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH;?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_PATH;?>/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="content-wrapper" style="background: #fff; width: 550px;margin: 50px auto;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <h1>Krishna Golds Industries</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sign Up </h3>
                        </div>
                        <form class="form-horizontal" action='' id="registrationForm" method="POST">
                            <?php if (!empty($response)) { ?>
                                <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                                    <?php echo $response["message"]; ?>
                                </div>
                            <?php } ?>
                            <div class="card-body">
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
                                <button class="btn btn-primary" type="submit" id="submit" name="submit">Register</button>
                                <div class="controls">

                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        Already have a account? <a href="login.php">Login here</a>
                    </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo PUBLIC_PATH;?>/css/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo PUBLIC_PATH;?>/css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo PUBLIC_PATH;?>/css/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo PUBLIC_PATH;?>/css/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?php echo PUBLIC_PATH;?>/js/adminlte.min.js"></script>
<script src="<?php echo PUBLIC_PATH;?>/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#registrationForm').validate({
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
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
</body>
</html>