/*global $:false*/

$(document).ready(function() {
	
	"use strict";
	
	// login form
	$('.form-signin button').click(function() {
		$(this).addClass('loading').html('Aguarde...')
		.animate({'background-position': -150},5000,'linear');
		setTimeout(function() {
			window.location.href = 'http://sisgestor/login/logar';
		}, 1000 );
		//return false;
	});
	
});