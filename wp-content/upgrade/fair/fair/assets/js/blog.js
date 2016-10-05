(function($) {
    "use strict";


    var blog = {};
    edgtf.modules.blog = blog;

    blog.edgtfInitAudioPlayer = edgtfInitAudioPlayer;

    blog.edgtfOnDocumentReady = edgtfOnDocumentReady;
    blog.edgtfOnWindowLoad = edgtfOnWindowLoad;
    blog.edgtfOnWindowResize = edgtfOnWindowResize;
    blog.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).load(edgtfOnWindowLoad);
    $(window).resize(edgtfOnWindowResize);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitAudioPlayer();
        edgtfInitBlogMasonry();
        edgtfInitBlogMasonryLoadMore();
	    edgtfInitBlogMasonryGallery();
	    edgtfInitBlogMasonryGalleryLoadMore();
	    edgtfBlogNarrowHover();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
	    edgtfMasonryGalleryAppear();
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



    function edgtfInitAudioPlayer() {

        var players = $('audio.edgtf-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }


    function edgtfInitBlogMasonry() {

        if($('.edgtf-blog-holder.edgtf-blog-type-masonry').length) {

            var container = $('.edgtf-blog-holder.edgtf-blog-type-masonry');

			container.waitForImages({
				finished: function(){
					container.isotope({
						itemSelector: 'article',
						resizable: false,
						masonry: {
							columnWidth: '.edgtf-blog-masonry-grid-sizer',
							gutter: '.edgtf-blog-masonry-grid-gutter'
						}
					});

					setTimeout(function() {
						container.addClass('edgtf-appeared');
						container.isotope('layout');
					}, 400);
				},
				waitForAll: true
			});

            var filters = $('.edgtf-filter-blog-holder');
            $('.edgtf-filter').click(function() {
                var filter = $(this);
                var selector = filter.attr('data-filter');
                filters.find('.edgtf-active').removeClass('edgtf-active');
                filter.addClass('edgtf-active');
                container.isotope({filter: selector});
                return false;
            });
        }
    }

    function edgtfInitBlogMasonryLoadMore() {

        if($('.edgtf-blog-holder.edgtf-blog-type-masonry').length) {

            var container = $('.edgtf-blog-holder.edgtf-blog-type-masonry');

            if(container.hasClass('edgtf-masonry-pagination-infinite-scroll')) {
	            var i = 1;

	            $('.edgtf-blog-infinite-scroll-button a').appear(function(e) {
		            e.preventDefault();
		            var button = $('.edgtf-blog-infinite-scroll-button a');

		            var link = button.attr('href');
		            var content = '.edgtf-masonry-pagination-infinite-scroll';
		            var anchor = '.edgtf-blog-infinite-scroll-button a';
		            var nextHref = $(anchor).attr('href');
					button.css('visibility', 'visible');
		            button.text(edgtfGlobalVars.vars.edgtfMessage);
		            $.get(link + '', function(data) {
			            var newContent = $(content, data).wrapInner('').html();
			            nextHref = $(anchor, data).attr('href');
			            container.append(newContent).waitForImages({
			            	finished: function() {
					            edgtf.modules.blog.edgtfInitAudioPlayer();
					            edgtf.modules.common.edgtfSlickSlider();
					            edgtf.modules.common.edgtfFluidVideo();
					            container.isotope('reloadItems').isotope({sortBy: 'original-order'});
					            $('.edgtf-masonry-pagination-load-more').isotope('layout');
					        },
					        waitForAll: true
			            });

			            if(button.parent().data('rel') > i) {
				            button.attr('href', nextHref); // Change the next URL
				            button.css('visibility', 'hidden');
			            } else {
				            button.text(edgtfGlobalVars.vars.edgtfFinishedMessage);
				            setTimeout(function() {
					            button.parent().fadeOut(600, function(){ button.parent().remove();});
				            }, 600);

			            }
		            });
		            i++;
	            },{ one: false, accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            } else if(container.hasClass('edgtf-masonry-pagination-load-more')) {
                var i = 1;
                $('.edgtf-blog-load-more-button a').on('click', function(e) {
                    e.preventDefault();

                    var button = $(this);

                    var link = button.attr('href');
                    var content = '.edgtf-masonry-pagination-load-more';
                    var anchor = '.edgtf-blog-load-more-button a';
                    var nextHref = $(anchor).attr('href');
                    $.get(link + '', function(data) {
                        var newContent = $(content, data).wrapInner('').html();
                        nextHref = $(anchor, data).attr('href');
                        container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        edgtf.modules.blog.edgtfInitAudioPlayer();
                        edgtf.modules.common.edgtfSlickSlider();
                        edgtf.modules.common.edgtfFluidVideo();
                        setTimeout(function() {
                            $('.edgtf-masonry-pagination-load-more').isotope('layout');
                        }, 400);
                        if(button.parent().data('rel') > i) {
                            button.attr('href', nextHref); // Change the next URL
                        } else {
                            button.parent().remove();
                        }
                    });
                    i++;
                });
            }
        }
    }

    
    function setBlogLoadMoreAjaxData(container){
        
        var returnValue = {
            action: 'fair_edge_blog_load_more',
            nextPage: container.nextPage,
            number: container.number,
            category: container.category,
            blogType: container.blogType,
            archiveCategory: container.archiveCategory,
            archiveAuthor: container.archiveAuthor,
            archiveTag: container.archiveTag,
            archiveDay: container.archiveDay,
            archiveMonth: container.archiveMonth,
            archiveYear: container.archiveYear
        };
        
        return returnValue;
    }

	function edgtfInitBlogMasonryGallery() {

		if($('.edgtf-blog-holder.edgtf-blog-type-masonry-gallery').length) {

			edgtfResizeBlogMasonryGallery($('.edgtf-blog-masonry-gallery-grid-sizer').width());

			var container = $('.edgtf-blog-holder.edgtf-blog-type-masonry-gallery');

			container.isotope({
				itemSelector: 'article',
				resizable: false,
				masonry: {
					columnWidth: '.edgtf-blog-masonry-gallery-grid-sizer',
					gutter: '.edgtf-blog-masonry-gallery-grid-gutter'
				}
			});

			var filters = $('.edgtf-filter-blog-holder');
			$('.edgtf-filter').click(function() {
				var filter = $(this);
				var selector = filter.attr('data-filter');
				filters.find('.edgtf-active').removeClass('edgtf-active');
				filter.addClass('edgtf-active');
				container.isotope({filter: selector});
				return false;
			});

			container.waitForImages(function(){
				container.animate({opacity: "1"}, 300, function() {
					container.isotope('layout');
				});
			});

			$(window).resize(function() {
				edgtfResizeBlogMasonryGallery($('.edgtf-blog-masonry-gallery-grid-sizer').width());
				container.isotope('layout');
			});
		}
	}

	function edgtfInitBlogMasonryGalleryLoadMore() {

		if($('.edgtf-blog-holder.edgtf-blog-type-masonry-gallery').length) {

			var container = $('.edgtf-blog-holder.edgtf-blog-type-masonry-gallery');

			if(container.hasClass('edgtf-masonry-pagination-infinite-scroll')) {
	            var i = 1;

	            $('.edgtf-blog-infinite-scroll-button a').appear(function(e) {
		            e.preventDefault();
		            var button = $('.edgtf-blog-infinite-scroll-button a');

		            var link = button.attr('href');
		            var content = '.edgtf-masonry-pagination-infinite-scroll';
		            var anchor = '.edgtf-blog-infinite-scroll-button a';
		            var nextHref = $(anchor).attr('href');
					button.css('visibility', 'visible');
		            button.text(edgtfGlobalVars.vars.edgtfMessage);
		            $.get(link + '', function(data) {
			            var newContent = $(content, data).wrapInner('').html();
			            nextHref = $(anchor, data).attr('href');
						container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
			            edgtf.modules.blog.edgtfInitAudioPlayer();
			            edgtf.modules.common.edgtfSlickSlider();
			            edgtf.modules.common.edgtfFluidVideo();
						edgtfResizeBlogMasonryGallery($('.edgtf-blog-masonry-gallery-grid-sizer').width());
						container.isotope('layout');
						setTimeout(function() {
				            $('.edgtf-masonry-pagination-load-more').isotope('layout');
						}, 400);

			            if(button.parent().data('rel') > i) {
				            button.attr('href', nextHref); // Change the next URL
				            button.css('visibility', 'hidden');
			            } else {
				            button.text(edgtfGlobalVars.vars.edgtfFinishedMessage);
				            setTimeout(function() {
					            button.parent().fadeOut(600, function(){ button.parent().remove();});
				            }, 600);

			            }
		            });
		            i++;
	            },{ one: false, accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
			} else if(container.hasClass('edgtf-masonry-pagination-load-more')) {
				var i = 1;
				$('.edgtf-blog-load-more-button a').on('click', function(e) {
					e.preventDefault();

					var button = $(this);

					var link = button.attr('href');
					var content = '.edgtf-masonry-pagination-load-more';
					var anchor = '.edgtf-blog-load-more-button a';
					var nextHref = $(anchor).attr('href');
					$.get(link + '', function(data) {
						var newContent = $(content, data).wrapInner('').html();
						nextHref = $(anchor, data).attr('href');
						container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
			            edgtf.modules.blog.edgtfInitAudioPlayer();
			            edgtf.modules.common.edgtfSlickSlider();
			            edgtf.modules.common.edgtfFluidVideo();
						edgtfResizeBlogMasonryGallery($('.edgtf-blog-masonry-gallery-grid-sizer').width());
						setTimeout(function() {
							$('.edgtf-masonry-pagination-load-more').isotope('layout');
						}, 400);
						if(button.parent().data('rel') > i) {
							button.attr('href', nextHref); // Change the next URL
						} else {
							button.parent().remove();
						}
					});
					i++;
				});
			}
			$(window).resize(function() {
				edgtfResizeBlogMasonryGallery($('.edgtf-blog-masonry-gallery-grid-sizer').width());
				container.isotope('reloadItems');
			});
		}
	}

	function edgtfResizeBlogMasonryGallery(size) {

		var rectangle_portrait = $('.edgtf-blog-holder.edgtf-blog-type-masonry-gallery .edgtf-post-size-large-height');
		var rectangle_landscape = $('.edgtf-blog-holder.edgtf-blog-type-masonry-gallery .edgtf-post-size-large-width');
		var square_big = $('.edgtf-blog-holder.edgtf-blog-type-masonry-gallery .edgtf-post-size-large-width-height');
		var square_small = $('.edgtf-blog-holder.edgtf-blog-type-masonry-gallery .edgtf-post-size-default');

		rectangle_portrait.css('height', 2 * size);
		rectangle_landscape.css('height', size);
		square_big.css('height', 2 * size);
		if(square_big.width() < 600) {
			square_big.css('height', square_big.width());
		}
		if (edgtf.windowWidth <= 480) {
			rectangle_landscape.css('height', size/2);
		}
		square_small.css('height', size);
	}

	function edgtfBlogNarrowHover() {

		var blogList = $('.edgtf-blog-holder.edgtf-blog-type-narrow');
		if (blogList.hasClass('edgtf-hover-follows')) {
			var articles = blogList.find('article'),
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
	}

	function edgtfMasonryGalleryAppear() {
		var masonryGalleryHolders = $('.edgtf-blog-type-masonry-gallery.edgtf-masonry-appear');

		if (masonryGalleryHolders.length) {
			masonryGalleryHolders.each(function(){
				var masonryGalleryHolder = $(this),
					articles = masonryGalleryHolder.find('article'),
					firstArticle = articles.first(),
					firstArticleTop = firstArticle.offset().top,
					numberOfArticles = articles.length,
					counter = 0,
					cycle = 1;

				articles.each(function(i){
					var article = $(this);	

					if (firstArticleTop == article.offset().top) {
						cycle++;
					}

					setTimeout(function(){
						article.appear(function(){
							if (counter == cycle) {
								counter = 0;
							}

							setTimeout(function(){
								article.addClass('edgtf-appeared');
							}, counter* 300);

							counter++;
						});
					}, 20); //cycle set
				});
			});
		}
	}

})(jQuery);