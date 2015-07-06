<!DOCTYPE html>
<!--[if lt IE 9]>      <html lang="en" class="ie"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	
	<!-- meta -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" >
	<meta name="keywords" content="spookynet.org, webdesignlab.org " /> 
	<!-- favicon -->
	<link rel="shortcut icon" href="img/favicon.png" type="image/png">
	
	<!-- page title -->
	<title><?php echo $titulo; ?></title>
	
	<!-- css -->
	<link href="<?php echo base_url('public/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('public/css/bootstrap-responsive.css'); ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('public/css/vendor/circle.hover.css'); ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('public/css/vendor/fullcalendar.css'); ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('public/css/vendor/sourcerer.css'); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url('public/css/vendor/prettify.css'); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url('public/css/vendor/jquery.mcustomscrollbar.css'); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url('public/css/vendor/jquery.gritter.css'); ?>" type="text/css" rel="stylesheet" >
	<link href="<?php echo base_url('public/css/main.css'); ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('public/css/media.css'); ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('public/css/sisgestor.css'); ?>" >
	<link href="<?php echo base_url('public/css/vendor/jquery-ui.css'); ?>" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url('public/css/ui/jquery-ui-1.10.3.custom.css'); ?>" rel="stylesheet" type="text/css" >

	<!-- DatePicker-->
	<link rel="stylesheet" href="<?php echo base_url('public/css/jquery.ui.timepicker.css?v=0.3.2" type="text/css'); ?>" />

	<!-- layout appearance -->
    <script src="<?php echo base_url('public/js/vendor/jquery-1.9.0.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/js/appearance.js'); ?>"></script>

</head>
<body>
	
<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		
		<!-- gotop -->
<!--<div id="gotop"></div>-->

<!-- top navigation bar -->
<span class="accent-1"></span>

<div class="navbar navbar-fixed-top">
  
	<a href="dashboard.html">
		<div id="logo"></div>
	</a>
	
	<!-- header navigation -->
	<nav class="nav">
		<ul>
			<!--<li><a href="javascript:void(0);">Admin settings</a></li>-->
			<li><a href="<?php echo base_url('login/changePassword'); ?>">Alterar senha</a></li>
			<!--<li><a href="javascript:void(0);">Permissions</a></li>-->
			<!--<li><a href="javascript:void(0);">More options</a></li>-->
			<li><a href="javascript:void(0);" style="margin-left: 730px;"><span>Seja bem vindo(a): <?php echo $this->session->userdata('nome'); ?></span></a></li>
		</ul>
	</nav>
	
	<!-- right part header icons -->
	<ul class="user-nav">
		<!--
			<li><a href="#" data-placement="bottom" class="icon-status tip" title="Check stats"></a></li>
			<li><a href="#" data-placement="bottom" class="icon-user tip" title="User area"></a></li>
			<li><a href="#" data-placement="bottom" class="icon-dialog tip" title="Some information"></a></li>
		-->
		<li><a href="<?php echo base_url('login/logout'); ?>" data-placement="bottom" class="icon-logout tip" title="Logout"></a></li>
	</ul>
	
	<!-- search sidebar -->
	<div class="search-box right-bar"></div>
	
	<!-- appearance sidebar -->
	<div id="pickup" class="right-bar">
		
		<span class="dotted"></span>
		
		<div class="side-wrap top-10">
			<p class="top-10">Admin background patterns:</p>
			<ul class="pattern">
				<li><a class="default active tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="1" href="javascript:;">1</a></li>
				<li><a class="default tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="2" href="javascript:;">2</a></li>
				<li><a class="default tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="3" href="javascript:;">3</a></li>
				<li><a class="default tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="4" href="javascript:;">4</a></li>
				<li><a class="default tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="5" href="javascript:;">5</a></li>
				<li><a class="default tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="6" href="javascript:;">6</a></li>
				<li><a class="default tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="7" href="javascript:;">7</a></li>
				<li><a class="default tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="8" href="javascript:;">8</a></li>
				<li><a class="default tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="9" href="javascript:;">9</a></li>
				<li><a class="default tip" title="Default" data-toggle="tooltip" data-placement="bottom" data-pick="10" href="javascript:;">10</a></li>
			</ul>
		</div>
		
		<span class="dotted"></span>
	</div>
 
