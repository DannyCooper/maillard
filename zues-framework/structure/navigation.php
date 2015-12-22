<?php
/**
 * Outputs the primary navigation.
 *
 * @package zues
 */

if ( ! function_exists( 'zues_nav_primary' ) ) {
	/**
	 * Outputs primary navigation structure.
	 */
	function zues_nav_primary() {

		echo '<nav '. zues_get_attr( 'menu', 'primary' ) .'">';
			do_action( 'zues_primary_nav_before' );
				echo '<div class="wrap">';
					do_action( 'zues_primary_nav' );
				 echo '</div>';
			 do_action( 'zues_primary_nav_before' );
		echo '</nav>';

	}
}

if ( ! function_exists( 'zues_output_primary_nav' ) ) {
	/**
	 * Outputs primary navigation.
	 */
	function zues_output_primary_nav() {

		wp_nav_menu(
			array(
			   'theme_location' => 'primary',
			   'container' => false,
			   'depth'      => 3,
			   )
		);

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
function zues_get_menu_location_name( $location ) {
	$locations = get_registered_nav_menus();
	return isset( $locations[ $location ] ) ? $locations[ $location ] : '';
}
