<?php
/**
 * The wrapper used to build all front-facing pages.
 *
 * @package zeus
 */

function zeus() {

	zeus_head();

	/**
	 * Fires before the <body> tag
	 */
	 do_action( 'zeus_body_open_before' );

	 /**
 	 * The opening <body> tag.
 	 *
 	 * @hooked zeus_body_open_html - 10
 	 */
	 do_action( 'zeus_body_open' );

	/**
	 * Fires after the <body> tag before the site header
	 */
	do_action( 'zeus_body_open_after' );

	echo '<div class="site-wrapper">';

	/**
	 * Fires before the site-header
	 */
	do_action( 'zeus_header_before' );

	echo '<header '. zeus_get_attr( 'header' ) .'">';

		do_action( 'zeus_header_wrapper_before' );


		echo '<div class="wrap">';

	/**
	 * Zeus site-header hook
	 *
	 * @hooked zeus_load_header_template - 10
	 */
	do_action( 'zeus_header' );

	echo '</div><!-- .wrap -->';

	do_action( 'zeus_header_wrapper_after' );


	echo '</header><!-- .site-header -->';
	/**
	 * Fires after the site-header
	 *
	 * @hooked zeus_nav_primary - 10
	 */
	do_action( 'zeus_header_after' );

	do_action( 'zeus_site_content_before' );



			echo '<div class="site-content">';


				/**
				 * Fires before the site-content (content + sidebar)
				 */
				do_action( 'zeus_content_sidebar_wrapper_before' );
				echo '<div class="wrap">';


					/**
					 * Content + Sidebar Hook
					 */
					 do_action( 'zeus_content_sidebar_wrapper' );

				echo '</div><!-- .wrap -->';

				/**
				 * Fires after the site-content wrapper
				 */
				do_action( 'zeus_content_sidebar_wrapper_after' );

			echo '</div><!-- .site-content -->';

			 do_action( 'zeus_site_content_after' );

			do_action( 'zeus_footer_before' );

		echo '<footer ' . zeus_get_attr( 'footer' ) .'>';

			/**
			 * Fires before the footer wrap
			 */
			do_action( 'zeus_footer_wrapper_before' );

			echo '<div class="wrap">';

				/**
				 * Zeus footer hook
				 *
				 * @hooked zeus_load_footer_template - 10
				 */
				do_action( 'zeus_footer' );

			echo '</div><!-- .wrap -->';

			/**
			 * Fires after the footer wrap
			 */
			do_action( 'zeus_footer_wrapper_after' );

		echo '</footer><!-- .site-footer -->';

		do_action( 'zeus_footer_after' );

		echo '</div><!-- .site-wrapper -->';

	/**
	 * Fires before the closing </body> tag
	 */
	 do_action( 'zeus_body_close_before' );

	 /**
 	 * The closing </body> tag.
 	 *
 	 * @hooked zeus_body_close_html - 10
 	 */
	 do_action( 'zeus_body_close' );

	/**
	 * Fires after the closing </body> tag
	 */
	 do_action( 'zeus_body_close_after' );

	echo '</html>';

}
