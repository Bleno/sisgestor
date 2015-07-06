<?php 

$idMapeamento = $this->uri->segment(3);

if($idMapeamento == null) redirect('mapeamento/listagem');

$mapeamento = $this->MapeamentoModel->getById($idMapeamento)->row();

?>
<div style="position: absolute; top: 128px;">
	<?php 
		if($this->session->flashdata('edicaook')):
	?>
			<script>
				setTimeout(function(){
					$('#mapearSucessoEditar').fadeOut(3000);
				}, 4000);
			</script>
			<div id="mapearSucessoEditar" class="alert alert-success fade in" style="width: 1038px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('edicaook'); ?>
			</div>
	<?php
		endif;
	?>
</div>

<div style="margin-top: 30px;">
	<form  action="<?php echo base_url("mapeamento/editar/$idMapeamento");?>" method="post" class="main example3">						
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
						echo form_dropdown('id_docente', $docentes, $mapeamento->id_docente, "id='docenteValueEditar' class='required' style='width: 335px;' disabled='disabled'");
					?>
				</div>
			</div>
			<div id="cursoAjaxEditar">
				
			</div>		
			<div class="row">
				<div class="grid1">
					<label>Perido:* </label>
				</div>
				<div class="grid2">
					<?php 

						$dateI = explode('-', $mapeamento->periodoInicio);
						$dateF = explode('-', $mapeamento->periodoFim);

					    $diaI = $dateI[2];
					    $mesI = $dateI[1];
					    $anoI = $dateI[0];


					    $diaF = $dateF[2];
					    $mesF = $dateF[1];
					    $anoF = $dateF[0];

					    $mapeamento->periodoInicio = $diaI.'/'.$mesI.'/'.$anoI;
					    $mapeamento->periodoFim    = $diaF.'/'.$mesF.'/'.$anoF;
					?>
					<input type="text" name="periodoInicio" id="periodoInicio" value="<?php echo $mapeamento->periodoInicio;?>" class="shiny size5 required green-high">
					<label> à </label>
					<input type="text" name="periodoFim" id="periodoFim" value="<?php echo $mapeamento->periodoFim;?>" class="shiny size5 required green-high" style="margin-left: 13px;">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Horario:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="horarioInicio" id="horarioInicio" value="<?php echo $mapeamento->horarioInicio; ?>" class="shiny size5 required green-high">
					<label> à </label>
					<input type="text" name="horarioFim" id="horarioFim" value="<?php echo $mapeamento->horarioFim; ?>" class="shiny size5 required green-high" style="margin-left: 13px;">
				</div>
			</div>			
			<div class="row">
				<div class="grid1">
					<label>Unidade:* </label>
				</div>
				<div class="grid2">
					<?php 
						echo form_dropdown('id_unidade', $unidades, $mapeamento->id_unidade, "id='unidadeValue' class='required' style='width: 335px;'");
					?>
				</div>
			</div>	
			<div class="row">
				<div class="grid1">
					<label>Dia da Semana:* </label>
				</div>
				<div class="grid2">
					<span >Domingo: 						  </span><input type="checkbox" <?php echo $mapeamento->domingo == 1 ? 'checked="checked"' : ''; ?> name="domingo" value="domingo" id="diaDomingo"/>	
					<span style="margin-left: 25px;">Segunda: </span><input type="checkbox" <?php echo $mapeamento->segunda == 1 ? 'checked="checked"' : ''; ?> name="segunda" value="segunda" id="diaSegunda"/>
					<span style="margin-left: 25px;">Terça:   </span><input type="checkbox" <?php echo $mapeamento->terca   == 1 ? 'checked="checked"' : ''; ?> name="terca" value="terca" id="diaTerca"/>
					<span style="margin-left: 25px;">Quarta:  </span><input type="checkbox" <?php echo $mapeamento->quarta  == 1 ? 'checked="checked"' : ''; ?> name="quarta" value="quarta" id="diaQuarta"/>
					<span style="margin-left: 25px;">Quinta:  </span><input type="checkbox" <?php echo $mapeamento->quinta  == 1 ? 'checked="checked"' : ''; ?> name="quinta" value="quinta" id="diaQuinta"/>
					<span style="margin-left: 25px;">Sexta:   </span><input type="checkbox" <?php echo $mapeamento->sexta   == 1 ? 'checked="checked"' : ''; ?> name="sexta" value="sexta" id="diaSexta"/>
					<span style="margin-left: 25px;">Sábado:  </span><input type="checkbox" <?php echo $mapeamento->sabado  == 1 ? 'checked="checked"' : ''; ?> name="sabado" value="sabado" id="diaSabado"/>
				</div>
			</div>				
			<div class="row">
				<div class="grid3">
					<input type="reset" value="Limpar" class="btn">
					<input type="submit" value="Salvar" id="EnviarUsuario" class="submit">
					<input type="hidden" name="idMapeamento" value="<?php echo $idMapeamento; ?>">
				</div>
			</div>
		</div>
	</form>
</div>