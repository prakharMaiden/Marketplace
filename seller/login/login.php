<?php
include_once("./../../functions/seller/loginFunctions.php");
error_reporting(E_ALL);
$loginData=new DB_con();
if(isset($_POST['submit'])) {
    $response= $loginData->signIn($_POST['login'],md5($_POST['password']));
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
                            <h3 class="card-title">Login </h3>
                        </div>
                        <form class="form-horizontal" action='' id="loginForm" method="POST">
                            <?php if (!empty($response)) { ?>
                                <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                                    <?php echo $response["message"]; ?>
                                </div>
                            <?php } ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="login">E-mail/Mobile</label>
                                    <input type="text" id="login" name="login" placeholder="E-mail/Mobile" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit" id="submit"  name="submit">Login</button>
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