
jQuery(document).ready(function ($) {

// Prepare data
	var $generator = $('#devn-generator'),
		$search = $('#devn-generator-search'),
		$filter = $('#devn-generator-filter'),
		$filters = $filter.children('a'),
		$choices = $('#devn-generator-choices'),
		$choice = $choices.find('span'),
		$settings = $('#devn-generator-settings'),
		$prefix = $('#devn-compatibility-mode-prefix'),
		$result = $('#devn-generator-result'),
		$selected = $('#devn-generator-selected'),
		mce_selection = '';

	// Generator button
	$('body').on('click', '.devn-generator-button', function (e) {
		e.preventDefault();
		// Save the target
		window.devn_Shortcode_Generator_target = $(this).data('target');
		
		buttonClicked = this;
		// Open magnificPopup
		$(this).magnificPopup({
			type: 'inline',
			alignTop: true,
			callbacks: {
				open: function () {
					// Open queried shortcode
					var shortcode = $(buttonClicked).attr('data-shortcode');
					if( shortcode == '' ){
						shortcode = $(buttonClicked).closest('.widget-content ').find('.componentTitle').val();
						if( shortcode != null )
							shortcode = shortcode.toLowerCase();
					}
					if (shortcode) $choice.filter('[data-shortcode="' + shortcode + '"]').trigger('click');
					// Focus search field when popup is opened
					else window.setTimeout(function () {
						$search.focus();
					}, 200);
					// Change z-index
					$('body').addClass('devn-mfp-shown');
					// Save selection
					mce_selection = (typeof tinyMCE !== 'undefined' && tinyMCE.activeEditor != null && tinyMCE.activeEditor.hasOwnProperty('selection')) ? tinyMCE.activeEditor.selection.getContent({
						format: "text"
					}) : '';
				},
				close: function () {
					// Clear search field
					$search.val('');
					// Hide settings
					$settings.html('').hide();
					// Remove narrow class
					$generator.removeClass('devn-generator-narrow');
					// Show filters
					$filter.show();
					// Show choices panel
					$choices.show();
					$choice.show();
					// Clear selection
					mce_selection = '';
					// Change z-index
					$('body').removeClass('devn-mfp-shown');
				}
			}
		}).magnificPopup('open');
	});

	// Filters
	$filters.click(function (e) {
	
		$('#devn-generator-filter a').removeClass('active');
		$(this).addClass('active');
		
		// Prepare data
		var filter = $(this).data('filter');
		// If filter All, show all choices
		if (filter === 'all') $choice.css({
			opacity: 1
		});
		// Else run search
		else {
			var regex = new RegExp(filter, 'gi');
			// Hide all choices
			$choice.css({
				opacity: 0.2
			});
			// Find searched choices and show
			$choice.each(function () {
				// Get shortcode name
				var group = $(this).data('group');
				// Show choice if matched
				if (group.match(regex) !== null) $(this).css({
					opacity: 1
				});
			});
		}
		e.preventDefault();
	});

	// Go to home link
	$('#devn-generator').on('click', '.devn-generator-home', function (e) {
		// Clear search field
		$search.val('');
		// Hide settings
		$settings.html('').hide();
		// Remove narrow class
		$generator.removeClass('devn-generator-narrow');
		// Show filters
		$filter.show();
		// Show choices panel
		$choices.show();
		$choice.show();
		// Clear selection
		mce_selection = '';
		// Focus search field
		$search.focus();
		e.preventDefault();
	});

	// Generator close button
	$('#devn-generator').on('click', '.devn-generator-close', function (e) {
		// Close popup
		$.magnificPopup.close();
		// Prevent default action
		e.preventDefault();
	});

	// Search field
	$search.on({
		focus: function () {
			// Clear field
			$(this).val('');
			// Hide settings
			$settings.html('').hide();
			// Remove narrow class
			$generator.removeClass('devn-generator-narrow');
			// Show choices panel
			$choices.show();
			$choice.css({
				opacity: 1
			});
			// Show filters
			$filter.show();
		},
		blur: function () {},
		keyup: function (e) {
			var val = $(this).val(),
				regex = new RegExp(val, 'gi');
			// Hide all choices
			$choice.css({
				opacity: 0.2
			});
			// Find searched choices and show
			$choice.each(function () {
				// Get shortcode name
				var id = $(this).data('shortcode'),
					name = $(this).data('name'),
					desc = $(this).data('desc'),
					group = $(this).data('group');
				// Show choice if matched
				if (id.match(regex) !== null) $(this).css({
					opacity: 1
				});
				else if (name.match(regex) !== null) $(this).css({
					opacity: 1
				});
				else if (desc.match(regex) !== null) $(this).css({
					opacity: 1
				});
				else if (group.match(regex) !== null) $(this).css({
					opacity: 1
				});
			});
		}
	});

	// Click on shortcode choice
	$choice.on('click', function (e) {
		// Prepare data
		var shortcode = $(this).data('shortcode');

		// Load shortcode options
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'devn_Shortcode_Generator_settings',
				shortcode: shortcode
			},
			beforeSend: function () {
				// Hide preview box
				$('#devn-generator-preview').hide();
				// Hide choices panel
				$choices.hide();
				// Show loading animation
				$settings.addClass('devn-generator-loading').show();
				// Add narrow class
				$generator.addClass('devn-generator-narrow');
				// Hide filters
				$filter.hide();
			},
			success: function (data) {
				
				// Hide loading animation
				$settings.removeClass('devn-generator-loading');
				// Insert new HTML
				$settings.html(data);
				// Apply selected text to the content field
				if (typeof mce_selection !== 'undefined' && mce_selection !== '') $('#devn-generator-content').val(mce_selection);
				// Init range pickers
				$('.devn-generator-range-picker').each(function (index) {
					var $picker = $(this),
						$val = $picker.find('input'),
						min = $val.attr('min'),
						max = $val.attr('max'),
						step = $val.attr('step');
					// Apply noUIslider
					$val.simpleSlider({
						snap: true,
						step: step,
						range: [min, max]
					});
					$val.attr('type', 'text').show();
					$val.on('keyup blur', function (e) {
						$val.simpleSlider('setValue', $val.val());
					});
				});
				// Init color pickers
				$('.devn-generator-select-color').each(function (index) {
					$(this).find('.devn-generator-select-color-wheel').filter(':first').farbtastic('.devn-generator-select-color-value:eq(' +
						index + ')');
					$(this).find('.devn-generator-select-color-value').focus(function () {
						$('.devn-generator-select-color-wheel:eq(' + index + ')').show();
					});
					$(this).find('.devn-generator-select-color-value').blur(function () {
						$('.devn-generator-select-color-wheel:eq(' + index + ')').hide();
					});
				});
				// Init image sourse pickers
				$('.devn-generator-isp').each(function () {
					var $picker = $(this),
						$sources = $picker.find('.devn-generator-isp-sources'),
						$source = $picker.find('.devn-generator-isp-source'),
						$add_media = $picker.find('.devn-generator-isp-add-media'),
						$images = $picker.find('.devn-generator-isp-images'),
						$cats = $picker.find('.devn-generator-isp-categories'),
						$taxes = $picker.find('.devn-generator-isp-taxonomies'),
						$terms = $('.devn-generator-isp-terms'),
						$val = $picker.find('.devn-generator-attr'),
						frame;
					// Update hidden value
					var update = function () {
						var val = 'none',
							ids = '',
							source = $sources.val();
						// Media library
						if (source === 'media') {
							var images = [];
							$images.find('span').each(function (i) {
								images[i] = $(this).data('id');
							});
							if (images.length > 0) ids = images.join(',');
						}
						// Category
						else if (source === 'category') {
							var categories = $cats.val() || [];
							if (categories.length > 0) ids = categories.join(',');
						}
						// Taxonomy
						else if (source === 'taxonomy') {
							var tax = $taxes.val() || '',
								terms = $terms.val() || [];
							if (tax !== '0' && terms.length > 0) val = 'taxonomy: ' + tax + '/' + terms.join(',');
						}
						// Deselect
						else if (source === '0') {
							val = 'none';
						}
						// Other options
						else {
							val = source;
						}
						if (ids !== '') val = source + ': ' + ids;
						$val.val(val).trigger('change');
					}
					// Switch source
					$sources.on('change', function (e) {
						var source = $(this).val();
						e.preventDefault();
						$source.removeClass('devn-generator-isp-source-open');
						if (source.indexOf(':') === -1) $picker.find('.devn-generator-isp-source-' + source).addClass('devn-generator-isp-source-open');
						update();
					});
					// Remove image
					$images.on('click', 'span i', function () {
						$(this).parent('span').css('border-color', '#f03').fadeOut(300, function () {
							$(this).remove();
							update();
						});
					});
					// Add image
					$add_media.click(function (e) {
						e.preventDefault();
						if (typeof (frame) !== 'undefined') frame.close();
						frame = wp.media.frames.su_media_frame_1 = wp.media({
							title: devn_Shortcode_Generator.isp_media_title,
							library: {
								type: 'image'
							},
							button: {
								text: devn_Shortcode_Generator.isp_media_insert
							},
							multiple: true
						});
						frame.on('select', function () {
							var files = frame.state().get('selection').toJSON();
							$images.find('em').remove();
							$.each(files, function (i) {
								$images.append('<span data-id="' + this.id + '" title="' + this.title + '"><img src="' + this.url + '" alt="" /><i class="fa fa-times"></i></span>');
							});
							update();
						}).open();
					});
					// Sort images
					$images.sortable({
						revert: 200,
						containment: $picker,
						tolerance: 'pointer',
						stop: function () {
							update();
						}
					});
					// Select categories and terms
					$cats.on('change', update);
					$terms.on('change', update);
					// Select taxonomy
					$taxes.on('change', function () {
						var $cont = $(this).parents('.devn-generator-isp-source'),
							tax = $(this).val();
						// Remove terms
						$terms.hide().find('option').remove();
						update();
						// Taxonomy is not selected
						if (tax === '0') return;
						// Taxonomy selected
						else {
							var ajax_term_select = $.ajax({
								url: ajaxurl,
								type: 'post',
								dataType: 'html',
								data: {
									'action': 'devn_Shortcode_Generator_get_terms',
									'tax': tax,
									'class': 'devn-generator-isp-terms',
									'multiple': true,
									'size': 10
								},
								beforeSend: function () {
									if (typeof ajax_term_select === 'object') ajax_term_select.abort();
									$terms.html('').attr('disabled', true).hide();
									$cont.addClass('devn-generator-loading');
								},
								success: function (data) {
									$terms.html(data).attr('disabled', false).show();
									$cont.removeClass('devn-generator-loading');
								}
							});
						}
					});
				});
				// Init media buttons
				$('.devn-generator-upload-button').each(function () {
					var $button = $(this),
						$val = $(this).parents('.devn-generator-attr-container').find('input:text'),
						file;
					$button.on('click', function (e) {
						e.preventDefault();
						e.stopPropagation();
						// If the frame already exists, reopen it
						if (typeof (file) !== 'undefined') file.close();
						// Create WP media frame.
						file = wp.media.frames.su_media_frame_2 = wp.media({
							// Title of media manager frame
							title: su_generator.upload_title,
							button: {
								//Button text
								text: su_generator.upload_insert
							},
							// Do not allow multiple files, if you want multiple, set true
							multiple: false
						});
						//callback for selected image
						file.on('select', function () {
							var attachment = file.state().get('selection').first().toJSON();
							$val.val(attachment.url).trigger('change');
						});
						// Open modal
						file.open();
					});
				});
				// Init icon pickers
				$('.devn-generator-icon-picker-button').each(function () {
					var $button = $(this),
						$field = $(this).parents('.devn-generator-attr-container'),
						$val = $field.find('.devn-generator-attr'),
						$picker = $field.find('.devn-generator-icon-picker'),
						$filter = $picker.find('input:text');

					$button.click(function (e) {
						$picker.toggleClass('devn-generator-icon-picker-visible');
						$filter.val('').trigger('keyup');
						if ($picker.hasClass('devn-generator-icon-picker-loaded')) return;
						// Load icons
						$.ajax({
							type: 'post',
							url: ajaxurl,
							data: {
								action: 'devn_Shortcode_Generator_get_icons'
							},
							dataType: 'html',
							beforeSend: function () {
								// Show loading animation
								$picker.addClass('devn-generator-loading');
								// Add loaded class
								$picker.addClass('devn-generator-icon-picker-loaded');
							},
							success: function (data) {
								$picker.append(data);
								var $icons = $picker.children('i');
								$icons.click(function (e) {
									$val.val('icon: ' + $(this).attr('title'));
									$picker.removeClass('devn-generator-icon-picker-visible');
									$val.trigger('change');
									e.preventDefault();
								});
								$filter.on({
									keyup: function () {
										var val = $(this).val(),
											regex = new RegExp(val, 'gi');
										// Hide all choices
										$icons.hide();
										// Find searched choices and show
										$icons.each(function () {
											// Get shortcode name
											var name = $(this).attr('title');
											// Show choice if matched
											if (name.match(regex) !== null) $(this).show();
										});
									},
									focus: function () {
										$(this).val('');
										$icons.show();
									}
								});
								$picker.removeClass('devn-generator-loading');
							}
						});
						e.preventDefault();
					});
				});
				// Init switches
				$('.devn-generator-switch').click(function (e) {
					// Prepare data
					var $switch = $(this),
						$value = $switch.parent().children('input'),
						is_on = $value.val() === 'yes';
					// Disable
					if (is_on) {
						// Change value
						$value.val('no').trigger('change');
					}
					// Enable
					else {
						// Change value
						$value.val('yes').trigger('change');
					}
					e.preventDefault();
				});
				$('.devn-generator-switch-value').on('change', function () {
					// Prepare data
					var $value = $(this),
						$switch = $value.parent().children('.devn-generator-switch'),
						value = $value.val();
					// Disable
					if (value === 'yes') $switch.removeClass('devn-generator-switch-no').addClass('devn-generator-switch-yes');
					// Enable
					else if (value === 'no') $switch.removeClass('devn-generator-switch-yes').addClass('devn-generator-switch-no');
				});
				// Init tax_term selects
				$('select#devn-generator-attr-taxonomy').on('change', function () {
					var $taxonomy = $(this),
						tax = $taxonomy.val(),
						$terms = $('select#devn-generator-attr-tax_term');
					// Load new options
					window.devn_Shortcode_Generator_get_terms = $.ajax({
						type: 'POST',
						url: ajaxurl,
						data: {
							action: 'devn_Shortcode_Generator_get_terms',
							tax: tax,
							noselect: true
						},
						dataType: 'html',
						beforeSend: function () {
							// Check previous requests
							if (typeof window.devn_Shortcode_Generator_get_terms === 'object') window.devn_Shortcode_Generator_get_terms.abort();
							// Show loading animation
							$terms.parent().addClass('devn-generator-loading');
						},
						success: function (data) {
							// Remove previous options
							$terms.find('option').remove();
							// Append new options
							$terms.append(data);
							// Hide loading animation
							$terms.parent().removeClass('devn-generator-loading');
						}
					});
				});
				// Init shadow pickers
				$('.devn-generator-shadow-picker').each(function (index) {
					var $picker = $(this),
						$fields = $picker.find('.devn-generator-shadow-picker-field input'),
						$hoff = $picker.find('.devn-generator-sp-hoff'),
						$voff = $picker.find('.devn-generator-sp-voff'),
						$blur = $picker.find('.devn-generator-sp-blur'),
						$color = {
							cnt: $picker.find('.devn-generator-shadow-picker-color'),
							value: $picker.find('.devn-generator-shadow-picker-color-value'),
							wheel: $picker.find('.devn-generator-shadow-picker-color-wheel')
						},
						$val = $picker.find('.devn-generator-attr');
					// Init color picker
					$color.wheel.farbtastic($color.value);
					$color.value.focus(function () {
						$color.wheel.show();
					});
					$color.value.blur(function () {
						$color.wheel.hide();
					});
					// Handle text fields
					$fields.on('change blur keyup', function () {
						$val.val($hoff.val() + 'px ' + $voff.val() + 'px ' + $blur.val() + 'px ' + $color.value.val()).trigger('change');
					});
					$val.on('keyup', function () {
						var value = $(this).val().split(' ');
						// Value is correct
						if (value.length === 4) {
							$hoff.val(value[0].replace('px', ''));
							$voff.val(value[1].replace('px', ''));
							$blur.val(value[2].replace('px', ''));
							$color.value.val(value[3]);
							$fields.trigger('keyup');
						}
					});
				});
				// Init border pickers
				$('.devn-generator-border-picker').each(function (index) {
					var $picker = $(this),
						$fields = $picker.find('.devn-generator-border-picker-field input, .devn-generator-border-picker-field select'),
						$width = $picker.find('.devn-generator-bp-width'),
						$style = $picker.find('.devn-generator-bp-style'),
						$color = {
							cnt: $picker.find('.devn-generator-border-picker-color'),
							value: $picker.find('.devn-generator-border-picker-color-value'),
							wheel: $picker.find('.devn-generator-border-picker-color-wheel')
						},
						$val = $picker.find('.devn-generator-attr');
					// Init color picker
					$color.wheel.farbtastic($color.value);
					$color.value.focus(function () {
						$color.wheel.show();
					});
					$color.value.blur(function () {
						$color.wheel.hide();
					});
					// Handle text fields
					$fields.on('change blur keyup', function () {
						$val.val($width.val() + 'px ' + $style.val() + ' ' + $color.value.val()).trigger('change');
					});
					$val.on('keyup', function () {
						var value = $(this).val().split(' ');
						// Value is correct
						if (value.length === 3) {
							$width.val(value[0].replace('px', ''));
							$style.val(value[1]);
							$color.value.val(value[2]);
							$fields.trigger('keyup');
						}
					});
				});
				// Remove skip class when setting is changed
				$settings.find('.devn-generator-attr').on('change keyup blur', function () {
					var $cnt = $(this).parents('.devn-generator-attr-container'),
						_default = $cnt.data('default'),
						val = $(this).val();
					// Value is changed
					if (val != _default) $cnt.removeClass('devn-generator-skip');
					else $cnt.addClass('devn-generator-skip');
				});
				// Init value setters
				$('.devn-generator-set-value').click(function (e) {
					$(this).parents('.devn-generator-attr-container').find('input').val($(this).text()).trigger('change');
				});
				// Save selected value
				$selected.val(shortcode);
				// Load last used preset
				
				
				$.ajax({
					type: 'GET',
					url: ajaxurl,
					data: {
						action: 'devn_Shortcode_Generator_get_preset',
						id: 'last_used',
						shortcode: shortcode
					},
					beforeSend: function () {
						// Show loading animation
						// $settings.addClass('devn-generator-loading');
					},
					success: function (data) {
						// Remove loading animation
						// $settings.removeClass('devn-generator-loading');
						// Set new settings

						if( typeof document.shortcodeReEdit == 'object' && document.shortcodeReEdit != null ){
							set(document.shortcodeReEdit);
							document.shortcodeReEdit = null;
						}else set(data);
						
						$('.devn-generator-toggle-preview').click();
						// Apply selected text to the content field
						if (typeof mce_selection !== 'undefined' && mce_selection !== '') $('#devn-generator-content').val(mce_selection);
					},
					dataType: 'json'
				});
				
				
			},
			dataType: 'html'
		});
	});

	// Insert shortcode
	$('#devn-generator').on('click', '.devn-generator-insert', function (e) {
		
		var targ = $('#'+window.devn_Shortcode_Generator_target);
		
		if( targ.hasClass('replaceOnly') ){
		
			targ.val('');
			var title = targ.closest('.widget-content').find('.componentTitle');
			if( title.get(0) ){
				title.val( $('#devn-generator #devn-generator-breadcrumbs span').html() );
			}
		}
		var shortcode = parse();

		// Save current settings to presets
		add_preset('last_used', $generator.last_used);
		// Close popup
		$.magnificPopup.close();
		// Save shortcode to div
		$result.text(shortcode);
		// Prevent default action
		e.preventDefault();

		// Save original activeeditor
		var su_wpActiveEditor = window.wpActiveEditor;
		// Set new active editor
		window.wpActiveEditor = window.devn_Shortcode_Generator_target;
		// Insert shortcode
		window.wp.media.editor.insert(shortcode);
		// Restore previous editor
		window.wpActiveEditor = su_wpActiveEditor;
		
		/*Call back function when insert shortcode*/
		if( typeof targ.get(0).callBack == 'function' ){
			targ.get(0).callBack( shortcode );
		}

	});

	// Preview shortcode
	$generator.on('click', '.devn-generator-toggle-preview', function (e) {
		// Prepare data
		var $preview = $('#devn-generator-preview'),
			$button = $(this);
		// Hide button
		$button.hide();
		// Show preview box
		$preview.addClass('devn-generator-loading').show();
		// Bind updating on settings changes
		$settings.find('input, textarea, select').on('change keyup blur', function () {
			update_preview();
		});
		// Update preview box
		update_preview(true);
		// Prevent default action
		e.preventDefault();
	});

	var gp_hover_timer;

	// Presets manager - mouseenter
	$('#devn-generator').on('mouseenter click', '.devn-generator-presets', function () {
		clearTimeout(gp_hover_timer);
		$('.devn-gp-popup').show();
	});
	// Presets manager - mouseleave
	$('#devn-generator').on('mouseleave', '.devn-generator-presets', function () {
		gp_hover_timer = window.setTimeout(function () {
			$('.devn-gp-popup').fadeOut(200);
		}, 600);
	});
	// Presets manager - add new preset
	$('#devn-generator').on('click', '.devn-gp-new', function (e) {
		// Prepare data
		var $container = $(this).parents('.devn-generator-presets'),
			$list = $('.devn-gp-list'),
			id = new Date().getTime();
		// Ask for preset name
		var name = prompt(su_generator.presets_prompt_msg, su_generator.presets_prompt_value);
		// Name is entered
		if (name !== '' && name !== null) {
			// Hide default text
			$list.find('b').hide();
			// Add new option
			$list.append('<span data-id="' + id + '"><em>' + name + '</em><i class="fa fa-times"></i></span>');
			// Perform AJAX request
			add_preset(id, name);
		}
	});
	// Presets manager - load preset
	$('#devn-generator').on('click', '.devn-gp-list span', function (e) {
		// Prepare data
		var shortcode = $('.devn-generator-presets').data('shortcode'),
			id = $(this).data('id'),
			$insert = $('.devn-generator-insert');
		// Hide popup
		$('.devn-gp-popup').hide();
		// Disable hover timer
		clearTimeout(gp_hover_timer);
		// Get the preset
		$.ajax({
			type: 'GET',
			url: ajaxurl,
			data: {
				action: 'devn_Shortcode_Generator_get_preset',
				id: id,
				shortcode: shortcode
			},
			beforeSend: function () {
				// Disable insert button
				$insert.addClass('button-primary-disabled').attr('disabled', true);
			},
			success: function (data) {
				// Enable insert button
				$insert.removeClass('button-primary-disabled').attr('disabled', false);
				// Set new settings
				set(data);
			},
			dataType: 'json'
		});
		// Prevent default action
		e.preventDefault();
		e.stopPropagation();
	});
	// Presets manager - remove preset
	$('#devn-generator').on('click', '.devn-gp-list i', function (e) {
		// Prepare data
		var $list = $(this).parents('.devn-gp-list'),
			$preset = $(this).parent('span'),
			id = $preset.data('id');
		// Remove DOM element
		$preset.remove();
		// Show default text if last preset was removed
		if ($list.find('span').length < 1) $list.find('b').show();
		// Perform ajax request
		remove_preset(id);
		// Prevent <span> action
		e.stopPropagation();
		// Prevent default action
		e.preventDefault();
	});

	/**
	 * Create new preset with specified name from current settings
	 */
	function add_preset(id, name) {
		// Prepare shortcode name and current settings
		var shortcode = $('.devn-generator-presets').data('shortcode'),
			settings = get();
		// Perform AJAX request
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'devn_Shortcode_Generator_add_preset',
				id: id,
				name: name,
				shortcode: shortcode,
				settings: settings
			}
		});
	}

	/**
	 * Remove preset by ID
	 */
	function remove_preset(id) {
		// Get current shortcode name
		var shortcode = $('.devn-generator-presets').data('shortcode');
		// Perform AJAX request
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'devn_Shortcode_Generator_remove_preset',
				id: id,
				shortcode: shortcode
			}
		});
	}

	function parse() {
		// Prepare data
		var query = $selected.val(),
			prefix = $prefix.val(),
			$settings = $('#devn-generator-settings .devn-generator-attr-container:not(.devn-generator-skip) .devn-generator-attr'),
			content = $('#devn-generator-content').val(),
			result = new String('');
		// Open shortcode

		result += '[' + prefix + query;
		// Add shortcode attributes
		$settings.each(function () {
			// Prepare field and value
			var $this = $(this),
				value = '';
			// Selects
			if ($this.is('select')) value = $this.find('option:selected').val();
			// Other fields
			else value = $this.val();
			// Check that value is not empty
			if (value == null) value = '';
			else if (typeof value === 'array') value = value.join(',');
			// Add attribute
			if (value !== '') result += ' ' + $(this).attr('name') + '="' + $(this).val().toString().replace(/"/gi, "'") + '"';
		});
		// End of opening tag
		result += ']';
		// Wrap shortcode if content presented
		if (content != 'false') result += content + '[/' + prefix + query + ']';
		// Return result
		return result;
	}

	function get() {
		// Prepare data
		var query = $selected.val(),
			$settings = $('#devn-generator-settings .devn-generator-attr'),
			content = $('#devn-generator-content').val(),
			data = {};
		// Add shortcode attributes
		$settings.each(function (i) {
			// Prepare field and value
			var $this = $(this),
				value = '',
				name = $this.attr('name');
			// Selects
			if ($this.is('select')) value = $this.find('option:selected').val();
			// Other fields
			else value = $this.val();
			// Check that value is not empty
			if (value == null) value = '';
			// Save value
			data[name] = value;
		});
		// Add content
		
		data['content'] = content.toString();
		// Return data
		return data;
	}

	function set(data) {
		// Prepare data
		var $settings = $('#devn-generator-settings .devn-generator-attr'),
			$content = $('#devn-generator-content');
		// Loop through settings
		$settings.each(function () {
			var $this = $(this),
				name = $this.attr('name');
			// Data contains value for this field
			if (data.hasOwnProperty(name)) {
				// Set new value
				$this.val(data[name]);
				$this.trigger('keyup').trigger('change').trigger('blur');
			}
		});
		// Set content
		if (data.hasOwnProperty('content')) $content.val(data['content']).trigger('keyup').trigger('change').trigger('blur');
		// Update preview
		update_preview();
	}

	var update_preview_timer,
		update_preview_request;

	function update_preview(forced) {
		// Prepare data
		var $preview = $('#devn-generator-preview'),
			shortcode = parse(),
			previous = $result.text();
		// Check forced mode
		forced = forced || false;
		// Break if preview box is hidden (preview isn't enabled)
		if (!$preview.is(':visible')) return;
		// Check shortcode is changed is this is not a forced mode
		if (shortcode === previous && !forced) return;
		// Run timer to filter often calls
		window.clearTimeout(update_preview_timer);
		update_preview_timer = window.setTimeout(function () {
			
			$preview.html('<h5 id="preview-headding">Preview</h5><br /><iframe scrolling="no" style="width:100%;" onload="su_preview_iframe_onload(this)" src="'+ajaxurl+'?action=devn_Shortcode_Generator_preview&shortcode='+Base64.encode(shortcode)+'"></iframe>').removeClass('devn-generator-loading');
			return;
			update_preview_request = $.ajax({
				type: 'POST',
				url: ajaxurl,
				cache: false,
				data: {
					action: 'devn_Shortcode_Generator_preview',
					shortcode: shortcode
				},
				beforeSend: function () {
					// Abort previous requests
					if (typeof update_preview_request === 'object') 
						update_preview_request.abort();
						
					// Show loading animation
					$preview.addClass('devn-generator-loading').html('');
				},
				success: function (data) {
					// Hide loading animation and set new HTML
					//data = data.replace(/jquery/g,'')
					$preview.html(data).removeClass('devn-generator-loading');
				},
				dataType: 'html'
			});
		}, 300);
		// Save shortcode to div
		$result.text(shortcode);
	}

});


