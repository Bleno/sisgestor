<div style="position: absolute; top: 128px;">
	<?php 
		if($this->session->flashdata('cadastrook')):
	?>
			<script>
				$(document).ready(function(){

					setTimeout(function(){
						$('#usuarioSucesso').fadeOut(3000);
					}, 4000);

				});
			</script>
			<div class="alert alert-success fade in" id="usuarioSucesso" style="width: 1036px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('cadastrook'); ?>
			</div>
	<?php
		endif;
	?>
</div>

<div style="margin-top: 30px;">
	<form  action="<?php echo base_url('docente/cadastrar');?>" method="post" class="main example3">						
		<div class="whead">
			<strong><?php echo $titulo; ?></strong>
		</div>	
		<div class="box holder">
			<div class="row">
				<div class="grid1">
					<label>Nome:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="nome" class="shiny required green-high" autofocus>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Matricula:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="matricula" id="matricula" alt="matricula" class="shiny required green-high" maxlength="6">
				</div>
			</div>	
			<div class="row">
				<div class="grid1">
					<label>Email:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="email" class="shiny required email green-high">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Telefone:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="telefone" class="shiny required green-high">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Celular:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="celular" class="shiny required green-high">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Endereço:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="endereco" class="shiny required green-high">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Lotação: </label>
				</div>
				<div class="grid2">
					<input type="text" name="lotacao" class="shiny green-high">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Escolaridade:* </label>
				</div>
				<div class="grid2">
					<?php 
						echo form_dropdown('id_escolaridade', $escolaridade, 0, "class='required'");
					?>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Eixo:* </label>
				</div>
				<div class="grid2">
					<?php 
						echo form_dropdown('id_eixo', $eixo, 0, "class='required'");
					?>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Hora Aula:*</label>
				</div>
				<div class="grid2">
					<input type="text" name="hora_aula" class="shiny required green-high">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Graduação:* </label>
				</div>
				<div class="grid2">
					<textarea name="graduacao" cols="30" rows="10" class="shiny required no-resize green-high"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Data de Admissão:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="data_admissao" id="dataAdmissao" class="shiny required green-high">
				</div>
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
					<input type="hidden" name='id_usuario' value="<?php echo $this->session->userdata('id');?> ">
					<input type="reset" value="Limpar" class="btn">
					<input type="submit" value="Salvar" class="submit">
				</div>
			</div>		
		</div>
	</form>
</div>

