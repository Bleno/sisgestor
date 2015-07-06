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
 
        <!-- >javascripts<!-->	
                
    <script src="<?php echo base_url('public/js/vendor/jquery-1.9.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/prettify.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/jquery.sparkline.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/vendor/jquery.mcustomscrollbar.concat.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/main.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/page/index.js'); ?>"></script>
    
    <script src="<?php echo base_url('public/js/jquery.pstrength.1.2.js'); ?>"></script>
    
    
    <script src="<?php echo base_url('public/js/vendor/jquery.validate.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/page/forms_validation.js'); ?>"></script>
    
    <script src="<?php echo base_url('public/js/sisgestor.js'); ?>"></script>
</head>
<body>		
	<!-- login form -->
 <?php
//$idUser = $this->uri->segment(3);
//
//if($idUser == null) redirect('usuario/listagem');
//
//$usuario = $this->UsuarioModel->getById($idUser)->row();
//
//if($this->session->flashdata('edicaook')):
?>
	<script>
		$(document).ready(function(){

			setTimeout(function(){
				$('#usuarioSucesso').fadeOut(3000);
			}, 4000);

		});
	</script>
	<div class="alert alert-block fade in" id="usuarioSucesso">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Aviso! Caro Usuário do SISGESTOR</strong> 
                <p>   Caso seja o seu primeiro acesso ou sua senha foi forçada para alteração, é nessário
                preencher os campos abaixo para concluir o acesso ao sistema. <?php echo anchor('','Voltar'); ?></p>
                
	</div>
<?php
    
        $id_usuario= $this->session->userdata('id');
        $login= $this->session->userdata('login');
    
?>

<div style="margin-top: 30px;">
	<form  action='' method="post" class="main example3">						
		<div class="whead">
			<strong><?php echo $titulo; ?></strong>
		</div>	
		<div class="box holder">
			<div class="row">
				<div class="grid1">
					<label>Login: </label>
				</div>
				<div class="grid2">
                                    <input type="text" readonly="" name="login" class="shiny" value="<?php echo $login; ?>">
                                    <input type="hidden" name="idusuario" value="<?php echo $id_usuario; ?>">
				</div>
			</div>		
			<div class="row">
				<div class="grid1">
					<label>Senha: </label>
				</div>
				<div class="grid2">
                                    <input type="password" name="senha" id="senha" class="shiny required green-high" value="">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Confirmar Senha: </label>
				</div>
				<div class="grid2">
                                    <input type="password" name="confirmiSenha" id="confirmiSenha" class="shiny required green-high" value="">
                                    <span style="display: none;" id="senhaDiferente" class="label label-important">A senha digitada não confere</span>
                                </div>
			</div>			
			<div class="row">
				<div class="grid3">
					<input type="reset" value="Limpar" class="btn">
                    <input type="submit" id="EnviarUsuario" value="Salvar" class="submit">
				</div>
			</div>
		</div>
	</form>
</div>
    <!-- footer -->
	<footer id="footer">
		
	</footer>
		
</body>
</html>