</div>


<!-- sidebar -->
<div class="sidebar-nav">
	
	<div id="user-box">
		
	</div>
	
	<a class="prof-pic right-open" href="javascript:;" data-href="#user-settings">
		<img src="<?php echo base_url('public/img/__tmp/sidebar.png'); ?>" alt="">
	</a>
	
	<!-- sidebar navigation -->
	<ul id="navigation">
		<li><a class="active" href="<?php echo base_url('indexx/index'); ?> "><i class="nav-dashboard"></i>Inicio</a></li>
		<?php
			if($this->session->userdata('id_perfil') == 1):			
		?>
		<li>
			<a href="javascript:;"><i class="nav-ui"></i>Usuario<span>2</span></a>
			<ul>
				<li><a href="<?php echo base_url('usuario/cadastrar'); ?>">Cadastrar</a></li>
				<li><a href="<?php echo base_url('usuario/listagem'); ?>">Listagem</a></li>
			</ul>
		</li>
		<?php 
			endif;
		?>
		<li>
			<a href="javascript:;"><i class="nav-typography"></i>Curso<span>2</span></a>
			<ul>
				<li><a href="<?php echo base_url('curso/cadastrar'); ?>">Cadastrar</a></li>
				<li><a href="<?php echo base_url('curso/listagem'); ?>">Listagem</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"><i class="nav-forms"></i>Unidade<span>2</span></a>
			<ul>
				<li><a href="<?php echo base_url('unidade/cadastrar'); ?> ">Cadastrar</a></li>
				<li><a href="<?php echo base_url('unidade/listagem'); ?> ">Listagem</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"><i class="nav-user"></i>Docente<span>5</span></a>
			<ul>
				<li><a href="<?php echo base_url('docente/cadastrar'); ?>">Cadastrar</a></li>
				<li><a href="<?php echo base_url('docente/docentesAtivos'); ?>">Docentes Ativos</a></li>
				<li><a href="<?php echo base_url('docente/docentesFerias'); ?>">Docentes de Ferias</a></li>
				<li><a href="<?php echo base_url('docente/docentesEncostados'); ?>">Docentes Encostados</a></li>
				<li><a href="<?php echo base_url('docente/docentesDemitidos'); ?>">Docentes Demitido</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"><i class="nav-tables"></i>Mapeamento<span>2</span></a>
			<ul>
				<li><a href="<?php  echo base_url('mapeamento/mapear')?>">Mapear</a></li>
				<li><a href="<?php  echo base_url('mapeamento/listagem')?>">Listagem de Mapeamento</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"><i class="nav-pdf"></i>PDF<span>2</span></a>
			<ul>
				<li><a href="<?php  echo base_url('pdf/pdfGeral')?>">Mapeamento Geral</a></li>
				<li><a href="<?php  echo base_url('pdf/pdfFiltro')?>">Filtrar Mapeamento</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"><i class="nav-excel"></i>Excel<span>2</span></a>
			<ul>
				<li><a href="<?php  echo base_url('excel/excelGeral')?>">Mapeamento Geral</a></li>
				<!--<li><a href="<?php  //echo base_url('excel/excelFiltro')?>">Filtrar Mapeamento</a></li>-->
			</ul>
		</li>
		<!--
		<li><a href="typography.html"><i class="nav-typography"></i>Typography</a></li>
		<li><a href="charts.html"><i class="nav-chart"></i>Charts and Graphs</a></li>
		
		<li><a href="javascript:;" class="right-open" data-href="#pickup"><i class="nav-color"></i>Aparencia</a></li>
		
		<li>
			<a href="javascript:;"><i class="nav-pages"></i>Other pages<span>5</span></a>
			<ul>
				<li><a href="search.html">Search page</a></li>
				<li><a href="404.html">404 page</a></li>
				<li><a href="messaging.html">Messages</a></li>
				<li><a href="grid.html">Grid layout</a></li>
				<li><a href="blanc_page.html">Blanc page</a></li>
			</ul>
		</li>
		-->
	</ul>
</div>