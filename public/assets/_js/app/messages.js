;(function( window, document, undefined ) {

	'use strict';

	var messages = (function() {

		var $private = {};
		var $public = {};





		// -----------------------------------

		/**
		 * Private Methods
		 */

		/**
		 * Init events
		 */
		$private._initEvents = function() {

			console.log('$private._initEvents();');

			$("table.table-messages input[type='checkbox']").on('switchChange.bootstrapSwitch', function(event, state) {
				var id = $(this).attr('data-id');
				console.log('id:', id);
				console.log('state:', state);

				$.ajax({
					url: base_url + 'home/change_status',
					type: 'post',
					data: {
						id: id,
						state: state
					},
					success: function(data) {
						console.log('success');
					},
					error: function() {
						console.log('error');
					},
					complete: function() {
						console.log('finish');
					}
				});
			});

			$("a.remove-message").on('click', function (event) {
				event.preventDefault();

				var url = this.href;
				var $el = $(this);

				var id = $(this).attr('data-id');
				console.log('id:', id);

				$.ajax({
					url: url,
					type: 'post',
					data: {
						id: id
					},
					success: function(data) {

						console.log('success');

						$el.closest('tr').fadeOut();

					},
					error: function() {
						console.log('error');
					},
					complete: function() {
						console.log('finish');
					}
				});

			});

			$("a.view-message").on('click', function () {

				var id = $(this).attr('data-id');
				$private._viewMessage(id);

			});

		};

		$private._viewMessage = function(id) {

			console.log('$private._viewMessage();');

			$.ajax({
				url: base_url + 'home/ver_recado',
				type: 'post',
				data: {
					id: id
				},
				success: function(data) {

					console.log('success:', data);
					data = $.parseJSON(data);

					$('h4.modal-title').html(data.titulo);
					$('p.view-message-data_envio').html(data.data_envio);
					$('p.view-message-nome').html(data.nome);
					$('p.view-message-email').html(data.email);
					$('p.view-message-texto').html(data.texto);

				},
				error: function() {
					console.log('error');
				},
				complete: function() {
					console.log('finish');
				}
			});

		};

		/**
		 * Init switch
		 */
		$private._initSwitch = function() {

			console.log('$private._initSwitch();');

			$("input[type='checkbox']").bootstrapSwitch({
				onText: 'Sim',
				offText: 'Não',
				size: 'small'
			});

		};

		/**
		 * Init datetime picker
		 */
		$private._initPìcker = function() {

			console.log('$private._initPìcker();');

			$('[data-picker]').datetimepicker({
				locale: 'pt-br'
			});

			$('[data-picker-date-from]').datetimepicker({
				locale: 'pt-br'
			});

			$('[data-picker-date-to]').datetimepicker({
				locale: 'pt-br',
				useCurrent: false
			});

			$('[data-picker-date-from]').on("dp.change", function (e) {
				$('[data-picker-date-to]').data("DateTimePicker").minDate(e.date);
			});
			$('[data-picker-date-to]').on("dp.change", function (e) {
				$('[data-picker-date-from]').data("DateTimePicker").maxDate(e.date);
			});
		};


		// -----------------------------------

		/**
		 * Public Methods
		 */

		$public.init = function() {

			console.log('messages.js');

			$private._initEvents();
			$private._initSwitch();
			$private._initPìcker();

		};

		// -----------------------------------

		return $public;

	})();

	// Global
	window.messages = messages;

})( window, document );