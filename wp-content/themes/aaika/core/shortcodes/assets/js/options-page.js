// Wait DOM
jQuery(document).ready(function ($) {

	// ########## About screen ##########

	$('.devn-demo-video').magnificPopup({
		type: 'iframe',
		callbacks: {
			open: function () {
				// Change z-index
				$('body').addClass('devn-mfp-shown');
			},
			close: function () {
				// Change z-index
				$('body').removeClass('devn-mfp-shown');
			}
		}
	});

	// ########## Custom CSS screen ##########

	$('.devn-custom-css-originals a').magnificPopup({
		type: 'iframe',
		callbacks: {
			open: function () {
				// Change z-index
				$('body').addClass('devn-mfp-shown');
			},
			close: function () {
				// Change z-index
				$('body').removeClass('devn-mfp-shown');
			}
		}
	});

	// Enable ACE editor
	if ($('#sunrise-field-custom-css-editor').length > 0) {
		var editor = ace.edit('sunrise-field-custom-css-editor'),
			$textarea = $('#sunrise-field-custom-css').hide();
		editor.getSession().setValue($textarea.val());
		editor.getSession().on('change', function () {
			$textarea.val(editor.getSession().getValue());
		});
		editor.getSession().setMode('ace/mode/css');
		editor.setTheme('ace/theme/monokai');
		editor.getSession().setUseWrapMode(true);
		editor.getSession().setWrapLimitRange(null, null);
		editor.renderer.setShowPrintMargin(null);
		editor.session.setUseSoftTabs(null);
	}

	// ########## Add-ons screen ##########

	var addons_timer = 0;
	$('.devn-addons-item').each(function () {
		var $item = $(this),
			delay = 300;
		$item.click(function (e) {
			window.open($(this).data('url'));
			e.preventDefault();
		});
		addons_timer = addons_timer + delay;
		window.setTimeout(function () {
			$item.addClass('animated bounceIn').css('visibility', 'visible');
		}, addons_timer);
	});

	// ########## Examples screen ##########

	// Disable all buttons
	$('#devn-examples-preview').on('click', '.devn-button', function (e) {
		if ($(this).hasClass('devn-example-button-clicked')) alert(su_options_page.not_clickable);
		else $(this).addClass('devn-example-button-clicked');
		e.preventDefault();
	});

	var examples_timer = 0,
		open = $('#su_open_example').val(),
		$example_window = $('#devn-examples-window'),
		$example_preview = $('#devn-examples-preview');
	$('.devn-examples-group-title, .devn-examples-item').each(function () {
		var $item = $(this),
			delay = 200;
		if ($item.hasClass('devn-examples-item')) {
			$item.on('click', function (e) {
				var code = $(this).data('code'),
					id = $(this).data('id');
				$item.magnificPopup({
					type: 'inline',
					alignTop: true,
					callbacks: {
						open: function () {
							// Change z-index
							$('body').addClass('devn-mfp-shown');
						},
						close: function () {
							// Change z-index
							$('body').removeClass('devn-mfp-shown');
							$example_preview.html('');
						}
					}
				});
				var su_example_preview = $.ajax({
					url: ajaxurl,
					type: 'get',
					dataType: 'html',
					data: {
						action: 'su_example_preview',
						code: code,
						id: id
					},
					beforeSend: function () {
						if (typeof su_example_preview === 'object') su_example_preview.abort();
						$example_window.addClass('devn-ajax');
						$item.magnificPopup('open');
					},
					success: function (data) {
						$example_preview.html(data);
						$example_window.removeClass('devn-ajax');
					}
				});
				e.preventDefault();
			});
			// Open preselected example
			if ($item.data('id') === open) $item.trigger('click');
		}
		examples_timer = examples_timer + delay;
		window.setTimeout(function () {
			$item.addClass('animated fadeInDown').css('visibility', 'visible');
		}, examples_timer);
	});
	$('#devn-examples-window').on('click', '.devn-examples-get-code', function (e) {
		$(this).hide();
		$(this).parent('.devn-examples-code').children('textarea').slideDown(300);
		e.preventDefault();
	});

	// ########## Cheatsheet screen ##########
	$('.devn-cheatsheet-switch').on('click', function (e) {
		$('body').toggleClass('devn-print-cheatsheet');
		e.preventDefault();
	});
});