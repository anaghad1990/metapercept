<?php
namespace FairEdge\Modules\Shortcodes\ImageGallery;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class ImageGallery implements ShortcodeInterface{

	private $base;

	/**
	 * Image Gallery constructor.
	 */
	public function __construct() {
		$this->base = 'edgtf_image_gallery';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see edgt_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Image Gallery', 'fair'),
			'base'                      => $this->getBase(),
			'category'                  => 'by EDGE',
			'icon'                      => 'icon-wpb-image-gallery extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'			=> 'attach_images',
					'heading'		=> 'Images',
					'param_name'	=> 'images',
					'description'	=> 'Select images from media library'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Image Size',
					'param_name'	=> 'image_size',
					'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Gallery Type',
					'admin_label' => true,
					'param_name'  => 'type',
					'value'       => array(
						'Slider'		=> 'slider',
						'Carousel'		=> 'carousel',
						'Image Grid'	=> 'image_grid'
					),
					'description' => 'Select gallery type',
					'save_always' => true
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Number of columns',
					'param_name'	=> 'column_number_carousel',
					'value'			=> array(
						'4'			=> '4',
						'5'			=> '5'
					),
					'dependency'	=> array(
						'element'	=> 'type',
						'value'		=> array(
							'carousel'
						)
					),
					'description' => 'Select number of columns for image gallery',
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Slide duration',
					'admin_label'	=> true,
					'param_name'	=> 'autoplay',
					'value'			=> array(
						'3'			=> '3',
						'5'			=> '5',
						'10'		=> '10',
						'Disable'	=> 'disable'
					),
					'save_always'	=> true,
					'dependency'	=> array(
						'element'	=> 'type',
						'value'		=> array(
							'slider',
							'carousel'
						)
					),
					'description' => 'Auto rotate slides each X seconds',
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Column Number',
					'param_name'	=> 'column_number',
					'value'			=> array(2, 3, 4, 5),
					'save_always'	=> true,
					'dependency'	=> array(
						'element' 	=> 'type',
						'value'		=> array(
							'image_grid'
						)
					),
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Enable Shadow on every image',
					'param_name'	=> 'image_shadow',
					'value'			=> array(
						'No'		=> 'no',
						'Yes'		=> 'yes'
					),
					'dependency'	=> array(
						'element'	=> 'type',
						'value'		=> array(
							'carousel'
						)
					)
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Open PrettyPhoto on click',
					'param_name'	=> 'pretty_photo',
					'value'			=> array(
						'No'		=> 'no',
						'Yes'		=> 'yes'
					),
					'save_always'	=> true,
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Grayscale Images',
					'param_name' => 'grayscale',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
					'save_always'	=> true,
					'dependency'	=> array(
						'element'	=> 'type',
						'value'		=> array(
							'image_grid'
						)
					)
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Show Navigation Arrows',
					'param_name' 	=> 'navigation',
					'value' 		=> array(
						'Yes'		=> 'yes',
						'No'		=> 'no'
					),
					'dependency' 	=> array(
						'element' => 'type',
						'value' => array(
							'slider',
							'carousel'
						)
					),
					'save_always'	=> true
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Show Pagination',
					'param_name' 	=> 'pagination',
					'value' 		=> array(
						'Yes' 		=> 'yes',
						'No'		=> 'no'
					),
					'save_always'	=> true,
					'dependency'	=> array(
						'element' => 'type',
						'value' => array(
							'slider',
							'carousel'
						)
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Navigation skin',
					'param_name' => 'navigation_skin',
					'value' => array(
						'Dark' => 'dark',
						'Light' => 'light',
					),
					'dependency'	=> array(
						'element' => 'type',
						'value' => array(
							'slider',
							'carousel'
						)
					)
				)
			)
		));

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'images'				=> '',
			'image_size'			=> 'thumbnail',
			'type'					=> 'slider',
			'autoplay'				=> '5000',
			'image_shadow'			=> '',
			'pretty_photo'			=> '',
			'column_number'			=> '',
			'grayscale'				=> '',
			'navigation'			=> 'yes',
			'pagination'			=> 'yes',
			'column_number_carousel' => '4',
			'navigation_skin'        => 'dark'
		);

		$params = shortcode_atts($args, $atts);
		$params['carousel_classes'] = $this->getCarouselClasses($params);
		$params['slider_data'] = $this->getSliderData($params);
		$params['image_size'] = $this->getImageSize($params['image_size']);
		$params['images'] = $this->getGalleryImages($params);
		$params['pretty_photo'] = ($params['pretty_photo'] == 'yes') ? true : false;
		$params['columns'] = 'edgtf-gallery-columns-' . $params['column_number'];
		$params['gallery_classes'] = ($params['grayscale'] == 'yes') ? 'edgtf-grayscale' : '';

		if ($params['type'] == 'image_grid') {
			$template = 'gallery-grid';
		} elseif ($params['type'] == 'slider') {
			$template = 'gallery-slider';
		} elseif ($params['type'] == 'carousel') {
			$template = 'gallery-carousel';
		}

		$html = fair_edge_get_shortcode_module_template_part('templates/' . $template, 'imagegallery', '', $params);

		return $html;

	}

	/**
	 * Return images for gallery
	 *
	 * @param $params
	 * @return array
	 */
	private function getGalleryImages($params) {
		$image_ids = array();
		$images = array();
		$i = 0;

		if ($params['images'] !== '') {
			$image_ids = explode(',', $params['images']);
		}

		foreach ($image_ids as $id) {

			$image['image_id'] = $id;
			$image_original = wp_get_attachment_image_src($id, 'full');
			$image['url'] = $image_original[0];
			$image['title'] = get_the_title($id);

			$images[$i] = $image;
			$i++;
		}

		return $images;

	}

	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getImageSize($image_size) {

		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if(in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
			return $image_size;
		} elseif(!empty($matches[0])) {
			return array(
					$matches[0][0],
					$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}

	/**
	 * Return all configuration data for slider
	 *
	 * @param $params
	 * @return array
	 */
	private function getSliderData($params) {

		$slider_data = array();

		$slider_data['data-autoplay'] = ($params['autoplay'] !== '') ? $params['autoplay'] : '';
		$slider_data['data-navigation'] = ($params['navigation'] !== '') ? $params['navigation'] : '';
		$slider_data['data-pagination'] = ($params['pagination'] !== '') ? $params['pagination'] : '';
		$slider_data['data-column_number_carousel'] = ($params['column_number_carousel'] !== '') ? $params['column_number_carousel'] : '';

		return $slider_data;

	}

	/**
	 * Generates classes for carousel and slider
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getCarouselClasses($params){

		$carousel_classes = array();

		if($params['navigation_skin'] !== ''){
			$carousel_classes[] = 'edgtf-gallery-nav-'.$params['navigation_skin'];
		}

		if($params['image_shadow'] == 'yes'){
			$carousel_classes[] = 'edgtf-gallery-image-with-shadow';
		}

		return implode(' ', $carousel_classes);
	}

}