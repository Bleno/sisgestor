<?php
	if($this->session->userdata('id_perfil') == 1){			
?>
<div style="position: absolute; top: 128px;">
	<?php 
		if($this->session->flashdata('inativadook')):
	?>
			<script>
				$(document).ready(function(){

					setTimeout(function(){
						$('#usuarioSucessoInativado').fadeOut(3000);
					}, 4000);

				});
			</script>
			<div class="alert alert-success fade in" id="usuarioSucessoInativado" style="width: 1038px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('inativadook'); ?>
			</div>
	<?php
		endif;
	?>
</div>
<div class="whead top-10">
	<strong><?php echo $titulo; ?></strong>
</div>
<div class="table-search-holder sizing">
	<input type="text" class="table-search" placeholder="Busca por linha...">
</div>
	
<div class="box holder tblr twhite" style="width: 1088px;">
	<table class="table table-striped table-bordered" id="sample_1">
		<thead>
			<tr>
				<th style="width: 390px;">Nome</th>
				<th style="width: 360px;">Email</th>
				<th>Login</th>
				<th style="width: 64px;">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($usuarios as $row):
			?>
			<tr>
				<td style="width: 390px;"><?php echo $row->nome; echo nbs(70);?></td>
				<td style="width: 360px;"><?php echo $row->email; echo nbs(70);?></td>
				<td><?php echo $row->login;?></td>
				<td class="action" style="width: 69px;">
					<a class="btn tip" href="editar/<?php echo $row->id; ?>" data-placement="bottom" title="Editar">
						<i class="icon-pencil"></i>
					</a>
					<?php 
						if($row->ativo == 1){
					?>
					<a class="btn tip" href="inativarUsuario/<?php echo $row->id; ?>" data-placement="bottom" title="Desabilitar">
						<i class="icon-remove inativarUsuario"></i>
					</a>
					<?php }else{ ?>
					<a class="btn tip" href="ativarUsuario/<?php echo $row->id; ?>" data-placement="bottom" title="Habilitar">
						<i class="icon-ok ativarUsuario"></i>
					</a>
					<?php } ?>				
				</td>
			</tr>
			<?php endforeach; ?>			
		</tbody>
	</table>
</div>
<script src="<?php echo base_url('public/js/page/tables_dynamic.js'); ?>"></script>
<?php 
	}else{
		redirect('indexx/index');
	}
?>