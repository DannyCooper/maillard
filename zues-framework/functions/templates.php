<?php
/**
 * Zues template functions
 *
 * @package zues
 */

	/**
	 * Load wrapper.php, unless a more specific template exists.
	 * Such as wrapper-archive.php.
	 */
class Zues_Wrapping {

	/**
	 * Stores the full path to the main template file
	 */
	static $main_template;

	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 */
	static $base;

	/*
     * Load the template
	 */
	static function wrap( $template ) {

		self::$main_template = $template;

		self::$base = substr( basename( self::$main_template ), 0, -4 );

		if ( 'index' === self::$base ) {
			self::$base = false;
		}

		$templates = array( 'wrapper.php' );

		if ( self::$base ) {
			array_unshift( $templates, sprintf( 'wrapper-%s.php', self::$base ) );
		}

		return locate_template( $templates );

	}
}

add_filter( 'template_include', array( 'Zues_Wrapping', 'wrap' ), 99 );

/**
 * Returns path of the template to be loaded.
 */
function zues_template_path() {
	return Zues_Wrapping::$main_template;
}

/**
 * Returns name of the template to be loaded.
 */
function zues_template_base() {
	return Zues_Wrapping::$base;
}

/**
 * Return a list of available header templates.
 *
 * @return  array The list of templates.
 * @todo  check against child theme
 */
function zues_get_headers() {

	require_once( ABSPATH . 'wp-admin/includes/file.php' );

	WP_Filesystem();

	global $wp_filesystem;

	$header_templates = array();

	$dir = THEME_DIR . '/template-parts/headers/';

	if ( is_dir( $dir ) ) {

		if ( $dh = opendir( $dir ) ) {

			while ( ($file = readdir( $dh )) !== false ) {
				if ( '.' !== $file && '..' !== $file ) {

					if ( ! preg_match( '|Header Name:(.*)$|mi', $wp_filesystem->get_contents( $dir.$file ), $header ) ) {
						continue;
					}

					$header_templates[ $file ] = _cleanup_header_comment( $header[1] );
				}
			}

			closedir( $dh );
		}

		return $header_templates;
	}

}

	/**
	 * Return a list of available footer templates.
	 *
	 * @return  array The list of templates.
	 */
function zues_get_footers() {

	require_once( ABSPATH . 'wp-admin/includes/file.php' );

	WP_Filesystem();

	global $wp_filesystem;

	$footers_templates = array();

	$dir = THEME_DIR . '/template-parts/footers/';

	if ( is_dir( $dir ) ) {

		if ( $dh = opendir( $dir ) ) {

			while ( ($file = readdir( $dh )) !== false ) {
				if ( '.' !== $file && '..' !== $file ) {

					if ( ! preg_match( '|Footer Name:(.*)$|mi', $wp_filesystem->get_contents( $dir.$file ), $header ) ) {
						continue;
					}

					$footer_templates[ $file ] = _cleanup_header_comment( $header[1] );
				}
			}

			closedir( $dh );
		}

		return $footer_templates;
	}

}
