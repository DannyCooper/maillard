<?php
/**
 * Functions used to build the page-*.php templates.
 *
 * @package zeus
 */

if ( ! function_exists( 'zeus_archive_header' ) ) {
	/**
	 * Output the header for archive pages.
	 */
	function zeus_archive_header() {

		$priority = array(
			'template-parts/archive-header.php',
			'zeus-framework/structure/template-parts/archive-header.php',
		);

		locate_template( $priority, true );

	}
}

if ( ! function_exists( 'zeus_search_header' ) ) {
	/**
	 * Output the header for search pages.
	 */
	function zeus_search_header() {

		$priority = array(
			'template-parts/search-header.php',
			'zeus-framework/structure/template-parts/search-header.php',
		);

		locate_template( $priority, true );
	}
}
