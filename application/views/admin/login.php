<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Sign In</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
        
	</head>
	<body class="login-page">
        <div class="login-box">
            <div class="logo">
                <a href="javascript:void(0);"><img src="<?= base_url() ?>assets/img/logo.png" style="width: unset;"></a>
            </div>
            <div class="card">
                <div class="body">
                    <form action="https://brain.orangelinelab.com/auth/register" class="login-form" method="post" accept-charset="utf-8">
                        <div class="msg">Sign In</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons fa fa-user"></i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="email" placeholder="Email" required="" autofocus="">
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons fa fa-lock"></i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" placeholder="Password" required="">
                            </div>
                        </div>
                        <div class="form-group" style="display: inline;width: 50%;">
                            <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                            <label for="terms">Remember me.</label>
                        </div>
                        <div class="form-group" style="display: inline;font-size: 13px;width: 50%;float: right;text-align: right;">
                            <a href="<?php echo base_url('/reset-password')?>">Forgot password?</a>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 login-wrap">
                                <input type="submit" name="submit" id="submit" class="btn btn-block btn-success waves-effect" value="LOGIN">
                            </div>
                        </div>
                        <div class="m-t-25 align-center">
                            <a href="<?php echo base_url('/register')?>">Do you have no account?</a>
                        </div>
                    </form>            
                </div>
            </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
</html>