<?php 
if($this->session->flashdata('inativadook') || $this->session->flashdata('ativadook')):
?>
<div style="position: absolute; top: 128px;">
	<script>
		setTimeout(function(){
			$('#cursoSucessoEditar').fadeOut(3000);
		}, 4000);
	</script>
	<div id="cursoSucessoEditar" class="alert alert-success fade in" style="width: 1038px;">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Operação realizada com sucesso.
	</div>
</div>
<?php endif; ?>
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
				<th>Curso</th>
				<th>Eixo</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($cursos as $row):
			?>
			<tr>
				<td><?php echo $row->curso; echo nbs(70);?></td>
				<td><?php echo $row->eixo; echo nbs(70);?></td>
				<td class="action" style="width: 69px;">
					<a class="btn tip" href="editar/<?php echo $row->id; ?>" data-placement="bottom" title="Editar">
						<i class="icon-pencil"></i>
					</a>
					<?php
						if($row->ativo == 1){
					?>
					<a class="btn tip" href="inativarCurso/<?php echo $row->id; ?>"  data-placement="bottom" title="Desabilitar">
						<i class="icon-remove inativarCurso" ></i>
					</a>
					<?php }else{ ?>
					<a class="btn tip" href="ativarCurso/<?php echo $row->id; ?>" data-placement="bottom" title="Habilitar">
						<i class="icon-ok ativarCurso"></i>
					</a>
					<?php } ?>				
				</td>
			</tr>
			<?php endforeach; ?>			
		</tbody>
	</table>
</div>
<script src="<?php echo base_url('public/js/page/tables_dynamic.js'); ?>"></script>