<?php
/**
 #		(c) www.king-theme.com
 */
get_header(); ?>

---
	
<?php $devn->breadcrumb(); ?>
	
<div id="primary" class="site-content">
	<div id="content" class="container">
	
		<div class="error_pagenotfound">
	    	
	        <strong><?php _e('404', 'aaikadomain' ); ?></strong>
	        <br>
	    	<b><?php _e('Oops... Page Not Found!', 'aaikadomain' ); ?></b>
	        
	        <em><?php _e('Sorry the Page Could not be Found here.', 'aaikadomain' ); ?></em>
	
	        <p><?php _e('Try using the button below to go to main page of the site', 'aaikadomain' ); ?></p>
	        
	        <div class="clearfix margin_top3"></div>
	    	
	        <a href="<?php echo SITE_URI; ?>" class="btn btn-primary">
	        	<i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; <?php _e('Go to Back', 'aaikadomain' ); ?>
	        </a>

	    </div>
	    
	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>		    
