<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Reset Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
        
		<script type="text/javascript">
        var base_url = "<?php echo base_url()?>";
        </script>
	</head>
	<body class="login-page">
		<div class="login-box">
			<div class="logo">
				<a href="javascript:void(0);"><img src="<?= base_url() ?>assets/img/logo.png" style="width: unset;" /></a>
			</div>
			<div class="card">
				<div class="body">
					<form action="https://brain.orangelinelab.com/auth/register" class="login-form" method="post" accept-charset="utf-8">
						<div class="msg">Enter your email and we will send you instructions on how to reset your password.</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons fa fa-envelope" style="font-size: 15px;"></i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="email" placeholder="Email" required="" autofocus="">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 login-wrap">
								<input type="submit" name="submit" id="submit" class="btn btn-success waves-effect" value="RECOVER PASSWORD" style="width: auto !important;">
							</div>
						</div>
						<div class="m-t-25 align-center">
							<a href="<?php echo base_url('/login')?>">Go to login</a>
						</div>				
					</form>                 
				</div>
			</div>
		</div>
    </body>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
</html>