<?php
/**
 * Zues Theme Customizer
 *
 * @package Zues
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zues_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'zues_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zues_customize_preview_js() {
	wp_enqueue_script( 'zues_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'zues_customize_preview_js' );

/**
 * Output the customizer CSS
 */
function header_output() {

	echo '<style type="text/css">';

	// @TODO
	
	echo '</style>';
}
add_action( 'wp_head' , 'header_output' );
