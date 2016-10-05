(function($) {
    'use strict';

    var shortcodes = {};

    edgtf.modules.shortcodes = shortcodes;

    shortcodes.edgtfInitCounter = edgtfInitCounter;
    shortcodes.edgtfInitProgressBars = edgtfInitProgressBars;
    shortcodes.edgtfInitCountdown = edgtfInitCountdown;
    shortcodes.edgtfInitMessages = edgtfInitMessages;
    shortcodes.edgtfInitMessageHeight = edgtfInitMessageHeight;
    shortcodes.edgtfInitTestimonials = edgtfInitTestimonials;
    shortcodes.edgtfInitCarousels = edgtfInitCarousels;
    shortcodes.edgtfInitPieChart = edgtfInitPieChart;
    shortcodes.edgtfInitPieChartDoughnut = edgtfInitPieChartDoughnut;
    shortcodes.edgtfInitTabs = edgtfInitTabs;
    shortcodes.edgtfInitTabIcons = edgtfInitTabIcons;
    shortcodes.edgtfInitBlogListMasonry = edgtfInitBlogListMasonry;
    shortcodes.edgtfInitBlogListNarrow = edgtfInitBlogListNarrow;
    shortcodes.edgtfCustomFontResize = edgtfCustomFontResize;
    shortcodes.edgtfInitImageGallery = edgtfInitImageGallery;
    shortcodes.edgtfInitAccordions = edgtfInitAccordions;
    shortcodes.edgtfShowGoogleMap = edgtfShowGoogleMap;
    shortcodes.edgtfInitPortfolioListMasonry = edgtfInitPortfolioListMasonry;
    shortcodes.edgtfInitPortfolioListPinterest = edgtfInitPortfolioListPinterest;
    shortcodes.edgtfInitPortfolio = edgtfInitPortfolio;
    shortcodes.edgtfPortfolioPopUp = edgtfPortfolioPopUp;
    shortcodes.edgtfInitPortfolioMasonryFilter = edgtfInitPortfolioMasonryFilter;
    shortcodes.edgtfInitPortfolioSlider = edgtfInitPortfolioSlider;
    shortcodes.edgtfInitPortfolioLoadMore = edgtfInitPortfolioLoadMore;
    shortcodes.edgtfCheckSliderForHeaderStyle = edgtfCheckSliderForHeaderStyle;
    shortcodes.edgtfInitShopListMasonry = edgtfInitShopListMasonry;
    shortcodes.edgtfItemShowcase = edgtfItemShowcase;
    shortcodes.edgtfComboSlider = edgtfComboSlider;
    shortcodes.edgtfCustomFontTypeOut = edgtfCustomFontTypeOut;
    shortcodes.edgtfTiltZoom = edgtfTiltZoom;
    shortcodes.edgtfCascadingImages = edgtfCascadingImages;
    shortcodes.edgtfInitVerticalMarquee = edgtfInitVerticalMarquee;
    shortcodes.edgtfDevicePresentation = edgtfDevicePresentation;

    shortcodes.edgtfOnDocumentReady = edgtfOnDocumentReady;
    shortcodes.edgtfOnWindowLoad = edgtfOnWindowLoad;
    shortcodes.edgtfOnWindowResize = edgtfOnWindowResize;
    shortcodes.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitCounter();
        edgtfInitProgressBars();
        edgtfInitCountdown();
        edgtfIcon().init();
        edgtfInitMessages();
        edgtfInitMessageHeight();
        edgtfInitTestimonials();
        edgtfInitCarousels();
        edgtfInitPieChart();
        edgtfInitPieChartDoughnut();
        edgtfInitTabs();
        edgtfInitTabIcons();
        edgtfButton().init();
        edgtfInitBlogListMasonry();
        edgtfInitBlogListNarrow();
		edgtfInitBlogSlider();
        edgtfCustomFontResize();
        edgtfInitImageGallery();
        edgtfInitAccordions();
        edgtfShowGoogleMap();
        edgtfInitPortfolioListMasonry();
        edgtfInitPortfolioListPinterest();
        edgtfInitPortfolio();
        edgtfPortfolioPopUp();
        edgtfInitPortfolioMasonryFilter();
        edgtfInitPortfolioSlider();
        edgtfInitPortfolioLoadMore();
        edgtfSlider().init();
        edgtfSocialIconWidget().init();
        edgtfInitIconList().init();
        edgtfInitShopListMasonry();
	    edgtfInitVerticalSplitSlider();
	    edgtfItemShowcase();
	    edgtfComboSlider();
        edgtfCustomFontTypeOut();
	    edgtfNumberedBoxes().init();
        edgtfInitPreviewSlider();
        edgtfDevicePresentation();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
		edgtfAnimationElementHolder();
		edgtfTiltZoom();
		edgtfCascadingImages();
		edgtfInitVerticalMarquee();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfInitBlogListMasonry();
        edgtfCustomFontResize();
        edgtfInitPortfolioListMasonry();
        edgtfInitPortfolioListPinterest();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {
        
    }

    

    /**
     * Counter Shortcode
     */
    function edgtfInitCounter() {

        var counters = $('.edgtf-counter');


        if (counters.length) {
            counters.each(function() {
                var counter = $(this);
                counter.appear(function() {
                    counter.parent().addClass('edgtf-counter-holder-show');

                    //Counter zero type
                    if (counter.hasClass('zero')) {
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        counter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }

                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            });
        }

    }
    
    /*
    **	Horizontal progress bars shortcode
    */
    function edgtfInitProgressBars(){
        
        var progressBar = $('.edgtf-progress-bar');
        
        if(progressBar.length){
            
            progressBar.each(function() {
                
                var thisBar = $(this);
                
                thisBar.appear(function() {
                    edgtfInitToCounterProgressBar(thisBar);
                    if(thisBar.find('.edgtf-floating.edgtf-floating-inside') !== 0){
                        var floatingInsideMargin = thisBar.find('.edgtf-progress-content').height();
                        floatingInsideMargin += parseFloat(thisBar.find('.edgtf-progress-title-holder').css('padding-bottom'));
                        floatingInsideMargin += parseFloat(thisBar.find('.edgtf-progress-title-holder').css('margin-bottom'));
                        thisBar.find('.edgtf-floating-inside').css('margin-bottom',-(floatingInsideMargin)+'px');
                    }
                    var percentage = thisBar.find('.edgtf-progress-content').data('percentage'),
                        progressContent = thisBar.find('.edgtf-progress-content'),
                        progressNumber = thisBar.find('.edgtf-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage+'%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage+'%'}, 1500);

                });
            });
        }
    }

    /*
    **	Counter for horizontal progress bars percent from zero to defined percent
    */
    function edgtfInitToCounterProgressBar(progressBar){
        var percentage = parseFloat(progressBar.find('.edgtf-progress-content').data('percentage'));
        var percent = progressBar.find('.edgtf-progress-number .edgtf-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.edgtf-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }
    
    /*
    **	Function to close message shortcode
    */
    function edgtfInitMessages(){
        var message = $('.edgtf-message');
        if(message.length){
            message.each(function(){
                var thisMessage = $(this);
                thisMessage.find('.edgtf-close').click(function(e){
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }
    
    /*
    **	Init message height
    */
    function edgtfInitMessageHeight(){
       var message = $('.edgtf-message.edgtf-with-icon');
       if(message.length){
           message.each(function(){
               var thisMessage = $(this);
               var textHolderHeight = thisMessage.find('.edgtf-message-text-holder').height();
               var iconHolderHeight = thisMessage.find('.edgtf-message-icon-holder').height();
               
               if(textHolderHeight > iconHolderHeight) {
                   thisMessage.find('.edgtf-message-icon-holder').height(textHolderHeight);
               } else {
                   thisMessage.find('.edgtf-message-text-holder').height(iconHolderHeight);
               }
           });
       }
    }

    /**
     * Countdown Shortcode
     */
    function edgtfInitCountdown() {

        var countdowns = $('.edgtf-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if (countdowns.length) {

            countdowns.each(function(){

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#'+countdownId),
                    digitFontSize,
                    labelFontSize,
                    labelColor;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');
                labelColor = countdown.data('label-color');

                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size' : digitFontSize+'px',
                        'line-height' : digitFontSize+'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size' : labelFontSize+'px',
                        'color' : labelColor,
                    });
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var edgtfIcon = edgtf.modules.shortcodes.edgtfIcon = function() {
        //get all icons on page
        var icons = $('.edgtf-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('edgtf-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.edgtf-icon-animation-holder').addClass('edgtf-icon-animation-show');
                }, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.edgtf-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var edgtfSocialIconWidget = edgtf.modules.shortcodes.edgtfSocialIconWidget = function() {
        //get all social icons on page
        var icons = $('.edgtf-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function edgtfInitTestimonials(){

        var testimonial = $('.edgtf-testimonials');
        if(testimonial.length){
            testimonial.each(function(){

                var thisTestimonial = $(this);

                thisTestimonial.appear(function() {
                    thisTestimonial.css('visibility','visible');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

                var auto = true;
                var controlNav = true;
                var directionNav = true;
                var animationSpeed = 800;
				var responsive;
				var slidesToShow = 1;

                if(typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
                    animationSpeed = thisTestimonial.data('animation-speed');
                }

				if(typeof thisTestimonial.data('dots-navigation') !== 'undefined') {
					controlNav = thisTestimonial.data('dots-navigation');
				}
				if(typeof thisTestimonial.data('arrows-navigation') !== 'undefined') {
					directionNav = thisTestimonial.data('arrows-navigation');
				}

				if(thisTestimonial.hasClass('edgtf-testimonials-type-carousel')){
					slidesToShow = 3;

					responsive = [
						{
							breakpoint: 1024,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1,
								infinite: true
							}
						},
						{
							breakpoint: 600,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}
					];
				}

				thisTestimonial.slick({
					infinite: true,
					autoplay: auto,
                    autoplaySpeed: 3000,
					slidesToShow : slidesToShow,
					arrows: directionNav,
					dots: controlNav,
					dotsClass: 'edgtf-slick-dots',
					adaptiveHeight: true,
                    easing: 'easeInOutQuint',
                    speed: animationSpeed,
					prevArrow: '<span class="edgtf-slick-prev edgtf-prev-icon"><span class="arrow_carrot-left"></span></span>',
					nextArrow: '<span class="edgtf-slick-next edgtf-next-icon"><span class="arrow_carrot-right"></span></span>',
					customPaging: function(slider, i) {
						return '<span class="edgtf-slick-dot-inner"></span>';
					},
					responsive: responsive
				});

            });

        }

    }

    /**
     * Init Carousel shortcode
     */
    function edgtfInitCarousels() {

        var carouselHolders = $('.edgtf-carousel-holder'),
            carousel,
            numberOfItems,
			arrowsNavigation,
			dotsNavigation;

        if (carouselHolders.length) {
            carouselHolders.each(function(){
                carousel = $(this).children('.edgtf-carousel');
                numberOfItems = carousel.data('items');
                arrowsNavigation = (carousel.data('arrows-navigation') == 'yes') ? true : false;
                dotsNavigation = (carousel.data('dots-navigation') == 'yes') ? true : false;

                //Responsive breakpoints

      			carousel.slick({
					infinite: true,
					autoplay: true,
					slidesToShow : numberOfItems,
					arrows: arrowsNavigation,
					dots: dotsNavigation,
					dotsClass: 'edgtf-slick-dots',
					adaptiveHeight: true,
					prevArrow: '<span class="edgtf-slick-prev edgtf-prev-icon"><span class="arrow_carrot-left"></span></span>',
					nextArrow: '<span class="edgtf-slick-next edgtf-next-icon"><span class="arrow_carrot-right"></span></span>',
					customPaging: function(slider, i) {
						return '<span class="edgtf-slick-dot-inner"></span>';
					},
                    easing: 'easeInOutQuint',
                    speed: 800,
                    touchMove: false,
					responsive: [
						{
							breakpoint: 1024,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 1,
								infinite: true,
								dots: false
							}
						},
						{
							breakpoint: 600,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1
							}
						},
						{
							breakpoint: 480,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}
					]
				});


			});
        }

    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function edgtfInitPieChart() {

        var pieCharts = $('.edgtf-pie-chart-holder, .edgtf-pie-chart-with-icon-holder');

        if (pieCharts.length) {

            pieCharts.each(function () {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.edgtf-percentage, .edgtf-percentage-with-icon'),
                    barColor = '#387ce0',
                    trackColor = '#d9d9d9',
                    lineWidth = '9',
                    size = 200;

                if(typeof percentageHolder.data('bar-color') !== 'undefined' && percentageHolder.data('bar-color') !== '') {
                    barColor = percentageHolder.data('bar-color');
                }

                if(typeof percentageHolder.data('track-color') !== 'undefined' && percentageHolder.data('track-color') !== '') {
                    trackColor = percentageHolder.data('track-color');
                }

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

            });

        }

    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart( pieChart ){

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.edgtf-to-counter'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /**
     * Init Pie Chart shortcode
     */
    function edgtfInitPieChartDoughnut() {

        var pieCharts = $('.edgtf-pie-chart-doughnut-holder, .edgtf-pie-chart-pie-holder');

        pieCharts.each(function(){

            var pieChart = $(this),
                canvas = pieChart.find('canvas'),
                chartID = canvas.attr('id'),
                chart = document.getElementById(chartID).getContext('2d'),
                data = [],
                jqChart = $(chart.canvas); //Convert canvas to JQuery object and get data parameters

            for (var i = 1; i<=10; i++) {

                var chartItem,
                    value = jqChart.data('value-' + i),
                    color = jqChart.data('color-' + i);
                
                if (typeof value !== 'undefined' && typeof color !== 'undefined' ) {
                    chartItem = {
                        value : value,
                        color : color
                    };
                    data.push(chartItem);
                }

            }

            if (canvas.hasClass('edgtf-pie')) {
                new Chart(chart).Pie(data,
                    {segmentStrokeColor : 'transparent'}
                );
            } else {
                new Chart(chart).Doughnut(data,
                    {segmentStrokeColor : 'transparent'}
                );
            }

        });

    }

    /*
    **	Init tabs shortcode
    */
    function edgtfInitTabs(){

       var tabs = $('.edgtf-tabs');
        if(tabs.length){
            tabs.each(function(){
                var thisTabs = $(this);

                thisTabs.children('.edgtf-tab-container').each(function(index){
                    index = index + 1;
                    var that = $(this),
                        link = that.attr('id'),
                        navItem = that.parent().find('.edgtf-tabs-nav li:nth-child('+index+') a'),
                        navLink = navItem.attr('href');

                        link = '#'+link;

                        if(link.indexOf(navLink) > -1) {
                            navItem.attr('href',link);
                        }
                });

                if(thisTabs.hasClass('edgtf-horizontal-tab')){
                    thisTabs.tabs();
                } else if(thisTabs.hasClass('edgtf-vertical-tab')){
                    thisTabs.tabs().addClass( 'ui-tabs-vertical ui-helper-clearfix' );
                    thisTabs.find('.edgtf-tabs-nav > ul >li').removeClass( 'ui-corner-top' ).addClass( 'ui-corner-left' );
                }
            });
        }
    }

    /*
    **	Generate icons in tabs navigation
    */
    function edgtfInitTabIcons(){

        var tabContent = $('.edgtf-tab-container');
        if(tabContent.length){

            tabContent.each(function(){
                var thisTabContent = $(this);

                var id = thisTabContent.attr('id');
                var icon = '';
                if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
                    icon = thisTabContent.data('icon-html');
                }

                var tabNav = thisTabContent.parents('.edgtf-tabs').find('.edgtf-tabs-nav > li > a[href="#'+id+'"]');

                if(typeof(tabNav) !== 'undefined') {
                    tabNav.children('.edgtf-icon-frame').append(icon);
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var edgtfButton = edgtf.modules.shortcodes.edgtfButton = function() {
        //all buttons on the page
        var buttons = $('.edgtf-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
                button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
            }
        };



        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };
    
    /*
    **	Init blog list masonry type
    */
    function edgtfInitBlogListMasonry(){
        var blogList = $('.edgtf-blog-list-holder.edgtf-masonry .edgtf-blog-list');
        if(blogList.length) {
            blogList.each(function() {
                var thisBlogList = $(this);
                blogList.waitForImages(function() {
                    thisBlogList.isotope({
                        itemSelector: '.edgtf-blog-list-masonry-item',
                        masonry: {
                            columnWidth: '.edgtf-blog-list-masonry-grid-sizer',
                            gutter: '.edgtf-blog-list-masonry-grid-gutter'
                        }
                    });
                    thisBlogList.addClass('edgtf-appeared');
                });
            });

        }
    }

    /*
    * Init FX for blog list narrow
    */
    function edgtfInitBlogListNarrow() {
        var blogLists = $('.edgtf-blog-list-holder.edgtf-narrow');
        if (blogLists.length) {
            blogLists.each(function(){
                var blogList = $(this);

                if (blogList.hasClass('edgtf-animate')) {
                    var articles = blogList.find('.edgtf-blog-list-item'),
                        animateCycle = 2, // rewind delay
                        animateCycleCounter = 0;
                    articles.each(function(i){
                        var article = $(this);
                        article.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                article.addClass('edgtf-animated');
                            }, animateCycleCounter*150)
                        },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
                    });
                }

                if (blogList.hasClass('edgtf-hover-follows')) {
                    var articles = blogList.find('.edgtf-blog-list-item'),
                        articleHover = blogList.find('.edgtf-blog-narrow-bgrnd'),
                        flagUpLeave = false,
                        flagDownLeave = false;

                    articleHover.css({top: 0});

                    articles.each(function(){
                        var article = $(this);
                        article.mouseenter(function(){
                            flagUpLeave = false;
                            flagDownLeave = false;
                            articleHover.css({height: article.outerHeight()});
                            articleHover.css({top: article.offset().top - blogList.offset().top});
                        });
                    });

                    articles.first().mouseleave(function(){
                        flagUpLeave = true;
                    }); 

                    articles.last().mouseleave(function(){
                        flagDownLeave = true;
                    }); 

                    blogList.mouseleave(function(){
                        if (flagUpLeave == true) {
                            articleHover.css({top: -articleHover.outerHeight()});
                        }
                        if (flagDownLeave == true) {
                            articleHover.css({top:blogList.outerHeight()});
                        }
                    });
                }
            });
        }
    }

	/**
	 * Initializes portfolio slider
	 */

	function edgtfInitBlogSlider(){
		var blogSlider = $('.edgtf-blog-slider');
		if(blogSlider.length){
			blogSlider.each(function(){
				var thisBlogSlider = $(this);
				var navigation = false;
				var responsive;
				var slides = 1;

				if (typeof thisBlogSlider.data('type') !== 'undefined' && thisBlogSlider.data('type') !== false && thisBlogSlider.data('type') == 'carousel') {

					responsive = [
						{
							breakpoint: 1024,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1,
								infinite: true,
								dots: true
							}
						},
						{
							breakpoint: 600,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}
					];
					slides = 3;
				}

				thisBlogSlider.slick({
					infinite: true,
					autoplay: true,
					slidesToShow : slides,
					arrows: navigation,
					dots: true,
					dotsClass: 'edgtf-slick-dots',
					adaptiveHeight: true,
                    easing: 'easeInOutQuint',
                    speed: 800,
					prevArrow: '<span class="edgtf-slick-prev edgtf-prev-icon"><span class="arrow_carrot-left"></span></span>',
					nextArrow: '<span class="edgtf-slick-next edgtf-next-icon"><span class="arrow_carrot-right"></span></span>',
					customPaging: function(slider, i) {
						return '<span class="edgtf-slick-dot-inner"></span>';
					},
					responsive: responsive
				});
			});
		}
	}

	/*
	**	Custom Font resizing
	*/
	function edgtfCustomFontResize(){
		var customFont = $('.edgtf-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (edgtf.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (edgtf.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (edgtf.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (edgtf.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (edgtf.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && edgtf.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && edgtf.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **	Show Google Map
     */
    function edgtfShowGoogleMap(){

        if($('.edgtf-google-map').length){
            $('.edgtf-google-map').each(function(){

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_"+ uniqueId;
                var geocoder = "geocoder_"+ uniqueId;
                var holderId = "edgtf-map-"+ uniqueId;

                edgtfInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }
    /*
     **	Init Google Map
     */
    function edgtfInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [
            {
                stylers: [
                    {hue: color },
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle){
            googleMapStyleId = 'edgtf-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Edge Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)){
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'edgtf-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('edgtf-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            edgtfInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }
    /*
     **	Init Google Map Addresses
     */
    function edgtfInitializeGoogleAddress(data, pin,  map, geocoder){
        if (data === '')
            return;
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<p>'+data+'</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode( { 'address': data}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon:  pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function edgtfInitAccordions(){
        var accordion = $('.edgtf-accordion-holder');
        if(accordion.length){
            accordion.each(function(){

               var thisAccordion = $(this);

				if(thisAccordion.hasClass('edgtf-accordion')){

					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('edgtf-toggle')){

					var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.edgtf-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
            });
        }
    }

    function edgtfInitImageGallery() {

        var sliders = $('.edgtf-image-gallery-slider');

        if (sliders.length) {
            sliders.each(function () {
                var slider = $(this),
                    autoplay = slider.data('autoplay'),
                    navigation = (slider.data('navigation') == 'yes'),
                    pagination = (slider.data('pagination') == 'yes');

                slider.slick({
                    singleItem: true,
                    autoplay: true,
                    autoplaySpeed: autoplay * 1000,
                    arrows: navigation,
                    autoHeight: true,
                    dots: pagination,
                    easing: 'easeInOutQuint',
                    speed: 800,
                    prevArrow: '<span class="edgtf-slick-prev edgtf-prev-icon"><span class="arrow_carrot-left"></span></span>',
                    nextArrow: '<span class="edgtf-slick-next edgtf-next-icon"><span class="arrow_carrot-right"></span></span>',
                    customPaging: function(slider, i) {
                        return '<span class="edgtf-slick-dot-inner"></span>';
                    }
                });
            });
        }
        
        var carousels = $('.edgtf-image-gallery-carousel-wrapper');

        if (carousels.length) {
            carousels.each(function () {
                var carousel = $(this).children('.edgtf-image-gallery-carousel'),
                    navigation = (carousel.data('navigation') == 'yes'),
                    pagination = (carousel.data('pagination') == 'yes'),
                    columnNumberCarousel = 4,
                    autoPlay = true,
                    autoPlaySpeed = 1;

                if(typeof carousel.data('autoplay') !== 'undefined' && carousel.data('autoplay') !== false){
                    autoPlay = true;
                    autoPlaySpeed = carousel.data('autoplay') * 1000;
                }

                if(typeof carousel.data('column_number_carousel') !== 'undefined' && carousel.data('column_number_carousel') !== false){
                    columnNumberCarousel = carousel.data('column_number_carousel');
                }

                var responsive = [
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 601,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ];



                carousel.slick({
                    autoplay: autoPlay,
                    autoplaySpeed: autoPlaySpeed,
                    arrows: navigation,
                    dots: pagination,
                    dotsClass: 'edgtf-slick-dots',
                    easing: 'easeInOutQuint',
                    speed: 800,
                    draggable: false,
                    slidesToShow: columnNumberCarousel,
                    prevArrow: '<span class="edgtf-slick-prev edgtf-prev-icon"><span class="arrow_carrot-left"></span></span>',
                    nextArrow: '<span class="edgtf-slick-next edgtf-next-icon"><span class="arrow_carrot-right"></span></span>',
                    responsive:responsive,
                    customPaging: function(slider, i) {
                        return '<span class="edgtf-slick-dot-inner"></span>';
                    },
                    touchMove: false,
                });
            });
        }

    }
    /**
     * Initializes portfolio list
     */
    function edgtfInitPortfolio(){
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-standard:not(.edgtf-portfolio-slider-holder), .edgtf-portfolio-list-holder-outer.edgtf-ptf-gallery:not(.edgtf-portfolio-slider-holder), .edgtf-portfolio-list-holder-outer.edgtf-ptf-gallery-with-space');
        if(portList.length){            
            portList.each(function(){
                var thisPortList = $(this);
                edgtfInitPortMixItUp(thisPortList);
            });
        }
    }
    /**
     * Initializes mixItUp function for specific container
     */
    function edgtfInitPortMixItUp(container){
        var filterClass = '';
        if(container.hasClass('edgtf-ptf-has-filter')){
            filterClass = container.find('.edgtf-portfolio-filter-holder-inner ul li').data('class');
            filterClass = '.'+filterClass;
        }
        
        var holderInner = container.find('.edgtf-portfolio-list-holder');
        holderInner.mixItUp({
            callbacks: {
                onMixLoad: function(){
                    holderInner.find('article').css('visibility','visible');
                },
                onMixStart: function(){
                    holderInner.find('article').css('visibility','visible');
                },
                onMixBusy: function(){
                    holderInner.find('article').css('visibility','visible');
                },
                onMixEnd: function(){
                	edgtf.modules.common.edgtfInitParallax();
                }
            },           
            selectors: {
                filter: filterClass
            },
            animation: {
                effects: 'fade',
                duration: 600
            }
            
        });
        
    }
     /*
    **	Init portfolio list masonry type
    */
    function edgtfInitPortfolioListMasonry(){
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-masonry');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.edgtf-portfolio-list-holder');
                var size = thisPortList.find('.edgtf-portfolio-list-masonry-grid-sizer').width();
                edgtfResizeMasonry(size,thisPortList);
                
                edgtfInitMasonry(thisPortList);
                $(window).resize(function(){
                    edgtfResizeMasonry(size,thisPortList);
                    edgtfInitMasonry(thisPortList);
                });
            });
        }
    }
    
    function edgtfInitMasonry(container){
        container.waitForImages(function() {
            container.isotope({
                itemSelector: '.edgtf-portfolio-item',
                masonry: {
                    columnWidth: '.edgtf-portfolio-list-masonry-grid-sizer'
                }
            });
            container.addClass('edgtf-appeared');
        });
    }
    
    function edgtfResizeMasonry(size,container){
        
        var defaultMasonryItem = container.find('.edgtf-default-masonry-item');
        var largeWidthMasonryItem = container.find('.edgtf-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.edgtf-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.edgtf-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeHeightMasonryItem.css('height', Math.round(2*size));

        if(edgtf.windowWidth > 600){
            largeWidthHeightMasonryItem.css('height', Math.round(2*size));
            largeWidthMasonryItem.css('height', size);
        }else{
            largeWidthHeightMasonryItem.css('height', size);
            largeWidthMasonryItem.css('height', Math.round(size/2));

        }
    }
    /**
     * Initializes portfolio pinterest 
     */
    function edgtfInitPortfolioListPinterest(){
        
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-pinterest');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.edgtf-portfolio-list-holder');
                edgtfInitPinterest(thisPortList);
                $(window).resize(function(){
                     edgtfInitPinterest(thisPortList);
                });
            });
            
        }
    }
    
    function edgtfInitPinterest(container){
        container.waitForImages(function() {
            container.addClass('edgtf-appeared');
            container.isotope({
                itemSelector: '.edgtf-portfolio-item',
                masonry: {
                    columnWidth: '.edgtf-portfolio-list-masonry-grid-sizer'
                }
            });
        }, ptfPinterestAppear(container));
    }

    function ptfPinterestAppear(container) {
        if (container.parent().hasClass('edgtf-ptf-appear')) {
            var articles = container.find('article'),
                animateCycle = 5, // rewind delay
                animateCycleCounter = 0;

            if (articles.length) {
                articles.each(function(){
                    var article = $(this);

                    setTimeout(function(){
                        article.appear(function(){
                            animateCycleCounter ++;

                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }

                            setTimeout(function(){
                                if (!article.hasClass('edgtf-appeared')) {
                                    article.addClass('edgtf-appeared');        
                                }
                            },animateCycleCounter * 120);
                        },{accX: 0, accY: 0});
                    },30);
                });
            }
        }
    }
    /**
     * Initializes portfolio masonry filter
     */
    function edgtfInitPortfolioMasonryFilter(){
        
        var filterHolder = $('.edgtf-portfolio-filter-holder.edgtf-masonry-filter');
        
        if(filterHolder.length){
            filterHolder.each(function(){
               
                var thisFilterHolder = $(this);
                
                var portfolioIsotopeAnimation = null;
                
                var filter = thisFilterHolder.find('ul li').data('class');
                
                thisFilterHolder.find('.filter:first').addClass('current');
                
                thisFilterHolder.find('.filter').click(function(){

                    var currentFilter = $(this);
                    clearTimeout(portfolioIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');

                    portfolioIsotopeAnimation = setTimeout(function(){
                        $('.isotope, .isotope .isotope-item').css('transition-duration','0s'); 
                    },700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.siblings('.edgtf-portfolio-list-holder-outer').find('.edgtf-portfolio-list-holder').isotope({ filter: selector });

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });
                
            });
        }
    }

    /**
     * Initializes portfolio popup
     */

	function edgtfPortfolioPopUp(){
		var portfolioPopUps = $('.edgtf-portfolio-item.edgtf-with-popup');

		if (portfolioPopUps.length){
			var popUpHolder,
				popUpHolderInner,
				popUpClose,
				launchHolder,
				imageHolder,
				popUpHtml;

			popUpHtml = '<div class="edgtf-ptf-popup-holder"><div class="edgtf-ptf-popup-holder-inner"> \
							<div class="edgtf-popup-content-table"> \
								<div class="edgtf-popup-top"> \
									<div class="edgtf-popup-top-left"></div>\
									<div class="edgtf-popup-top-right">\
										<a href="#" class="edgtf-ptf-close-popup">\
											<span class="icon_close"></span>\
										</a>\
									</div>\
								</div>\
								<div class="edgtf-popup-bottom">\
									<div class="edgtf-popup-bottom-holder">\
										<div class="edgtf-popup-bottom-inner"></div>\
									</div>\
								</div>\
							</div>\
						</div></div>';

			edgtf.body.append(popUpHtml);

			popUpHolder = $('.edgtf-ptf-popup-holder');
			popUpHolderInner = $('.edgtf-ptf-popup-holder-inner');
			popUpClose = popUpHolderInner.find('.edgtf-ptf-close-popup');
			launchHolder = popUpHolderInner.find('.edgtf-popup-top-left');
			imageHolder = popUpHolderInner.find('.edgtf-popup-bottom-inner');

			imageHolder.niceScroll({
				scrollspeed: 100,
				mousescrollstep: 100,
				cursorwidth: 6,
				cursorborder: 0,
				cursorborderradius: 50,
				cursorcolor: "rgba(255,255,255,0.5)",
				autohidemode: false,
				horizrailenabled: false,
				railoffset:{
					top: 0,
					left: 8
				}
			});

			popUpClose.on('touch click', function(e){
				e.preventDefault();
				popUpHolder.removeClass('edgtf-appeared');
				setTimeout(function(){
					launchHolder.empty();
					imageHolder.empty();
				},200);
				edgtf.modules.common.edgtfEnableScroll();
			});

            //Close on click away
            $(document).mouseup(function (e) {
            	if (popUpHolder.hasClass('edgtf-appeared')) {
	                if (!popUpHolderInner.is(e.target) && popUpHolderInner.has(e.target).length === 0)  {
	                    e.preventDefault();
	                    popUpHolder.removeClass('edgtf-appeared');
						setTimeout(function(){
							launchHolder.empty();
							imageHolder.empty();
						},200);
						edgtf.modules.common.edgtfEnableScroll();
	                }
	            }
            });

			portfolioPopUps.each(function(){
				var thisPopUp = $(this),
					popUpOpener = thisPopUp.find('.edgtf-portfolio-link-popup'),
					popUpLaunch = thisPopUp.find('.edgtf-ptf-popup-launch').html(),
					popUpContent = thisPopUp.find('.edgtf-popup-image').html();

				popUpOpener.unbind('touch click');				
				popUpOpener.on('touch click', function(e){
					e.preventDefault();
					edgtf.modules.common.edgtfDisableScroll();
						
					launchHolder.append(popUpLaunch);
					imageHolder.append(popUpContent);

					setTimeout(function(){
						popUpHolder.addClass('edgtf-appeared');
					},50);
				});	

			});
		}
	}

    /**
     * Initializes portfolio slider
     */
    
    function edgtfInitPortfolioSlider(){
        var portSlider = $('.edgtf-portfolio-list-holder-outer.edgtf-portfolio-slider-holder');
        if(portSlider.length){
            portSlider.each(function(){
                var thisPortSlider = $(this);
                var sliderWrapper = thisPortSlider.children('.edgtf-portfolio-list-holder');
                var numberOfItems = thisPortSlider.data('items');
                var navigation = true;

                sliderWrapper.slick({      
                    infinite: true,
                    autoplay: true,              
                    autoplaySpeed: 3000,
                    slidesToShow: numberOfItems,
                    dots: false,
                    arrows: navigation,
                    easing: 'easeInOutQuint',
                    speed: 500,
                    prevArrow: '<span class="edgtf-slick-prev edgtf-prev-icon"><span class="arrow_carrot-left"></span></span>',
                    nextArrow: '<span class="edgtf-slick-next edgtf-next-icon"><span class="arrow_carrot-right"></span></span>',
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: numberOfItems,
                                slidesToScroll: 1,
                                infinite: true,
                                dots: false
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]

                });
            });
        }
    }
    /**
     * Initializes portfolio load more function
     */
    function edgtfInitPortfolioLoadMore(){
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-load-more');
        if(portList.length){
            portList.each(function(){
                
                var thisPortList = $(this);
                var thisPortListInner = thisPortList.find('.edgtf-portfolio-list-holder');
                var size = thisPortListInner.find('.edgtf-portfolio-list-masonry-grid-sizer').width();
                var nextPage; 
                var maxNumPages;
                var loadMoreButton = thisPortList.find('.edgtf-ptf-list-load-more a');
                
                if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {  
                    maxNumPages = thisPortList.data('max-num-pages');
                }
                
                loadMoreButton.on('click', function (e) {  
                    var loadMoreDatta = edgtfGetPortfolioAjaxData(thisPortList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation(); 
                    if(nextPage <= maxNumPages){
                        var ajaxData = edgtfSetPortfolioAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: edgtCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisPortList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = edgtfConvertHTML(response.html); //convert response html into jQuery collection that Mixitup can work with
                                setTimeout(function() {
                                    if(thisPortList.hasClass('edgtf-ptf-masonry') || thisPortList.hasClass('edgtf-ptf-pinterest') ){
										thisPortList.waitForImages(function(){ 
											thisPortListInner.isotope().append( responseHtml ).isotope( 'appended', responseHtml ).isotope('reloadItems');

											edgtfResizeMasonry(size,thisPortListInner);
											edgtfInitMasonry(thisPortListInner);
                                            ptfPinterestAppear(thisPortListInner);
                                            edgtfTiltZoom();
                                            edgtfPortfolioPopUp();
										});
                                    } else {
										thisPortList.waitForImages(function(){ 
                                        	thisPortListInner.mixItUp('append',responseHtml, function(){});
                                            edgtfTiltZoom();
                                            edgtfPortfolioPopUp();
										});
                                    }
                                },400);
                                edgtfPortfolioPopUp();
                            }
                        });
                    }
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                });
                
            });
        }
    }
    
    function edgtfConvertHTML ( html ) {
        var newHtml = $.trim( html ),
                $html = $(newHtml ),
                $empty = $();

        $html.each(function ( index, value ) {
            if ( value.nodeType === 1) {
                $empty = $empty.add ( this );
            }
        });

        return $empty;
    }

    /**
     * Initializes portfolio load more data params
     * @param portfolio list container with defined data params
     * return array
     */
    function edgtfGetPortfolioAjaxData(container){
        var returnValue = {};
        
        returnValue.type = '';
        returnValue.columns = '';
        returnValue.gridSize = '';
        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.imageSize = '';
        returnValue.hoverType = '';
        returnValue.tabStyle = '';
        returnValue.popUp = '';
        returnValue.filter = '';
        returnValue.filterOrderBy = '';
        returnValue.category = '';
        returnValue.selectedProjectes = '';
        returnValue.showLoadMore = '';
        returnValue.titleTag = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        
        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.type = container.data('type');
        }
        if (typeof container.data('grid-size') !== 'undefined' && container.data('grid-size') !== false) {                    
            returnValue.gridSize = container.data('grid-size');
        }
        if (typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {                    
            returnValue.columns = container.data('columns');
        }
        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {                    
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {                    
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {                    
            returnValue.number = container.data('number');
        }
        if (typeof container.data('image-size') !== 'undefined' && container.data('image-size') !== false) {                    
            returnValue.imageSize = container.data('image-size');
        }
        if (typeof container.data('hover-type') !== 'undefined' && container.data('hover-type') !== false) {                    
            returnValue.hoverType = container.data('hover-type');
        }
        if (typeof container.data('tab-style') !== 'undefined' && container.data('tab-style') !== false) {                    
            returnValue.tabStyle = container.data('tab-style');
        }
        if (typeof container.data('pop-up') !== 'undefined' && container.data('pop-up') !== false) {                    
            returnValue.popUp = container.data('pop-up');
        }
        if (typeof container.data('filter') !== 'undefined' && container.data('filter') !== false) {                    
            returnValue.filter = container.data('filter');
        }
        if (typeof container.data('filter-order-by') !== 'undefined' && container.data('filter-order-by') !== false) {                    
            returnValue.filterOrderBy = container.data('filter-order-by');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('selected-projects') !== 'undefined' && container.data('selected-projects') !== false) {                    
            returnValue.selectedProjectes = container.data('selected-projects');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {                    
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {                    
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {                    
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {                    
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        return returnValue;
    }
     /**
     * Sets portfolio load more data params for ajax function
     * @param portfolio list container with defined data params
     * return array
     */
    function edgtfSetPortfolioAjaxData(container){
        var returnValue = {
            action: 'edgt_core_portfolio_ajax_load_more',
            type: container.type,
            columns: container.columns,
            gridSize: container.gridSize,
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            imageSize: container.imageSize,
            hoverType: container.hoverType,
            tabStyle: container.tabStyle,
            popUp: container.popUp,
            filter: container.filter,
            filterOrderBy: container.filterOrderBy,
            category: container.category,
            selectedProjectes: container.selectedProjectes,
            showLoadMore: container.showLoadMore,
            titleTag: container.titleTag,
            nextPage: container.nextPage
        };
        return returnValue;
    }

	/**
	 * Slider object that initializes whole slider functionality
	 * @type {Function}
	 */
	var edgtfSlider = edgtf.modules.shortcodes.edgtfSlider = function() {

		//all sliders on the page
		var sliders = $('.edgtf-slider .carousel');
		//image regex used to extract img source
		var imageRegex = /url\(["']?([^'")]+)['"]?\)/;

		/*** Functionality for translating image in slide - START ***/

		var matrixArray = { zoom_center : '1.2, 0, 0, 1.2, 0, 0', zoom_top_left: '1.2, 0, 0, 1.2, -150, -150', zoom_top_right : '1.2, 0, 0, 1.2, 150, -150', zoom_bottom_left: '1.2, 0, 0, 1.2, -150, 150', zoom_bottom_right: '1.2, 0, 0, 1.2, 150, 150'};

		// regular expression for parsing out the matrix components from the matrix string
		var matrixRE = /\([0-9epx\.\, \t\-]+/gi;

		// parses a matrix string of the form "matrix(n1,n2,n3,n4,n5,n6)" and
		// returns an array with the matrix components
		var parseMatrix = function (val) {
			return val.match(matrixRE)[0].substr(1).
			split(",").map(function (s) {
				return parseFloat(s);
			});
		};

		// transform css property names with vendor prefixes;
		// the plugin will check for values in the order the names are listed here and return as soon as there
		// is a value; so listing the W3 std name for the transform results in that being used if its available
		var transformPropNames = [
			"transform",
			"-webkit-transform"
		];

		var getTransformMatrix = function (el) {
			// iterate through the css3 identifiers till we hit one that yields a value
			var matrix = null;
			transformPropNames.some(function (prop) {
				matrix = el.css(prop);
				return (matrix !== null && matrix !== "");
			});

			// if "none" then we supplant it with an identity matrix so that our parsing code below doesn't break
			matrix = (!matrix || matrix === "none") ?
				"matrix(1,0,0,1,0,0)" : matrix;
			return parseMatrix(matrix);
		};

		// set the given matrix transform on the element; note that we apply the css transforms in reverse order of how its given
		// in "transformPropName" to ensure that the std compliant prop name shows up last
		var setTransformMatrix = function (el, matrix) {
			var m = "matrix(" + matrix.join(",") + ")";
			for (var i = transformPropNames.length - 1; i >= 0; --i) {
				el.css(transformPropNames[i], m + ' rotate(0.01deg)');
			}
		};

		// interpolates a value between a range given a percent
		var interpolate = function (from, to, percent) {
			return from + ((to - from) * (percent / 100));
		};

		$.fn.transformAnimate = function (opt) {
			// extend the options passed in by caller
			var options = {
				transform: "matrix(1,0,0,1,0,0)"
			};
			$.extend(options, opt);

			// initialize our custom property on the element to track animation progress
			this.css("percentAnim", 0);

			// supplant "options.step" if it exists with our own routine
			var sourceTransform = getTransformMatrix(this);
			var targetTransform = parseMatrix(options.transform);
			options.step = function (percentAnim, fx) {
				// compute the interpolated transform matrix for the current animation progress
				var $this = $(this);
				var matrix = sourceTransform.map(function (c, i) {
					return interpolate(c, targetTransform[i],
						percentAnim);
				});

				// apply the new matrix
				setTransformMatrix($this, matrix);

				// invoke caller's version of "step" if one was supplied;
				if (opt.step) {
					opt.step.apply(this, [matrix, fx]);
				}
			};

			// animate!
			return this.stop().animate({ percentAnim: 100 }, options);
		};

		/*** Functionality for translating image in slide - END ***/


		/**
		 * Calculate heights for slider holder and slide item, depending on window width, but only if slider is set to be responsive
		 * @param slider, current slider
		 * @param defaultHeight, default height of slider, set in shortcode
		 * @param responsive_breakpoint_set, breakpoints set for slider responsiveness
		 * @param reset, boolean for reseting heights
		 */
		var setSliderHeight = function(slider, defaultHeight, responsive_breakpoint_set, reset) {
			var sliderHeight = defaultHeight;
			if(!reset) {
				if(edgtf.windowWidth > responsive_breakpoint_set[0]) {
					sliderHeight = defaultHeight;
				} else if(edgtf.windowWidth > responsive_breakpoint_set[1]) {
					sliderHeight = defaultHeight * 0.75;
				} else if(edgtf.windowWidth > responsive_breakpoint_set[2]) {
					sliderHeight = defaultHeight * 0.6;
				} else if(edgtf.windowWidth > responsive_breakpoint_set[3]) {
					sliderHeight = defaultHeight * 0.55;
				} else if(edgtf.windowWidth <= responsive_breakpoint_set[3]) {
					sliderHeight = defaultHeight * 0.45;
				}
			}

			slider.css({'height': (sliderHeight) + 'px'});
			slider.find('.edgtf-slider-preloader').css({'height': (sliderHeight) + 'px'});
			slider.find('.edgtf-slider-preloader .edgtf-ajax-loader').css({'display': 'block'});
			slider.find('.item').css({'height': (sliderHeight) + 'px'});
			if(edgtfPerPageVars.vars.edgtfStickyScrollAmount === 0) {
				edgtf.modules.header.stickyAppearAmount = sliderHeight; //set sticky header appear amount if slider there is no amount entered on page itself
			}
		};

		/**
		 * Calculate heights for slider holder and slide item, depending on window size, but only if slider is set to be full height
		 * @param slider, current slider
		 */
		var setSliderFullHeight = function(slider) {
			var mobileHeaderHeight = edgtf.windowWidth < 1024 ? edgtfGlobalVars.vars.edgtfMobileHeaderHeight + $('.edgtf-top-bar').height() : 0;
			var passepartoutSlider = edgtf.windowWidth > 1024 ? edgtf.passepartout : 0;
			slider.css({'height': (edgtf.windowHeight - mobileHeaderHeight - passepartoutSlider) + 'px'});
			slider.find('.edgtf-slider-preloader').css({'height': (edgtf.windowHeight - mobileHeaderHeight - passepartoutSlider) + 'px'});
			slider.find('.edgt-slider-preloader .edgtf-ajax-loader').css({'display': 'block'});
			slider.find('.item').css({'height': (edgtf.windowHeight - mobileHeaderHeight - passepartoutSlider) + 'px'});
			if(edgtfPerPageVars.vars.edgtfStickyScrollAmount === 0) {
				edgtf.modules.header.stickyAppearAmount = edgtf.windowHeight; //set sticky header appear amount if slider there is no amount entered on page itself
			}
		};

		var setElementsResponsiveness = function(slider) {
			// Basic text styles responsiveness
			slider
				.find('.edgtf-slide-element-text-small, .edgtf-slide-element-text-normal, .edgtf-slide-element-text-large, .edgtf-slide-element-text-extra-large')
				.each(function() {
					var element = $(this);
					if (typeof element.data('default-font-size') === 'undefined') { element.data('default-font-size', parseInt(element.css('font-size'),10)); }
					if (typeof element.data('default-line-height') === 'undefined') { element.data('default-line-height', parseInt(element.css('line-height'),10)); }
					if (typeof element.data('default-letter-spacing') === 'undefined') { element.data('default-letter-spacing', parseInt(element.css('letter-spacing'),10)); }
				});
			// Advanced text styles responsiveness
			slider.find('.edgtf-slide-element-responsive-text').each(function() {
				if (typeof $(this).data('default-font-size') === 'undefined') { $(this).data('default-font-size', parseInt($(this).css('font-size'),10)); }
				if (typeof $(this).data('default-line-height') === 'undefined') { $(this).data('default-line-height', parseInt($(this).css('line-height'),10)); }
				if (typeof $(this).data('default-letter-spacing') === 'undefined') { $(this).data('default-letter-spacing', parseInt($(this).css('letter-spacing'),10)); }
			});
			// Button responsiveness
			slider.find('.edgtf-slide-element-responsive-button').each(function() {
				if (typeof $(this).data('default-font-size') === 'undefined') { $(this).data('default-font-size', parseInt($(this).find('a').css('font-size'),10)); }
				if (typeof $(this).data('default-line-height') === 'undefined') { $(this).data('default-line-height', parseInt($(this).find('a').css('line-height'),10)); }
				if (typeof $(this).data('default-letter-spacing') === 'undefined') { $(this).data('default-letter-spacing', parseInt($(this).find('a').css('letter-spacing'),10)); }
				if (typeof $(this).data('default-ver-padding') === 'undefined') { $(this).data('default-ver-padding', parseInt($(this).find('a').css('padding-top'),10)); }
				if (typeof $(this).data('default-hor-padding') === 'undefined') { $(this).data('default-hor-padding', parseInt($(this).find('a').css('padding-left'),10)); }
			});
			// Margins for non-custom layouts
			slider.find('.edgtf-slide-element').each(function() {
				var element = $(this);
				if (typeof element.data('default-margin-top') === 'undefined') { element.data('default-margin-top', parseInt(element.css('margin-top'),10)); }
				if (typeof element.data('default-margin-bottom') === 'undefined') { element.data('default-margin-bottom', parseInt(element.css('margin-bottom'),10)); }
				if (typeof element.data('default-margin-left') === 'undefined') { element.data('default-margin-left', parseInt(element.css('margin-left'),10)); }
				if (typeof element.data('default-margin-right') === 'undefined') { element.data('default-margin-right', parseInt(element.css('margin-right'),10)); }
			});
			adjustElementsSizes(slider);
		};

		var adjustElementsSizes = function(slider) {
			var boundaries = {
				// These values must match those in map.php (for slider), slider.php and edgt.layout.inc
				mobile: 600,
				tabletp: 800,
				tabletl: 1024,
				laptop: 1440
			};
			slider.find('.edgtf-slider-elements-container').each(function() {
				var container = $(this);
				var target = container.filter('.edgtf-custom-elements').add(container.not('.edgtf-custom-elements').find('.edgtf-slider-elements-holder-frame')).not('.edgtf-grid');
				if (target.length) {
					if (boundaries.mobile >= edgtf.windowWidth && container.attr('data-width-mobile').length) {
						target.css('width', container.data('width-mobile') + '%');
					}
					else if (boundaries.tabletp >= edgtf.windowWidth && container.attr('data-width-tablet-p').length) {
						target.css('width', container.data('width-tablet-p') + '%');
					}
					else if (boundaries.tabletl >= edgtf.windowWidth && container.attr('data-width-tablet-l').length) {
						target.css('width', container.data('width-tablet-l') + '%');
					}
					else if (boundaries.laptop >= edgtf.windowWidth && container.attr('data-width-laptop').length) {
						target.css('width', container.data('width-laptop') + '%');
					}
					else if (container.attr('data-width-desktop').length){
						target.css('width', container.data('width-desktop') + '%');
					}
				}
			});
			slider.find('.item').each(function() {
				var slide = $(this);
				var def_w = slide.find('.edgtf-slider-elements-holder-frame').data('default-width');
				var elements = slide.find('.edgtf-slide-element');

				// Adjusting margins for all elements
				elements.each(function() {
					var element = $(this);
					var def_m_top = element.data('default-margin-top'),
						def_m_bot = element.data('default-margin-bottom'),
						def_m_l = element.data('default-margin-left'),
						def_m_r = element.data('default-margin-right');
					var scale_data = (typeof element.data('resp-scale') !== 'undefined') ? element.data('resp-scale') : undefined;
					var factor;

					if (boundaries.mobile >= edgtf.windowWidth) {
						factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.mobile);
					}
					else if (boundaries.tabletp >= edgtf.windowWidth) {
						factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.tabletp);
					}
					else if (boundaries.tabletl >= edgtf.windowWidth) {
						factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.tabletl);
					}
					else if (boundaries.laptop >= edgtf.windowWidth) {
						factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.laptop);
					}
					else {
						factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.desktop);
					}

					element.css({
						'margin-top': Math.round(factor * def_m_top )+ 'px',
						'margin-bottom': Math.round(factor * def_m_bot )+ 'px',
						'margin-left': Math.round(factor * def_m_l )+ 'px',
						'margin-right': Math.round(factor * def_m_r) + 'px'
					});
				});

				// Adjusting responsiveness
				elements
					.filter('.edgtf-slide-element-responsive-text, .edgtf-slide-element-responsive-button, .edgtf-slide-element-responsive-image')
					.add(elements.find('a.edgtf-slide-element-responsive-text, span.edgtf-slide-element-responsive-text'))
					.each(function() {
						var element = $(this);
						var scale_data = (typeof element.data('resp-scale') !== 'undefined') ? element.data('resp-scale') : undefined,
							left_data = (typeof element.data('resp-left') !== 'undefined') ? element.data('resp-left') : undefined,
							top_data = (typeof element.data('resp-top') !== 'undefined') ? element.data('resp-top') : undefined;
						var factor, new_left, new_top;

						if (boundaries.mobile >= edgtf.windowWidth) {
							factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.mobile);
							new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.mobile != '' ? left_data.mobile+'%' : element.data('left')+'%');
							new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.mobile != '' ? top_data.mobile+'%' : element.data('top')+'%');
						}
						else if (boundaries.tabletp >= edgtf.windowWidth) {
							factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.tabletp);
							new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.tabletp != '' ? left_data.tabletp+'%' : element.data('left')+'%');
							new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.tabletp != '' ? top_data.tabletp+'%' : element.data('top')+'%');
						}
						else if (boundaries.tabletl >= edgtf.windowWidth) {
							factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.tabletl);
							new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.tabletl != '' ? left_data.tabletl+'%' : element.data('left')+'%');
							new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.tabletl != '' ? top_data.tabletl+'%' : element.data('top')+'%');
						}
						else if (boundaries.laptop >= edgtf.windowWidth) {
							factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.laptop);
							new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.laptop != '' ? left_data.laptop+'%' : element.data('left')+'%');
							new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.laptop != '' ? top_data.laptop+'%' : element.data('top')+'%');
						}
						else {
							factor = (typeof scale_data === 'undefined') ? edgtf.windowWidth / def_w : parseFloat(scale_data.desktop);
							new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left')+'%' : '') : (left_data.desktop != '' ? left_data.desktop+'%' : element.data('left')+'%');
							new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top')+'%' : '') : (top_data.desktop != '' ? top_data.desktop+'%' : element.data('top')+'%');
						}

						if (!factor) {
							element.hide();
						}
						else {
							element.show();
							var def_font_size,
								def_line_h,
								def_let_spac,
								def_ver_pad,
								def_hor_pad;

							if (element.is('.edgtf-slide-element-responsive-button')) {
								def_font_size = element.data('default-font-size');
								def_line_h = element.data('default-line-height');
								def_let_spac = element.data('default-letter-spacing');
								def_ver_pad = element.data('default-ver-padding');
								def_hor_pad = element.data('default-hor-padding');

								element.css({
										'left': new_left,
										'top': new_top
									})
									.find('.edgtf-btn').css({
									'font-size': Math.round(factor * def_font_size) + 'px',
									'line-height': Math.round(factor * def_line_h) + 'px',
									'letter-spacing': Math.round(factor * def_let_spac) + 'px',
									'padding-left': Math.round(factor * def_hor_pad) + 'px',
									'padding-right': Math.round(factor * def_hor_pad) + 'px',
									'padding-top': Math.round(factor * def_ver_pad) + 'px',
									'padding-bottom': Math.round(factor * def_ver_pad) + 'px'
								});
							}
							else if (element.is('.edgtf-slide-element-responsive-image')) {
								if (factor != edgtf.windowWidth / def_w) { // if custom factor has been set for this screen width
									var up_w = element.data('upload-width'),
										up_h = element.data('upload-height');

									element.filter('.custom-image').css({
											'left': new_left,
											'top': new_top
										})
										.add(element.not('.custom-image').find('img'))
										.css({
											'width': Math.round(factor * up_w) + 'px',
											'height': Math.round(factor * up_h) + 'px'
										});
								}
								else {
									var w = element.data('width');

									element.filter('.custom-image').css({
											'left': new_left,
											'top': new_top
										})
										.add(element.not('.custom-image').find('img'))
										.css({
											'width': w + '%',
											'height': ''
										});
								}
							}
							else {
								def_font_size = element.data('default-font-size');
								def_line_h = element.data('default-line-height');
								def_let_spac = element.data('default-letter-spacing');

								element.css({
									'left': new_left,
									'top': new_top,
									'font-size': Math.round(factor * def_font_size) + 'px',
									'line-height': Math.round(factor * def_line_h) + 'px',
									'letter-spacing': Math.round(factor * def_let_spac) + 'px'
								});
							}
						}
					});
			});
			var nav = slider.find('.carousel-indicators');
			slider.find('.edgtf-slide-element-section-link').css('bottom', nav.length ? parseInt(nav.css('bottom'),10) + nav.outerHeight() + 10 + 'px' : '20px');
		};

		var checkButtonsAlignment = function(slider) {
			slider.find('.item').each(function() {
				var inline_buttons = $(this).find('.edgtf-slide-element-button-inline');
				inline_buttons.css('display', 'inline-block').wrapAll('<div class="edgtf-slide-elements-buttons-wrapper" style="text-align: ' + inline_buttons.eq(0).css('text-align') + ';"/>');
			});
		};

		/**
		 * Set heights for slider and elemnts depending on slider settings (full height, responsive height od set height)
		 * @param slider, current slider
		 */
		var setHeights =  function(slider) {

			var responsiveBreakpointSet = [1600,1200,900,650,500,320];

			setElementsResponsiveness(slider);

			if(slider.hasClass('edgtf-full-screen')){

				setSliderFullHeight(slider);

				$(window).resize(function() {
					setSliderFullHeight(slider);
					adjustElementsSizes(slider);
				});

			}else if(slider.hasClass('edgtf-responsive-height')){

				var defaultHeight = slider.data('height');
				setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);

				$(window).resize(function() {
					setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
					adjustElementsSizes(slider);
				});

			}else {
				var defaultHeight = slider.data('height');

				slider.find('.edgtf-slider-preloader').css({'height': (slider.height()) + 'px'});
				slider.find('.edgtf-slider-preloader .edgtf-ajax-loader').css({'display': 'block'});

				edgtf.windowWidth < 1000 ? setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false) : setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);

				$(window).resize(function() {
					if(edgtf.windowWidth < 1000){
						setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
					}else{
						setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);
					}
					adjustElementsSizes(slider);
				});
			}
		};

		/**
		 * Set prev/next numbers on navigation arrows
		 * @param slider, current slider
		 * @param currentItem, current slide item index
		 * @param totalItemCount, total number of slide items
		 */
		var setPrevNextNumbers = function(slider, currentItem, totalItemCount) {
			if(currentItem == 1){
				slider.find('.left.carousel-control .prev').html(totalItemCount);
				slider.find('.right.carousel-control .next').html(currentItem + 1);
			}else if(currentItem == totalItemCount){
				slider.find('.left.carousel-control .prev').html(currentItem - 1);
				slider.find('.right.carousel-control .next').html(1);
			}else{
				slider.find('.left.carousel-control .prev').html(currentItem - 1);
				slider.find('.right.carousel-control .next').html(currentItem + 1);
			}
		};

		/**
		 * Set video background size
		 * @param slider, current slider
		 */
		var initVideoBackgroundSize = function(slider){
			var min_w = 1500; // minimum video width allowed
			var video_width_original = 1920;  // original video dimensions
			var video_height_original = 1080;
			var vid_ratio = 1920/1080;

			slider.find('.item .edgtf-video .edgtf-video-wrap').each(function(){

				var slideWidth = edgtf.windowWidth;
				var slideHeight = $(this).closest('.carousel').height();

				$(this).width(slideWidth);

				min_w = vid_ratio * (slideHeight+20);
				$(this).height(slideHeight);

				var scale_h = slideWidth / video_width_original;
				var scale_v = (slideHeight - edgtfGlobalVars.vars.edgtfMenuAreaHeight) / video_height_original;
				var scale =  scale_v;
				if (scale_h > scale_v)
					scale =  scale_h;
				if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

				$(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
				$(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
				$(this).scrollLeft(($(this).find('video').width() - slideWidth) / 2);
				$(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - slideHeight) / 2);
				$(this).scrollTop(($(this).find('video').height() - slideHeight) / 2);
			});
		};

		/**
		 * Init video background
		 * @param slider, current slider
		 */
		var initVideoBackground = function(slider) {
			$('.item .edgtf-video-wrap .edgtf-video-element').mediaelementplayer({
				enableKeyboard: false,
				iPadUseNativeControls: false,
				pauseOtherPlayers: false,
				// force iPhone's native controls
				iPhoneUseNativeControls: false,
				// force Android's native controls
				AndroidUseNativeControls: false
			});

			initVideoBackgroundSize(slider);
			$(window).resize(function() {
				initVideoBackgroundSize(slider);
			});

			//mobile check
			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
				$('.edgtf-slider .edgtf-mobile-video-image').show();
				$('.edgtf-slider .edgtf-video-wrap').remove();
			}
		};

		var initPeek = function(slider) {
			if (slider.hasClass('edgtf-slide-peek')) {

				var navArrowHover = function(arrow, entered) {
					var dir = arrow.is('.left') ? 'left' : 'right';
					var targ_peeker = peekers.filter('.'+dir);
					if (entered) {
						arrow.addClass('hovered');
						var targ_item = (items.index(items.filter('.active')) + (dir=='left' ? -1 : 1) + items.length) % items.length;
						targ_peeker.find('.edgtf-slider-peeker-inner').css({
							'background-image': items.eq(targ_item).find('.edgtf-image, .edgtf-mobile-video-image').css('background-image'),
							'width': itemWidth + 'px'
						});
						targ_peeker.addClass('shown');
					}
					else {
						arrow.removeClass('hovered');
						peekers.removeClass('shown');
					}
				};

				var navBulletHover = function(bullet, entered) {
					if (entered) {
						bullet.addClass('hovered');

						var targ_item = bullet.data('slide-to');
						var cur_item = items.index(items.filter('.active'));
						if (cur_item != targ_item) {
							var dir = (targ_item < cur_item) ? 'left' : 'right';
							var targ_peeker = peekers.filter('.'+dir);
							targ_peeker.find('.edgtf-slider-peeker-inner').css({
								'background-image': items.eq(targ_item).find('.edgtf-image, .edgtf-mobile-video-image').css('background-image'),
								'width': itemWidth + 'px'
							});
							targ_peeker.addClass('shown');
						}
					}
					else {
						bullet.removeClass('hovered');
						peekers.removeClass('shown');
					}
				};

				var handleResize = function() {
					itemWidth = items.filter('.active').width();
					itemWidth += (itemWidth % 2) ? 1 : 0; // To make it even
					items.children('.edgtf-image, .edgtf-video').css({
						'position': 'absolute',
						'width': itemWidth + 'px',
						'height': '110%',
						'left': '50%',
						'transform': 'translateX(-50%)'
					});
				};

				var items = slider.find('.item');
				var itemWidth;
				handleResize();
				$(window).resize(handleResize);

				slider.find('.carousel-inner').append('<div class="edgtf-slider-peeker left"><div class="edgtf-slider-peeker-inner"></div></div><div class="edgtf-slider-peeker right"><div class="edgtf-slider-peeker-inner"></div></div>');
				var peekers = slider.find('.edgtf-slider-peeker');
				var nav_arrows = slider.find('.carousel-control');
				var nav_bullets = slider.find('.carousel-indicators > li');

				nav_arrows
					.hover(
						function() {
							navArrowHover($(this), true);
						},
						function() {
							navArrowHover($(this), false);
						}
					);

				nav_bullets
					.hover(
						function() {
							navBulletHover($(this), true);
						},
						function() {
							navBulletHover($(this), false);
						}
					);

				slider.on('slide.bs.carousel', function() {
					setTimeout(function() {
						peekers.addClass('edgtf-slide-peek-in-progress').removeClass('shown');
					}, 500);
				});

				slider.on('slid.bs.carousel', function() {
					nav_arrows.filter('.hovered').each(function() {
						navArrowHover($(this), true);
					});
					setTimeout(function() {
						nav_bullets.filter('.hovered').each(function() {
							navBulletHover($(this), true);
						});
					}, 200);
					peekers.removeClass('edgtf-slide-peek-in-progress');
				});
			}
		};

		var updateNavigationThumbs = function(slider) {
			if (slider.hasClass('edgtf-slider-thumbs')) {
				var src, prev_image, next_image;
				var all_items_count = slider.find('.item').length;
				var curr_item = slider.find('.item').index($('.item.active')[0]) + 1;
				setPrevNextNumbers(slider, curr_item, all_items_count);

				// prev thumb
				if(slider.find('.item.active').prev('.item').length){
					if(slider.find('.item.active').prev('div').find('.edgtf-image').length){
						src = imageRegex.exec(slider.find('.active').prev('div').find('.edgtf-image').attr('style'));
						prev_image = new Image();
						prev_image.src = src[1];
						//prev_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
					}else{
						prev_image = slider.find('.active').prev('div').find('> .edgtf-video').clone();
						prev_image.find('.edgtf-video-overlay, .mejs-offscreen').remove();
						prev_image.find('.edgtf-video-wrap').width(150).height(84);
						prev_image.find('.mejs-container').width(150).height(84);
						prev_image.find('video').width(150).height(84);
					}
					slider.find('.left.carousel-control .img .old').fadeOut(300,function(){
						$(this).remove();
					});
					slider.find('.left.carousel-control .img').append(prev_image).find('div.thumb-image, > img, div.edgtf-video').fadeIn(300).addClass('old');

				}else{
					if(slider.find('.carousel-inner .item:last-child .edgtf-image').length){
						src = imageRegex.exec(slider.find('.carousel-inner .item:last-child .edgtf-image').attr('style'));
						prev_image = new Image();
						prev_image.src = src[1];
						//prev_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
					}else{
						prev_image = slider.find('.carousel-inner .item:last-child > .edgtf-video').clone();
						prev_image.find('.edgtf-video-overlay, .mejs-offscreen').remove();
						prev_image.find('.edgtf-video-wrap').width(150).height(84);
						prev_image.find('.mejs-container').width(150).height(84);
						prev_image.find('video').width(150).height(84);
					}
					slider.find('.left.carousel-control .img .old').fadeOut(300,function(){
						$(this).remove();
					});
					slider.find('.left.carousel-control .img').append(prev_image).find('div.thumb-image, > img, div.edgtf-video').fadeIn(300).addClass('old');
				}

				// next thumb
				if(slider.find('.active').next('div.item').length){
					if(slider.find('.active').next('div').find('.edgtf-image').length){
						src = imageRegex.exec(slider.find('.active').next('div').find('.edgtf-image').attr('style'));
						next_image = new Image();
						next_image.src = src[1];
						//next_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
					}else{
						next_image = slider.find('.active').next('div').find('> .edgtf-video').clone();
						next_image.find('.edgtf-video-overlay, .mejs-offscreen').remove();
						next_image.find('.edgtf-video-wrap').width(150).height(84);
						next_image.find('.mejs-container').width(150).height(84);
						next_image.find('video').width(150).height(84);
					}

					slider.find('.right.carousel-control .img .old').fadeOut(300,function(){
						$(this).remove();
					});
					slider.find('.right.carousel-control .img').append(next_image).find('div.thumb-image, > img, div.edgtf-video').fadeIn(300).addClass('old');

				}else{
					if(slider.find('.carousel-inner .item:first-child .edgtf-image').length){
						src = imageRegex.exec(slider.find('.carousel-inner .item:first-child .edgtf-image').attr('style'));
						next_image = new Image();
						next_image.src = src[1];
						//next_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
					}else{
						next_image = slider.find('.carousel-inner .item:first-child > .edgtf-video').clone();
						next_image.find('.edgtf-video-overlay, .mejs-offscreen').remove();
						next_image.find('.edgtf-video-wrap').width(150).height(84);
						next_image.find('.mejs-container').width(150).height(84);
						next_image.find('video').width(150).height(84);
					}
					slider.find('.right.carousel-control .img .old').fadeOut(300,function(){
						$(this).remove();
					});
					slider.find('.right.carousel-control .img').append(next_image).find('div.thumb-image, > img, div.edgtf-video').fadeIn(300).addClass('old');
				}
			}
		};

		/**
		 * initiate slider
		 * @param slider, current slider
		 * @param currentItem, current slide item index
		 * @param totalItemCount, total number of slide items
		 * @param slideAnimationTimeout, timeout for slide change
		 */
		var initiateSlider = function(slider, totalItemCount, slideAnimationTimeout) {

			//set active class on first item
			slider.find('.carousel-inner .item:first-child').addClass('active');
			//check for header style
			edgtfCheckSliderForHeaderStyle($('.carousel .active'), slider.hasClass('edgtf-header-effect'));
			// setting numbers on carousel controls
			if(slider.hasClass('edgtf-slider-numbers')) {
				setPrevNextNumbers(slider, 1, totalItemCount);
			}
			// set video background if there is video slide
			if(slider.find('.item video').length){
				//initVideoBackgroundSize(slider);
				initVideoBackground(slider);
			}

			// update thumbs
			updateNavigationThumbs(slider);

			// initiate peek
			initPeek(slider);

			// enable link hover color for slide elements with links
			slider.find('.edgtf-slide-element-wrapper-link')
				.mouseenter(function() {
					$(this).removeClass('inheriting');
				})
				.mouseleave(function() {
					$(this).addClass('inheriting');
				})
			;

			//init slider
			if(slider.hasClass('edgtf-auto-start')){
				slider.carousel({
					interval: slideAnimationTimeout,
					pause: false
				});

				//pause slider when hover slider button
				slider.find('.slide_buttons_holder .qbutton')
					.mouseenter(function() {
						slider.carousel('pause');
					})
					.mouseleave(function() {
						slider.carousel('cycle');
					});
			} else {
				slider.carousel({
					interval: 0,
					pause: false
				});
			}

			$(window).scroll(function() {
				if(slider.hasClass('edgtf-full-screen') && edgtf.scroll > edgtf.windowHeight && edgtf.windowWidth > 1000){
					slider.carousel('pause');
				}else if(!slider.hasClass('edgtf-full-screen') && edgtf.scroll > slider.height() && edgtf.windowWidth > 1000){
					slider.carousel('pause');
				}else{
					slider.carousel('cycle');
				}
			});


			//initiate image animation
			if($('.carousel-inner .item:first-child').hasClass('edgtf-animate-image') && edgtf.windowWidth > 1000){
				slider.find('.carousel-inner .item.edgtf-animate-image:first-child .edgtf-image').transformAnimate({
					transform: "matrix("+matrixArray[$('.carousel-inner .item:first-child').data('edgtf_animate_image')]+")",
					duration: 30000
				});
			}
		};

		return {
			init: function() {
				if(sliders.length) {
					sliders.each(function() {
						var $this = $(this);
						var slideAnimationTimeout = $this.data('slide_animation_timeout');
						var totalItemCount = $this.find('.item').length;

						checkButtonsAlignment($this);

						setHeights($this);

						/*** wait until first video or image is loaded and than initiate slider - start ***/
						if(edgtf.htmlEl.hasClass('touch')){
							if($this.find('.item:first-child .edgtf-mobile-video-image').length > 0){
								var src = imageRegex.exec($this.find('.item:first-child .edgtf-mobile-video-image').attr('style'));
							}else{
								var src = imageRegex.exec($this.find('.item:first-child .edgtf-image').attr('style'));
							}
							if(src) {
								var backImg = new Image();
								backImg.src = src[1];
								$(backImg).load(function(){
									$('.edgtf-slider-preloader').fadeOut(500);
									initiateSlider($this,totalItemCount,slideAnimationTimeout);
								});
							}
						} else {
							if($this.find('.item:first-child video').length > 0){
								$this.find('.item:first-child video').eq(0).one('loadeddata',function(){
									$('.edgtf-slider-preloader').fadeOut(500);
									initiateSlider($this,totalItemCount,slideAnimationTimeout);
								});
							}else{
								var src = imageRegex.exec($this.find('.item:first-child .edgtf-image').attr('style'));
								if (src) {
									var backImg = new Image();
									backImg.src = src[1];
									$(backImg).load(function(){
										$('.edgtf-slider-preloader').fadeOut(500);
										initiateSlider($this,totalItemCount,slideAnimationTimeout);
									});
								}
							}
						}
						/*** wait until first video or image is loaded and than initiate slider - end ***/

						/* before slide transition - start */
						$this.on('slide.bs.carousel', function () {
							$this.addClass('edgtf-in-progress');
							$this.find('.active .edgtf-slider-elements-holder-frame, .active .edgtf-slide-element-section-link').fadeTo(250,0);
						});
						/* before slide transition - end */

						/* after slide transition - start */
						$this.on('slid.bs.carousel', function () {
							$this.removeClass('edgtf-in-progress');
							$this.find('.active .edgtf-slider-elements-holder-frame, .active .edgtf-slide-element-section-link').fadeTo(0,1);

							// setting numbers on carousel controls
							if($this.hasClass('edgtf-slider-numbers')) {
								var currentItem = $('.item').index($('.item.active')[0]) + 1;
								setPrevNextNumbers($this, currentItem, totalItemCount);
							}

							// initiate image animation on active slide and reset all others
							$('.item.edgtf-animate-image .edgtf-image').stop().css({'transform':'', '-webkit-transform':''});
							if($('.item.active').hasClass('edgtf-animate-image') && edgtf.windowWidth > 1000){
								$('.item.edgtf-animate-image.active .edgtf-image').transformAnimate({
									transform: "matrix("+matrixArray[$('.item.edgtf-animate-image.active').data('edgtf_animate_image')]+")",
									duration: 30000
								});
							}

							// setting thumbnails on navigation controls
							if($this.hasClass('edgtf-slider-thumbs')) {
								updateNavigationThumbs($this);
							}
						});
						/* after slide transition - end */

						/* swipe functionality - start */
						$this.swipe( {
							swipeLeft: function(){ $this.carousel('next'); },
							swipeRight: function(){ $this.carousel('prev'); },
							threshold:20
						});
						/* swipe functionality - end */

					});

					//adding parallax functionality on slider
					if($('.no-touch .carousel').length){
						var skrollr_slider = skrollr.init({
							smoothScrolling: false,
							forceHeight: false
						});
						skrollr_slider.refresh();
					}

					$(window).scroll(function(){
						//set control class for slider in order to change header style
						if($('.edgtf-slider .carousel').height() < edgtf.scroll){
							$('.edgtf-slider .carousel').addClass('edgtf-disable-slider-header-style-changing');
						}else{
							$('.edgtf-slider .carousel').removeClass('edgtf-disable-slider-header-style-changing');
							edgtfCheckSliderForHeaderStyle($('.edgtf-slider .carousel .active'),$('.edgtf-slider .carousel').hasClass('edgtf-header-effect'));
						}

						//hide slider when it is out of viewport
						if($('.edgtf-slider .carousel').hasClass('edgtf-full-screen') && edgtf.scroll > edgtf.windowHeight && edgtf.windowWidth > 1000){
							$('.edgtf-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
						}else if(!$('.edgtf-slider .carousel').hasClass('edgtf-full-screen') && edgtf.scroll > $('.edgtf-slider .carousel').height() && edgtf.windowWidth > 1000){
							$('.edgtf-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
						}else{
							$('.edgtf-slider .carousel').find('.carousel-inner, .carousel-indicators').show();
						}
					});
				}
			}
		};
	};

    /**
     * Check if slide effect on header style changing
     * @param slide, current slide
     * @param headerEffect, flag if slide
     */

    function edgtfCheckSliderForHeaderStyle(slide, headerEffect) {

        if($('.edgtf-slider .carousel').not('.edgtf-disable-slider-header-style-changing').length > 0) {

            var slideHeaderStyle = "";
            if (slide.hasClass('light')) { slideHeaderStyle = 'edgtf-light-header'; }
            if (slide.hasClass('dark')) { slideHeaderStyle = 'edgtf-dark-header'; }

            if (slideHeaderStyle !== "") {
                if (headerEffect) {
                    edgtf.body.removeClass('edgtf-dark-header edgtf-light-header').addClass(slideHeaderStyle);
                }
            } else {
                if (headerEffect) {
                    edgtf.body.removeClass('edgtf-dark-header edgtf-light-header').addClass(edgtf.defaultHeaderStyle);
                }

            }
        }
    }

    /**
     * List object that initializes list with animation
     * @type {Function}
     */
    var edgtfInitIconList = edgtf.modules.shortcodes.edgtfInitIconList = function() {
        var iconList = $('.edgtf-animate-list');

        /**
         * Initializes icon list animation
         * @param list current list shortcode
         */
        var iconListInit = function(list) {
            setTimeout(function(){
                list.appear(function(){
                    list.addClass('edgtf-appeared');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            },30);
        };

        return {
            init: function() {
                if(iconList.length) {
                    iconList.each(function() {
                        iconListInit($(this));
                    });
                }
            }
        };
    };

    /*
     **  Init shop list masonry type
     */
    function edgtfInitShopListMasonry(){
        var shopList = $('.edgtf-shop-masonry');
        if(shopList.length) {
            shopList.each(function() {
                var thisShopList = $(this).children('.edgtf-shop-list-masonry');
                var size = thisShopList.find('.edgtf-shop-list-masonry-grid-sizer').width();
                edgtfResizeShopMasonry(size,thisShopList);

                edgtfInitMasonryLayout(thisShopList);
                $(window).resize(function(){
                    size = thisShopList.find('.edgtf-shop-list-masonry-grid-sizer').width();
                    edgtfResizeShopMasonry(size,thisShopList);
                    edgtfInitMasonryLayout(thisShopList);
                });
            });
        }
    }

    function edgtfInitMasonryLayout(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.edgtf-shop-product',
            masonry: {
                columnWidth: '.edgtf-shop-list-masonry-grid-sizer'
            }
        });
    }

    function edgtfResizeShopMasonry(size,container){

        var defaultMasonryItem = container.find('.edgtf-default-masonry-item');
        var largeWidthMasonryItem = container.find('.edgtf-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.edgtf-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.edgtf-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeHeightMasonryItem.css('height', Math.round(2*size));

        var breakpoint = edgtf.body.hasClass('page-template-full-width') ? 480 : 600;

        if(edgtf.windowWidth > breakpoint){
            largeWidthHeightMasonryItem.css('height', Math.round(2*size));
            largeWidthMasonryItem.css('height', size);
        }else{
            largeWidthHeightMasonryItem.css('height', size);
            largeWidthMasonryItem.css('height', Math.round(size/2));

        }
    }

    /**
     * Initializes shop masonry filter
     */
    function edgtfInitShopMasonryFilter(){

        var filterHolder = $('.edgtf-shop-filter-holder.edgtf-masonry-filter');

        if(filterHolder.length){
            filterHolder.each(function(){

                var thisFilterHolder = $(this);

                var shopIsotopeAnimation = null;

                thisFilterHolder.find('.filter:first').addClass('current');

                thisFilterHolder.find('li').click(function(){

                    var currentFilter = $(this);
                    clearTimeout(shopIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');

                    shopIsotopeAnimation = setTimeout(function(){
                        $('.isotope, .isotope .isotope-item').css('transition-duration','0s');
                    },700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.parent().find('.edgtf-shop-list-masonry').isotope({ filter: selector });

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });

            });
        }
    }


	/*
	 **	Vertical Split Slider
	 */

	function edgtfInitVerticalSplitSlider(){

		var body = $('body');

		if(body.hasClass('edgtf-vertical-split-screen-initialized')){
			body.removeClass('edgtf-vertical-split-screen-initialized');
			$.fn.multiscroll.destroy();
		}

		if($('.edgtf-vertical-split-slider').length) {

			var slider = $('.edgtf-vertical-split-slider');

			slider.height(edgtf.windowHeight).animate({opacity:1},300);
			slider.multiscroll({
				scrollingSpeed: 500,
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.edgtf-vss-ms-section',
				leftSelector: '.edgtf-vss-ms-left',
				rightSelector: '.edgtf-vss-ms-right',
				afterRender: function(){

					body.addClass('edgtf-vertical-split-screen-initialized');

					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $("<div class='edgtf-vertical-split-slider-responsive' />");
					slider.after(verticalSplitSliderResponsive);
					var leftSide    = $('.edgtf-vertical-split-slider .edgtf-vss-ms-left > div');
					var rightSide   = $('.edgtf-vertical-split-slider .edgtf-vss-ms-right > div');

					for(var i = 0; i < leftSide.length; i++){
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length-1-i]).clone(true));
					}

					//prepare google maps clones
					if($('.edgtf-vertical-split-slider-responsive .edgtf-google-map').length){
						$('.edgtf-vertical-split-slider-responsive .edgtf-google-map').each(function(){
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id','edgtf-map-' + num);
							map.data('unique-id', num);
						});
					}

					edgtfInitPortfolioListMasonry();
					edgtfInitPortfolioListPinterest();
					edgtfInitPortfolio();
					edgtfShowGoogleMap();
				}
			});


			if(edgtf.windowWidth <= 1024){
				$.fn.multiscroll.destroy();
			}else{
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function() {
				if(edgtf.windowWidth <= 1024){
					$.fn.multiscroll.destroy();
				}else{
					$.fn.multiscroll.build();
				}
				
			});
		}
	}

    /**
     * Check if slide effect on header style changing
     */
    function edgtfItemShowcase() {
        var itemShowcase = $('.edgtf-item-showcase');
        if (itemShowcase.length) {
            itemShowcase.each(function(){
                var thisItemShowcase = $(this),
                    leftItems = thisItemShowcase.find('.edgtf-item-left'),
                    rightItems = thisItemShowcase.find('.edgtf-item-right'),
                    itemImage = thisItemShowcase.find('.edgtf-item-image');

                //logic
                leftItems.wrapAll( "<div class='edgtf-item-showcase-holder edgtf-holder-left' />");
                rightItems.wrapAll( "<div class='edgtf-item-showcase-holder edgtf-holder-right' />");
                thisItemShowcase.animate({opacity:1},200);
                setTimeout(function(){
                    thisItemShowcase.appear(function(){
                        itemImage.addClass('edgtf-appeared');
                        setTimeout(function(){
                            if(edgtf.windowWidth > 1200) {
                                itemAppear('.edgtf-holder-left .edgtf-item');
                                itemAppear('.edgtf-holder-right .edgtf-item');
                            } else {
                                itemAppear('.edgtf-item');
                            }
                        },300);
                    },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
                },100);

                //appear animation trigger
                function itemAppear(itemCSSClass) {
                    thisItemShowcase.find(itemCSSClass).each(function(i){
                        var thisListItem = $(this);
                        setTimeout(function(){
                            thisListItem.addClass('edgtf-appeared');
                        }, i*150);
                    });
                }
            });

        }
    }

	/*
	 **	Init animation holder
	 */
	function edgtfAnimationElementHolder() {
        var animationHolders = $('.edgtf-animation-holder-init');

		if(animationHolders.length) {
            animationHolders.each(function(){
			var animationHolder = $(this),
                animationDelay = animationHolder.attr('data-animation-delay');

                if ((animationDelay == undefined) || (!$.isNumeric(animationDelay)) ) {
                    animationDelay = 0;
                }

                if(!animationHolder.hasClass('edgtf-appeared')) {
                    animationHolder.appear(
                        function(){
                            setTimeout(function(){
                                animationHolder.addClass('edgtf-appeared');
                            }, animationDelay);
                        },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount}
                    );
                }
            });
		}

	}

    /**
     * Init Combo slider shortcode
     */
    function edgtfComboSlider() {

        var sliders = $('.edgtf-combo-slider-holder');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this);

				slider.on('init afterChange', function(slick){
					var sliderItems = slider.find('.slick-track'),
						activeSlide = sliderItems.find('.slick-active'),
						contentHeight = activeSlide.find('.edgtf-combo-slide-content-inner').outerHeight(),
						pagination = slider.find('.edgtf-slick-numbered');

					pagination.css({'top': contentHeight + 'px'});
				});

      			slider.slick({
					infinite: true,
					autoplay: true,
					autoplaySpeed: 2300,
					slidesToShow : 1,
					fade: true,
					arrows: false,
					dots: true,
					dotsClass: 'edgtf-slick-numbered',
					adaptiveHeight: true,
                    speed: 700,
					customPaging: function(slider, i) {
						return '<span class="edgtf-slick-number">'+(i+1)+'</span>';
					}
				});


			});
        }

    }

	/*
	 * Type out functionality for Custom Font
	 */
	function edgtfCustomFontTypeOut() {

		var edgtfTyped = $('.edgtf-typed');

		if (edgtfTyped.length) {
			edgtfTyped.each(function(){

				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parents('.edgtf-typed-wrap'),
					customFontHolder = typedWrap.parents('.edgtf-custom-font-holder'),
					originalText = customFontHolder.find('.edgtf-custom-font-original'),
					str,
					string_1 = thisTyped.find('.edgtf-typed-1').text(),
					string_2 = thisTyped.find('.edgtf-typed-2').text(),
					string_3 = thisTyped.find('.edgtf-typed-3').text();

				//show only the strings that are entered in
				if (!string_2.trim() || !string_3.trim() ) {
					str = [string_1];
				}
				if (!string_3.trim() && string_2.length) {
					str = [string_1,string_2];
				}
				if (string_1.length && string_2.length && string_3.length) {
					str = [string_1,string_2,string_3];
				}

				//ampersand
				if(originalText.text().indexOf('&') != -1) {
					originalText.html(originalText.text().replace('&', '<span class="edgtf-amp">&</span>'));
				}

				//typeout
				setTimeout(function(){
					customFontHolder.appear(function() {
						thisTyped.typed({
							strings: str,
							typeSpeed: 90,
							backDelay: 700,
							loop: true,
							contentType: 'text',
							loopCount: false,
							cursorChar: "_",
						});
					},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
				}, 100);

			});
		}
	}

	var edgtfNumberedBoxes = edgtf.modules.shortcodes.edgtfNumberedBoxes = function() {

		var numberedBoxesHolder = $('.edgtf-numbered-boxes-holder');

		var boxAnimation = function(currentHolder) {
			if (currentHolder.attr('data-interactivity') == 'yes') {

				var boxes = currentHolder.find('.edgtf-numbered-box'),
					cols = currentHolder.attr('data-number'),
					widthDefault,
					widthDefaultFirst,
					widthDefaultSecond,
					widthActive,
					widthIdle;

				if (boxes.outerHeight() == currentHolder.outerHeight()) { //horizontal layout check

					//col width
					if (cols == '2') {
						widthActive = '55%';
						widthIdle = '45%';
						widthDefault = '50%';
						widthDefaultFirst = '50%';
						widthDefaultSecond = '50%';

						if (currentHolder.hasClass('edgtf-numbered-layout-66-33')){
							widthDefaultFirst = '66.66%';
							widthDefaultSecond = '33.33%';
						}
						else if (currentHolder.hasClass('edgtf-numbered-layout-33-66')){
							widthDefaultFirst = '33.33%';
							widthDefaultSecond = '66.66%';
						}
					}

					if (cols == '3') {
						widthActive = '36%';
						widthIdle = '32%';
						widthDefault = '33.33%';
						widthDefaultFirst = '33.33%';
					}
				}

			}
			boxContentWidth(currentHolder);
			boxInteractivity(currentHolder, cols, widthDefault,widthDefaultFirst, widthDefaultSecond, widthActive, widthIdle);
		};



		var boxContentWidth = function(currentHolder) {
			var boxes = currentHolder.find('.edgtf-numbered-box');
			boxes.each(function() {
				var box = $(this);
				var content = box.find('.edgtf-numbered-box-inner');
				content.css('width', content.outerWidth());
			});
		}

		var boxInteractivity = function(currentHolder, cols, widthDefault,widthDefaultFirst, widthDefaultSecond, widthActive, widthIdle) {

			var boxes = currentHolder.find('.edgtf-numbered-box');
			boxes.each(function() {
				var box = $(this);
				box.mouseenter(function(){
					var active = $(this),
						idle = active.siblings(),
						activeWidth = parseInt(active.outerWidth()),
						idleWidth = parseInt(idle.outerWidth());

					if (cols == '2') {
						if (currentHolder.hasClass('edgtf-numbered-layout-66-33') || currentHolder.hasClass('edgtf-numbered-layout-33-66')){
							if (activeWidth > idleWidth) {
								widthActive = '70%';
								widthIdle = '30%';
							}
							else{
								widthActive = '37%';
								widthIdle = '63%';
							}
						}
					}

					active.css('width',widthActive);
					idle.css('width',widthIdle);
				});
			});
			boxes.mouseleave(function(){
				if (widthDefault == widthDefaultFirst){
					boxes.css('width',widthDefault);
				}
				else{
					$(boxes[0]).css('width',widthDefaultFirst);
					$(boxes[1]).css('width',widthDefaultSecond);
				}
			});
		}

		return {
			init: function() {
				if(numberedBoxesHolder.length) {
					numberedBoxesHolder.each(function() {
						boxAnimation($(this));
					});
				}
			}
		};
	};



    /*
    * Tilt Zoom effect for portfolio articles
    */
    function edgtfTiltZoom() {
        var ptfTiltArticles = $('article.edgtf-hover-tilt-zoom');

        if (ptfTiltArticles.length) {
            ptfTiltArticles.each(function(){
                var ptfTiltArticle = $(this),
                    ptfTiltImageHolder = ptfTiltArticle.find('.edgtf-item-image-holder'),
                    img = ptfTiltArticle.find('img'),
                    imgSrc = img.attr('src'),
                    maxMove = 10, //maximum movement in px
                    move = 0, //move 
                    rotateFactor = 0.25,
                    w = ptfTiltArticle.outerWidth(),
                    h = ptfTiltArticle.outerHeight(),
                    topOffset,
                    leftOffset,
                    xPos,
                    yPos,
                    xShift,
                    yShift,
                    pause,
                    pauseFlag = true;

                //swap img with div el with the same bgrnd    
                ptfTiltImageHolder.append('<div class="ptf-tilt-bgrnd" style="background-image: url('+imgSrc+')"></div>');
                var tiltBgrnd = ptfTiltArticle.find('.ptf-tilt-bgrnd');
                
                //tilt effect
                ptfTiltArticle.mouseenter(function(){
                    topOffset = ptfTiltArticle.offset().top,
                    leftOffset = ptfTiltArticle.offset().left,
                    xPos = 0;
                    yPos = 0;
                    tiltBgrnd.css('transition', 'none');

                    pause = setTimeout(function(){
                        pauseFlag = false;
                    }, 200); //wait for image to be zoomed in

                    ptfTiltArticle.mousemove(function (event) {
                        if (pauseFlag) {
                            event.stopPropagation();
                        }
                        else {
                            xPos = event.pageX - leftOffset;
                            yPos = event.pageY - topOffset;
                            xShift = ((w / 2 - xPos) / w * 2) * move;
                            yShift = ((h / 2 - yPos) / h * 2) * move;

                            var transformOffset = "translateX("+ xShift+"px) translateY("+ yShift+"px) rotateX(" + -xShift * rotateFactor + "deg) rotateY(" + yShift * rotateFactor + "deg) ";

                            tiltBgrnd.css('transform', transformOffset);

                            if(move < maxMove){
                                move += 0.3; //increment slowly to its final value to avoid flicker on first move
                            }
                        }
                    });

                });
    
                //tilt reset
                ptfTiltArticle.mouseleave(function(){
                    move = 0;
                    pauseFlag = true;
                    tiltBgrnd.css('transition', 'all .45s cubic-bezier(0.19, 0.65, 0.02, 0.93)');
                    tiltBgrnd.css('transform', 'translateX(0) translateY(0) rotateX(0) rotateY(0)');
                });
            });
        }
    }

    /*
    *   Initializing Cascading Images shortcodes
    */
    function edgtfCascadingImages() {
        var cascading = $('.edgtf-cascading-images');
        if (cascading.length) {
        	cascading.each(function () {
        		var thisCascading = $(this);

	            thisCascading.appear(function() {
	            	setTimeout(function () {
	            		thisCascading.addClass('edgtf-cascade');
	            	},200);
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
        	});
        }
    }

    /*
	*	Vertical marquee script - start
	*/
	function edgtfInitVerticalMarquee() {

		if ($('.edgtf-vertical-marquee').length) {
			window.evm = new function() {
				this.$marquee = $('.edgtf-vertical-marquee');
				this.$left = $('.edgtf-vm-left');
				this.$right = $('.edgtf-vm-right');
				this.$monitor = this.$left.find('.edgtf-vm-monitor');
				this.$slides = this.$left.find('.edgtf-vm-slide');
				this.$texts = this.$right.find('.edgtf-vm-r-text-container');

				this.last_scroll = null;

				this.handle_viewport = function() {
					evm.unfix_right();
					var cur_scroll = edgtf.scroll;
					var cur_pos = evm.window_position(cur_scroll);
					evm.unfix_monitor((cur_pos == "out down" || cur_pos == "below") ? "bottom" : "top");
					
					var total_padding = edgtf.windowHeight - evm.$monitor.height();
					evm.$left.css({
						'padding-top': total_padding * 0.6 + 'px',
						'padding-bottom': total_padding * 0.4 + 'px',
					});
					evm.$texts.each(function() {
						var total_padding = edgtf.windowHeight - $(this).height();
						$(this).css({
							'padding': total_padding /2 + 'px 0'
						});
					});
					evm.$marquee.height(evm.$right.height());

					if (cur_pos == "in") evm.fix_monitor();
					if (cur_pos == "in") evm.fix_right();
					$(document).scrollTop(cur_scroll+1);
				};

				this.fix_monitor = function() {
					var w = evm.$monitor.width() + 'px', h = evm.$monitor.height() + 'px';
					var top = evm.$left.css('padding-top'), left = Math.round(evm.$monitor.offset().left) + 'px';
					evm.$monitor.addClass('fixed').css({
						'top': top,
						'left': left,
						'width': w,
						'height': h,
						'margin-top': '0px',
					});
				};

				this.unfix_monitor = function(position) {
					evm.$monitor.removeClass('fixed').css({
						'top': '',
						'left': '',
						'width': '',
						'height': '',
						'margin-top': (position == "bottom") ? (evm.$left.height() - evm.$monitor.height() + 'px') : '0px', 
					});
				};

				this.fix_right = function(scr_top) {
					scr_top = (typeof scr_top === "undefined") ? edgtf.scroll : scr_top;
					var top = Math.round(evm.$right.offset().top) - scr_top + 'px', left = Math.round(evm.$right.offset().left) + 'px';
					var w = evm.$right.outerWidth() + 'px', h = evm.$right.outerHeight() + 'px';
					evm.$right.addClass('fixed').css({
						'top': top,
						'left': left,
						'width': w,
						'height': h
					});
				};

				this.unfix_right = function() {
					evm.$right.removeClass('fixed').css({
						'top': '',
						'left': '',
						'width': '',
						'height': ''
					});
				};

				this.move_right = function(deltaY) {
					if (evm.$right.is('.fixed')) {
						var cur_top = parseInt(evm.$right.css('top'),10);
						var new_top = cur_top - deltaY;
						var block_h = evm.$texts.outerHeight();
						if (!evm.$right.is('.snapped') && Math.floor(-cur_top/block_h) != Math.floor(-new_top/block_h)) {
							new_top = -Math.round(-new_top/block_h) * block_h;
							evm.$right.addClass('snapped');
							evm.$slides.removeClass('current').eq(Math.round(-new_top/block_h)).addClass('current');
						}
						else {
							evm.$right.removeClass('snapped');
							evm.$slides.removeClass('current');
						}
						evm.$right.css({
							'top': new_top + 'px'
						});
						evm.set_slides_visibility();
					}
				};

				this.set_slides_visibility = function() {
					if (evm.$right.is('.fixed')) {
						var op_0 = 0.3, op_1 = 0.7;
						var block_h = evm.$texts.outerHeight();
						var cur_top = -parseInt(evm.$right.css('top'),10);
						var cur_bot = cur_top + block_h;
						evm.$slides.each(function() {
							var ord = $(this).index();
							var coverage = ((ord * block_h < cur_top) * ((ord+1) * block_h - cur_top) + (ord * block_h >= cur_top) * (cur_bot - ord * block_h)) / block_h;
							var opacity = (coverage < op_0) ? 0 : ( (coverage > op_1) ? 1 : (coverage / (op_1-op_0) + op_0 / (op_0 - op_1)) );
							$(this).css({
								'opacity': opacity,
								'filter': 'alpha(opacity='+ opacity*100 +')'
							});
							evm.$texts.eq(ord).css({
								'opacity': opacity,
								'filter': 'alpha(opacity='+ opacity*100 +')'
							});
						});
					}
				};

				this.window_position = function(scr_top) {
					var win_h = $(window).height();
					var r_top = Math.round(evm.$marquee.offset().top);
					var r_bot = r_top + evm.$marquee.height();
					if (scr_top + win_h < r_top) {
						return 'out up';
					} else if (scr_top > r_bot) {
						return 'out down';
					} else if (scr_top >= r_top && scr_top + win_h <= r_bot) {
						return 'in';
					} else if (scr_top < r_top && scr_top + win_h >= r_top) {
						return 'above';
					} else if (scr_top + win_h > r_bot && scr_top <= r_bot) {
						return 'below';
					} else {
						return 'unknown';
					}
				};

				this.handle_scroll = function() {
					var new_scroll = $(window).scrollTop(); // Don't use edgtf.scroll because this gets called before it updates.
					if (evm.last_scroll == new_scroll) {
						return;
					}
					var cur_pos = evm.window_position(evm.last_scroll);
					var next_pos = evm.window_position(new_scroll);
					var deltaY = new_scroll - evm.last_scroll;
					var moving_right = true;
					var r_top = Math.round(evm.$marquee.offset().top);
					if (cur_pos == "out up") {
						if (next_pos == "in") {
							evm.last_scroll = r_top;
							$(document).scrollTop(evm.last_scroll);
							evm.fix_monitor();
							evm.fix_right(evm.last_scroll);
							moving_right = false;
						}
						else {
							if (next_pos == "below" || next_pos == "out down") {
								evm.unfix_monitor('bottom');
							}
							evm.last_scroll = new_scroll;
						}
					}
					else if (cur_pos == "out down") {
						if (next_pos == "in") {
							evm.last_scroll = r_top + evm.$marquee.height() - edgtf.windowHeight;
							$(document).scrollTop(evm.last_scroll);
							evm.fix_monitor();
							evm.fix_right(evm.last_scroll);
							moving_right = false;
						}
						else {
							if (next_pos == "above" || next_pos == "out up") {
								evm.unfix_monitor('top');
							}
							evm.last_scroll = new_scroll;
						}
					}
					else if (cur_pos == "above") {
						if (next_pos == "in") {
							evm.last_scroll = r_top;
							$(document).scrollTop(evm.last_scroll);
							evm.fix_monitor();
							evm.fix_right();
							moving_right = false;
						} 
						else {
							if (next_pos == "below" || next_pos == "out down") {
								evm.unfix_monitor('bottom');
							}
							evm.last_scroll = new_scroll;
						}
					}
					else if (cur_pos == "below") {
						if (next_pos == "in") {
							evm.last_scroll = r_top + evm.$marquee.height() - edgtf.windowHeight;
							$(document).scrollTop(evm.last_scroll);
							evm.fix_monitor();
							evm.fix_right();
							moving_right = false;
						}
						else {
							if (next_pos == "above" || next_pos == "out up") {
								evm.unfix_monitor('top');
							}
							evm.last_scroll = new_scroll;
						}
					}
					else if (cur_pos == "in") {
						if (!evm.try_scrolling_screen((deltaY > 0) ? 30 : -30)) {
							evm.last_scroll = new_scroll;
							if (next_pos == "above" || next_pos == "out up") {
								evm.unfix_right();
								evm.unfix_monitor('top');
								evm.$slides.removeClass('current').css({'opacity': 0,'filter': 'alpha(opacity=0)'}).first().addClass('current').css({'opacity': 1,'filter': 'alpha(opacity=100)'});
								evm.$texts.css({'opacity': 0,'filter': 'alpha(opacity=0)'}).first().css({'opacity': 1,'filter': 'alpha(opacity=100)'});
							}
							else if (next_pos == "below" || next_pos == "out down") {
								evm.unfix_right();
								evm.unfix_monitor('bottom');
								evm.$slides.removeClass('current').css({'opacity': 0,'filter': 'alpha(opacity=0)'}).last().addClass('current').css({'opacity': 1,'filter': 'alpha(opacity=100)'});
								evm.$texts.css({'opacity': 0,'filter': 'alpha(opacity=0)'}).last().css({'opacity': 1,'filter': 'alpha(opacity=100)'});
							}
						}
						else {
							moving_right = false;
							$(document).scrollTop(evm.last_scroll);
						}
					}
					if (moving_right) evm.move_right(deltaY);
				};

				this.try_scrolling_screen = function(deltaY) {
					var scrolled = false;
					var $slide = evm.$slides.filter('.current');
					if ($slide.length) {
						var slide_top = parseInt($slide.css('top'),10);
						var slide_bot = slide_top + $slide.height();
						var screen_h = evm.$monitor.find('.edgtf-vm-monitor-screen').height();
						var space_below = slide_bot - screen_h;

						if (deltaY > 0 && space_below > 0) { // ok, scroll down
							$slide.css('top', slide_top - 2*Math.min(deltaY,space_below) + 'px');
							scrolled = true;
						}
						else if (deltaY < 0 && slide_top < 0) { // ok, scroll up
							$slide.css('top', slide_top - 2*Math.max(deltaY,slide_top) + 'px');
							scrolled = true;
						}
					}
					return scrolled;
				};

				this.handle_resize = function() {
					setTimeout(function() {
						evm.handle_viewport();				
					}, 20);
				};

				this.init = function() {
					if (edgtf.windowWidth > 768) {
						evm.handle_viewport();
						evm.$right.addClass('snapped');
						evm.$slides.eq(0).addClass('current').css({'opacity': 1,'filter': 'alpha(opacity=100)'});
						evm.last_scroll = 0; //$(window).scrollTop(); // Don't use edgtf.scroll because this gets called before it updates.
						$(document).scroll(evm.handle_scroll);
						$(window).on("resize orientationchange",evm.handle_resize);
						evm.handle_scroll();
					}
				};
			};

			evm.init();
			edgtf.modules.common.edgtfInitParallax();
		}
	}

	/*
	 **	Init Preview Slider - Start
	 */

	function edgtfInitPreviewSlider() {

		var sliders = $('.edgtf-preview-slider');
		sliders.each(function() {

			var slider = $(this);
			var textSlider = $(this).find('.edgtf-ps-text-slider-holder');


            var autoplay = false,
                autoPlaySpeed = 4000;

            if(typeof slider.data('autoplay') !== 'undefined' && slider.data('autoplay') == 'yes'){
                autoplay = true;
            }

            if(typeof slider.data('autoplay-speed') !== 'undefined' && slider.data('autoplay-speed') !== ''){
                autoPlaySpeed = slider.data('autoplay-speed');
            }

			var slickImages = {
				slidesToShow: 1,
				slidesToScroll: 1,
                autoplay: autoplay,
                autoplaySpeed: autoPlaySpeed,
				arrows: false,
				fade: true,
				draggable: false,
				infinite: true,
			};
			
			var slickText = {
				slidesToShow: 1,
				slidesToScroll: 1,
                autoplay: autoplay,
                autoplaySpeed: autoPlaySpeed,
				asNavFor: slider.find('.edgtf-preview-slider-element'),
				speed: 150,
                fade: true,
                easing: 'easeOutQuint',
				arrows: false,
				draggable: false,
				dots: true,
				dotsClass: 'edgtf-slick-dots-with-number',
				customPaging: function(slider, i) {
					return '<span class="edgtf-slick-dot-number">' + (i + 1) +'</span>';
				},
				infinite: true
			};

			var laptopSlider = slider.find('.edgtf-ps-laptop-images').slick(slickImages);
			var tabletSlider = slider.find('.edgtf-ps-tablet-images').slick(slickImages);
			var mobileSlider = slider.find('.edgtf-ps-mobile-images').slick(slickImages);
			var infoSlider  = textSlider.slick(slickText);

            if (autoplay) {
                slider.on('mouseleave', function () {
                    laptopSlider.slick('slickPlay');
                    tabletSlider.slick('slickPlay');
                    mobileSlider.slick('slickPlay');
                    infoSlider.slick('slickPlay');
                });

                slider.on('mouseenter', function () {
                    laptopSlider.slick('slickPause');
                    tabletSlider.slick('slickPause');
                    mobileSlider.slick('slickPause');
                    infoSlider.slick('slickPause');
                });
            }
			
		});
	}

    /*
    * Device Presentation shortcode
    */
    function edgtfDevicePresentation() {
        var devicePresentationShortcodes = $('.edgtf-device-presentation');

        if (devicePresentationShortcodes.length) {
            devicePresentationShortcodes.each(function(){
                var devicePresentation = $(this);

                //infinite scroll effect
                if (devicePresentation.hasClass('edgtf-infinite-scroll-effect') && !$('html').hasClass('touch')) {
                    edgtfRequestAnimationFrame();

                    var images = devicePresentation.find('.edgtf-device-background-image'),
                        imageWidth = Math.round(images.width());

                    devicePresentation.find('.edgtf-aux-background-image').css('left', imageWidth); //set to the right of initial image

                    images.each(function(i){
                        var image = $(this),
                            currentPos = 0,
                            delta = 1;

                        var edgtfInfiniteScrollEffect = function() {
                            currentPos -= delta;

                            if (Math.round(image.offset().left) <= -imageWidth) {
                                image.css('left', parseInt(imageWidth - 2*delta));
                                currentPos = 0;
                            }

                            image.css('transform','translate3d('+currentPos+'px,0,0)');
                            requestNextAnimationFrame(edgtfInfiniteScrollEffect);
                        }   

                        $(window).load(function(){
                            edgtfInfiniteScrollEffect();
                        });
                    });
                }

                //responsiveness
                if ((devicePresentation.hasClass('edgtf-background-image-set') && devicePresentation.data() != undefined) && (devicePresentation.data() != '')){
                    var initialOffset = devicePresentation.css('padding-bottom'),
                        content = devicePresentation.find('.edgtf-device-presentation-content'),
                        dataHidpi = (devicePresentation.data('hidpi') != '') ? parseInt(devicePresentation.data('hidpi')) : initialOffset,
                        dataMdpi = (devicePresentation.data('mdpi') != '') ? parseInt(devicePresentation.data('mdpi')) : initialOffset,
                        dataTabletLandscape = (devicePresentation.data('tablet-landscape') != '') ? parseInt(devicePresentation.data('tablet-landscape')) : initialOffset,
                        dataTabletPortrait = (devicePresentation.data('tablet-portrait') != '') ? parseInt(devicePresentation.data('tablet-portrait')) : initialOffset;


                    var resizeDevicePresentation = function(dataHidpi, dataMdpi, dataTabletLandscape, dataTabletPortrait) {
                        if (edgtf.windowWidth <= 1440 && edgtf.windowWidth > 1280) {
                            devicePresentation.css('padding-bottom', dataHidpi);
                            content.css('transform', 'translateY('+dataHidpi+'px)');
                        }

                        if (edgtf.windowWidth <= 1280 && edgtf.windowWidth > 1024) {
                            devicePresentation.css('padding-bottom', dataMdpi);
                            content.css('transform', 'translateY('+dataMdpi+'px)');
                        }

                        if (edgtf.windowWidth <= 1024 && edgtf.windowWidth > 768) {
                            devicePresentation.css('padding-bottom', dataTabletLandscape);
                            content.css('transform', 'translateY('+dataTabletLandscape+'px)');
                        }

                        if (edgtf.windowWidth <= 768 && edgtf.windowWidth > 600) {
                            devicePresentation.css('padding-bottom', dataTabletPortrait);
                            content.css('transform', 'translateY('+dataTabletPortrait+'px)');
                        }
                    }

                    resizeDevicePresentation(dataHidpi, dataMdpi, dataTabletLandscape, dataTabletPortrait);

                    $(window).resize(function(){
                        resizeDevicePresentation(dataHidpi, dataMdpi, dataTabletLandscape, dataTabletPortrait);
                    });
                }

                //devices appear effect
                if (devicePresentation.hasClass('edgtf-devices-appear-effect') && !$('html').hasClass('touch')) { 
                    $(window).load(function(){
                        var contentHolder = devicePresentation.find('.edgtf-device-presentation-content'),
                            devicesHolder = devicePresentation.find('.edgtf-devices-holder'),
                            devices = devicesHolder.find('> div');

                        var delay = 0;
                        if (edgtf.body.hasClass('edgtf-smooth-page-transitions')) {
                            delay = 200; //preloader fade out time
                        }

                        devicePresentation.appear(function(){
                            contentHolder.css('visibility','visible');
                            setTimeout(function(){
                                devices.addClass('edgtf-appeared');

                                devices.last().one('transitionend webkitTransitionEnd oTransitionEnd', function(){
                                    devices.find('img').css('transform','translateZ(0)'); //flicker fix
                                });
                            }, delay);
                        });
                    });
                }
            });
        }
    }

    /*
    * Request Animation Frame shim
    */
    function edgtfRequestAnimationFrame() {
        window.requestNextAnimationFrame =
            (function () {
                var originalWebkitRequestAnimationFrame = undefined,
                    wrapper = undefined,
                    callback = undefined,
                    geckoVersion = 0,
                    userAgent = navigator.userAgent,
                    index = 0,
                    self = this;

                // Workaround for Chrome 10 bug where Chrome
                // does not pass the time to the animation function

                if (window.webkitRequestAnimationFrame) {
                    // Define the wrapper

                    wrapper = function (time) {
                        if (time === undefined) {
                            time = +new Date();
                        }

                        self.callback(time);
                    };

                    // Make the switch
                  
                    originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;    

                    window.webkitRequestAnimationFrame = function (callback, element) {
                        self.callback = callback;

                        // Browser calls the wrapper and wrapper calls the callback
                    
                        originalWebkitRequestAnimationFrame(wrapper, element);
                    }
                }

                // Workaround for Gecko 2.0, which has a bug in
                // mozRequestAnimationFrame() that restricts animations
                // to 30-40 fps.

                if (window.mozRequestAnimationFrame) {
                    // Check the Gecko version. Gecko is used by browsers
                    // other than Firefox. Gecko 2.0 corresponds to
                    // Firefox 4.0.
                 
                    index = userAgent.indexOf('rv:');

                        if (userAgent.indexOf('Gecko') != -1) {
                            geckoVersion = userAgent.substr(index + 3, 3);

                        if (geckoVersion === '2.0') {
                           // Forces the return statement to fall through
                           // to the setTimeout() function.

                           window.mozRequestAnimationFrame = undefined;
                        }
                    }
                }
              
                return window.requestAnimationFrame   ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame    ||
                    window.oRequestAnimationFrame      ||
                    window.msRequestAnimationFrame     ||

                    function (callback, element) {
                        var start,
                            finish;

                        window.setTimeout( function () {
                            start = +new Date();
                            callback(start);
                            finish = +new Date();

                        self.timeout = 1000 / 60 - (finish - start);

                        }, self.timeout);
                    };
                }
            )
        ();
    }

})(jQuery);