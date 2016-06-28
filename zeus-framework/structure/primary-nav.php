<?php
/**
 * Outputs the primary navigation.
 *
 * @package zeus
 */

if ( ! function_exists( 'zeus_nav_primary' ) ) {
	/**
	 * Outputs primary navigation.
	 */
	function zeus_nav_primary() {

		$priority = array(
			'template-parts/primary-nav.php',
			'zeus-framework/structure/template-parts/primary-nav.php',
		);

		locate_template( $priority, true );

	}
}

/**
 * Function for grabbing a WP nav menu theme location name.
 *
 * @since  2.0.0
 * @access public
 * @param  string $location
 * @return string
 */
function zeus_get_menu_location_name( $location ) {
	$locations = get_registered_nav_menus();
	return isset( $locations[ $location ] ) ? $locations[ $location ] : '';
}
