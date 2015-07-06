<div class="whead top-10">
	<strong><?php echo $titulo; ?></strong>
</div>
<div class="table-search-holder sizing">
	<input type="text" class="table-search" placeholder="Busca por linha...">
</div>
	
<?php 
//var_dump($docentes);
?>

<div class="box holder tblr twhite" style="width: 1103px;">
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
				<th>Situação</th>
				<th>Hora Aula</th>
				<th>Data Admissão</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($docentes as $row):
			?>
			<tr>
				<td><?php echo $row->nome; ?></td>
				<td><?php echo $row->matricula; ?></td>
				<td><?php echo $row->email; ?></td>
				<td><?php echo $row->telefone; ?></td>
				<td><?php echo $row->celular; ?></td>
				<td><?php echo $row->escolaridade; ?></td>
				<td><?php echo $row->eixo; ?></td>
				<td><?php echo $row->situacao; ?></td>
				<td><?php echo $row->hora_aula; ?></td>
				<td><?php echo $row->data_admissao; ?></td>
				<td class="action" style="width: 69px;">
					<a class="btn tip" href="editar/<?php echo $row->id; ?>" data-placement="bottom" title="Editar Registro">
						<i class="icon-pencil"></i>
					</a>
					<a class="btn tip" href="excluir/<?php echo $row->id; ?>" data-placement="bottom" title="Excluir Registro">
						<i class="icon-remove"></i>
					</a>				
				</td>
			</tr>
			<?php endforeach; ?>			
		</tbody>
	</table>
</div>
<script src="<?php echo base_url('public/js/page/tables_dynamic.js'); ?>"></script>