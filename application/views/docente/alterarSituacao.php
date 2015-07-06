<div style="margin-top: 30px;">
	<form  action="<?php echo base_url('docente/alterarSituacao');?>" method="post" class="main example3">						
		<div class="whead">
			<strong><?php echo $titulo; ?></strong>
		</div>	
		<div class="box holder">
			<div class="row">
				<div class="grid1">
					<label>Nome:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="nome" class="shiny required green-high" value="<?php echo $docente->nome; ?>" disabled="disabled">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Matricula:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="matricula" id="matricula" alt="matricula" class="shiny required green-high" value="<?php echo $docente->matricula; ?>" disabled="disabled">
				</div>
			</div>			
			<div class="row">
				<div class="grid1">
					<label>Situação:* </label>
				</div>
				<div class="grid2">
					<?php 
						echo form_dropdown('id_situacao', $situacao, $docente->id_situacao, "class='required' id='idAlterarSituacao'");
					?>
				</div>
			</div>
			<div id="divPeriodoFerias">
				
			</div>			
			<div class="row">
				<div class="grid1">
					<label>Observação: </label>
				</div>
				<div class="grid2">
					<textarea name="observacao" cols="30" rows="10" class="shiny no-resize green-high"></textarea>
				</div>
			</div>					
			<div class="row">
				<div class="grid3">
					<input type="hidden" name='id_docente' value="<?php echo $docente->id;?> ">
					<input type="hidden" name='idSituacaoRedirect' value="<?php echo $docente->id_situacao;?> ">
					<input type="reset" value="Limpar" class="btn">
					<input type="submit" value="Salvar" class="submit">
				</div>
			</div>		
		</div>
	</form>
</div>

