<?php
/**
 * Plugin Name: Webdevia AJAX Load Post
 * Plugin URI: http://www.themeforest.net/user/Mymoun
 * Description: Load the content of posts with AJAX.
 * Version: 0.1
 * Author: Mymoun
 * Author URI: http://www.themeforest.net/user/Mymoun 
 * License: GPL2 based on (http://www.problogdesign.com)
 */
 
 function wd_alp_init() {
 	global $wp_query;
 
 		wp_enqueue_script(
 			'wd-alp-load',
 			plugin_dir_url( __FILE__ ) . 'js/load-posts.js',
 			array('jquery'),
 			'1.0',
 			true
 		);
 }
 add_action('template_redirect', 'wd_alp_init');
 
 ?>