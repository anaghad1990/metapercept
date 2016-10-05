/**
 * Admin
 */
jQuery(function ($) {

    $(document).on('change', '.devn_filter_type, .devn_filter_attributes', function (e) {
        var t = this,
            container = $(this).parents('.widget-content').find('.devn_filter_placeholder').html(''),
            spinner = container.next('.spinner').show();


        var display = $(this).parents('.widget-content').find('#dev-filter-display');

        var data = {
            action   : 'devn_filter_select_type',
            id       : $('input[name=widget_id]', $(t).parents('.widget-content')).val(),
            name     : $('input[name=widget_name]', $(t).parents('.widget-content')).val(),
            attribute: $('.devn_filter_attributes', $(t).parents('.widget-content')).val(),
            value    : $('.devn_filter_type', $(t).parents('.widget-content')).val(),
        };

        /* Hierarchical hide/show */
        if (data.value == 'list' || data.value == 'select') {
            display.show();
        } else if (data.value == 'label' || data.value == 'color') {
            display.hide();
        }

        $.post(ajaxurl, data, function (response) {
            spinner.hide();
            container.html(response.content);
            $(document).trigger('devn_colorpicker');
        }, 'json');
    });

    //color-picker
    $(document).on('devn_colorpicker',function () {
        $('.devn-colorpicker').each(function () {
            $(this).wpColorPicker();
        });
    }).trigger('devn_colorpicker');
});