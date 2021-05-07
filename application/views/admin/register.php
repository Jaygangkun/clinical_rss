<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Register</title>
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
				
					<div class="msg">Create a Account</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons fa fa-user"></i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="">
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons fa fa-user"></i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="first_name" placeholder="First Name" required="" autofocus="">
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons fa fa-user"></i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="last_name" placeholder="Last Name" required="" autofocus="">
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons fa fa-envelope" style="font-size: 15px;"></i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="email" placeholder="email" required="" autofocus="">
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
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons fa fa-lock"></i>
						</span>
						<div class="form-line">
							<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="">
						</div>
					</div>
					<div class="form-group">
						<input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
						<label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
					</div>
					<div class="row">
						<div class="col-xs-12 login-wrap">
							<input type="submit" name="submit" id="submit_register" class="btn btn-block btn-success waves-effect" value="Register">
						</div>
					</div>
					<div class="m-t-25 align-center">
						<a href="<?php echo base_url('/login')?>">You already have a account?</a>
					</div>
				</div>
			</div>
		</div>
    </body>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/app.js?v=<?php echo time()?>"></script>
</html>