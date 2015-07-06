<div style="position: absolute; top: 128px;">
	<?php 
		if($this->session->flashdata('edicaook')):
	?>
			<script>
				setTimeout(function(){
					$('#docenteSucessoEdicao').fadeOut(3000);
				}, 4000);
			</script>
			<div id="docenteSucessoEdicao" class="alert alert-success fade in" style="width: 1036px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('edicaook'); ?>
			</div>
	<?php
		endif;

		if($this->session->flashdata('erro')):
	?>
			<script>
				setTimeout(function(){
					$('#docenteErroEdicao').fadeOut(3000);
				}, 4000);
			</script>
			<div id="docenteErroEdicao" class="alert alert-error fade in" style="width: 1036px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('erro'); ?>
			</div>
	<?php 
		endif; 
	?>
</div>

<?php 

$idDocente = $this->uri->segment(3);

if($idDocente == null) redirect('docente/listagem');

$docente = $this->DocenteModel->getById($idDocente)->row();

if($docente->id_situacao != 3){
	
?>

<div style="margin-top: 30px;">
	<form  action="<?php echo base_url("docente/editar/$idDocente");?>" method="post" class="main example3">						
		<div class="whead">
			<strong><?php echo $titulo; ?></strong>
		</div>	
		<div class="box holder">
			<div class="row">
				<div class="grid1">
					<label>Nome:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="nome" class="shiny required green-high" value="<?php echo $docente->nome; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Matricula:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="matricula" id="matricula" alt="matricula" class="shiny required green-high" value="<?php echo $docente->matricula; ?>">
				</div>
			</div>	
			<div class="row">
				<div class="grid1">
					<label>Email:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="email" class="shiny required email green-high" value="<?php echo $docente->email; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Telefone:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="telefone" class="shiny required green-high" value="<?php echo $docente->telefone; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Celular:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="celular" class="shiny required green-high" value="<?php echo $docente->celular; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Endereço:* </label>
				</div>
				<div class="grid2">
					<input type="text" name="endereco" class="shiny required green-high" value="<?php echo $docente->endereco; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Lotação: </label>
				</div>
				<div class="grid2">
					<input type="text" name="lotacao" class="shiny green-high" value="<?php echo $docente->lotacao; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Escolaridade:* </label>
				</div>
				<div class="grid2">
					<?php 
						echo form_dropdown('id_escolaridade', $escolaridade ,$docente->id_escolaridade, "class='required'");
					?>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Eixo:* </label>
				</div>
				<div class="grid2">
					<?php 
						echo form_dropdown('id_eixo', $eixo, $docente->id_eixo, "class='required'");
					?>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Hora Aula:*</label>
				</div>
				<div class="grid2">
					<input type="text" name="hora_aula" class="shiny required green-high" value="<?php echo $docente->hora_aula; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Graduação:* </label>
				</div>
				<div class="grid2">
					<textarea name="graduacao" cols="30" rows="10" class="shiny required no-resize green-high"><?php echo $docente->graduacao; ?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Data de Admissão:* </label>
				</div>
				<div class="grid2">
					<?php 
						$date = explode('-', $docente->data_admissao);

					    $ano = $date[0];
					    $mes = $date[1];
					    $dia = $date[2];

					    $docente->data_admissao = $dia.'/'.$mes.'/'.$ano;
					?>
					<input type="text" name="data_admissao" id="dataAdmissao" class="shiny required green-high" value="<?php echo $docente->data_admissao; ?>">
				</div>
			</div>
			<div class="row">
				<div class="grid1">
					<label>Observação: </label>
				</div>
				<div class="grid2">
					<textarea name="observacao" cols="30" rows="10" class="shiny no-resize green-high"><?php echo $docente->observacao ?></textarea>
				</div>
			</div>					
			<div class="row">
				<div class="grid3">
					<input type="reset" value="Limpar" class="btn">
					<input type="submit" value="Salvar" class="submit">
				</div>
			</div>		
		</div>
	</form>
</div>
<?php 
}else{

	if($docente->id_situacao == 3){
		redirect('docente/docentesDemitidos');
	}
}
?>
