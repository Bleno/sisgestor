<ul class="ch-grid square">
	
	<!--<li class="tip" title="">-->
	<?php if($this->session->userdata('id_perfil') != 2): ?>
	<li>
		<div class="ch-item">				
			<div class="ch-info-wrap">
				<div class="ch-info">
					<div class="ch-info-front ch-img-3"></div>
					<div class="ch-info-back">
						<h3><a href="<?php echo base_url('usuario/cadastrar'); ?> "><p style="color: #FFFFFF;">Cadastro de Usuário</p></a></h3>
					</div>	
				</div>
			</div>
		</div>
	</li>
	<?php endif; ?>
	
	<li>
		<div class="ch-item">
			<div class="ch-info-wrap">
				<div class="ch-info">
					<div class="ch-info-front ch-img-1"></div>
					<div class="ch-info-back">
						<h3><a href="<?php echo base_url('curso/cadastrar'); ?> "><p style="color: #FFFFFF;">Cadastro de Curso</p></a></h3>
					</div>
				</div>
			</div>
		</div>
	</li>
	
	<li>
		<div class="ch-item">
			<div class="ch-info-wrap">
				<div class="ch-info">
					<div class="ch-info-front ch-img-2"></div>
					<div class="ch-info-back">
						<h3><a href="<?php echo base_url('unidade/cadastrar'); ?> "><p style="color: #FFFFFF;">Cadastro de Unidade</p></a></h3>
					</div>
				</div>
			</div>
		</div>
	</li>
	
	<li class="tip" title="Place some additional information in here">
		<div class="ch-item">
			<div class="ch-info-wrap">
				<div class="ch-info">
					<div class="ch-info-front ch-img-4"></div>
					<div class="ch-info-back">
						<h3><a href="<?php echo base_url('docente/cadastrar'); ?> "><p style="color: #FFFFFF;">Cadastro de Docente</p></a></h3>
					</div>
				</div>
			</div>
		</div>
	</li>
	
	<li>
		<div class="ch-item">
			<div class="ch-info-wrap">
				<div class="ch-info">
					<div class="ch-info-front ch-img-5"></div>
					<div class="ch-info-back">
						<h3><a href="<?php echo base_url('mapeamento/mapear'); ?> "><p style="color: #FFFFFF;">Mapear Docente</p></a></h3>
					</div>
				</div>
			</div>
		</div>
	</li>
	
</ul>