<?php
/**
 * Template Name: Full Width Template
 *
 * The template for displaying a full width page.
 *
 * @package maillard
 */

/**
 * @TODO
 */
function ot_author_customizer_css() {

	echo "<style> \n ";

	$custom_css = array(

		array(
			'selector' => 'input[type="submit"], button',
			'style' => 'background-color',
			'theme_mod' => 'accent-color',
		),

		array(
			'selector' => 'input[type="submit"]:hover, button:hover',
			'style' => 'background-color',
			'theme_mod' => 'accent-hover-color',
		),

		array(
			'selector' => '.entry-content a, .comments-area a, .entry-footer a, .post-navigation a, .sub-footer a',
			'style' => 'color',
			'theme_mod' => 'accent-color',
		),

		array(
			'selector' => '.entry-content a:hover, .comments-area a:hover, .entry-footer a:hover, .post-navigation a:hover, .sub-footer a:hover',
			'style' => 'color',
			'theme_mod' => 'accent-hover-color',
		),

		array(
			'selector' => '.menu-primary .menu li.current_page_item a, .menu-primary .menu li a:hover',
			'style' => 'border-color',
			'theme_mod' => 'accent-color',
		),

	);

	foreach ( $custom_css as $mod ) {
		generate_css( $mod['selector'], $mod['style'], $mod['theme_mod'] );
		echo "\n";
	}

	echo "\n </style> \n ";
}

add_action( 'wp_head', 'ot_author_customizer_css' );

/**
 * This will generate a line of CSS for use in header output. If the setting
 * ($mod_name) has no defined value, the CSS will not be output.
 *
 * @uses get_theme_mod()
 * @param string $selector CSS selector
 * @param string $style The name of the CSS *property* to modify
 * @param string $mod_name The name of the 'theme_mod' option to fetch
 * @param string $prefix Optional. Anything that needs to be output before the CSS property
 * @param string $postfix Optional. Anything that needs to be output after the CSS property
 * @param bool   $echo Optional. Whether to print directly to the page (default: true).
 * @return string Returns a single line of CSS with selectors and a property.
 * @since MyTheme 1.0
 */
function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {
	$return = '';
	$mod = get_theme_mod( $mod_name );
	if ( ! empty( $mod ) ) {
		$return = sprintf('%s { %s: %s; }',
			$selector,
			$style,
			$prefix.$mod.$postfix
		);
		if ( $echo ) {
			echo $return;
		}
	}
	return $return;
}
