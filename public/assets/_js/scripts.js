/*
	Scripts genéricos usados para todas as páginas

	Índice de funções para esse arquivo:
	* site.init();
	* site.init_events();
*/


// Remover os console.log do site ao colocar em produção
/*if(typeof(console) === 'undefined') {
	var console = {};
	console.log = console.error = console.info = console.debug = console.warn = console.trace = console.dir = console.dirxml = console.group = console.groupEnd = console.time = console.timeEnd = console.assert = console.profile = function() {};

} else {
	console.log = function() { return false; };
}*/



// Transformando site, base_url e template_url em variáveis globais
var site,
	$script_default,
	base_url,
	template_url;

(function( window, document, $, undefined ) {

	"use strict";

	site = (function() {

		$script_default = $( '#script-default' );
		base_url        = $script_default.data( 'base-url' );
		template_url    = $script_default.data( 'template-url' );

		return {

			/*--------------------------------------------------------------------------------------
			 *
			 * @name: init()
			 * @description: Todas as funções que devem iniciar ao carregar o site
			 *
			 *-------------------------------------------------------------------------------------*/
			init : function() {

				console.log( 'carregou /assets/_js/scripts.js' );

				// IE
				/*$.browser = {};
				(function () {
					$.browser.msie = false;
					$.browser.version = 0;
					if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
						$.browser.msie = true;
						$.browser.version = RegExp.$1;
					}
				})();

				if ($.browser.msie && $.browser.version == 10) {
					$("html").addClass("ie10");
				}
				*/

				site.init_events();

			}, // init










			/*--------------------------------------------------------------------------------------
			 *
			 * @name: init_events
			 * @description: Eventos
			 *
			 *-------------------------------------------------------------------------------------*/
			init_events : function() {

				// Remove o click de links com hash (#) no href
				$( 'a[href="#"], a[data-ng-click]' ).on('click', function(e) {
					e.preventDefault();
				});

			} // init_events

		}; // return
	})(); // site



	// DOM Loaded
	$(function() {
		site.init();

		messages.init();

		$(window).on('load', function () {
			$('body').fadeIn();
		});

	});

})( window, document, jQuery );