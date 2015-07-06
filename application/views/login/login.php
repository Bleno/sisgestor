<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="keywords" content="spookynet.org, webdesignlab.org " /> 
	<title><?php echo $titulo; ?></title>
	
	<link href="<?php echo base_url('public/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('public/css/bootstrap-responsive.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('public/css/main.css'); ?>" rel="stylesheet" type="text/css" />

</head>
<body>		
	<!-- login form -->
	<form action="<?php echo base_url('Login/logar'); ?>" method="post" class="form-signin">
		<div class="profile">
			<span><img src="<?php echo base_url('public/img/__tmp/profile.png'); ?>" alt=""></span>
		</div>
		<input type="text" class="input-block-level"  name="login" id="login" placeholder="Login" autofocus>
		<input type="password" class="input-block-level"  name="senha" id="senha" placeholder="Senha">
		<button class="btn btn-large btn-primary" type="submit" id="logar"> Entrar </button>
		<?php if($this->session->flashdata('loginInvalido')): ?>
			<script>
				setTimeout(function(){
					$('#loginInvalido').fadeOut(3000);
				}, 4000);
			</script>
			<div id="loginInvalido">
				<font color="#FC5555"><?php echo $this->session->flashdata('loginInvalido'); ?></font>
			</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('loginVazio')): ?>
			<script>
				setTimeout(function(){
					$('#loginVazio').fadeOut(3000);
				}, 4000);
			</script>
			<div id="loginVazio">
				<font color="#FC5555"><?php echo $this->session->flashdata('loginVazio'); ?></font>
			</div>
		<?php endif; ?>
	</form>	
    <!-- footer -->
	<footer id="footer">
		
	</footer>
	
    <script src="<?php echo base_url('public/js/vendor/jquery-1.9.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/prettify.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/jquery.sparkline.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/jquery.mcustomscrollbar.concat.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/main.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/page/index.js'); ?>"></script>
    <!-- <script src="<?php //echo base_url('public/js/jquery.pstrength.1.2.js'); ?>"></script>
    // <script src="<?php //echo base_url('public/js/sisgestor.js'); ?>"></script> -->
		
</body>
</html>
