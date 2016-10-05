<?php
/**
 * (c) king-theme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $post, $more, $devn;

get_header('header-6');

?>
<div class="clearfix margin_top5"></div>
<div class="login_form clearfix" id="devn-form-user">        
	<form id="devn-form" method="post" name="loginform" action="" class="devn-form" onsubmit="return false;" novalidate="novalidate">
		<?php
		
		if( is_user_logged_in() ){
			echo '<header class="aligncenter">'.__( 'You are logged in', 'aaikadomain' ).'</header>';
		}else{
	   
	   ?>
	   <header><?php _e('Forgot your password', 'aaikadomain' ); ?></header>
	   <fieldset>
	      <section>
	         <div class="row">
	            <label class="label col col-4"> <?php _e('Your Email', 'aaikadomain' ); ?></label>
	            <div class="col col-8"><label class="input"><i class="fa fa-user"></i><input type="text" name="email"></label></div>
	            <br />
	            <br />
	            <button type="submit" name="submit" class="button btn btn-primary btn-resetpwd">
	         	<?php _e('Reset password!', 'aaikadomain' ); ?>
	         </button>
	         </div>
	      </section>
	   </fieldset>
	   <footer>
	      <div class="fright">
	         
	         <p><?php _e('Back to login', 'aaikadomain' ); ?> <a href="<?php echo site_url(); ?>'?action=login">Login</a></p> 
	         <br />
	         <p class="status"></p>
	      </div>
	   </footer>
	   <input type="hidden" name="action" value="devn_user_forgot" />
	   <?php wp_nonce_field( 'ajax-forgotpw-nonce', 'security_fgpw' ); ?>
	   <?php }//End of if logged-in  ?>
	</form>
</div>
<div class="clearfix margin_top8"></div>
<?php get_footer(); ?>