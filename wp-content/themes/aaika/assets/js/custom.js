(function($){
	"use strict";
	$(document).ready(function($){
		$(
				'.devn-sidebar .widget_categories,.devn-sidebar .widget_archive,'+
				'.devn-sidebar .widget_pages,.devn-sidebar .widget_meta,'+
				'.devn-sidebar .widget_recent_entries,'+
				'.devn-sidebar .widget_product_categories,'+
				'.devn-sidebar .widget_nav_menu').each(function(){
				
			$(this).find('ul').addClass('arrows_list1');
			$(this).find('li a').prepend('<i class="fa fa-caret-right"></i>');
		
		});
		
		$('ul.nav>li.current-menu-item>a').addClass('active');
		
		$('.devn-sidebar h3.widget-title,.footer h3.widget-title').each(function(){
			var html = this.innerHTML;
			if( html.indexOf(' ') > -1 ){
				var title = html.substring( 0 , html.indexOf(' ') );
				title += '<i>'+html.substring( html.indexOf(' '), html.length )+'</i>';
				this.innerHTML = title;
			}
		});
			
		$('#tabs ul.tabs li').click(function(e){
			$('#tabs .tab_container').css({display:'none'});
			$( $(this).find('a').attr('href') ).css({display:'block'});
			$('#tabs ul.tabs li.active').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});
		
		$('.devn-portfolio-item a.lightbox').attr({ 'rel': 'lb[portfolio]' });
		
		$("a[rel^='lb']").prettyPhoto({
			animation_speed:'normal',
			theme:'pp_default',
			slideshow:5000, 
			hideflash: true,
			autoplay_slideshow: false,
			social_tools: '',
			show_title: true
		});	
		
		$('#scrollup').click(function(e){
			$('html,body').animate({ 'scroll-top' : 0 });
			e.preventDefault();
		});

		$('.navbar-toggle').click(function(){
			var targ = $(this).attr('data-target');
			if( $( targ ).get(0) ){
				$( targ ).slideToggle();
			}
		});
		
		$('a').click(function(e){
			if( $(this).attr('href') == '#' ){
				e.preventDefault();
			}
		});
		
		$('.flexslider').flexslider({
			animation:"slide",
			animationLoop:true,
			itemWidth:1170,
			itemMargin:5,
			pausePlay:true,
			start:function(slider){
				$('body').removeClass('loading');
			}
		});
		
		document.mainMenu = $('body');
		
		$(window).scroll(function () {

		    if ($(window).scrollTop() > 30 ) {
		        $('#scrollup').show();
		        document.mainMenu.addClass('compact');
		    } else {
		        $('#scrollup').hide();
		        document.mainMenu.removeClass('compact');
		    }
		});
		
		$('.close-but').click(function(){
			$(this).parent().parent().hide('slow',function(){$(this).remove();});
		});
		
		$('.devn-preload').each(function(){
			
			var rel = $(this).attr('data-option').split('|');
			
			(function( elm ){
				$.post( site_uri+'/index.php', {
						'control'	: 'ajax',
						'task'		: rel[0], 
						'id'		: rel[1],
						'amount'	: rel[2]
					}, function (result) {
					
					elm.innerHTML = result;
					$(elm).addClass('animated fadeIn');
						
				})
			})(this);
			
		});
		
		
		// Show / Hide Top Panel
		$('#topMenuImage').click(function(){
			if( !$(this).find('.open').hasClass('hide') ){
				$('#sliderContent').addClass('showPanel');
				$(this).find('.open,.close').addClass('hide');
				setTimeout(function(){
					$('#topMenuImage .close').removeClass('hide');
				},500);
				
			}else{
				$('#sliderContent').removeClass('showPanel');
				$(this).find('.close').addClass('hide');
				setTimeout(function(){
					$('#topMenuImage .open').removeClass('hide');
				},500);
			}
		});
		
		
		// Menu OnePage
		$('#menu-onepage .nav-toggle').click(function(){
			if($(this).hasClass('active')){
				$(this).removeClass('active');
			}
			else{
				$(this).addClass('active');
			}
			$(this).next().slideToggle();
		});
		$('#menu-onepage a').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('#menu-onepage li.active').removeClass('active');
					$(this).parent().addClass('active');
					$('.nav-collapse').attr({style:''});
					$('.nav-toggle').removeClass('active');
					$('html,body').animate({
						scrollTop: target.offset().top-100
					}, 1000);
					return false;
				}
			}
		});
		
		
		$('#devn-mainmenu li a').click(function(e){
			if( !$(this.parentNode).find('ul').get(0) || $('body').width() > 1000 ){
				return true;
			}
			if( $(this.parentNode).hasClass('open') ){
				$(this.parentNode).removeClass('open');
				return true;
			}else $(this.parentNode).addClass('open');

			e.preventDefault();
			
			return false;
		});
		
					
	});
	
	
	$(window).load(function(){
		$('.flexslider').flexslider({
			animation:"slide",
			animationLoop:true,
			itemWidth:1170,
			itemMargin:5,
			pausePlay:true,
			start:function(slider){
				$('body').removeClass('loading');
			}
		});
	});
	
})(jQuery);	


function timelineLoadmore( index, btn ){
	
	jQuery( btn ).html('<i class="fa fa-spinner fa-spin"></i>').get(0).disabled = true;
	jQuery.post( site_uri+'/wp-admin/admin-ajax.php', {
			'action': 'loadPostsTimeline',
			'index': index
		}, function (result) {
			jQuery( btn ).remove();
			jQuery('#cd-timeline').append( result );
	});
}

