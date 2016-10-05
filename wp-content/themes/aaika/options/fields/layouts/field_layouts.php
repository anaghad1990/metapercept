<?php
class devn_options_layouts extends devn_options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since devn_options 1.0
	*/
	function __construct($field = array(), $value ='', $parent){
		
		//$this->render();
		
	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since devn_options 1.0
	*/
	function render(){
		
					
	}//function
	
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since devn_options 1.0
	*/
	function enqueue(){
		wp_enqueue_style('nhp-opts-jquery-ui-css');
		wp_enqueue_script(
			'nhp-opts-field-date-js', 
			devn_options_URL.'fields/date/field_date.js', 
			array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'),
			time(),
			true
		);
		
	}//function
	
}//class
?>