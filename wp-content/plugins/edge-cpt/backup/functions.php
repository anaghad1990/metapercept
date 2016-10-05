<?php

if(!function_exists('edgt_core_themename_theme_menu_backup_options')) {
	/**
	 * Function that generates admin menu for options page.
	 * It generates one admin page per options page.
	 */
	function edgt_core_themename_theme_menu_backup_options() {
		if (edgt_core_theme_installed()) {

			global $fair_edge_Framework;
			$slug = "_backup_options";
			$page_hook_suffix = add_submenu_page(
				'fair_edge_theme_menu',
				'Edge Options - Backup Options',                   // The value used to populate the browser's title bar when the menu page is active
				'Backup Options',                   // The text of the menu in the administrator's sidebar
				'administrator',                  // What roles are able to access the menu
				'fair_edge_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
				array($fair_edge_Framework->getSkin(), 'renderBackupOptions')
			);
			add_action('admin_print_scripts-'.$page_hook_suffix, 'fair_edge_enqueue_admin_scripts');
			add_action('admin_print_styles-'.$page_hook_suffix, 'fair_edge_enqueue_admin_styles');

		}
	}

	add_action( 'admin_menu', 'edgt_core_themename_theme_menu_backup_options',99);
}

if(!function_exists('fair_edge_export_options')) {
	/**
	 * Function that saves theme options to db.
	 * It hooks to ajax wp_ajax_edgtf_save_options action.
	 */
	function fair_edge_export_options() {
		$options = get_option("edgt_options_fair");
		$output = base64_encode(serialize($options));

		return $output;
	}

}

if(!function_exists('fair_edge_import_theme_options')) {
	/**
	 * Function that import theme options to db.
	 * It hooks to ajax wp_ajax_fair_edge_import_theme_options action.
	 */
	function fair_edge_import_theme_options() {

		if(current_user_can('administrator')) {
			if (empty($_POST) || !isset($_POST)) {
				edge_cpt_ajax_status('error', esc_html__('Import field is empty', 'edge-cpt'));
			} else {
				$data = $_POST;
				if (wp_verify_nonce($data['nonce'], 'edgtf_import_theme_options_secret_value')) {
					$content = $data['content'];
					$unserialized_content = unserialize(base64_decode($content));
					update_option( 'edgt_options_fair', $unserialized_content);
					edge_cpt_ajax_status('success', esc_html__('Options are imported successfully', 'edge-cpt'));
				} else {
					edge_cpt_ajax_status('error', esc_html__('Non valid authorization', 'edge-cpt'));
				}

			}
		} else {
			edge_cpt_ajax_status('error', esc_html__('You don\'t have privileges for this operation', 'edge-cpt'));
		}
	}

	add_action('wp_ajax_fair_edge_import_theme_options', 'fair_edge_import_theme_options');
}

if( ! function_exists('edge_cpt_ajax_status') ) {

	/**
	 * Function that return status from ajax functions
	 *
	 */

	function edge_cpt_ajax_status($status, $message, $data = NULL) {

		$response = array (
			'status' => $status,
			'message' => $message,
			'data' => $data
		);

		$output = json_encode($response);

		exit($output);

	}

}