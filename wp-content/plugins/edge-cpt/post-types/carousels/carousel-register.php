<?php
namespace EdgeCore\PostTypes\Carousels;

use EdgeCore\Lib;

/**
 * Class CarouselRegister
 * @package EdgeCore\PostTypes\Carousels
 */
class CarouselRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    /**
     * @var string
     */
    private $taxBase;

    public function __construct() {
        $this->base = 'carousels';
        $this->taxBase = 'carousels_category';
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $fair_edge_Framework;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';
        if(edgt_core_theme_installed()) {
            $menuPosition = $fair_edge_Framework->getSkin()->getMenuItemPosition('carousel');
            $menuIcon = $fair_edge_Framework->getSkin()->getMenuIcon('carousel');
        }

        register_post_type($this->base,
            array(
                'labels'    => array(
                    'name'			=> esc_html__( 'Edge Carousel', 'edge-cpt' ),
                    'menu_name'		=> esc_html__( 'Edge Carousel', 'edge-cpt' ),
                    'all_items'		=> esc_html__( 'Carousel Items', 'edge-cpt' ),
                    'add_new'		=> esc_html__( 'Add New Carousel Item', 'edge-cpt' ),
                    'singular_name'	=> esc_html__( 'Carousel Item', 'edge-cpt' ),
                    'add_item'		=> esc_html__( 'New Carousel Item', 'edge-cpt' ),
                    'add_new_item'	=> esc_html__( 'Add New Carousel Item', 'edge-cpt' ),
                    'edit_item'		=> esc_html__( 'Edit Carousel Item', 'edge-cpt' )
                ),
                'public' 		=>  false,
                'show_in_menu'	=>  true,
                'rewrite'		=>  array('slug' => 'carousels'),
                'menu_position'	=>  $menuPosition,
                'show_ui'		=>  true,
                'has_archive'	=>  false,
                'hierarchical'	=>  false,
                'supports'		=>  array('title'),
                'menu_icon'		=>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'				=> esc_html__( 'Carousels', 'edge-cpt' ),
            'singular_name'		=> esc_html__( 'Carousel', 'edge-cpt' ),
            'search_items'		=> esc_html__( 'Search Carousels', 'edge-cpt' ),
            'all_items'			=> esc_html__( 'All Carousels', 'edge-cpt' ),
            'parent_item'		=> esc_html__( 'Parent Carousel', 'edge-cpt' ),
            'parent_item_colon' => esc_html__( 'Parent Carousel:', 'edge-cpt' ),
            'edit_item'			=> esc_html__( 'Edit Carousel', 'edge-cpt' ),
            'update_item'		=> esc_html__( 'Update Carousel', 'edge-cpt' ),
            'add_new_item'		=> esc_html__( 'Add New Carousel', 'edge-cpt' ),
            'new_item_name'		=> esc_html__( 'New Carousel Name', 'edge-cpt' ),
            'menu_name'			=> esc_html__( 'Carousels', 'edge-cpt' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'		=> true,
            'labels'			=> $labels,
            'show_ui'			=> true,
            'query_var'			=> true,
            'show_admin_column' => true,
            'rewrite'			=> array( 'slug' => 'carousels-category' ),
        ));
    }

}