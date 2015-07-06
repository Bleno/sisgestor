<center>
	<div class="box holder tblr twhite" style="width: 1103px;">
		<table>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Hora Aula</th>
					<th>Endereço</th>
					<th>Lotação</th>
					<th>Graduação</th>
					<th>Observação</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $docente->nome; ?></td>
					<td><?php echo $docente->hora_aula; ?></td>
					<td><?php echo $docente->endereco; ?></td>
					<td><?php echo $docente->lotacao; ?></td>
					<td><?php echo $docente->graduacao; ?></td>
					<td><?php echo $docente->observacao; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</center>