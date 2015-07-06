$(document).ready(function(){

	/*
		Tela de Login
	*/

	//Após clicar no botão de logar será executado essa função
	$('#logar').click(function(){

		//Pega os valores das inputs
		var login = $('#login').val();
		var senha = $('#senha').val();

		//Verifica se os campos estão vazios
		if(login == '' && senha == ''){

			/*
				Estando os campos vazios, e aplicado um css nas inputs avisando
			 	a o usuario que os campos estão vazios
			 */
			$('#login, #senha').css('background', '#ffc4c4');		

			//Função que retira o css aplicado né um intervalo de 3 segundos
			setTimeout(function(){
				$('#login, #senha').removeAttr('style');
			}, 3000);

			//retorna falso para não ser mais executado
			return false;
		}

		//Verifica se o campos input-username esta vazio
		if(login == ''){

			$('#login').css('background', '#ffc4c4');		

			setTimeout(function(){
				$('#login').removeAttr('style');
			}, 3000);

			return false;
		}

		if(senha == ''){

			$('#senha').css('background', '#ffc4c4');

			setTimeout(function(){
				$('#senha').removeAttr('style');
			}, 3000);

			return false;
		}
	});

	/*
		Tela de Usuario
	*/

	//Nivel de senha
	$('#senha').pstrength();

	$('#confirmiSenha').blur(function(){

		var senha 		  = $('#senha').val();
		var confirmiSenha = $('#confirmiSenha').val();

		if(senha != confirmiSenha){

			$('#senhaDiferente').fadeIn('slow');
			
			setTimeout(function(){
				$('#senhaDiferente').fadeOut('slow');
			}, 3000);

			return false;
		}
	});

	$('#EnviarUsuario').click(function(e){

		var senha 		  = $('#senha').val();
		var confirmiSenha = $('#confirmiSenha').val();
		
		if(senha != confirmiSenha){

			$('#senhaDiferente').fadeIn('slow');
			
			setTimeout(function(){
				$('#senhaDiferente').fadeOut('slow');
			}, 3000);

			return false;
		}
	});

	/*
		Tela de Docente
	*/

	//$('#matricula').setMask();

	$('#dataAdmissao, #periodoInicio, #periodoFim').datepicker({
		showAnim: "slide",		
	    dateFormat: 'dd/mm/yy',
	    dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
	    monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ]
	});

	$('#horarioInicio, #horarioFim').timepicker({
		hourText: 'Hora',
        minuteText: 'Minuto',
        showAnim: 'blind',
        showPeriodLabels: false
    });

    $('#unidadeValue').change(function(){

    	var idDocente 	  = $('#docenteValue').val();
    	var idCurso 	  = $('#cursoValue').val();
    	var idUnidade 	  = $('#unidadeValue').val();
    	var periodoInicio = $('#periodoInicio').val();
    	var periodoFim    = $('#periodoFim').val();
    	var horarioInicio = $('#horarioInicio').val();
    	var horarioFim 	  = $('#horarioFim').val();

    	$.ajax({
    		url: 'http://sisgestor/mapeamento/confereDocente',
    		type: 'post',
    		dataType: 'json',
    		data: {'idDocente' : idDocente, 'idCurso' : idCurso, 'idUnidade' : idUnidade, 'periodoInicio' : periodoInicio, 'periodoFim' : periodoFim, 'horarioInicio': horarioInicio, 'horarioFim' : horarioFim },
    		success: function(data){

    			//console.log(data);

    			if(data.resp == false){
    				$('#domingo').removeClass('disabled');
    				$('#segunda').removeClass('disabled');
    				$('#terca').removeClass('disabled');
    				$('#quarta').removeClass('disabled');
    				$('#quinta').removeClass('disabled');
    				$('#sexta').removeClass('disabled');
    				$('#sabado').removeClass('disabled');
    			}

    			for(var i = 0; i < data.length; i++){

    				if(data[i].domingo == 1){
	    				$('#domingo').addClass('disabled');
	    			}else{
	    				$('#domingo').removeClass('disabled');
	    			}

	    			if(data[i].segunda == 1){
	    				$('#segunda').addClass('disabled');
	    			}else{
	    				$('#segunda').removeClass('disabled');
	    			}

	    			if(data[i].terca == 1){
	    				$('#terca').addClass('disabled');
	    			}else{
	    				$('#terca').removeClass('disabled');
	    			}

	    			if(data[i].quarta == 1){
	    				$('#quarta').addClass('disabled');
	    			}else{
	    				$('#quarta').removeClass('disabled');
	    			}

	    			if(data[i].quinta == 1){
	    				$('#quinta').addClass('disabled');
	    			}else{
	    				$('#quinta').removeClass('disabled');
	    			}

	    			if(data[i].sexta == 1){
	    				$('#sexta').addClass('disabled');
	    			}else{
	    				$('#sexta').removeClass('disabled');
	    			}

	    			if(data[i].sabado == 1){
	    				$('#sabado').addClass('disabled');
	    			}else{
	    				$('#sabado').removeClass('disabled');
	    			}	
    			}
    		}
    	});
    });

$('#periodoInicio, #periodoFim, #horarioInicio, #horarioFim').change(function(){

    	var idDocente 	  = $('#docenteValue').val();
    	var idCurso 	  = $('#cursoValue').val();
    	var idUnidade 	  = $('#unidadeValue').val();
    	var periodoInicio = $('#periodoInicio').val();
    	var periodoFim    = $('#periodoFim').val();
    	var horarioInicio = $('#horarioInicio').val();
    	var horarioFim 	  = $('#horarioFim').val();

    	$.ajax({
    		url: 'http://sisgestor/mapeamento/confereDocente',
    		type: 'post',
    		dataType: 'json',
    		data: {'idDocente' : idDocente, 'idCurso' : idCurso, 'idUnidade' : idUnidade, 'periodoInicio' : periodoInicio, 'periodoFim' : periodoFim, 'horarioInicio': horarioInicio, 'horarioFim' : horarioFim },
    		success: function(data){

    			//console.log(data);

    			if(data.resp == false){
    				$('#domingo').removeClass('disabled');
    				$('#segunda').removeClass('disabled');
    				$('#terca').removeClass('disabled');
    				$('#quarta').removeClass('disabled');
    				$('#quinta').removeClass('disabled');
    				$('#sexta').removeClass('disabled');
    				$('#sabado').removeClass('disabled');
    			}

    			for(var i = 0; i < data.length; i++){

    				if(data[i].domingo == 1){
	    				$('#domingo').addClass('disabled');
	    			}else{
	    				$('#domingo').removeClass('disabled');
	    			}

	    			if(data[i].segunda == 1){
	    				$('#segunda').addClass('disabled');
	    			}else{
	    				$('#segunda').removeClass('disabled');
	    			}

	    			if(data[i].terca == 1){
	    				$('#terca').addClass('disabled');
	    			}else{
	    				$('#terca').removeClass('disabled');
	    			}

	    			if(data[i].quarta == 1){
	    				$('#quarta').addClass('disabled');
	    			}else{
	    				$('#quarta').removeClass('disabled');
	    			}

	    			if(data[i].quinta == 1){
	    				$('#quinta').addClass('disabled');
	    			}else{
	    				$('#quinta').removeClass('disabled');
	    			}

	    			if(data[i].sexta == 1){
	    				$('#sexta').addClass('disabled');
	    			}else{
	    				$('#sexta').removeClass('disabled');
	    			}

	    			if(data[i].sabado == 1){
	    				$('#sabado').addClass('disabled');
	    			}else{
	    				$('#sabado').removeClass('disabled');
	    			}	
    			}
    		}
    	});
    });

	$('table').delegate('.inativarUsuario', 'click', function(){

		var resp = confirm('Deseja realmente desabilitar este registro ?');

		if(resp){
			return true;
		}else{
			return false;
		}
	});

	$('table').delegate('.ativarUsuario', 'click', function(){

		var resp = confirm('Deseja realmente habilitar este registro ?');

		if(resp){
			return true;
		}else{
			return false;
		}
	});

	$('table').delegate('.inativarCurso', 'click', function(){

		var resp = confirm('Deseja realmente desabilitar este registro ?');

		if(resp){
			return true;
		}else{
			return false;
		}
	});

	$('table').delegate('.ativarCurso', 'click', function(){

		var resp = confirm('Deseja realmente habilitar este registro ?');

		if(resp){
			return true;
		}else{
			return false;
		}
	});

	$('table').delegate('.inativarUnidade', 'click', function(){

		var resp = confirm('Deseja realmente desabilitar este registro ?');

		if(resp){
			return true;
		}else{
			return false;
		}
	});

	$('table').delegate('.ativarUnidade', 'click', function(){

		var resp = confirm('Deseja realmente habilitar este registro ?');

		if(resp){
			return true;
		}else{
			return false;
		}
	});

	$('table').delegate('#desabilitarMapeamento', 'click', function(){

		var resp = confirm('Deseja realmente desabilitar este registro ?');

		if(resp){
			return true;
		}else{
			return false;
		}
	});

	$('#idAlterarSituacao').change(function(){

		var id_situacao = $(this).val();

		$.ajax({
			url: 'http://sisgestor/docente/periodoFerias',
			type: 'post',
			dataType: 'html',
			success: function(data){
				if(id_situacao == 2 || id_situacao == 4){
					$('#divPeriodoFerias').html(data);
				}else{
					$('#divPeriodoFerias').html('');
				}
			} 
		});
	});

	//Configuração do dialog
	$('#docentesAtivosDetalhes').dialog({
		autoOpen: false,
		title: 'Detalhes',
		modal: true,
		width: 1305,
		height: 157,
	});

	$('table').delegate('#docenteDetalhes', 'click', function(){
		//Abre o dialog
		$('#docentesAtivosDetalhes').dialog('open');
		return false;
	});

	$('table').delegate('#docenteDetalhes', 'click', function(){

		var id_docente = $(this).attr('rel');

		$.ajax({
			url: 'http://sisgestor/docente/detalhesDocente',
			type: 'post',
			dataType: 'html',
			data: {'id_docente' : id_docente},
			success: function(data){
				$('#docentesAtivosDetalhes').html(data);
			}
		});
	});

	$('#docenteValue').change(function(){

		var id_docente = $(this).val();

		$.ajax({
			url: 'http://sisgestor/mapeamento/cursoAjax',
			type: 'post',
			dataType: 'html',
			data: {'id_docente' : id_docente},
			success: function(data){
				$('#cursoAjax').html(data);
			}
		});
	});
	
	//Configuração do dialog
	$('#detalhesMapeamento').dialog({
		autoOpen: false,
		title: 'Detalhes',
		modal: true,
		width: 1130,
		height: 160,
	});

	$('table').delegate('#mapeamentoDetalhes', 'click', function(){
		//Abre o dialog
		$('#detalhesMapeamento').dialog('open');
		return false;
	});

	$('table').delegate('#mapeamentoDetalhes', 'click', function(){

		var id_mapeamento = $(this).attr('rel');

		$.ajax({
			url: 'http://sisgestor/mapeamento/detalhesMapeamento',
			type: 'post',
			dataType: 'html',
			data: {'id_mapeamento' : id_mapeamento},
			success: function(data){
				$('#detalhesMapeamento').html(data);
			}
		});
	});

	var id_docenteE = $('#docenteValueEditar').val();

	$.ajax({
		url: 'http://sisgestor/mapeamento/cursoAjax',
		type: 'post',
		dataType: 'html',
		data: {'id_docenteE' : id_docenteE},
		success: function(data){
			$('#cursoAjaxEditar').html(data);
		}
	});


});