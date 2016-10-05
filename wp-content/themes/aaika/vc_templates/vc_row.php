<?php

$output = $devn_id = $devn_bg_image = $devn_bg_repeat = $devn_class = $devn_no_mb = $devn_class_container = $devn_row_type = '';
extract(shortcode_atts(array(
    'devn_id'        		=> '',
    'bg_image'       	=> '',
    'devn_bg_repeat'      => '',
    'bg_color' 			=> '',
    'devn_padding_top'    => '',
    'devn_padding_bottom' => '',
    'devn_class'   		=> '',
    'devn_class_container'   => '',
    'devn_no_mb'  		=> '',
    'devn_row_type'       => ''
), $atts));

wp_enqueue_script( 'wpb_composer_front_js' );


$devn_class = $this->getExtraClass($devn_class);

	$style = '';
    // BG Image
    $has_image = false;
    if((int)$bg_image > 0 && ($image_url = wp_get_attachment_url( $bg_image, 'large' )) !== false) {
        $has_image = true;
        $style .= "background-image: url(".$image_url.");";
    }
    if(!empty($devn_bg_repeat) && $has_image) {
        if($devn_bg_repeat === 'no-repeat') {
        } elseif($devn_bg_repeat === 'repeat-x') {
            $style .= "background-repeat:repeat-x;";
        } elseif($devn_bg_repeat === 'repeat-y') {
            $style .= 'background-repeat: repeat-y;';
        } elseif($devn_bg_repeat === 'repeat') {
            $style .= 'background-repeat: repeat;';
        }
    }

    // Padding
    $padding = '';
    if(!empty($devn_padding_top)) {
        $padding .= 'padding-top: '.$devn_padding_top.'px;';
    }
    if(!empty($devn_padding_bottom)) {
        $padding .= 'padding-bottom: '.$devn_padding_bottom.'px;';
    }

if ($devn_id=='') {
    $devn_id_rand = rand(100000,900000);
    $devn_id = 'devn-'.$devn_id_rand;
}

$css_class =  apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,
							 'wpb_row '.get_row_css_class().$devn_class.' '.
							 $devn_no_mb . ($devn_row_type!='container'?' '.$devn_row_type:''), $this->settings['base']);
							 
$output .= '<div id="'.$devn_id.'" class="'.$css_class.'" style="'.$style.'">';

	$output .= '<div class="'.($devn_row_type!='container_full'?'container':'').' '.$devn_class_container.'" style="'.$padding.'">';
		   $output .= wpb_js_remove_wpautop($content);
	$output .= '<div class="clear"></div></div>';

$output .= '</div>'.$this->endBlockComment('row');

echo $output;