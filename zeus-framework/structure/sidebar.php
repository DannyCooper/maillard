<?php
/**
 * Filters used to modify theme output.
 *
 * @package zeus
 */

if ( ! function_exists( 'zeus_sidebar_primary' ) ) {
	/**
	 * Output the primary sidebar and hooks.
	 */
	function zeus_sidebar_primary() {

		echo '<aside '. zeus_get_attr( 'sidebar', 'primary' ) . '">';

			/**
			 * Fires before the sidebar
			 */
			do_action( 'zeus_sidebar_primary_before' );

			/**
			 * Primary Sidebar Hook
			 */
			do_action( 'zeus_sidebar_primary' );

			/**
			 * Fires after the sidebar
			 */
			do_action( 'zeus_sidebar_primary_after' );

		echo '</aside><!-- .sidebar-primary -->';

	}
}

if ( ! function_exists( 'zeus_build_sidebar' ) ) {
	/**
	 * Output the primary sidebar.
	 */
	function zeus_build_sidebar() {

		echo '<div class="sidebar-primary-inner">';
			dynamic_sidebar( 'primary-sidebar' );
		echo '</div><!-- .sidebar-primary-inner -->';

	}
}


/**
 * Function for grabbing a dynamic sidebar name.
 *
 * @since  2.0.0
 * @access public
 * @global array   $wp_registered_sidebars
 * @param  string $sidebar_id
 * @return string
 */
function zeus_get_sidebar_name( $sidebar_id ) {
	global $wp_registered_sidebars;
	return isset( $wp_registered_sidebars[ $sidebar_id ] ) ? $wp_registered_sidebars[ $sidebar_id ]['name'] : '';
}
