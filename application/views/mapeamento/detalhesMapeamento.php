<center>
	<div class="box holder tblr twhite" style="width: 1103px;">
		<table>
			<thead>
				<tr>
					<th style="width: 75px;">Domingo</th>
					<th style="width: 75px;">Segunda</th>
					<th style="width: 75px;">Terça</th>
					<th style="width: 75px;">Quarta</th>
					<th style="width: 75px;">Quinta</th>
					<th style="width: 75px;">Sexta</th>
					<th style="width: 75px;">Sabado</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><center><input type="checkbox" disabled="disabled" <?php echo $detalhes[0]->domingo == 1 ? 'checked="checked"' : ''; ?>></center></td>
					<td><center><input type="checkbox" disabled="disabled" <?php echo $detalhes[0]->segunda == 1 ? 'checked="checked"' : ''; ?>></center></td>	
					<td><center><input type="checkbox" disabled="disabled" <?php echo $detalhes[0]->terca   == 1 ? 'checked="checked"' : ''; ?>></center></td>
					<td><center><input type="checkbox" disabled="disabled" <?php echo $detalhes[0]->quarta  == 1 ? 'checked="checked"' : ''; ?>></center></td>
					<td><center><input type="checkbox" disabled="disabled" <?php echo $detalhes[0]->quinta  == 1 ? 'checked="checked"' : ''; ?>></center></td>
					<td><center><input type="checkbox" disabled="disabled" <?php echo $detalhes[0]->sexta   == 1 ? 'checked="checked"' : ''; ?>></center></td>
					<td><center><input type="checkbox" disabled="disabled" <?php echo $detalhes[0]->sabado  == 1 ? 'checked="checked"' : ''; ?>></center></td>	
				</tr>	
			</tbody>
		</table>
	</div>
</center>