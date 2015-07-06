<div style="position: absolute; top: 128px;">
	<?php 
		if($this->session->flashdata('cadastrook')):
	?>
			<script>
				setTimeout(function(){
					$('#unidadeSucesso').fadeOut(3000);
				}, 4000);
			</script>
			<div id="unidadeSucesso" class="alert alert-success fade in" style="width: 1038px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('cadastrook'); ?>
			</div>
	<?php
		endif; 
	?>
</div>

<div style="margin-top: 30px;">
	<form  action="<?php echo base_url('unidade/cadastrar');?>" method="post" class="main example3">						
		<div class="whead">
			<strong><?php echo $titulo; ?></strong>
		</div>	
		<div class="box holder">
			<div class="row">
				<div class="grid1">
					<label>Unidade:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="unidade" class="shiny required green-high" autofocus>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Endereço:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="endereco" class="shiny required green-high" autofocus>
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