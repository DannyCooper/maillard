<?php
/**
 * Filters used to modify theme output.
 *
 * @package zues
 */

if ( ! function_exists( 'zues_site_footer' ) ) {

	/**
	 * Output the footer widget areas
	 */
	function zues_site_footer() {

		echo '<footer ' . zues_get_attr( 'footer' ) .'>';

			do_action( 'zues_footer_before' );

			echo '<div class="wrap">';

			/**
			 * Zues footer hook
			 *
			 * @hooked zues_load_footer_template - 10
			 */
			do_action( 'zues_footer' );

			echo '</div>';

			do_action( 'zues_footer_after' );

		echo '</footer>';
	}
}

if ( ! function_exists( 'zues_load_footer_template' ) ) {

	/**
	 * Output the footer widget areas
	 */
	function zues_load_footer_template() {

		if (
		 	   ! is_active_sidebar( 'footer-1' )
			&& ! is_active_sidebar( 'footer-2' )
			&& ! is_active_sidebar( 'footer-3' )
			&& ! is_active_sidebar( 'footer-4' ) ) {
			return;
		}

		 echo '<div class="footer-widgets">';
				 zues_widget_area( 'footer-1' );
				 zues_widget_area( 'footer-2' ); 
				 zues_widget_area( 'footer-3' );
				 zues_widget_area( 'footer-4' );
		 echo '</div>';
	}
}

if ( ! function_exists( 'zues_footer_attribution' ) ) {
	/**
	 * Output the footer attribution text, this can be overwritten using a filter (zues_footer_attribution).
	 */
	function zues_sub_footer() {
		echo '<div class="sub-footer">';
			echo '<div class="wrap">';
				do_action( 'zues_sub_footer' );
			echo '</div>';
		echo '</div>';
	}
}

if ( ! function_exists( 'zues_footer_attribution' ) ) {
	/**
	 * Output the footer attribution text, this can be overwritten using a filter (zues_footer_attribution).
	 */
	function zues_footer_attribution() {

		$footer_attribution = __( 'Powered by the <a href="http://olympusthemes.com">Zues Theme</a>.', 'zues' );
		$filtered_footer_attribution = apply_filters( 'zues_footer_attribution', $footer_attribution );

		echo '<span class="footer-attribution">'.wp_kses_post( $filtered_footer_attribution ).'</span>';

	}
}

if ( ! function_exists( 'zues_footer_copyright' ) ) {
	/**
	 * Output the footer copyright text, this can be overwritten using a filter (zues_footer_copyright).
	 */
	function zues_footer_copyright() {

		$text = __( 'Copyright &copy; %1$s <a href="%2$s">%3$s</a> &middot; All Rights Reserved.', 'zues' );

		$date = date( 'Y' );
		$url = esc_url( home_url() );
		$name = get_bloginfo( 'name' );

		$footer_copyright = sprintf( $text, $date, $url, $name );

		$filtered_footer_copyright = apply_filters( 'zues_footer_copyright', $footer_copyright );

		echo '<span class="footer-copyright">'.wp_kses_post( $filtered_footer_copyright ).'</span>';

	}
}

if ( ! function_exists( 'zues_wpfooter' ) ) {
	/**
	 * Output the wp_footer function, required for plugins.
	 */
	function zues_wpfooter() {

		wp_footer();

	}
}
