<?php
namespace FairEdge\Modules\Shortcodes\ShopMasonry;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class ShopMasonry implements ShortcodeInterface
{
    private $base;

    public function __construct()
    {
        $this->base = 'edgtf_shop_masonry';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        vc_map(array(
            'name' => 'Shop Masonry',
            'base' => $this->base,
            'icon' => 'icon-wpb-shop-masonry extended-custom-icon',
            'category' => 'by EDGE',
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => 'Order by',
                    'param_name' => 'orderby',
                    'value' => array(
                        'Date' => 'date',
                        'Title' => 'title',
                    ),
                    'std' => 'title',
                    'save_always' => true,
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Sort order',
                    'param_name' => 'order',
                    'value' => array(
                        'Descending' => 'DESC',
                        'Ascending' => 'ASC',
                    ),
                    'save_always' => true,
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Category',
                    'param_name' => 'category',
                    'value' => '',
                    'description' => 'Category Slug (leave empty for all)'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Show Category Filter',
                    'param_name' => 'filter',
                    'value' => array(
                        'No' => 'no',
                        'Yes' => 'yes',
                    ),
                    'save_always' => true,
                )
            )
        ));
    }

    public function render($atts, $content = null)
    {

        $params = shortcode_atts(array(
            'orderby' => 'date',
            'category' => '',
            'order' => 'DESC',
            'filter' => 'no',
        ), $atts);


        extract($params);

        $query_args = $this->getQueryArgs($params);

        $products = new \WP_Query($query_args, $atts);
        $columns  = 4;

        $html = '';

        $html  .= '<div class="woocommerce edgtf-shop-masonry columns-' . $columns .'">';

        if($filter == 'yes'){
            $params['filter_categories'] = $this->getFilterCategories($params);
            $html .= fair_edge_get_shortcode_module_template_part('templates/shop-filter','shop-masonry', '', $params);
        }

        if ( $products->have_posts() ) :

            do_action( "woocommerce_shortcode_before_products_loop" );

            $html .= '<div class="products edgtf-shop-list-masonry">';
            $html .= '<div class="edgtf-shop-list-masonry-grid-sizer"></div>';

            while ( $products->have_posts() ) : $products->the_post();

                $id = get_the_ID();
                $params['image_size_class'] = $this->getMasonrySize($id);
                $params['thumb_size'] = $this->getImageSize($id);
                $params['title_tag'] = $this->getTitleTag($id);
                $categories = $this->getItemCats($id);
                $params['cats'] = $categories['cats'];
                $params['cats_slug'] = $categories['cats_slug'];
                $params['out_stock_class'] = $this->getMasonryOutStockClass();
                $params['on_sale_class'] = $this->getMasonryOnSaleClass();
                $html .= fair_edge_get_shortcode_module_template_part('templates/shop-masonry-template','shop-masonry','',$params);

            endwhile; // end of the loop.

            $html .= '</div>';

            do_action( "woocommerce_shortcode_after_products_loop" );

        endif;

        woocommerce_reset_loop();
        wp_reset_postdata();

        $html .= '</div>';

        return $html;
    }

    /**
     * Gets product's categories based on $id
     *
     * @param $id
     * @return array
     */
    private function getItemCats($id){
        $terms = get_the_terms( $id, 'product_cat');
        $categories = array();
        $cats = '';
        $cats_slug = '';

		if($terms) {
			foreach ($terms as $term) {
				$cats .= 'product_cat-' . $term->term_id . ' ';
				$cats_slug .= '<span>'.$term->name . '</span>';
			}
		}

		$categories['cats'] = $cats;
		$categories['cats_slug'] = $cats_slug;
        return $categories;
    }


    /**
     * Gets all categories or child categories of a specific one
     *
     * @param $params
     * @return array|int|\WP_Error
     */
    private function getFilterCategories($params){

        $cat_id = 0;

        if(!empty($params['category'])){

            $top_category = get_term_by('slug', $params['category'], 'product_cat');
            if(isset($top_category->term_id)){
                $cat_id = $top_category->term_id;
            }

        }

        $args = array(
            'child_of' => $cat_id,
        );

        $filter_categories = get_terms('product_cat',$args);

        return $filter_categories;

    }


    /**
     * Creates an array of args for loop
     *
     * @param $params
     * @return array
     */
    private function getQueryArgs($params){

        $args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'orderby'             => $params['orderby'],
            'order'               => $params['order'],
            'posts_per_page'      => -1,
            'meta_query'          => WC()->query->get_meta_query()
        );

        if($params['category'] != ''){
            $args['product_cat'] = $params['category'];
        }

        return $args;
    }


    /**
     * Gets required class for masonry layout
     *
     * @param $id
     * @return string
     */
    private function getMasonrySize($id){
        $masonry_size_class = '';

        $masonry_size = get_post_meta($id, 'shop_masonry_dimensions',true);
        switch($masonry_size):
	        default:
	        case 'default' :
                $masonry_size_class = 'edgtf-default-masonry-item ';
                break;
            case 'large_width' :
                $masonry_size_class = 'edgtf-large-width-masonry-item ';
                break;
            case 'large_height' :
                $masonry_size_class = 'edgtf-large-height-masonry-item ';
                break;
            case 'large_width_height' :
                $masonry_size_class = 'edgtf-large-width-height-masonry-item ';
                break;
        endswitch;

        return $masonry_size_class;
    }

    /**
     * Gets hs for masonry layout based on type
     *
     * @param $id
     * @return string
     */
    private function getTitleTag($id){
        $title_tag = '';

        $masonry_size = get_post_meta($id, 'shop_masonry_dimensions',true);
        switch($masonry_size):
            case 'large_width_height' :
            case 'large_width' :
            case 'large_height' :
                $title_tag = 'h2';
                break;
	        case 'default' :
                $title_tag = 'h4';
                break;
            default:
                $title_tag = 'h4';
        endswitch;

        return $title_tag;
    }
    /**
     * Returns product class if product is out of stock
     *
     * @return string
     */
    private function getMasonryOutStockClass(){

        global $product;

        $masonry_out_stock_class = '';

        if (!$product->is_in_stock()) {
            $masonry_out_stock_class = "edgtf-out-of-stock";
        }

        return $masonry_out_stock_class;
    }

    /**
     * Returns product class if product is on sale
     *
     * @return string
     */
    private function getMasonryOnSaleClass(){

        global $product;

        $masonry_on_sale_class = '';

        if ( $product->is_on_sale() ) {
            $masonry_on_sale_class = "edgtf-on-sale";
        }

        return $masonry_on_sale_class;
    }


    /**
     * Gets required class for product thumb
     *
     * @param $id
     * @return string
     */
    private function getImageSize($id){

        $masonry_size = get_post_meta($id, 'shop_masonry_dimensions',true);

        switch($masonry_size):
	        default:
	        case 'default' :
                $thumb_size = 'fair_edge_square';
                break;
            case 'large_width' :
                $thumb_size = 'fair_edge_large_width';
                break;
            case 'large_height' :
                $thumb_size = 'fair_edge_large_height';
                break;
            case 'large_width_height' :
                $thumb_size = 'fair_edge_large_width_height';
                break;
        endswitch;

        return $thumb_size;
    }
}