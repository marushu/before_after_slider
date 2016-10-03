<?php
/**
 * Plugin Name:     Before After Slider
 * Plugin URI:      https://private.hibou-web.com
 * Description:     Before and after comparison built-in slider.
 * Author:          Hibou
 * Author URI:      https://private.hibou-web.com
 * Text Domain:     before-after-slider
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Before_After_Slider
 */

/**
 * Add Pinterest Pins and Boards :)
 */
function add_ba_slider_script() {

	wp_enqueue_script(
		'bfore-after-js',
		plugins_url( 'js/before-after.min.js' , __FILE__ ),
		array( 'jquery' ),
		'',
		true
	);

	wp_enqueue_script(
		'bxslider-js',
		plugins_url( 'js/bxslider.min.js' , __FILE__ ),
		array( 'jquery' ),
		'',
		true
	);

	wp_enqueue_script(
		'easing-js',
		plugins_url( 'js/easing.1.3.js' , __FILE__ ),
		array( 'jquery' ),
		'',
		true
	);

	wp_enqueue_script(
		'fitvids-js',
		plugins_url( 'js/fitvids.js' , __FILE__ ),
		array( 'jquery' ),
		'',
		true
	);

	wp_enqueue_style(
		'before-after-style',
		plugins_url( 'css/before-after.css' , __FILE__ ),
		'',
		''
	);

	wp_enqueue_style(
		'bxslider-style',
		plugins_url( 'css/jquery.bxslider.css' , __FILE__ ),
		'',
		''
	);

}
add_action( 'wp_enqueue_scripts', 'add_ba_slider_script' );