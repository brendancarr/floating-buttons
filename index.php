<?php 
/*
Plugin Name: Floating Buttons
Plugin URI: https://infinus.ca
Description: Display Floating Buttons on your WordPress front-end. Based on work by Faraz Quazi.
Version: 1.0.0
Author: Infinus
Author URI: https://infinus.ca
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: floating-buttons
*/

define( 'FBS_PLUGIN_URL', plugin_dir_url(__FILE__) );
define( 'FBS_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'FBS_DEFAULT_IMG', FBS_PLUGIN_URL.'assets/img/default.png' );
define( 'FBS_COLOR', '#FFFFFF' );
define( 'FBS_BG_COLOR', '#1E73BE' );
define( 'FBS_LINK', '' );
define( 'FBS_TEXT', '' );
define( 'FBS_TYPE', '' );

register_activation_hook(__FILE__, function(){
	/* Silence is Golden */
});

register_deactivation_hook(__FILE__, function(){
	/* Silence is Golden */
});

add_action( 'init', function(){
   	ob_start();
});

add_action( 'wp_enqueue_scripts', function(){
	$fbs_btns = get_option( 'fbs_buttons', json_encode(array()) );
	
			if(is_array( $fbs_btns) && count( $fbs_btns ) > 0):
				$number = 0;
				foreach( $fbs_btns as $fbs_btn ):
					$number++;
					$fbs_btn = fbs_parse_content( $fbs_btn );
					list( $active, $position, $type, $text, $link, $img_id, $color, $bg_color, $visibility ) = explode( '|', $fbs_btn ); 
						
						if( $type == '0' ){
							//do nothing
						}elseif( $type == '1' ){
							$url = FBS_PLUGIN_URL.'assets/home-conditional-script.js';
							wp_register_script( 'fbs-home-conditional-script', $url, array( 'jquery' ) );
							wp_enqueue_script( 'fbs-home-conditional-script' );
						}elseif( $type == '2' ){
							$url = FBS_PLUGIN_URL.'assets/home-conditional-style.css';
							wp_register_style( 'fbs-home-conditional-style', $url );
							wp_enqueue_style( 'fbs-home-conditional-style' );
						}
						
						$url = FBS_PLUGIN_URL.'assets/home-script.js';
						wp_register_script( 'fbs-home-script', $url, array( 'jquery' ) );
						wp_enqueue_script( 'fbs-home-script' );
						
						$url = FBS_PLUGIN_URL.'assets/style.css';
						wp_register_style( 'fbs-home-style', $url );
						wp_enqueue_style( 'fbs-home-style' );
						
						wp_register_script( 'fbs-cookies', 'https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js', array( 'jquery' ) );
						wp_enqueue_script( 'fbs-cookies' );

						load_template(FBS_PLUGIN_PATH.'views/fbs-button.php' );
					
				endforeach;
			endif; 
	
}); 

add_action( 'admin_enqueue_scripts', function(){
	wp_enqueue_media();

    wp_enqueue_style( 'wp-color-picker' );

	$url = FBS_PLUGIN_URL.'assets/admin-style.css';
	wp_register_style( 'fbs-admin-style', $url );
	wp_enqueue_style( 'fbs-admin-style' );

	$url = FBS_PLUGIN_URL.'assets/admin-script.js';
	wp_register_script( 'fbs-admin-script', $url, array( 'jquery', 'wp-color-picker' ) );
	wp_enqueue_script( 'fbs-admin-script' );
}); 

add_action( 'admin_menu', function(){
	add_menu_page(
		'Floating Buttons',
		'Floating Buttons',
		'manage_options',
		'fbs-button-frontend-settings',
		'fbs_button_frontend_settings',
		'dashicons-screenoptions',
		75
	);
});

function fbs_button_frontend_settings(){
	load_template( FBS_PLUGIN_PATH.'views/settings.php' );
}

add_action( 'wp_ajax_fbs_settings_save', function(){
	
	if(!current_user_can( 'manage_options' ) ){
		echo FALSE;
		exit();
	}
	
	if(!isset( $_REQUEST['_wpnonce']) || !wp_verify_nonce( $_REQUEST['_wpnonce'], 'fbs_settings_save' ) ){
	    echo FALSE;
	    exit();
	}

	update_option( 'fbs_buttons', fbs_sanitize_array( $_POST['buttons']), TRUE);
    update_option( 'fbs_sub_btns', fbs_sanitize_array( $_POST['sub_buttons']), TRUE);

	echo TRUE;
	exit();
}, 10);

function fbs_sanitize_array( $input ){
	$new_input = array();
	foreach( $input as $key => $value){
		$new_input[ $key ] = sanitize_text_field( $value );
	}
	return $new_input;
}

function fbs_parse_content( $str='' ){
	$str = str_replace( '\"', '"', $str );
	$str = str_replace( "\`", "`", $str );
	return $str;
}

/* End of Plugin File */
?>