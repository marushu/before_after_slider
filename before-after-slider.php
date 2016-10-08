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
 * Add image size.
 */
add_image_size( 'thmb_1020_500', 1020, 500, true );
add_image_size( 'thumb_509_999', 509, 9999, true );

/**
 * Add Pinterest Pins and Boards :)
 */
function add_ba_slider_script() {

	wp_enqueue_script(
		'bxslider-js',
		plugins_url( 'js/jquery.bxslider.min.js' , __FILE__ ),
		array( 'jquery' ),
		'',
		true
	);

	wp_enqueue_script(
		'bfore-after-js',
		plugins_url( 'js/before-after.min.js' , __FILE__ ),
		array( 'jquery' ),
		'',
		true
	);

	wp_enqueue_script(
		'bfore-after-common-js',
		plugins_url( 'js/common.js' , __FILE__ ),
		array( 'jquery', 'bfore-after-js' ),
		date( 'TmdHis', filemtime( plugin_dir_path( __FILE__ ) . 'js/common.js' ) ),
		true
	);

	wp_enqueue_style(
		'bxslider-style',
		plugins_url( 'css/jquery.bxslider.css' , __FILE__ ),
		'',
		''
	);

	wp_enqueue_style(
		'common-style',
		plugins_url( 'css/common.css' , __FILE__ ),
		'',
		''
	);

}
add_action( 'wp_enqueue_scripts', 'add_ba_slider_script' );

/**
 * Add js file to admin panel.
 */
function add_to_admin_script() {

	wp_enqueue_script(
		'renovegga-works-script',
		plugins_url( '/js/admin_panel.js' , __FILE__ ),
		array('jquery', 'jquery-ui-sortable'),
		'',
		true
	);

	wp_enqueue_style(
		'admin-panel-style',
		plugins_url( 'css/ba_style.css' , __FILE__ ),
		'',
		''
	);

}
add_action( 'admin_enqueue_scripts', 'add_to_admin_script' );


function get_ba_image_slider_content( $atts ) {

	global $post;
	extract( shortcode_atts( array(
		'class'          => 'bxslider',
		'post_type'      => array( 'works' ),
		'posts_per_page' => 999,
	), $atts ) );

	//var_dump( $post_type );


	if ( is_singular( $post_type ) || is_post_type_archive() || is_home() ) {

		$post_id = get_the_ID();
		$post_data = get_post( $post_id );
		$post_title = esc_html( $post_data->post_title );
		$ba_images_count = get_post_meta( $post_id, 'image_ba', true );
		//var_dump( $ba_images_count );

		$html  = '';

		$html .= '<div class="slider-area">';
		$html .= '<ul class="bxslider">';

		for ( $i = 0; $i < intval( $ba_images_count ); $i++ ) {

			$html .= '<li>';

			$b_image_id       = get_post_meta( $post_id, sprintf( 'image_ba_%d__b', $i ), true );
			$before_image     = wp_get_attachment_image_src( $b_image_id, 'thmb_1020_500' );
			$before_image_tag = sprintf(
				'<img src="%1$s" width="%2$d" height="%3$d" alt="%4$s" title="%4$s">',
				esc_url( $before_image[ 0 ] ),
				intval( $before_image[ 1 ] ),
				intval( $before_image[ 2 ] ),
				$post_title . ' 施工前_' . intval( $i + 1 )
			);

			//$html .= $before_image_tag;

			$a_image_id      = get_post_meta( $post_id, sprintf( 'image_ba_%d__a', $i ), true );
			$after_image     = wp_get_attachment_image_src( $a_image_id, 'thmb_1020_500' );
			$after_image_tag = sprintf(
				'<img src="%1$s" width="%2$d" height="%3$d" alt="%4$s" title="%4$s">',
				esc_url( $after_image[ 0 ] ),
				intval( $after_image[ 1 ] ),
				intval( $after_image[ 2 ] ),
				$post_title . ' 施工後_' . intval( $i + 1 )
			);

			//$html .= $after_image_tag;


			$html .= '<div class="ba-slider">';
			$html .= $after_image_tag;
			$html .= '<div class="resize">';
			$html .= $before_image_tag;
			$html .= '</div>';
			$html .= '<span class="handle"></span>';
			$html .= '</div>';


			$html .= '</li>';

		}

		$html .= '</ul>';
		$html .= '</div>';

		return $html;

	}

}
add_shortcode( 'ba_slider', 'get_ba_image_slider_content' );


/**
 * Add image size.
 */
add_image_size( 'thumb_509_372_second', 509, 372, true );

/**
 * Add before after images at placed shortcode.
 * @param $atts
 *
 * @return string
 */
function get_ba_image_content( $atts ) {

	global $post;
	extract( shortcode_atts( array(
		'num'      => 0,
	), $atts ) );

	$post_id = get_the_ID();
	$post_content = get_post( $post_id );
	$post_title = esc_html( $post_content->post_title );

	$html  = '';

	$b_image_id = get_post_meta( $post_id, sprintf( 'image_ba_%d__b', $num ), true );

	if ( ! empty( $b_image_id ) ) {

		$html .= '<div class="comarison_image">';

		$before_image     = wp_get_attachment_image_src( $b_image_id, 'thumb_509_372_second' );
		$before_image_tag = sprintf(
			'<img class="comparison" src="%1$s" width="%2$d" height="%3$d" alt="%4$s" title="%4$s">',
			esc_url( $before_image[ 0 ] ),
			intval( $before_image[ 1 ] ),
			intval( $before_image[ 2 ] ),
			$post_title . ' 施工前_' . intval( $num + 1 )
		);

		$html .= $before_image_tag;

		$a_image_id      = get_post_meta( $post_id, sprintf( 'image_ba_%d__a', $num ), true );
		$after_image     = wp_get_attachment_image_src( $a_image_id, 'thumb_509_372_second' );
		$after_image_tag = sprintf(
			'<img class="comparison" src="%1$s" width="%2$d" height="%3$d" alt="%4$s" title="%4$s">',
			esc_url( $after_image[ 0 ] ),
			intval( $after_image[ 1 ] ),
			intval( $after_image[ 2 ] ),
			$post_title . ' 施工後_' . intval( $num + 1 )
		);

		$html .= $after_image_tag;
		$html .= '</div>';

	}

	return $html;

}
add_shortcode( 'ba_image', 'get_ba_image_content' );