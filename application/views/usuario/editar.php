<?php 

if($this->session->userdata('id_perfil') == 1){

$idUser = $this->uri->segment(3);

if($idUser == null) redirect('usuario/listagem');

$usuario = $this->UsuarioModel->getById($idUser)->row();

if($this->session->flashdata('edicaook')):
?>
<div style="position: absolute; top: 128px;">
	<script>
		$(document).ready(function(){

			setTimeout(function(){
				$('#usuarioSucessoEdicao').fadeOut(3000);
			}, 4000);

		});
	</script>
	<div class="alert alert-success fade in" id="usuarioSucessoEdicao" style="width: 1038px;">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('edicaook'); ?>
	</div>
</div>
<?php endif; ?>

<div style="margin-top: 30px;">
	<form  action='<?php echo base_url("usuario/editar/$idUser");?>' method="post" class="main example3">						
		<div class="whead">
			<strong><?php echo $titulo; ?></strong>
		</div>	
		<div class="box holder">
			<div class="row">
				<div class="grid1">
					<label>Nome: </label>
				</div>
				<div class="grid2">
					<input type="text" name="nome" class="shiny required" value="<?php echo $usuario->nome; ?>">
				</div>
			</div>		
			<div class="row">
				<div class="grid1">
					<label>Email: </label>
				</div>
				<div class="grid2">
					<input type="text" name="email" class="shiny required email" value="<?php echo $usuario->email; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Perfil:* </label>
				</div>
				<div class="grid2">
					<?php echo form_dropdown('id_perfil', $perfil, $usuario->id_perfil, "class='required'"); ?>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Login: </label>
				</div>
				<div class="grid2">
					<input type="text" name="login" class="shiny required" value="<?php echo $usuario->login; ?>" disabled>
					<input type="hidden" name="idusuario" value="<?php echo $usuario->id; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label><?php echo $forcar; ?></label>
				</div>
				<div class="grid2">
                    <input type="checkbox" name="primeiro_acesso" value="1" />
                    <input type="hidden" name="idusuario" value="<?php echo $usuario->id; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid3">
					<input type="reset" value="Limpar" class="btn">
					<input type="submit" value="Salvar" class="submit">
				</div>
			</div>
		</div>
	</form>
</div>
<?php
}else{
	redirect('indexx/index');
}
?>