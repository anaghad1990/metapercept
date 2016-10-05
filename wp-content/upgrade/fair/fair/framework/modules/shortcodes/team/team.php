<?php
namespace FairEdge\Modules\Shortcodes\Team;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Team
 */
class Team implements ShortcodeInterface
{
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_team';

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
	public function vcMap()	{

		$team_social_icons_array = array();
		for ($x = 1; $x<6; $x++) {
			$teamIconCollections = fair_edge_icon_collections()->getCollectionsWithSocialIcons();
			foreach($teamIconCollections as $collection_key => $collection) {

				$team_social_icons_array[] = array(
					'type' => 'dropdown',
					'heading' => 'Social Icon '.$x,
					'param_name' => 'team_social_'.$collection->param.'_'.$x,
					'value' => $collection->getSocialIconsArrayVC(),
					'dependency' => Array('element' => 'team_social_icon_pack', 'value' => array($collection_key))
				);

			}

			$team_social_icons_array[] = array(
				'type' => 'textfield',
				'heading' => 'Social Icon '.$x.' Link',
				'param_name' => 'team_social_icon_'.$x.'_link',
				'dependency' => array('element' => 'team_social_icon_pack', 'value' => fair_edge_icon_collections()->getIconCollectionsKeys())
			);

			$team_social_icons_array[] = array(
				'type' => 'dropdown',
				'heading' => 'Social Icon '.$x.' Target',
				'param_name' => 'team_social_icon_'.$x.'_target',
				'value' => array(
					'' => '',
					'Self' => '_self',
					'Blank' => '_blank'
				),
				'dependency' => Array('element' => 'team_social_icon_'.$x.'_link', 'not_empty' => true)
			);

		}

		vc_map( array(
			'name' => esc_html__('Team', 'fair'),
			'base' => $this->base,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-team extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Type',
						'param_name' => 'team_type',
						'value' => array(
							'Main Info Below Image'  => 'main-info-below-image',
							'Main Info on Hover'     => 'main-info-on-hover'
						),
						'save_always' => true
						
					),
					array(
						'type' => 'attach_image',
						'heading' => 'Image',
						'param_name' => 'team_image'
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Image Hover',
						'param_name' => 'image_hover',
						'value' => array(
							'No hover'     => 'no-hover',
							'Gradient'     => 'gradient'							
						),
						'save_always' => true,
						'dependency' => array('element' => 'image_rounded', 'value' => array('yes'))
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Gradient First Color',
						'param_name' => 'gradient_1_color',
						'dependency' => array('element' => 'image_hover', 'value' => array('gradient'))
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Gradient Second Color',
						'param_name' => 'gradient_2_color',
						'dependency' => array('element' => 'image_hover', 'value' => array('gradient'))
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Image Rounded',
						'param_name' => 'image_rounded',
						'value' => array(
							'Yes'   => 'yes',
							'No'   => 'no'							
						),
						'save_always' => true,
						'dependency' => array('element' => 'team_type', 'value' => array('main-info-below-image'))
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Image margin',
						'param_name' => 'image_margin',
						'dependency' => array('element' => 'team_type', 'value' => array('main-info-below-image')),
						'description' => 'Please insert margin in format 0px 10px 0px 10px'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Name',
						'admin_label' => true,
						'param_name' => 'team_name'
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Name Tag',
						'param_name' => 'team_name_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'dependency' => array('element' => 'team_name', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Position',
						'admin_label' => true,
						'param_name' => 'team_position'
					),
					array(
						'type' => 'textarea',
						'heading' => 'Description',
						'admin_label' => true,
						'param_name' => 'team_description'
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Social Icon Pack',
						'param_name' => 'team_social_icon_pack',
						'admin_label' => true,
						'value' => array_merge(array('' => ''),fair_edge_icon_collections()->getIconCollectionsVCExclude(array('linea_icons'))),
						'save_always' => true
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Social Icons Type',
						'param_name' => 'team_social_icon_type',
						'value' => array(
							'Normal' => 'normal',
							'Circle' => 'circle',
							'Square' => 'square'
						),
						'save_always' => true,
						'dependency' => array('element' => 'team_social_icon_pack', 'value' => fair_edge_icon_collections()->getIconCollectionsKeys())
					),
				),
				$team_social_icons_array
			)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null)
	{

		$args = array(
			'team_image' => '',
			'team_type' => 'main-info-on-hover',
			'team_name' => '',
			'team_name_tag' => 'h4',
			'team_position' => '',
			'team_description' => '',
			'team_social_icon_pack' => '',
			'team_social_icon_type' => 'normal_social',
			'image_hover' => 'image_hover',
			'gradient_1_color' => '',
			'gradient_2_color' => '',
			'image_rounded' => 'yes',
			'image_margin' => ''

		);

		$team_social_icons_form_fields = array();
		$number_of_social_icons = 5;

		for ($x = 1; $x <= $number_of_social_icons; $x++) {

			foreach (fair_edge_icon_collections()->iconCollections as $collection_key => $collection) {
				$team_social_icons_form_fields['team_social_' . $collection->param . '_' . $x] = '';
			}

			$team_social_icons_form_fields['team_social_icon_'.$x.'_link'] = '';
			$team_social_icons_form_fields['team_social_icon_'.$x.'_target'] = '';

		}

		$args = array_merge($args, $team_social_icons_form_fields);

		$params = shortcode_atts($args, $atts);

		$params['number_of_social_icons'] = 5;
		$params['team_name_tag'] = $this->getTeamNameTag($params, $args);
		$params['team_social_icons'] = $this->getTeamSocialIcons($params);
		$params['team_classes'] = $this->getTeamClasses($params);
		$params['background_hover_style'] = $this->getBackgroundHoverStyle($params);
		$params['image_below_style'] = $this->getImageBelowStyle($params);

		//Get HTML from template based on type of team
		$html = fair_edge_get_shortcode_module_template_part('templates/' . $params['team_type'], 'team', '', $params);

		return $html;

	}

	/**
	 * Return correct heading value. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return mixed
	 */
	private function getTeamNameTag($params, $args) {

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['team_name_tag'], $headings_array)) ? $params['team_name_tag'] : $args['team_name_tag'];

	}

	private function getTeamSocialIcons($params) {

		extract($params);
		$social_icons = array();

		if ($team_social_icon_pack !== '') {

			$icon_pack = fair_edge_icon_collections()->getIconCollection($team_social_icon_pack);
			$team_social_icon_type_label = 'team_social_' . $icon_pack->param;
			$team_social_icon_param_label = $icon_pack->param;

			for ( $i = 1; $i <= $number_of_social_icons; $i++ ) {

				$team_social_icon = ${$team_social_icon_type_label . '_' . $i};
				$team_social_link = ${'team_social_icon_' . $i . '_link'};
				$team_social_target = ${'team_social_icon_' . $i . '_target'};

				if ($team_social_icon !== '') {

					$team_icon_params = array();
					$team_icon_params['icon_pack'] = $team_social_icon_pack;
					$team_icon_params[$team_social_icon_param_label] =   $team_social_icon;
					$team_icon_params['link'] = ($team_social_link !== '') ? $team_social_link : '';
					$team_icon_params['target'] = ($team_social_target !== '') ? $team_social_target : '';
					$team_icon_params['type'] = ($team_social_icon_type !== '') ? $team_social_icon_type : '';

					$social_icons[] = fair_edge_execute_shortcode('edgtf_icon', $team_icon_params);
				}

			}

		}

		return $social_icons;

	}


	/**
	 * Return Classes for Team shorcode image rounded
	 *
	 * @param $params
	 * @return string
	 */
	private function getTeamClasses($params) {
		$team_classes = array();
		$team_classes[] = 'edgtf-team';

		if ($params['team_type'] !== ''){
			$team_classes[] = $params['team_type'];
		}

		if ($params['image_rounded'] == 'yes' && $params['team_type'] != 'main-info-on-hover'){
			$team_classes[] = 'edgtf-image-rounded';
		}
		
		return implode(' ', $team_classes);
	}

	/**
	 * Return CSS styles for Team shortcode
	 *
	 * @param $params
	 * @return string
	 */
	private function getImageBelowStyle($params) {
		$image_rounded_style = array();

		if ($params['image_margin'] != '') {
			$image_rounded_style[] = 'margin: ' . $params['image_margin'] . ';';
		}

		return implode(';', $image_rounded_style);
	}

	/**
	* Function that returns background hover style
	*/

	private function getBackgroundHoverStyle($params){
		$background_hover_style = '';
		$first_color = $params['gradient_1_color'];
		$second_color = $params['gradient_2_color'];

		if ($first_color !== '' && $second_color !== ''){
			$background_hover_style .= fair_edge_inline_background_gradient($first_color, $second_color);
		}

		return $background_hover_style;
	}

}

