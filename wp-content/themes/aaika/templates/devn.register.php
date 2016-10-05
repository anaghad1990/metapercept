<?php
/**
 * (c) www.devn-theme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $more, $devn;

get_header( 'header-3' );

?>
<div class="container-fluid breadcrumbs page_title2" id="breadcrumb">
    <div class="container">
        <div class="col-md-12">
            <div class="title">
                <h1><?php _e('Register', 'aaikadomain' ); ?></h1>
			</div>
			<div class="pagenation">
				<div class="breadcrumbs"><a href="<?php echo SITE_URL; ?>"><?php _e('Home', 'aaikadomain' ); ?></a> / <?php _e('Register', 'aaikadomain' ); ?></div>
			</div>
        </div>
    </div>
</div>
<div id="primary" class="site-content">
	<div id="content" class="container">
		<div class="entry-content blog_postcontent">
			<div class="margin_top5"></div>
			<?php
				
			if( is_user_logged_in() ){
				echo '<header class="aligncenter">'.__( 'You are logged in', 'aaikadomain' ).'</header>';
			}else{
			
			$devn_user = new devn_user();
			$countries = $devn_user->get_countries();
			
			?>
			
			<div class="reg_form clearfix" id="devn-form-user">
			   <form id="devn-form" class="devn-form" novalidate="novalidate" onsubmit="return false;">
			      <header><?php _e( 'Registration form', 'aaikadomain' ); ?></header>
			      <fieldset>
			         <section>
			            <label class="input">
			            	<i class="fa fa-user"></i>
			            	<input type="text" name="user_login" placeholder="<?php _e('Username', 'aaikadomain' ); ?> *">
			            	<b class="tooltip tooltip-bottom-right"><?php _e('Needed to enter the website', 'aaikadomain' ); ?></b>
			            </label>
			            <br/>
			         </section>
			         <section>
			            <label class="input">
			            	<i class="fa fa-envelope"></i>
			            	<input type="user_email" name="user_email" placeholder="<?php _e('Email', 'aaikadomain' ); ?> *">
			            	<b class="tooltip tooltip-bottom-right"><?php _e('Needed to verify your account', 'aaikadomain' ); ?></b>
			            </label>
			            <br />
			         </section>
			         <section>
			            <label class="input">
			            	<i class="fa fa-lock"></i>
			            	<input type="password" name="password" placeholder="<?php _e('Password', 'aaikadomain' ); ?> *" id="password">
			            	<b class="tooltip tooltip-bottom-right"><?php _e('Do not forget your password', 'aaikadomain' ); ?></b>
			            </label>
			            <br />
			         </section>
			         <section>
			            <label class="input">
			            	<i class="fa fa-lock"></i>
			            	<input type="password" name="passwordConfirm" placeholder="<?php _e('Confirm Password', 'aaikadomain' ); ?> *">
			            	<b class="tooltip tooltip-bottom-right"><?php _e('Do not forget your password', 'aaikadomain' ); ?></b>
			            </label>
			            <br />
			         </section>
			      </fieldset>
			      <fieldset>
			         <div class="row">
			            <section class="col col-3">
				            <label class="select">
				               <i class="fa  fa-pied-piper-alt"></i>
				               <select name="sex">
				                  <option value="0" selected="" disabled=""><?php _e('Gender', 'aaikadomain' ); ?></option>
				                  <option value="1"><?php _e('Male', 'aaikadomain' ); ?></option>
				                  <option value="2"><?php _e('Female', 'aaikadomain' ); ?></option>
				                  <option value="3"><?php _e('Other', 'aaikadomain' ); ?></option>
				               </select>
				               <i></i>
				            </label>
			         	</section>
			         	<section class="col col-3">
				         	<label class="select">
				         		<i class="fa fa-calendar"></i>
								<select name="bd_day">
									<option value="0"><?php _e('Day', 'aaikadomain' ); ?></option>
									<?php 
										for($i=1;$i<=31;$i++){
											echo "<option value='$i'>$i</option>";
										}
									?>						
								</select>
							</label>
						</section>	
						<section class="col col-3">
				         	<label class="select">
				         		<i class="fa fa-calendar"></i>
								<select name="bd_month">
									<option value="0"><?php _e('Month', 'aaikadomain' ); ?></option>
									<?php 
										for($m=1;$m<=12;$m++){
											$dateObj   = DateTime::createFromFormat('!m', $m);
											$monthName = $dateObj->format('F'); // March
											echo "<option value='$m'>$monthName</option>";
										}
									?>							
								</select>
							</label>
						</section>
						<section class="col col-3">
				         	<label class="select">
				         		<i class="fa fa-calendar"></i>
								<select name="bd_year">
									<option value="0"><?php _e('Year', 'aaikadomain' ); ?></option>
									<?php 
										for($i=2001;$i>=1980;$i--){
											echo "<option value='$i'>$i</option>";
										}
									?>							
								</select>
							</label>
						</section>		
			         </div>
			         <br />
			         <div class="row">
			         	<section class="col col-6">
				         	<label class="input">
				         		<i class="fa fa-map-marker"></i>
								<input type="text" name="city" placeholder="<?php _e('City', 'aaikadomain' ); ?>" value="" />
							</label>
						</section>
						<section class="col col-6">
				         	<label class="select">
				         		<i class="fa fa-map-marker"></i>
								<select name="country">
									<option value="0"><?php _e('- Select Country -', 'aaikadomain' ); ?></option>
									<?php
										foreach($countries as $code => $country_name){
											echo "<option value='$code'>$country_name</option>";
										}
									?>
								</select>
							</label>
						</section>
			         </div>
			         <br />
			         <div class="row">
				         <section>
					         <label class="input">
					         	<i class="fa fa-map-marker"></i>
							 	<input type="text" name="address" placeholder="<?php _e('Address', 'aaikadomain' ); ?>" id="password">
							 </label>
				         </section>
				         <br />
				         <section>
					         <label class="check">
							 	<input type="checkbox" name="agree" value="1" checked="checked">
								<?php _e('I agree the User Agreement and', 'aaikadomain' ); ?>
								<a href="#" class="colored"><?php _e('Terms &amp; Condition', 'aaikadomain' ); ?>.</a>
							 </label>
				         </section>
			         </div>				
			      </fieldset>
			      <footer>
			      	 <p class="status"></p>
			         <button type="submit" class="button btn btn-primary btn-register"><?php _e('Register Now!', 'aaikadomain' ); ?></button>
			         <br />
			         <?php _e('Already Registered?', 'aaikadomain' ); ?>
			          &nbsp;
			          <a href="<?php echo site_url(); ?>?action=login" class="colored"><?php _e('Log In', 'aaikadomain' ); ?>.</a>
			         <input type="hidden" name="action" value="devn_user_register" />
					 <?php wp_nonce_field( 'ajax-register-nonce', 'security_reg' ); ?>
			         <br />
			      </footer>
			      <p></p>
			   </form>
			   <p></p>
			</div>

			<?php } ?>	
			<div class="margin_top8"></div>
		</div>
	</div>
</div>



<?php get_footer(); ?>   