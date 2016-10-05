<?php
/**
 * Main class
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'DEVN_FILTER' ) ) {

    class DEVN_FILTER {

        public $obj = null;

        /**
         * Constructor
         *
         * @return mixed|DEVN_FILTER_Admin|DEVN_FILTER_Frontend
         */
        public function __construct() {

            // actions
            add_action( 'init', array( $this, 'init' ) );
            add_action( 'widgets_init', array( $this, 'registerWidgets' ) );


            if ( is_admin() ) {
                $this->obj = new DEVN_FILTER_Admin();
            }
            else {
                $this->obj = new DEVN_FILTER_Frontend();
            }

            return $this->obj;
        }


        /**
         * Init method
         *
         * @access public
         */
        public function init() {
		
        }

        /**
         * Load and register widgets
         *
         * @access public
         */
        public function registerWidgets() {
            register_widget( 'DEVN_FILTER_Widget' );
            register_widget( 'DEVN_RESET_FILTER_Widget' );
        }

    }
}