(function($) {
    'use strict';

    var woocommerce = {};
    edgtf.modules.woocommerce = woocommerce;

    woocommerce.edgtfInitQuantityButtons = edgtfInitQuantityButtons;
    woocommerce.edgtfInitSelect2 = edgtfInitSelect2;
    woocommerce.edgtfAddedToCartButton = edgtfAddedToCartButton;

    woocommerce.edgtfOnDocumentReady = edgtfOnDocumentReady;
    woocommerce.edgtfOnWindowLoad = edgtfOnWindowLoad;
    woocommerce.edgtfOnWindowResize = edgtfOnWindowResize;
    woocommerce.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitQuantityButtons();
        edgtfInitSelect2();
        edgtfAddedToCartButton();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
    	edgtfInitSingleProductSlider();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {

    }
    

    function edgtfInitQuantityButtons() {

         $(document).on('click', '.edgtf-quantity-minus, .edgtf-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.parent().siblings('.edgtf-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('edgtf-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined || isNaN(max)) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
            inputField.trigger('change');
        });

    }

    function edgtfInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country, .dropdown_product_cat, .dropdown_layered_nav_color').select2();

        }

    }

    function edgtfAddedToCartButton(){
        $('body').on("added_to_cart", function( data ) {

            var btn = $('a.added_to_cart:not(.edgtf-btn)');
            btn.addClass('edgtf-btn').html("<span class='edgtf-icon-font-elegant icon_check'></span><span class='edgtf-btn-text'>"+btn.html()+"</span>");
        });
    }

    function edgtfInitSingleProductSlider() {
        if($('.edgtf-single-product-images').length) {
        	var productImages = $('.edgtf-single-product-images'),
            	sliderHolder = $('.edgtf-single-product-slider'),
            	sliderThumbnails = productImages.find('.thumbnails'),
            	productImage, thumbImage;

            sliderHolder.on('init', function(slick){
                sliderHolder.css("opacity", 1);
            });
            sliderThumbnails.on('init', function(slick){
                sliderThumbnails.css("opacity", 1);
                productImage = sliderHolder.find( 'img:eq(0)' );
                thumbImage = sliderThumbnails.find('.edgtf-single-product-thumbnail[data-slick-index=0]');
            });

            if(sliderHolder.length > 0) {
                sliderHolder.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    draggable: false
                });
            }

            if(sliderThumbnails.length > 0) {
                sliderThumbnails.slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    dots: false,
                    arrows: false,
                    vertical: true,
                    verticalSwiping: true,
                    draggable: true,
                    focusOnSelect: true,
                    infinite: false,
  					asNavFor: sliderHolder,
                });
            }
        }
    }

})(jQuery);