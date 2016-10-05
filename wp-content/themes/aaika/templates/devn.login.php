<?php
/**
 * (c) king-theme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $post, $more, $devn;

get_header('header-3');

?>
<div class="container-fluid breadcrumbs page_title2" id="breadcrumb">
    <div class="container">
        <div class="col-md-12">
            <div class="title">
                <h1><?php _e('Login', 'aaikadomain' ); ?></h1>
			</div>
			<div class="pagenation">
				<div class="breadcrumbs"><a href="<?php echo SITE_URL; ?>"><?php _e('Home', 'aaikadomain' ); ?></a> / <?php _e('Login', 'aaikadomain' ); ?></div>
			</div>
        </div>
    </div>
</div>
<div class="clearfix margin_top2"></div>
<div class="login_form clearfix" id="devn-form-user">        
	<form id="devn-form" method="post" name="loginform" action="" class="devn-form" onsubmit="return false;" novalidate="novalidate">
		<?php
		
		if( is_user_logged_in() ){
			echo '<header class="aligncenter">'.__( 'You are logged in', 'aaikadomain' ).'</header>';
		}else{
	   
	   ?>
	   <header><?php _e('Account Login', 'aaikadomain' ); ?></header>
	   <fieldset>
	      <section>
	         <div class="row">
	            <label class="label col col-4"> <?php _e('Username', 'aaikadomain' ); ?></label>
	            <div class="col col-8"><label class="input"><i class="fa fa-user"></i>
	            <input type="text" name="log" placeholder="<?php _e('Username or Email', 'aaikadomain' ); ?>"></label></div>
	            <p></p>
	         </div>
	      </section>
	      <section>
	         <div class="row">
	            <label class="label col col-4"> <?php _e('Password', 'aaikadomain' ); ?></label>
	            <div class="col col-8">
	               <label class="input"><i class="fa fa-lock"></i><input type="password" name="pwd"></label>
	               <p></p>
	               <br />
	            </div>	         
	          </div>
	         <div class="row">
	            <div class="col col-12">
	            	<label class="check">
	            		<input type="checkbox" name="remember" checked="">
						<i></i>
						<?php _e('Remember Me', 'aaikadomain' ); ?>
					</label>
	            </div>
	         </div>
	      </section>
	   </fieldset>
	   <footer>
	      <div class="fright">
	      	 <a class="colored" href="<?php echo site_url() ?>?action=register">
	         	 <?php _e('Register new Account!', 'aaikadomain' ); ?>
	         </a>
	         |
	      	 <a class="colored" href="<?php echo site_url() ?>?action=register">
	         	 <?php _e('Forgot Password?', 'aaikadomain' ); ?>
	         </a>
	         <button type="submit" name="submit" class="button btn btn-primary btn-login">
	         	<?php _e('Login Now!', 'aaikadomain' ); ?>
	         </button>
	         <br />
	         <p class="status"></p>
	      </div>
	   </footer>
	   <input type="hidden" name="action" value="devn_user_login" />
	   <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
	   <?php }//End of if logged-in  ?>
	</form>
</div>
<div class="clearfix margin_top8"></div>
<?php get_footer(); ?> 