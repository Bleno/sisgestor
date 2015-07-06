<div class="row">
	<div class="grid1">
		<label>Perido:* </label>
	</div>
	<div class="grid2 auto-tabs">
		<input type="text" name="periodoInicio" id="periodoInicio" class="shiny size5 required green-high">
		<label> à </label>
		<input type="text" name="periodoFim" id="periodoFim" class="shiny size5 required green-high" style="margin-left: 13px;">
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#periodoInicio, #periodoFim').datepicker({
		showAnim: "slide",		
	    dateFormat: 'dd/mm/yy',
	    dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
	    monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ]
	});
});
</script>