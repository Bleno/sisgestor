<?php
	if($this->session->userdata('id_perfil') == 1){			
?>
<div style="position: absolute; top: 128px;">
	<?php 
		if($this->session->flashdata('cadastrook')):
	?>
			<script>
				setTimeout(function(){
					$('#usuarioSucesso').fadeOut(3000);
				}, 4000);
			</script>
			<div id="usuarioSucesso" class="alert alert-success fade in" style="width: 1038px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('cadastrook'); ?>
			</div>
	<?php
		endif;
	?>
</div>

<div style="margin-top: 30px;">
	<form  action="<?php echo base_url('usuario/cadastrar');?>" method="post" class="main example3">						
		<div class="whead">
			<strong><?php echo $titulo; ?></strong>
		</div>	
		<div class="box holder">
			<div class="row">
				<div class="grid1">
					<label>Nome:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="nome" class="shiny required green-high" autofocus>
				</div>
			</div>		
			<div class="row">
				<div class="grid1">
					<label>Email:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="email" class="shiny required email green-high">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Login:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="login" class="shiny required green-high">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Perfil:* </label>
				</div>
				<div class="grid2">
					<?php echo form_dropdown('id_perfil', $perfil, 0, "class='required'"); ?>
				</div>
			</div>	
						
			<div class="row">
				<div class="grid3">
					<input type="reset" value="Limpar" class="btn">
					<input type="submit" value="Salvar" id="EnviarUsuario" class="submit">
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