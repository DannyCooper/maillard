<?php

function customizer_library_demo_options() {

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$options['accent-url'] = array(
		'id' => 'accent-url',
		'label'   => __( 'Accent Color', 'maillard' ),
		'section' => 'colors',
		'type'    => 'color',
	);

	// More Examples
	$section = 'examples';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Social Media Icons', 'maillard' ),
		'priority' => '10'
	);

	$options['facebook-url'] = array(
		'id' => 'facebook-url',
		'label'   => __( 'Facebook URL', 'maillard' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['twitter-url'] = array(
		'id' => 'twitter-url',
		'label'   => __( 'Twitter URL', 'maillard' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['instagram-url'] = array(
		'id' => 'instagram-url',
		'label'   => __( 'Instagram URL', 'maillard' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['youtube-url'] = array(
		'id' => 'youtube-url',
		'label'   => __( 'YouTube URL', 'maillard' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['pinterest-url'] = array(
		'id' => 'pinterest-url',
		'label'   => __( 'Pinterest URL', 'maillard' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['rss-url'] = array(
		'id' => 'rss-url',
		'label'   => __( 'RSS URL', 'maillard' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['contact-url'] = array(
		'id' => 'contact-url',
		'label'   => __( 'Contact URL', 'maillard' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['linkedin-url'] = array(
		'id' => 'linkedin-url',
		'label'   => __( 'LinkedIn URL', 'maillard' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['googleplus-url'] = array(
		'id' => 'googleplus-url',
		'label'   => __( 'Google+ URL', 'maillard' ),
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
add_action( 'init', 'customizer_library_demo_options' );
