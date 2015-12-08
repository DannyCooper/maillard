<?php
/**
 * Defines customizer options
 *
 * @package zues
 */

/**
 * Build an array of customizer panels, sections and options
 */
function zues_customizer_options() {

	// Stores all the controls that will be added.
	$options = array();

	// Stores all the sections to be added.
	$sections = array();

	// Stores all the panels to be added.
	$panels = array();

	// Adds the sections to the $options array.
	$options['sections'] = $sections;

	// Adds the panels to the $options array.
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();.
}
add_action( 'admin_init', 'zues_customizer_options' );
