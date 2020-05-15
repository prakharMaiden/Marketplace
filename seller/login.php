<?php
include_once("./../functions/seller/loginFunctions.php");
error_reporting(E_ALL);
$loginData=new DB_con();
if(isset($_POST['submit'])) {
    $response= $loginData->signIn($_POST['login'],md5($_POST['password']));
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
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
<div class="login-form">
    <form class="form-horizontal" action='' id="loginForm" method="POST">
        <h2 class="text-center">Login</h2>
        <?php if (!empty($response)) { ?>
            <div id="response" class="alert alert-<?php echo $response["type"]; ?> ">
                <?php echo $response["message"]; ?>
            </div>
        <?php } ?>
        <div class="form-group">
            <label class="control-label" for="login">E-mail/Mobile</label>
            <div class="controls">
                <input type="text" id="login" name="login" placeholder="E-mail/Mobile" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
            </div>
        </div>
        <div class="clearfix">
            <a href="#" class="pull-right">Forgot Password?</a>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" id="submit"  onClick="validatePassword();" name="submit">Login</button>

        </div>

    </form>
</div>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
    function validatePassword() {
        var validator = $("#loginForm").validate();
    }
</script>
</body>
</html>