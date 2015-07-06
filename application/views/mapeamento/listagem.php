<div style="position: absolute; top: 128px;">
	<?php 
		if($this->session->flashdata('inativadook')):
	?>
			<script>
				setTimeout(function(){
					$('#mapearInativadoOk').fadeOut(3000);
				}, 4000);
			</script>
			<div id="mapearInativadoOk" class="alert alert-success fade in" style="width: 1038px;">
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
				<th>ID</th>
				<th style="width: 390px;">Docente</th>
				<th style="width: 360px;">Curso</th>
				<th>Unidade</th>
				<th style="width: 64px;">Periodo Inicial</th>
				<th style="width: 64px;">Periodo Final</th>
				<th style="width: 64px;">Horario Inicial</th>
				<th style="width: 64px;">Horario Final</th>
				<th style="width: 64px;">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($mapeamento as $row):

					$dateI = explode('-', $row->periodoInicio);
					$dateF = explode('-', $row->periodoFim);

				 	$anoI = $dateI[0];
				 	$mesI = $dateI[1];
				 	$diaI = $dateI[2];

				 	$anoF = $dateF[0];
				 	$mesF = $dateF[1];
				 	$diaF = $dateF[2];

				 	$row->periodoInicio = $diaI.'/'.$mesI.'/'.$anoI;
				 	$row->periodoFim    = $diaF.'/'.$mesF.'/'.$anoF;
			?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->nome; ?></td>
				<td><?php echo $row->curso; ?></td>
				<td><?php echo $row->unidade; ?></td>
				<td><?php echo $row->periodoInicio; ?></td>
				<td><?php echo $row->periodoFim; ?></td>
				<td><?php echo $row->horarioInicio; ?></td>
				<td><?php echo $row->horarioFim; ?></td>
				<td class="action" style="width: 69px;">					
					<a class="btn tip" href="javascript:void(0);" id="mapeamentoDetalhes" rel="<?php echo $row->id; ?> " data-placement="bottom" title="Mais Detalhes">
						<i class="icon-eye-open"></i>
					</a>
					<a class="btn tip" href="editar/<?php echo $row->id; ?>" data-placement="bottom" title="Editar">
						<i class="icon-pencil"></i>
					</a>
					<a class="btn tip" href="desabilitarMapeamento/<?php echo $row->id; ?>" id="desabilitarMapeamento" data-placement="bottom" title="Excluir">
						<i class="icon-remove"></i>
					</a>				
				</td>
			</tr>
			<?php endforeach; ?>			
		</tbody>
	</table>
</div>
<div id="detalhesMapeamento">
	
</div>
<script src="<?php echo base_url('public/js/page/tables_dynamic.js'); ?>"></script>