<?php 

$idUnidade = $this->uri->segment(3);
$idUnidade = base64_decode($idUnidade);
if($idUnidade == null || !is_numeric($idUnidade)) redirect('unidade/listagem');

$unidade = $this->UnidadeModel->getById($idUnidade)->row();

if($this->session->flashdata('edicaook')):
?>
<div style="position: absolute; top: 128px;">
	<script>
		setTimeout(function(){
			$('#unidadeSucessoEditar').fadeOut(3000);
		}, 4000);
	</script>
	<div id="unidadeSucessoEditar" class="alert alert-success fade in" style="width: 1038px;">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('edicaook'); ?>
	</div>
<?php
endif;
?>
</div>

<div style="margin-top: 30px;">
	<form  action='<?php echo base_url("unidade/editar/$idUnidade");?>' method="post" class="main example3">						
		<div class="whead">
			<strong><?php echo $titulo; ?></strong>
		</div>	
		<div class="box holder">
			<div class="row">
				<div class="grid1">
					<label>Unidade:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="unidade" class="shiny required green-high" value="<?php echo $unidade->unidade; ?> " autofocus>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Endereço:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="endereco" class="shiny required green-high" value="<?php echo $unidade->unidade; ?> " >
				</div>
			</div>							
			<div class="row">
				<div class="grid3">
					<input type="hidden" name="idUnidade" value="<?php echo $unidade->id;?>">
					<input type="reset" value="Limpar" class="btn">
					<input type="submit" value="Salvar" id="EnviarUsuario" class="submit">
				</div>
			</div>		
		</div>
	</form>
</div>