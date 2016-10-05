(function($) {
    "use strict";

    var header = {};
    edgtf.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.edgtfSideArea = edgtfSideArea;
    header.edgtfSideAreaScroll = edgtfSideAreaScroll;
    header.edgtfFullscreenMenu = edgtfFullscreenMenu;
    header.edgtfInitMobileNavigation = edgtfInitMobileNavigation;
    header.edgtfMobileHeaderBehavior = edgtfMobileHeaderBehavior;
    header.edgtfSetDropDownMenuPosition = edgtfSetDropDownMenuPosition;
    header.edgtfDropDownMenu = edgtfDropDownMenu;
    header.edgtfSearch = edgtfSearch;
    header.edgtfVerticalMenuScroll = edgtfVerticalMenuScroll;
    header.edgtfMenuUnderline = edgtfMenuUnderline;

    header.edgtfOnDocumentReady = edgtfOnDocumentReady;
    header.edgtfOnWindowLoad = edgtfOnWindowLoad;
    header.edgtfOnWindowResize = edgtfOnWindowResize;
    header.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfHeaderBehaviour();
        edgtfSideArea();
        edgtfSideAreaScroll();
        edgtfFullscreenMenu();
        edgtfInitMobileNavigation();
        edgtfMobileHeaderBehavior();
        edgtfSetDropDownMenuPosition();
        edgtfDropDownMenu();
        edgtfSearch();
        edgtfVerticalMenuScroll();
        edgtfVerticalMenu().init();
        edgtfMenuUnderline();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
        edgtfSetDropDownMenuPosition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtfOnWindowResize() {
        edgtfDropDownMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {
        
    }



    /*
     **	Show/Hide sticky header on window scroll
     */
    function edgtfHeaderBehaviour() {

        var header = $('.edgtf-page-header');
        var stickyHeader = $('.edgtf-sticky-header');
        var fixedHeaderWrapper = $('.edgtf-fixed-wrapper');

        var headerMenuAreaOffset = $('.edgtf-page-header').find('.edgtf-fixed-wrapper').length ? $('.edgtf-page-header').find('.edgtf-fixed-wrapper').offset().top : null;

        var stickyAppearAmount;


        switch(true) {
            // sticky header that will be shown when user scrolls up
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-up'):
                edgtf.modules.header.behaviour = 'edgtf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = edgtfGlobalVars.vars.edgtfTopBarHeight + edgtfGlobalVars.vars.edgtfLogoAreaHeight + edgtfGlobalVars.vars.edgtfMenuAreaHeight + edgtfGlobalVars.vars.edgtfStickyHeaderHeight;

                var headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        edgtf.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .edgtf-menu-second').removeClass('edgtf-drop-down-start');
                    }else {
                        edgtf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-down-up'):
                edgtf.modules.header.behaviour = 'edgtf-sticky-header-on-scroll-down-up';

                if(edgtfPerPageVars.vars.edgtfStickyScrollAmount !== 0){
                    edgtf.modules.header.stickyAppearAmount = edgtfPerPageVars.vars.edgtfStickyScrollAmount;
                }else{
                    edgtf.modules.header.stickyAppearAmount = edgtfGlobalVars.vars.edgtfStickyScrollAmount !== 0 ? edgtfGlobalVars.vars.edgtfStickyScrollAmount : edgtfGlobalVars.vars.edgtfTopBarHeight + edgtfGlobalVars.vars.edgtfLogoAreaHeight + edgtfGlobalVars.vars.edgtfMenuAreaHeight;
                }

                var headerAppear = function(){
                    if(edgtf.scroll < edgtf.modules.header.stickyAppearAmount) {
                        edgtf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .edgtf-menu-second').removeClass('edgtf-drop-down-start');
                    }else{
                        edgtf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case edgtf.body.hasClass('edgtf-fixed-on-scroll'):
                edgtf.modules.header.behaviour = 'edgtf-fixed-on-scroll';
                var headerFixed = function(){
                    if(edgtf.scroll <= (headerMenuAreaOffset - edgtfPerPageVars.vars.edgtfPassepartout)){
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom',0);}
                    else{
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom',fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function edgtfSideArea() {

        var wrapper = $('.edgtf-wrapper'),
            sideMenu = $('.edgtf-side-menu'),
            sideMenuButtonOpen = $('a.edgtf-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false;

        if (edgtf.body.hasClass('edgtf-side-menu-slide-from-right')) {
            $('.edgtf-cover').remove();
            cssClass = 'edgtf-right-cover-side-menu-opened';
            wrapper.prepend('<div class="edgtf-cover"/>');
            slideFromRight = true;

        } else if (edgtf.body.hasClass('edgtf-side-menu-slide-with-content')) {

            cssClass = 'edgtf-side-menu-open';
            slideWithContent = true;

        } else if (edgtf.body.hasClass('edgtf-side-area-uncovered-from-content')) {

            cssClass = 'edgtf-right-side-menu-opened';
            slideUncovered = true;

        }

        $('a.edgtf-side-menu-button-opener, a.edgtf-close-side-menu').click( function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                edgtf.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.edgtf-wrapper .edgtf-cover').click(function() {
                        edgtf.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility' : 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function() {
                    if(Math.abs(edgtf.scroll - currentScroll) > 400){
                        edgtf.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function(){
                                sideMenu.css({'visibility':'hidden'});
                                clearTimeout(hideSideMenu);
                            },400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                edgtf.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function(){
                        sideMenu.css({'visibility':'hidden'});
                        clearTimeout(hideSideMenu);
                    },400);
                }

            }

            if (slideWithContent) {

                e.stopPropagation();
                wrapper.click(function() {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    edgtf.body.removeClass('edgtf-side-menu-open');
                });

            }

        });

    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function edgtfSideAreaScroll(){

        var sideMenu = $('.edgtf-side-menu');

        if(sideMenu.length){    
            sideMenu.niceScroll({ 
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0, 
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false, 
                horizrailenabled: false 
            });
        }
    }

    /**
     * Init Fullscreen Menu
     */
    function edgtfFullscreenMenu() {

        if ($('a.edgtf-fullscreen-menu-opener').length) {

            var popupMenuOpener = $( 'a.edgtf-fullscreen-menu-opener'),
                popupMenuHolderOuter = $(".edgtf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.edgtf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.edgtf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.edgtf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.edgtf-fullscreen-menu > ul li.edgtf-has-sub > a'),
                menuItemWithoutChild = $('.edgtf-fullscreen-menu ul li:not(.edgtf-has-sub) a');


            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(edgtf.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(edgtf.windowHeight);
            });

            if (edgtf.body.hasClass('edgtf-fade-push-text-right')) {
                cssClass = 'edgtf-push-nav-right';
                fadeRight = true;
            } else if (edgtf.body.hasClass('edgtf-fade-push-text-top')) {
                cssClass = 'edgtf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open/Close popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('opened')) {
                    openFullScreenMenu();
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) {
                            closeFullScreenMenu();
                        }
                    });
                } else {
                    closeFullScreenMenu(); 
                }
            });

            function closeFullScreenMenu() {
                popupMenuOpener.removeClass('opened');
                edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                edgtf.body.addClass(cssClass);
                if(!edgtf.body.hasClass('page-template-full_screen-php')){
                    edgtf.modules.common.edgtfEnableScroll();
                }
                $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                    $('nav.popup_menu').getNiceScroll().resize();
                });
            }

            function openFullScreenMenu() {
                popupMenuOpener.addClass('opened');
                edgtf.body.addClass('edgtf-fullscreen-menu-opened');
                edgtf.body.removeClass('edgtf-fullscreen-fade-out').addClass('edgtf-fullscreen-fade-in');
                edgtf.body.removeClass(cssClass);
                if(!edgtf.body.hasClass('page-template-full_screen-php')){
                    edgtf.modules.common.edgtfDisableScroll();
                }
            }

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                if ($(this).parent().hasClass('edgtf-has-sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {                    	
                        if($(this).parent().siblings().hasClass('open_sub')) {
                            $(this).parent().siblings().each(function() {
                                var sibling = $(this);
                                if(sibling.hasClass('open_sub')) {
                                    var openedUl = sibling.find('> ul.sub_menu');
                                    openedUl.slideUp(400, 'easeInOutExpo' , function () {
                                        popupMenuHolderOuter.getNiceScroll().resize();
                                    });
                                    sibling.removeClass('open_sub');
                                }
                                if(sibling.find('.open_sub')) {
                                    var openedUlUl = sibling.find('.open_sub').find('> ul.sub_menu');
                                    openedUlUl.slideUp(400, 'easeInOutExpo', function () {
                                        popupMenuHolderOuter.getNiceScroll().resize();
                                    });
                                    sibling.find('.open_sub').removeClass('open_sub');
                                }
                            });
                        }
                        
                        $(this).parent().addClass('open_sub');
                        submenu.slideDown(400, 'easeInOutExpo', function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.click(function (e) {

                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){

                    if (e.which == 1) {
                        popupMenuOpener.removeClass('opened');
                        edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                        edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                        edgtf.body.addClass(cssClass);
                        $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        edgtf.modules.common.edgtfEnableScroll();
                    }
                }else{
                    return false;
                }

            });

        }



    }

    function edgtfInitMobileNavigation() {
        var navigationOpener = $('.edgtf-mobile-header .edgtf-mobile-menu-opener');
        var navigationHolder = $('.edgtf-mobile-header .edgtf-mobile-nav');
        var dropdownOpener = $('.edgtf-mobile-nav .mobile_arrow, .edgtf-mobile-nav h4, .edgtf-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('edgtf-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('edgtf-opened');
                        }
                    }

                });
            });
        }

        $('.edgtf-mobile-nav a, .edgtf-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function edgtfMobileHeaderBehavior() {
        if(edgtf.body.hasClass('edgtf-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var topBar = $('.edgtf-top-bar');
            var mobileHeader = $('.edgtf-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var topBarHeight = topBar.is(':visible') ? topBar.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = topBarHeight + mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('edgtf-animate-mobile-header');
                    mobileHeader.css('margin-bottom',  mobileHeaderHeight);
                } else {
                    mobileHeader.removeClass('edgtf-animate-mobile-header');
                    mobileHeader.css('margin-bottom', 0);
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    if(adminBar.length) {
                        mobileHeader.find('.edgtf-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');

                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function edgtfSetDropDownMenuPosition(){

        var menuItems = $(".edgtf-drop-down > ul > li.edgtf-menu-narrow");
        menuItems.each( function(i) {

            var browserWidth = edgtf.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.edgtf-menu-second .edgtf-menu-inner ul').width();

            var menuItemFromLeft = 0;
            if(edgtf.body.hasClass('boxed')){
                menuItemFromLeft = edgtf.boxedLayoutWidth  - (menuItemPosition - (browserWidth - edgtf.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.edgtf-menu-second').addClass('right');
                $(this).find('.edgtf-menu-second .edgtf-menu-inner ul').addClass('right');
            }
        });

    }


    function edgtfDropDownMenu() {

        var menu_items = $('.edgtf-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.edgtf-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.edgtf-menu-second');

                if($(menu_items[i]).hasClass('edgtf-menu-wide')) {

                    var dropdown = $(this).find('.edgtf-menu-inner > ul');
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();

                    if(!$(this).hasClass('edgtf-menu-left-position') && !$(this).hasClass('edgtf-menu-right-position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.edgtf-menu-second > .edgtf-menu-inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });
                    $(this).find('.edgtf-menu-second > .edgtf-menu-inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.edgtf-menu-second > .edgtf-menu-inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    if(!$(this).hasClass('edgtf-wide-background')) {
                        if(!$(this).hasClass('edgtf-menu-left-position') && !$(this).hasClass('edgtf-menu-right-position')) {
                            var left_position = (edgtf.windowWidth - 2 * (edgtf.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    } else {
                        if(!$(this).hasClass('edgtf-menu-left-position') && !$(this).hasClass('edgtf-menu-right-position')) {
                            var left_position = $(this).offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', edgtf.windowWidth);

                        }
                    }
                }

                if(!edgtf.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(edgtf.body.hasClass('edgtf-dropdown-animate-height')) {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('edgtf-drop-down-start');
                                    dropDownSecondDiv.css({
                                        'visibility': 'visible',
                                        'height': '0px',
                                    });
                                    dropDownSecondDiv.css('opacity', '1');
                                    dropDownSecondDiv.stop().animate({
                                        'height': $(menu_items[i]).data('original_height')
                                    }, 500, 'easeInOutQuint', function() {
                                        dropDownSecondDiv.css('overflow', 'visible');
                                    });
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().animate({
                                    'height': '0px',
                                    'opacity': 0,
                                }, 0, function() {
                                    dropDownSecondDiv.css({
                                        'overflow': 'hidden',
                                        'visibility': 'hidden'
                                    });
                                });
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('edgtf-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('edgtf-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
         $('.edgtf-drop-down ul li.edgtf-menu-wide ul li a').on('click', function(e) {
            if (e.which == 1){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            }
        });

        edgtf.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function edgtfSearch() {

        var searchOpener = $('a.edgtf-search-opener'),
            searchClose,
            searchForm,
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {
            //Check for type of search
            if ( edgtf.body.hasClass('edgtf-fullscreen-search') ) {

                searchClose = $('.edgtf-fullscreen-search-close');

                edgtfFullscreenSearch();

            } else if ( edgtf.body.hasClass( 'edgtf-search-covers-header' ) ) {

                edgtfSearchCoversHeader();

            }

			//Check for hover color of search
			searchOpener.each(function () {
				var thisSearchOpener = $(this);
				if(typeof thisSearchOpener.data('hover-color') !== 'undefined') {
					var originalColor;

					var changeSearchColor = function(event) {
						event.data.thisSearchOpener.css('color', event.data.color);
					};

					if(typeof thisSearchOpener.data('color') !== 'undefined'){
						originalColor = thisSearchOpener.data('color');
					}
					else{
						originalColor = thisSearchOpener.css('color');
					}

					var hoverColor = thisSearchOpener.data('hover-color');

					thisSearchOpener.on('mouseenter', { thisSearchOpener: thisSearchOpener, color: hoverColor }, changeSearchColor);
					thisSearchOpener.on('mouseleave', { thisSearchOpener: thisSearchOpener, color: originalColor }, changeSearchColor);
				}
			});

        }

        /**
         * Search covers header type of search
         */
        function edgtfSearchCoversHeader() {

            searchOpener.click( function(e) {
                e.preventDefault();
                var searchFormHeight,
                    searchFormHolder = $('.edgtf-search-cover .edgtf-form-holder-outer'),
                    searchForm,
                    searchFormLandmark; // there is one more div element if header is in grid

                if($(this).closest('.edgtf-grid').length){
                    searchForm = $(this).closest('.edgtf-grid').children().first();
                    searchFormLandmark = searchForm.parent();
                }
                else{
                    searchForm = $(this).closest('.edgtf-menu-area').children().first();
                    searchFormLandmark = searchForm;
                }

                if ( $(this).closest('.edgtf-sticky-header').length > 0 ) {
                    searchForm = $(this).closest('.edgtf-sticky-header').children().first();
                    searchFormLandmark = searchForm.parent();
                }
                if ( $(this).closest('.edgtf-mobile-header').length > 0 ) {
                    searchForm = $(this).closest('.edgtf-mobile-header').children().children().first();
                }

                //Find search form position in header and height
                if ( searchFormLandmark.parent().hasClass('edgtf-logo-area') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfLogoAreaHeight;
                } else if ( searchFormLandmark.parent().hasClass('edgtf-top-bar') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfTopBarHeight;
                } else if ( searchFormLandmark.parent().hasClass('edgtf-menu-area') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfMenuAreaHeight - edgtfGlobalVars.vars.edgtfTopBarHeight;
                } else if ( searchFormLandmark.hasClass('edgtf-sticky-header') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfStickyHeaderHeight;
                } else if ( searchFormLandmark.parent().hasClass('edgtf-mobile-header') ) {
                    searchFormHeight = $('.edgtf-mobile-header-inner').height();
                }

                searchFormHolder.height(searchFormHeight);
                searchForm.stop(true).fadeIn(600);
                $('.edgtf-search-cover input[type="text"]').focus();
                $('.edgtf-search-close, .content, footer').click(function(e){
                    e.preventDefault();
                    searchForm.stop(true).fadeOut(450);
                });
                searchForm.blur(function() {
                    searchForm.stop(true).fadeOut(450);
                });
            });

        }

        /**
         * Fullscreen search (two types: fade and from circle)
         */
        function edgtfFullscreenSearch() {

            var searchHolder = $( '.edgtf-fullscreen-search-holder'),
                searchOverlay = $( '.edgtf-fullscreen-search-overlay' ),
                searchField = searchHolder.find('.edgtf-search-field');

            searchOpener.click( function(e) {
                e.preventDefault();
                var samePosition = false;
                if ( $(this).data('icon-close-same-position') === 'yes' ) {
                    var closeTop = $(this).offset().top;
                    var closeLeft = $(this).offset().left;
                    samePosition = true;
                }
                //Fullscreen search fade
                if ( searchHolder.hasClass( 'edgtf-animate' ) ) {
                    closeFullScreenSearch();
                } else {
                    openFullScreenSearch();
                }
                searchClose.click( function(e) {
                    closeFullScreenSearch();
                });
                //Close on escape
                $(document).keyup(function(e){
                    if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                        closeFullScreenSearch();
                    }
                });
                //Close on click away
                $(document).mouseup(function (e) {
                    var container = $(".edgtf-fullscreen-search-inner");
                    if (!container.is(e.target) && container.has(e.target).length === 0)  {
                        closeFullScreenSearch();
                    }
                });

                function closeFullScreenSearch() {
                    edgtf.body.removeClass('edgtf-fullscreen-search-opened');
                    edgtf.body.addClass( 'edgtf-search-fade-out' );
                    edgtf.body.removeClass( 'edgtf-search-fade-in' );
                    searchHolder.removeClass( 'edgtf-animate' );
                    if(!edgtf.body.hasClass('page-template-full_screen-php')){
                        edgtf.modules.common.edgtfEnableScroll();
                    }
                    searchField.blur().val('');
                }

                function openFullScreenSearch() {
                    edgtf.body.addClass('edgtf-fullscreen-search-opened');
                    edgtf.body.removeClass('edgtf-search-fade-out');
                    edgtf.body.addClass('edgtf-search-fade-in');
                    searchHolder.addClass('edgtf-animate');
                    if (samePosition) {
                        searchClose.css({
                            'top' : closeTop - edgtf.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                            'left' : closeLeft
                        });
                    }
                    if(!edgtf.body.hasClass('page-template-full_screen-php')){
                        edgtf.modules.common.edgtfDisableScroll();
                    }
                    setTimeout(function(){
                        searchField.focus();
                    },600);
                }
            });

            //Text input focus change
            $('.edgtf-fullscreen-search-holder .edgtf-search-field').focus(function(){
                $('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line').css("width","100%");
            });

            $('.edgtf-fullscreen-search-holder .edgtf-search-field').blur(function(){
                setTimeout(function(){
                    $('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line').css("width","0");
                },120);
            });

        }

    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var edgtfVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.edgtf-vertical-menu-area');

        /**
         * Initialzes navigation functionality.
         */
        var initNavigation = function() {
            var verticalNavObject = verticalMenuObject.find('.edgtf-vertical-menu'),
            	verticalTableCell = verticalMenuObject.find('.edgtf-vertical-menu-table-cell'),
            	verticalLogo = verticalMenuObject.find('.edgtf-logo-wrapper'),
            	verticalWidgetBottom = verticalMenuObject.find('.edgtf-vertical-widget-bottom');

			if (verticalWidgetBottom.length){
				var paddingBottom = verticalWidgetBottom.height();
				verticalTableCell.css({"padding-bottom": paddingBottom + 'px'});
			}

			if (verticalLogo.length){
				var paddingTop = verticalLogo.height();
				verticalTableCell.css({"padding-top": paddingTop + 'px'});
			}

            dropdownFloat();

            /**
             * Initializes floating navigation type (it comes from the side as a dropdown)
             */
            function dropdownFloat() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
                var allDropdowns = menuItems.find(' > .edgtf-menu-second, > ul');

                menuItems.each(function() {
                    var elementToExpand = $(this).find(' > .edgtf-menu-second, > ul');
                    var menuItem = this;

                    if(Modernizr.touch) {
                        var dropdownOpener = $(this).find('> a');

                        dropdownOpener.on('click tap', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if(elementToExpand.hasClass('edgtf-float-open')) {
                                elementToExpand.removeClass('edgtf-float-open');
                                $(menuItem).removeClass('open');
                            } else {
                                if(!$(this).parents('li').hasClass('open')) {
                                    menuItems.removeClass('open');
                                    allDropdowns.removeClass('edgtf-float-open');
                                }

                                elementToExpand.addClass('edgtf-float-open');
                                $(menuItem).addClass('open');
                            }
                        });
                    } else {
                        //must use hoverIntent because basic hover effect doesn't catch dropdown
                        //it doesn't start from menu item's edge
                        $(this).hoverIntent({
                            over: function() {
                                elementToExpand.addClass('edgtf-float-open');
                                $(menuItem).addClass('open');
                            },
                            out: function() {
                                elementToExpand.removeClass('edgtf-float-open');
                                $(menuItem).removeClass('open');
                            },
                            timeout: 300
                        });
                    }
                });
            }

           
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();   
                }
            }
        };
    };

    /*
     **  Smooth scroll functionality for Vertical Menu
     */
    function edgtfVerticalMenuScroll(){

        function verticalSideareascroll(event){
            var delta = 0;
            if (!event) event = window.event;
            if (event.wheelDelta) {
                delta = event.wheelDelta/120;
            } else if (event.detail) {
                delta = -event.detail/3;
            }

            if (delta)
                handle(delta);
            if (event.preventDefault)
                event.preventDefault();
            event.returnValue = false;
        }

        function handle(delta){
            if (delta < 0){
                if(Math.abs(margin) <= maxMargin){
                    margin += delta*20;
                    $(verticalMenuInner).css('margin-top', margin);
                }
            }
            else {
                if(margin <= -20){
                    margin += delta*20;
                    $(verticalMenuInner).css('margin-top', margin);
                }
            }
        }

        if($('.edgtf-vertical-menu-area').length && edgtf.windowWidth < 1500) {

            var browserHeight = edgtf.windowHeight;
            var verticalMenuArea = $('.edgtf-vertical-menu-area');
            var verticalMenuInner = $('.edgtf-vertical-menu-area .edgtf-vertical-menu-area-inner');
            var verticalMenu = verticalMenuInner.find('.edgtf-vertical-menu');
            var verticalMenuHeight = verticalMenu.outerHeight() + parseInt(verticalMenuArea.css('padding-top')) + parseInt(verticalMenuArea.css('padding-bottom'));
            var margin = 0;
            var maxMargin = (browserHeight - verticalMenuHeight)/2;

            $(verticalMenuArea).hover(
                function() {
                    edgtf.modules.common.edgtfDisableScroll();
                    if (window.addEventListener) {
                        window.addEventListener('mousewheel', verticalSideareascroll, false);
                        window.addEventListener('DOMMouseScroll', verticalSideareascroll, false);
                    }
                    window.onmousewheel = document.onmousewheel = verticalSideareascroll;
                },
                function() {
                    edgtf.modules.common.edgtfEnableScroll();
                    window.removeEventListener('mousewheel', verticalSideareascroll, false);
                    window.removeEventListener('DOMMouseScroll', verticalSideareascroll, false);
                }
            );
        }
    }

    /*
    * Menu underline animation
    */
    function edgtfMenuUnderline() {

        //first level menu
        var firstLevelMenus = $('.edgtf-main-menu > ul');

        if (firstLevelMenus.length) {
            firstLevelMenus.each(function(){
                var mainMenu = $(this);

                mainMenu.append('<li class="edgtf-main-menu-line"></li>');

                var menuLine = mainMenu.find('.edgtf-main-menu-line'),
                    menuItems = mainMenu.find('> li.menu-item');

                menuLine.css('left', menuItems.first().offset().left - mainMenu.offset().left);

                menuItems.each(function(){
                    var menuItem = $(this),
                        menuItemWidth = menuItem.outerWidth(),
                        mainMenuOffset = mainMenu.offset().left,
                        menuItemOffset = menuItem.offset().left - mainMenuOffset;

                    menuItem.mouseenter(function(){
                        menuLine.css('width', menuItemWidth);
                        menuLine.css('left', menuItemOffset);
                    });
                });

                mainMenu.mouseleave(function(){
                    menuLine.css('width', 0);
                    menuLine.css('left', menuItems.first().offset().left - mainMenu.offset().left);
                });

            });
        }

        //wide drop down
        var wideDropDowns = $('.edgtf-main-menu .edgtf-menu-wide ul > li > ul');

        if (wideDropDowns.length) {
            wideDropDowns.each(function(){
                var wideMenu = $(this);

                wideMenu.append('<li class="edgtf-wide-menu-line"></li>');

                var menuLine = wideMenu.find('.edgtf-wide-menu-line'),
                    menuItems = wideMenu.find('> li.menu-item'),
                    setIdleState = false;

                menuItems.each(function(){
                    var menuItem = $(this),
                        menuItemHeight = menuItem.find('> a').height(),
                        wideMenuOffset = wideMenu.closest('li').offset().top,
                        correctiveFactor = parseInt(wideMenu.css('padding-top')) + parseInt(menuItem.find('> a').css('padding-top')), //ul padding and inner paddings calc for vertical centering
                        menuItemOffset = menuItem.find('> a').offset().top  - wideMenuOffset - correctiveFactor;

                    if (!setIdleState) {
                        menuLine.css('top', menuItemOffset);
                        setIdleState = true;
                    }

                    menuItem.mouseenter(function(){
                        menuLine.css('height', menuItemHeight);
                        menuLine.css('top', menuItemOffset);
                    });
                });

                wideMenu.mouseleave(function(){
                    menuLine.css('height', 0);
                });

            });
        }

        //narrow drop down
        var narrowDropDowns = $('.edgtf-main-menu > ul > .edgtf-menu-narrow ul');

        if (narrowDropDowns.length) {
            narrowDropDowns.each(function(){
                var narrowMenu = $(this);

                narrowMenu.append('<li class="edgtf-narrow-menu-line"></li>');

                var menuLine = narrowMenu.find('.edgtf-narrow-menu-line'),
                    menuItems = narrowMenu.find('> li.menu-item'),
                    setIdleState = false;

                menuItems.each(function(){
                    var menuItem = $(this),
                        menuItemHeight = menuItem.find('> a').height(),
                        narrowMenuOffset = narrowMenu.closest('ul').offset().top,
                        correctiveFactor = parseInt(menuItem.find('> a').css('padding-top')),
                        menuItemOffset = menuItem.find('> a').offset().top  - narrowMenuOffset + correctiveFactor;

                    if (!setIdleState) {
                        menuLine.css('top', menuItemOffset);
                        setIdleState = true;
                    }

                    menuItem.mouseenter(function(){
                        menuLine.css('height', menuItemHeight);
                        menuLine.css('top', menuItemOffset);
                    });
                });

                narrowMenu.mouseleave(function(){
                    menuLine.css('height', 0);
                });

            });
        }

        //vertical drop down 
        var verticalDropDowns = $('nav.edgtf-vertical-menu > ul ul');

        if (verticalDropDowns.length) {
            verticalDropDowns.each(function(){
                var verticalMenu = $(this);

                verticalMenu.append('<li class="edgtf-vertical-menu-line"></li>');

                var menuLine = verticalMenu.find('.edgtf-vertical-menu-line'),
                    menuItems = verticalMenu.find('> li.menu-item'),
                    setIdleState = false;

                menuItems.each(function(){
                    var menuItem = $(this),
                        menuItemHeight = menuItem.find('> a').height(),
                        verticalMenuOffset = verticalMenu.closest('ul').offset().top,
                        correctiveFactor = parseInt(menuItem.find('> a').css('padding-top')),
                        menuItemOffset = menuItem.find('> a').offset().top  - verticalMenuOffset + correctiveFactor;

                    if (!setIdleState) {
                        menuLine.css('top', menuItemOffset);
                        setIdleState = true;
                    }

                    menuItem.mouseenter(function(){
                        menuLine.css('height', menuItemHeight);
                        menuLine.css('top', menuItemOffset);
                    });
                });

                verticalMenu.mouseleave(function(){
                    menuLine.css('height', 0);
                });

            });
        }
    }

})(jQuery);