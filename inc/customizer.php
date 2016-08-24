<?php
/**
 * Add the maillard theme customization options to the WordPress Customizer.
 *
 * @package maillard
 */

 /**
  * @TODO
  */
function maillard_remove_contorl( $wp_customize ) {
	$wp_customize->remove_control( 'header_textcolor' );
}
add_action( 'customize_register', 'maillard_remove_contorl', 11 );


/**
 * @TODO
 */
function maillard_customizer_options() {

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$options['accent-color'] = array(
		'id' => 'accent-color',
		'label'   => __( 'Accent Color', 'maillard-pro' ),
		'section' => 'colors',
		'type'    => 'color',
		'transport'   => 'postMessage',
		'default' => '#15ab15'
	);

	$options['accent-hover-color'] = array(
		'id' => 'accent-hover-color',
		'label'   => __( 'Accent Hover Color', 'maillard-pro' ),
		'section' => 'colors',
		'type'    => 'color',
		'default' => '#0d842b'
	);

	// More Examples
	$section = 'social-media';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Social Media Icons', 'maillard-pro' ),
		'priority' => '10'
	);

	$options['facebook-url'] = array(
		'id' => 'facebook-url',
		'label'   => __( 'Facebook URL', 'maillard-pro' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['twitter-url'] = array(
		'id' => 'twitter-url',
		'label'   => __( 'Twitter URL', 'maillard-pro' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['instagram-url'] = array(
		'id' => 'instagram-url',
		'label'   => __( 'Instagram URL', 'maillard-pro' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['youtube-url'] = array(
		'id' => 'youtube-url',
		'label'   => __( 'YouTube URL', 'maillard-pro' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['pinterest-url'] = array(
		'id' => 'pinterest-url',
		'label'   => __( 'Pinterest URL', 'maillard-pro' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['rss-url'] = array(
		'id' => 'rss-url',
		'label'   => __( 'RSS URL', 'maillard-pro' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['mail-url'] = array(
		'id' => 'mail-url',
		'label'   => __( 'Contact URL', 'maillard-pro' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['linkedin-url'] = array(
		'id' => 'linkedin-url',
		'label'   => __( 'LinkedIn URL', 'maillard-pro' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['googleplus-url'] = array(
		'id' => 'googleplus-url',
		'label'   => __( 'Google+ URL', 'maillard-pro' ),
		'section' => $section,
		'type'    => 'url',
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();

	$customizer_library->add_options( $options );
}
add_action( 'init', 'maillard_customizer_options' );
