<?PHP
include_once("./../functions/customer/loginFunctions.php");
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
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
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
    </style>
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
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="#" class="pull-right">Forgot Password?</a>
        </div>
        <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" id="submit" name="submit">Login</button>

        </div>

    </form>
</div>
</body>
</html>