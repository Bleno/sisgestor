<div style="position: absolute; top: 128px;">
	<?php 
		if($this->session->flashdata('alteadook')):
	?>
			<script>
				$(document).ready(function(){

					setTimeout(function(){
						$('#docenteSucessoAlterado').fadeOut(3000);
					}, 4000);

				});
			</script>
			<div class="alert alert-success fade in" id="docenteSucessoAlterado" style="width: 1038px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('alteadook'); ?>
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
	<table>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Matricula</th>
				<th>Email</th>
				<th>Telefone</th>
				<th>Celular</th>
				<th>Escolaridade</th>
				<th>Eixo</th>
				<th>Data Admissão</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($docentes as $row):

					$date = explode('-', $row->data_admissao);

				 	$ano = $date[0];
				 	$mes = $date[1];
				 	$dia = $date[2];

				 	$row->data_admissao = $dia.'/'.$mes.'/'.$ano;
			?>
			<tr>
				<td><?php echo $row->nome; ?></td>
				<td><?php echo $row->matricula; ?></td>
				<td><?php echo $row->email; ?></td>
				<td><?php echo $row->telefone; ?></td>
				<td><?php echo $row->celular; ?></td>
				<td><?php echo $row->escolaridade; ?></td>
				<td><?php echo $row->eixo; ?></td>
				<td><?php echo $row->data_admissao; ?></td>
				<td class="action" style="width: 69px;">
					<a class="btn tip" href="javascript:void(0);" id="docenteDetalhes" rel="<?php echo $row->id; ?> " data-placement="bottom" title="Mais Detalhes">
						<i class="icon-eye-open"></i>
					</a>
					<a class="btn tip" href="editar/<?php echo $row->id; ?>" data-placement="bottom" title="Editar">
						<i class="icon-pencil"></i>
					</a>
					<a class="btn tip" href="alterarSituacao/<?php echo $row->id; ?>" data-placement="bottom" title="Alterar Situação">
						<i class="icon-flag"></i>
					</a>				
				</td>
			</tr>
			<?php endforeach; ?>		
		</tbody>
	</table>
</div>

<div id="docentesAtivosDetalhes">

</div>
<script src="<?php echo base_url('public/js/page/tables_dynamic.js'); ?>"></script>