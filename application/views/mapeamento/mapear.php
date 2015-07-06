<div style="position: absolute; top: 128px;">
	<?php 
		if($this->session->flashdata('cadastrook')):
	?>
			<script>
				setTimeout(function(){
					$('#mapearSucesso').fadeOut(3000);
				}, 4000);
			</script>
			<div id="mapearSucesso" class="alert alert-success fade in" style="width: 1038px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('cadastrook'); ?>
			</div>
	<?php
		endif;
	?>
</div>

<div style="margin-top: 30px;">
	<form  action="<?php echo base_url('mapeamento/mapear');?>" method="post" class="main example3">						
		<div class="whead">
			<strong><?php echo $titulo; ?></strong>
		</div>	
		<div class="box holder">
			<div class="row">
				<div class="grid1">
					<label>Docente:* </label>
				</div>
				<div class="grid2">
					<?php 
						echo form_dropdown('id_docente', $docentes, 0, "id='docenteValue' class='required' style='width: 335px;'");
					?>
				</div>
			</div>
			<div id="cursoAjax">
				
			</div>		
			<div class="row">
				<div class="grid1">
					<label>Perido:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="periodoInicio" id="periodoInicio" class="shiny size5 required green-high">
					<label> à </label>
					<input type="text" name="periodoFim" id="periodoFim" class="shiny size5 required green-high" style="margin-left: 13px;">
				</div>
			</div>			
			<!--<div class="row">
				<div class="grid1">
					<label>Auto </label>
				</div>
				<div class="grid2 auto-tabsa">
					<input type="text" class="shiny size5" maxlength="10">
					<input type="text" class="shiny size5" maxlength="10">
					<input type="text" class="shiny size5" maxlength="6">
					<input type="text" class="shiny size5" maxlength="6">
					<input type="text" class="shiny size5" maxlength="6">
				</div>	
			</div>
		-->
			<div class="row">
				<div class="grid1">
					<label>Horario:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="horarioInicio" id="horarioInicio" class="shiny size5 required green-high">
					<label> à </label>
					<input type="text" name="horarioFim" id="horarioFim" class="shiny size5 required green-high" style="margin-left: 13px;">
				</div>
			</div>			
			<div class="row">
				<div class="grid1">
					<label>Unidade:* </label>
				</div>
				<div class="grid2">
					<?php 
						echo form_dropdown('id_unidade', $unidades, 0, "id='unidadeValue' class='required' style='width: 335px;'");
					?>
				</div>
			</div>	
			<div class="row">
				<div class="grid1">
					<label>Dia da Semana:* </label>
				</div>
				<div class="grid2">
					<span >Domingo: 						  </span><input type="checkbox" name="domingo" value="domingo" id="diaDomingo"/>	
					<span style="margin-left: 25px;">Segunda: </span><input type="checkbox" name="segunda" value="segunda" id="diaSegunda"/>
					<span style="margin-left: 25px;">Terça:   </span><input type="checkbox" name="terca" value="terca" id="diaTerca"/>
					<span style="margin-left: 25px;">Quarta:  </span><input type="checkbox" name="quarta" value="quarta" id="diaQuarta"/>
					<span style="margin-left: 25px;">Quinta:  </span><input type="checkbox" name="quinta" value="quinta" id="diaQuinta"/>
					<span style="margin-left: 25px;">Sexta:   </span><input type="checkbox" name="sexta" value="sexta" id="diaSexta"/>
					<span style="margin-left: 25px;">Sábado:  </span><input type="checkbox" name="sabado" value="sabado" id="diaSabado"/>
				</div>
			</div>				
			<div class="row">
				<div class="grid3">
					<input type="reset" value="Limpar" class="btn">
					<input type="submit" value="Salvar" id="EnviarUsuario" class="submit">
				</div>
			</div>
		</div>
	</form>
</div>