<div class="row">
	<div class="grid1">
		<label>Curso:* </label>
	</div>
	<div class="grid2">
		<?php 
			echo form_dropdown('id_curso', $cursos, 0, "id='cursoValue' class='required' style='width: 335px;'");
		?>
	</div>
</div>