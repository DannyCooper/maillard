<?php
/**
 * Filters used to modify theme output.
 *
 * @package zeus
 */

if ( ! function_exists( 'zeus_excerpt_more' ) ) {
	/**
	 * Filter default more text.
	 *
	 * @param $string $more Default 'read more link' html.
	 */
	function zeus_excerpt_more( $more ) {
		global $post;
		return '<p><a class="moretag" href="'. get_permalink( $post->ID ) . '">'.__( 'Continue Reading', 'zeus' ).'&hellip;</a></p>';
	}
}
add_filter( 'excerpt_more', 'zeus_excerpt_more' );


/**
 * Remove sidebar from full width page template.
 */
function remove_sidebar_from_full_width_template() {

	// Remove sidebar from just this page-template.
	if ( is_page_template( 'page-templates/full-width.php' ) ) {

		remove_action( 'zeus_content_sidebar_wrapper', 'zeus_sidebar_primary', 20 );

	}

}
add_action( 'zeus_content_sidebar_wrapper','remove_sidebar_from_full_width_template' );