function shortcodeInstantModeInit(){

	var $ = jQuery;

	// Prepare data
	var $generator = $('#devn-generator-instant'),
		$choices = $('#devn-generator-choices-instant'),
		$choice = $choices.find('span'),
		$settings = $('#devn-generator-settings-instant'),
		$prefix = $('#devn-compatibility-mode-prefix-instant'),
		$result = $('#devn-generator-result-instant'),
		$selected = $('#devn-generator-selected-instant'),
		mce_selection = '',
		timerInstantPreview = null;
		
		grid.fn.shortcode.get = function(){
			return parse();
		};

	// Generator close button
	$('#devn-generator').on('click', '.devn-generator-close', function (e) {
		// Close popup
		$.magnificPopup.close();
		// Prevent default action
		e.preventDefault();
	});
	
		// Go to home link
	$('#devn-generator-instant').on('click', '.devn-generator-home', function (e) {
		// Hide settings
		$settings.html('').hide();
		// Remove narrow class
		$generator.removeClass('devn-generator-narrow');
		// Show choices panel
		$choices.show();
		$choice.show();
		// Clear selection
		mce_selection = '';

		e.preventDefault();
	});
	
	// Click on shortcode choice
	$choice.on('click', function (e) {
		// Prepare data
		var shortcode = $(this).data('shortcode');
		
		// Load shortcode options
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'devn_Shortcode_Generator_settings',
				shortcode: shortcode
			},
			shortcode: shortcode,
			beforeSend: function () {
				// Hide preview box
				$('#devn-generator-preview').hide();
				// Hide choices panel
				$choices.hide();
				// Show loading animation
				$settings.addClass('devn-generator-loading').show();
				// Add narrow class
				$generator.addClass('devn-generator-narrow');

			},
			success: function (data) {
				
				data = data.replace(/\"devn\-generator\-content\"/g,'"devn-generator-content-instant"').
							replace('<div id="devn-generator-preview"></div>','');
				
				if( shortcode == undefined ){
					var shortcode = this.shortcode;
				}	
				// Hide loading animation
				$settings.removeClass('devn-generator-loading');
				// Insert new HTML
				$settings.html(data);
				
				// Apply selected text to the content field
				if (typeof mce_selection !== 'undefined' && mce_selection !== '') 
					$('#devn-generator-content-instant').val(mce_selection);
				
				// Init range pickers
				$('.devn-generator-range-picker').each(function (index) {
					var $picker = $(this),
						$val = $picker.find('input'),
						min = $val.attr('min'),
						max = $val.attr('max'),
						step = $val.attr('step');
					// Apply noUIslider
					$val.simpleSlider({
						snap: true,
						step: step,
						range: [min, max]
					});
					$val.attr('type', 'text').show();
					$val.on('keyup blur', function (e) {
						$val.simpleSlider('setValue', $val.val());
					});
				});
				// Init color pickers
				$('.devn-generator-select-color').each(function (index) {
					$(this).find('.devn-generator-select-color-wheel').filter(':first').farbtastic('.devn-generator-select-color-value:eq(' + index + ')').mouseup(function(){ $('.devn-generator-select-color-value:eq(' + index + ')').trigger('change'); });
					$(this).find('.devn-generator-select-color-value').focus(function () {
						$('.devn-generator-select-color-wheel:eq(' + index + ')').show();
					});
					$(this).find('.devn-generator-select-color-value').blur(function () {
						$('.devn-generator-select-color-wheel:eq(' + index + ')').hide();
					});
				});
				// Init image sourse pickers
				$('.devn-generator-isp').each(function () {
					var $picker = $(this),
						$sources = $picker.find('.devn-generator-isp-sources'),
						$source = $picker.find('.devn-generator-isp-source'),
						$add_media = $picker.find('.devn-generator-isp-add-media'),
						$images = $picker.find('.devn-generator-isp-images'),
						$cats = $picker.find('.devn-generator-isp-categories'),
						$taxes = $picker.find('.devn-generator-isp-taxonomies'),
						$terms = $('.devn-generator-isp-terms'),
						$val = $picker.find('.devn-generator-attr'),
						frame;
					// Update hidden value
					var update = function () {
						var val = 'none',
							ids = '',
							source = $sources.val();
						// Media library
						if (source === 'media') {
							var images = [];
							$images.find('span').each(function (i) {
								images[i] = $(this).data('id');
							});
							if (images.length > 0) ids = images.join(',');
						}
						// Category
						else if (source === 'category') {
							var categories = $cats.val() || [];
							if (categories.length > 0) ids = categories.join(',');
						}
						// Taxonomy
						else if (source === 'taxonomy') {
							var tax = $taxes.val() || '',
								terms = $terms.val() || [];
							if (tax !== '0' && terms.length > 0) val = 'taxonomy: ' + tax + '/' + terms.join(',');
						}
						// Deselect
						else if (source === '0') {
							val = 'none';
						}
						// Other options
						else {
							val = source;
						}
						if (ids !== '') val = source + ': ' + ids;
						
						$val.val(val).trigger('change');

					}
					// Switch source
					$sources.on('change', function (e) {
						var source = $(this).val();
						e.preventDefault();
						$source.removeClass('devn-generator-isp-source-open');
						if (source.indexOf(':') === -1) $picker.find('.devn-generator-isp-source-' + source).addClass('devn-generator-isp-source-open');
						update();
					});
					// Remove image
					$images.on('click', 'span i', function () {
						$(this).parent('span').css('border-color', '#f03').fadeOut(300, function () {
							$(this).remove();
							update();
						});
					});
					// Add image
					$add_media.click(function (e) {
						e.preventDefault();
						if (typeof (frame) !== 'undefined') frame.close();
						frame = wp.media.frames.su_media_frame_1 = wp.media({
							title: devn_Shortcode_Generator.isp_media_title,
							library: {
								type: 'image'
							},
							button: {
								text: devn_Shortcode_Generator.isp_media_insert
							},
							multiple: true
						});
						frame.on('select', function () {
							var files = frame.state().get('selection').toJSON();
							$images.find('em').remove();
							$.each(files, function (i) {
								$images.append('<span data-id="' + this.id + '" title="' + this.title + '"><img src="' + this.url + '" alt="" /><i class="fa fa-times"></i></span>');
							});
							update();
						}).open();
					});
					// Sort images
					$images.sortable({
						revert: 200,
						containment: $picker,
						tolerance: 'pointer',
						stop: function () {
							update();
						}
					});
					// Select categories and terms
					$cats.on('change', update);
					$terms.on('change', update);
					// Select taxonomy
					$taxes.on('change', function () {
						var $cont = $(this).parents('.devn-generator-isp-source'),
							tax = $(this).val();
						// Remove terms
						$terms.hide().find('option').remove();
						update();
						// Taxonomy is not selected
						if (tax === '0') return;
						// Taxonomy selected
						else {
							var ajax_term_select = $.ajax({
								url: ajaxurl,
								type: 'post',
								dataType: 'html',
								data: {
									'action': 'devn_Shortcode_Generator_get_terms',
									'tax': tax,
									'class': 'devn-generator-isp-terms',
									'multiple': true,
									'size': 10
								},
								beforeSend: function () {
									if (typeof ajax_term_select === 'object') ajax_term_select.abort();
									$terms.html('').attr('disabled', true).hide();
									$cont.addClass('devn-generator-loading');
								},
								success: function (data) {
									$terms.html(data).attr('disabled', false).show();
									$cont.removeClass('devn-generator-loading');
								}
							});
						}
					});
				});
				// Init media buttons
				$('.devn-generator-upload-button').each(function () {
					var $button = $(this),
						$val = $(this).parents('.devn-generator-attr-container').find('input:text'),
						file;
					$button.on('click', function (e) {
						e.preventDefault();
						e.stopPropagation();
						// If the frame already exists, reopen it
						if (typeof (file) !== 'undefined') file.close();
						// Create WP media frame.
						file = wp.media.frames.su_media_frame_2 = wp.media({
							// Title of media manager frame
							title: devn_Shortcode_Generator.upload_title,
							button: {
								//Button text
								text: devn_Shortcode_Generator.upload_insert
							},
							// Do not allow multiple files, if you want multiple, set true
							multiple: false
						});
						//callback for selected image
						file.on('select', function () {
							var attachment = file.state().get('selection').first().toJSON();
							$val.val(attachment.url).trigger('change');
						});
						// Open modal
						file.open();
					});
				});
				// Init icon pickers
				$('.devn-generator-icon-picker-button').each(function () {
					var $button = $(this),
						$field = $(this).parents('.devn-generator-attr-container'),
						$val = $field.find('.devn-generator-attr'),
						$picker = $field.find('.devn-generator-icon-picker'),
						$filter = $picker.find('input:text');

					$button.click(function (e) {
						$picker.toggleClass('devn-generator-icon-picker-visible');
						$filter.val('').trigger('keyup');
						if ($picker.hasClass('devn-generator-icon-picker-loaded')) return;
						// Load icons
						$.ajax({
							type: 'post',
							url: ajaxurl,
							data: {
								action: 'devn_Shortcode_Generator_get_icons'
							},
							dataType: 'html',
							beforeSend: function () {
								// Show loading animation
								$picker.addClass('devn-generator-loading');
								// Add loaded class
								$picker.addClass('devn-generator-icon-picker-loaded');
							},
							success: function (data) {
								$picker.append(data);
								var $icons = $picker.children('i');
								$icons.click(function (e) {
									$val.val('icon: ' + $(this).attr('title'));
									$picker.removeClass('devn-generator-icon-picker-visible');
									$val.trigger('change');
									e.preventDefault();
								});
								$filter.on({
									keyup: function () {
										var val = $(this).val(),
											regex = new RegExp(val, 'gi');
										// Hide all choices
										$icons.hide();
										// Find searched choices and show
										$icons.each(function () {
											// Get shortcode name
											var name = $(this).attr('title');
											// Show choice if matched
											if (name.match(regex) !== null) $(this).show();
										});
									},
									focus: function () {
										$(this).val('');
										$icons.show();
									}
								});
								$picker.removeClass('devn-generator-loading');
							}
						});
						e.preventDefault();
					});
				});
				// Init switches
				$('.devn-generator-switch').click(function (e) {
					// Prepare data
					var $switch = $(this),
						$value = $switch.parent().children('input'),
						is_on = $value.val() === 'yes';
					// Disable
					if (is_on) {
						// Change value
						$value.val('no').trigger('change');
					}
					// Enable
					else {
						// Change value
						$value.val('yes').trigger('change');
					}
					e.preventDefault();
				});
				$('.devn-generator-switch-value').on('change', function () {
					// Prepare data
					var $value = $(this),
						$switch = $value.parent().children('.devn-generator-switch'),
						value = $value.val();
					// Disable
					if (value === 'yes') $switch.removeClass('devn-generator-switch-no').addClass('devn-generator-switch-yes');
					// Enable
					else if (value === 'no') $switch.removeClass('devn-generator-switch-yes').addClass('devn-generator-switch-no');
				});
				// Init tax_term selects
				$('select#devn-generator-attr-taxonomy').on('change', function () {
					var $taxonomy = $(this),
						tax = $taxonomy.val(),
						$terms = $('select#devn-generator-attr-tax_term');
					// Load new options
					window.devn_Shortcode_Generator_get_terms = $.ajax({
						type: 'POST',
						url: ajaxurl,
						data: {
							action: 'devn_Shortcode_Generator_get_terms',
							tax: tax,
							noselect: true
						},
						dataType: 'html',
						beforeSend: function () {
							// Check previous requests
							if (typeof window.devn_Shortcode_Generator_get_terms === 'object') window.devn_Shortcode_Generator_get_terms.abort();
							// Show loading animation
							$terms.parent().addClass('devn-generator-loading');
						},
						success: function (data) {
							// Remove previous options
							$terms.find('option').remove();
							// Append new options
							$terms.append(data);
							// Hide loading animation
							$terms.parent().removeClass('devn-generator-loading');
						}
					});
				});
				// Init shadow pickers
				$('.devn-generator-shadow-picker').each(function (index) {
					var $picker = $(this),
						$fields = $picker.find('.devn-generator-shadow-picker-field input'),
						$hoff = $picker.find('.devn-generator-sp-hoff'),
						$voff = $picker.find('.devn-generator-sp-voff'),
						$blur = $picker.find('.devn-generator-sp-blur'),
						$color = {
							cnt: $picker.find('.devn-generator-shadow-picker-color'),
							value: $picker.find('.devn-generator-shadow-picker-color-value'),
							wheel: $picker.find('.devn-generator-shadow-picker-color-wheel')
						},
						$val = $picker.find('.devn-generator-attr');
					// Init color picker
					$color.wheel.farbtastic($color.value);
					$color.value.focus(function () {
						$color.wheel.show();
					});
					$color.value.blur(function () {
						$color.wheel.hide();
					});
					// Handle text fields
					$fields.on('change blur keyup', function () {
						$val.val($hoff.val() + 'px ' + $voff.val() + 'px ' + $blur.val() + 'px ' + $color.value.val()).trigger('change');
					});
					$val.on('keyup', function () {
						var value = $(this).val().split(' ');
						// Value is correct
						if (value.length === 4) {
							$hoff.val(value[0].replace('px', ''));
							$voff.val(value[1].replace('px', ''));
							$blur.val(value[2].replace('px', ''));
							$color.value.val(value[3]);
							$fields.trigger('keyup');
						}
					});
				});
				// Init border pickers
				$('.devn-generator-border-picker').each(function (index) {
					var $picker = $(this),
						$fields = $picker.find('.devn-generator-border-picker-field input, .devn-generator-border-picker-field select'),
						$width = $picker.find('.devn-generator-bp-width'),
						$style = $picker.find('.devn-generator-bp-style'),
						$color = {
							cnt: $picker.find('.devn-generator-border-picker-color'),
							value: $picker.find('.devn-generator-border-picker-color-value'),
							wheel: $picker.find('.devn-generator-border-picker-color-wheel')
						},
						$val = $picker.find('.devn-generator-attr');
					// Init color picker
					$color.wheel.farbtastic($color.value);
					$color.value.focus(function () {
						$color.wheel.show();
					});
					$color.value.blur(function () {
						$color.wheel.hide();
					});
					// Handle text fields
					$fields.on('change blur keyup', function () {
						$val.val($width.val() + 'px ' + $style.val() + ' ' + $color.value.val()).trigger('change');
					});
					$val.on('keyup', function () {
						var value = $(this).val().split(' ');
						// Value is correct
						if (value.length === 3) {
							$width.val(value[0].replace('px', ''));
							$style.val(value[1]);
							$color.value.val(value[2]);
							$fields.trigger('keyup');
						}
					});
				});
				// Remove skip class when setting is changed
				$settings.find('.devn-generator-attr').on('change keyup blur', function () {
					var $cnt = $(this).parents('.devn-generator-attr-container'),
						_default = $cnt.data('default'),
						val = $(this).val();
					// Value is changed
					if (val != _default) $cnt.removeClass('devn-generator-skip');
					else $cnt.addClass('devn-generator-skip');
				});
				// Init value setters
				$('.devn-generator-set-value').click(function (e) {
					$(this).parents('.devn-generator-attr-container').find('input').val($(this).text()).trigger('change');
				});
				// Save selected value
				$selected.val(shortcode);
				
				
				if( typeof grid.fn.shortcode.data == 'object' && grid.fn.shortcode.data != null ){

					set( grid.fn.shortcode.data );
					grid.fn.shortcode.data = null;
					
					$('#devn-generator-settings textarea').each(function(){
						this.innerHTML = this.value;
					});
					$settings.find('input, textarea, select').on('change', function () {
						var shortcode = parse();
						instantPreview( shortcode );
					});
					
				}else{ 

					$settings.find('input, textarea, select').on('change', function () {
						var shortcode = parse();
						instantPreview( shortcode );
					});
					instantPreview( parse() );
					
				}	

				grid.fn.shortcode.current = shortcode+'-'+grid.fn.shortcode.iframe.name;

				
			},
			dataType: 'html'
		});
	});

	// Insert shortcode
	$generator.on('click', '.devn-generator-insert', function (e) {

		var targ = $('#'+window.devn_Shortcode_Generator_target);

		if( targ.hasClass('replaceOnly') ){
		
			targ.val('');
			var title = targ.closest('.widget-content').find('.componentTitle');
			if( title.get(0) ){
				title.val( $('#devn-generator-breadcrumbs span').html() );
			}
		}
		var shortcode = parse();
		
		// Save current settings to presets
		add_preset('last_used', devn_Shortcode_Generator.last_used);
		// Close popup
		$.magnificPopup.close();
		// Save shortcode to div
		$result.text(shortcode);
		// Prevent default action
		e.preventDefault();
		if( targ.attr('type') != 'hidden' ){
			// Save original activeeditor
			window.su_wpActiveEditor = window.wpActiveEditor;
			// Set new active editor
			window.wpActiveEditor = window.devn_Shortcode_Generator_target;
			// Insert shortcode
			window.wp.media.editor.insert(shortcode);
			// Restore previous editor
			window.wpActiveEditor = window.su_wpActiveEditor;
		}
		
		
	});

	// Presets manager - mouseenter
	$('#devn-generator').on('mouseenter click', '.devn-generator-presets', function () {
		clearTimeout(gp_hover_timer);
		$('.devn-gp-popup').show();
	});
	// Presets manager - mouseleave
	$('#devn-generator').on('mouseleave', '.devn-generator-presets', function () {
		gp_hover_timer = window.setTimeout(function () {
			$('.devn-gp-popup').fadeOut(200);
		}, 600);
	});
	// Presets manager - add new preset
	$('#devn-generator').on('click', '.devn-gp-new', function (e) {
		// Prepare data
		var $container = $(this).parents('.devn-generator-presets'),
			$list = $('.devn-gp-list'),
			id = new Date().getTime();
		// Ask for preset name
		var name = prompt(devn_Shortcode_Generator.presets_prompt_msg, devn_Shortcode_Generator.presets_prompt_value);
		// Name is entered
		if (name !== '' && name !== null) {
			// Hide default text
			$list.find('b').hide();
			// Add new option
			$list.append('<span data-id="' + id + '"><em>' + name + '</em><i class="fa fa-times"></i></span>');
			// Perform AJAX request
			add_preset(id, name);
		}
	});
	// Presets manager - load preset
	$('#devn-generator').on('click', '.devn-gp-list span', function (e) {
		// Prepare data
		var shortcode = $('.devn-generator-presets').data('shortcode'),
			id = $(this).data('id'),
			$insert = $('.devn-generator-insert');
		// Hide popup
		$('.devn-gp-popup').hide();
		// Disable hover timer
		clearTimeout(gp_hover_timer);
		// Get the preset
		$.ajax({
			type: 'GET',
			url: ajaxurl,
			data: {
				action: 'devn_Shortcode_Generator_get_preset',
				id: id,
				shortcode: shortcode
			},
			beforeSend: function () {
				// Disable insert button
				$insert.addClass('button-primary-disabled').attr('disabled', true);
			},
			success: function (data) {
				// Enable insert button
				$insert.removeClass('button-primary-disabled').attr('disabled', false);
				// Set new settings
				set(data);
			},
			dataType: 'json'
		});
		// Prevent default action
		e.preventDefault();
		e.stopPropagation();
	});
	// Presets manager - remove preset
	$('#devn-generator').on('click', '.devn-gp-list i', function (e) {
		// Prepare data
		var $list = $(this).parents('.devn-gp-list'),
			$preset = $(this).parent('span'),
			id = $preset.data('id');
		// Remove DOM element
		$preset.remove();
		// Show default text if last preset was removed
		if ($list.find('span').length < 1) $list.find('b').show();
		// Perform ajax request
		remove_preset(id);
		// Prevent <span> action
		e.stopPropagation();
		// Prevent default action
		e.preventDefault();
	});

	/**
	 * Create new preset with specified name from current settings
	 */
	function add_preset(id, name) {
		// Prepare shortcode name and current settings
		var shortcode = $('.devn-generator-presets').data('shortcode'),
			settings = get();
		// Perform AJAX request
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'devn_Shortcode_Generator_add_preset',
				id: id,
				name: name,
				shortcode: shortcode,
				settings: settings
			}
		});
	}

	/**
	 * Remove preset by ID
	 */
	function remove_preset(id) {
		// Get current shortcode name
		var shortcode = $('.devn-generator-presets').data('shortcode');
		// Perform AJAX request
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'devn_Shortcode_Generator_remove_preset',
				id: id,
				shortcode: shortcode
			}
		});
	}

	function parse() {
		// Prepare data
		var query = $selected.val(),
			prefix = $prefix.val(),
			$settings = $('#devn-generator-settings-instant .devn-generator-attr-container:not(.devn-generator-skip) .devn-generator-attr'),
			content = ID('devn-generator-content-instant').value,
			result = new String('');
		// Open shortcode
		result += '[' + prefix + query;
		// Add shortcode attributes
		$settings.each(function () {
			// Prepare field and value
			var $this = $(this),
				value = '';
			// Selects
			if ($this.is('select')) value = $this.find('option:selected').val();
			// Other fields
			else value = $this.val();
			// Check that value is not empty
			if (value == null) value = '';
			else if (typeof value === 'array') value = value.join(',');
			// Add attribute
			if (value !== '') result += ' ' + $(this).attr('name') + '="' + $(this).val().toString().replace(/"/gi, "'") + '"';
		});
		// End of opening tag
		result += ']';
		// Wrap shortcode if content presented
		if (content != 'false') result += content + '[/' + prefix + query + ']';
		// Return result
		return result;
	}

	function get() {
		// Prepare data
		var query = $selected.val(),
			$settings = $('#devn-generator-settings .devn-generator-attr'),
			content = $('#devn-generator-content-instant').val(),
			data = {};
		// Add shortcode attributes
		$settings.each(function (i) {
			// Prepare field and value
			var $this = $(this),
				value = '',
				name = $this.attr('name');
			// Selects
			if ($this.is('select')) value = $this.find('option:selected').val();
			// Other fields
			else value = $this.val();
			// Check that value is not empty
			if (value == null) value = '';
			// Save value
			data[name] = value;
		});
		// Add content
		data['content'] = content.toString();
		// Return data
		return data;
	}

	function set(data) {
		// Prepare data
		var $settings = $('#devn-generator-settings-instant .devn-generator-attr'),
			$content = $('#devn-generator-content-instant');
		// Loop through settings
		$settings.each(function () {
			var $this = $(this),
				name = $this.attr('name');
			// Data contains value for this field
			if (data.hasOwnProperty(name)) {
				// Set new value
				$this.val(data[name]);
				$this.trigger('keyup').trigger('change').trigger('blur');
			}
		});
		// Set content
		if (data.hasOwnProperty('content')) $content.val(data['content']).trigger('keyup').trigger('change').trigger('blur');

	}
	
	function instantPreview( shortcode ){

		clearTimeout( timerInstantPreview );
		
		timerInstantPreview = setTimeout( function(){
			instantPreviewRun( shortcode );
		}, 400 );
			
	}	
	function instantPreviewRun( shortcode ){
	
		var data = Base64.encode(shortcode);
		var url = site_uri+'/wp-admin/admin-ajax.php?action=devn_Shortcode_Generator_preview&shortcode='+data;
		var _class = grid.fn.shortcode, ij = getIJ();
		
		if( typeof _class.iframe == 'object' ){

			_class.iframe.src = url;
			ij( _class.iframe ).attr({ 'shortcode-data' : data });
			
			if( url.length > 2048 ){
				_class.previewByPost( _class.iframe );
			}

			$('#shortcode-wrap .devn-generator-actions').addClass('updatingPreview');
			
		}else if( _class.iframe == 'addNew' ){
		
			var random 	= parseInt( Math.random()*100000000 );
			var ifr = '<div><iframe scrolling="no" onload="top.grid.fn.shortcode.onLoadPreview(this)" name="shortcode-ifr-prev-'+random+'" class="shortcode-ifr-prev" src="'+url+'" shortcode-data="'+data+'"></iframe></div>';
			
			formatDoc( 'insertHTML', ifr );
			
			ij('iframe').each(function(){
				if( this.name == 'shortcode-ifr-prev-'+random ){
					grid.fn.shortcode.iframe = this;
				}
			});
			
			if( url.length > 2048 ){
				_class.previewByPost( _class.iframe );
			}
			
		}
		
		ID('shortcodeActivity').style.display = 'block';
		ID('liveModeInnerBtns').style.display = 'none';
		
	}

}


function su_preview_iframe_onload(ifr){

	var ifdocument = ifr.contentWindow.document;
	var ifdoc = ifdocument.getElementsByTagName('html')[0];
	
	/*$(ifdoc).append('<link rel="stylesheet" href="'+theme+'/css/bootstrap3/css/bootstrap.min.css" type="text/css" media="all" />');*/
	jQuery(ifdoc).append('<style type="text/css">html,body{overflow:hidden;background:transparent;padding:0px;margin:0px;border:none;}</style>');
	
	var height = ifdoc.offsetHeight;
	ifr.style.height = (height)+'px';
	
	ifdocument.iframePar = ifr;
	
	ifdocument.onclick = function(){
		top.su_preview_iframe_onload(this.iframePar);
	}	
	
}	
