<?php
/**
 * Init class
 */

if ( !defined( 'DEVN_WISHLIST' ) ) { exit; } // Exit if accessed directly

if( !class_exists( 'DEVN_WISHLIST_INIT' ) ) {
   
    class DEVN_WISHLIST_INIT {
	
        private $_devn_wishlist_install, $options;
		
       
        public function __construct() {
			
            $this->_positions = apply_filters( 'devn_wishlist_positions', array(
                'after-cart' => array( 'hook' => 'woocommerce_single_product_summary', 'priority' => 31 ),
                'after-thumbnails' => array( 'hook' => 'woocommerce_product_thumbnails', 'priority' => 21 ),
                'after-summary'   => array( 'hook' => 'woocommerce_after_single_product_summary', 'priority' => 21 )
            ) );
            $this->_devn_wishlist_install = new DEVN_WISHLIST_INSTALL();
            
            if ( is_admin() && ! defined( 'DOING_AJAX' ) ) $this->install();
            
            add_action( 'init', array( $this, 'init' ), 0 );
            add_filter( 'woocommerce_page_settings', array( $this, 'add_page_setting_woocommerce' ) );
 
            if( devn_wishlist_actived() ) {
			
                add_action( 'wp_head', array( $this, 'add_button' ) );
                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_and_stuffs' ) );
                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
                    
                
                do_action( 'devn_wishlist_loaded' );
            }
        }
        
        public function init() {
        
            global $devn_wishlist;
            
            if( is_user_logged_in() ) {
                $devn_wishlist->details['user_id'] = get_current_user_id();
                
                //check whether any products are added to wishlist, then after login add to the wishlist if not added
                if( devn_usecookies() ) {
                    $cookie = devn_getcookie( 'devn_wishlist_products' );
                    foreach( $cookie as $details ) {
                        $devn_wishlist->details = $details;
                        $devn_wishlist->details['user_id'] = get_current_user_id();

                        $ret_val = $devn_wishlist->add();
                    }
                    
                    devn_destroycookie( 'devn_wishlist_products' );
                } else {
                    if( isset( $_SESSION['devn_wishlist_products'] ) ) {
                        foreach( $_SESSION['devn_wishlist_products'] as $details ) {
                            $devn_wishlist->details = $details;
                            $devn_wishlist->details['user_id'] = get_current_user_id();
    
                            $ret_val = $devn_wishlist->add();
                        }
                        
                        unset( $_SESSION['devn_wishlist_products'] );
                    }
                }
            }
            
           
        }
     
        /**
         * Installation
         */
        public function install() {
            if( !$this->_devn_wishlist_install->is_installed() ) {
                register_activation_hook( WISHLIST_DIR, array( $this->_devn_wishlist_install, 'init' ) );
                $this->_devn_wishlist_install->init();
                $this->_devn_wishlist_install->default_options( $this->options );
                
                
                do_action( 'devn_wishlist_installed' );
            }
        }
        
        /**
         * Add the "Add to Wishlist" button. Needed to use in wp_head hook.
         */
        public function add_button() {
            global $post, $devn;
            
            if( !isset( $post ) || !is_object( $post ) )
                { return; }
            
            // Add the link "Add to wishlist"
            $position = !empty($devn->cfg['wl_position'])?$devn->cfg['wl_position']:'use-shortcode';
            $position = empty( $position ) ? 'add-to-cart' : $position;
            
            if( $position != 'use-shortcode' )
            { 
                	add_action( $this->_positions[$position]['hook'], 
                				 create_function( '', 'echo do_shortcode( "[devn_add_to_wishlist]" );' ), 
                				 $this->_positions[$position]['priority'] 
                			  ); 
            }
        }
        
        /**
         * Enqueue styles, scripts and other stuffs needed in the <head>.
         */
        public function enqueue_styles_and_stuffs() {
            $located = locate_template( array(
                'woocommerce/wishlist.css',
                'wishlist.css'
            ) );
            
            if( !$located ) 
                { wp_enqueue_style( 'devn-wishlist-main', WISHLIST_URL . 'css/wishlist.css' ); }
            else
                { wp_enqueue_style( 'devn-wishlist-user-main', str_replace( get_template_directory(), get_template_directory_uri(), $located ) ); }
           
            
                
            ?>
           
            <script type="text/javascript">
            var devn_wishlist_ajax_web_url = '<?php echo admin_url('admin-ajax.php') ?>';
            var login_redirect_url= '<?php echo wp_login_url() . '?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] ) ?>';
            </script>
            <?php
        }
        
        /**
         * Enqueue scripts.
         */
        public function enqueue_scripts() {
            wp_register_script( 'devn-wishlist', WISHLIST_URL . 'js/devn-wishlist.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'devn-wishlist' );
            
            $devn_wishlist_outofstock = array(
                'out_of_stock' => __( 'Sorry! This product is Out of Stock.', 'aaikadomain' ),
            );
            wp_localize_script( 'jquery-devn-wishlist', 'devn_wishlist_outofstock', $devn_wishlist_outofstock );
        }
        
      
        /**
         * Add the select for the Wishlist page in WooCommerce > Settings > Pages
         */
        public function add_page_setting_woocommerce( $settings ) {
            unset( $settings[count( $settings ) - 1] );
            
            $settings[] = array(
                'name' => __( 'Wishlist Page', 'aaikadomain' ),
        		'desc' 		=> __( 'Page contents: [devn_wishlist]', 'aaikadomain' ),
        		'id' 		=> 'devn_wcwl_wishlist_page_id',
        		'type' 		=> 'single_select_page',
        		'std' 		=> '',         // for woocommerce < 2.0
        		'default' 	=> '',         // for woocommerce >= 2.0
        		'class'		=> 'chosen_select_nostd',
        		'css' 		=> 'min-width:300px;',
        		'desc_tip'	=>  false,
            );
            
            $settings[] = array( 'type' => 'sectionend', 'id' => 'page_options');
            
            return $settings;
        }
    }
}