<div class="row">
	<div class="grid1">
		<label>Curso:* </label>
	</div>
	<div class="grid2">
		<?php
			$docente = $this->MapeamentoModel->getById($id_docente)->row();

			echo form_dropdown('id_curso', $cursos, $docente->id_curso, "id='cursoValue' class='required' style='width: 335px;'");
		?>
	</div>
</div>