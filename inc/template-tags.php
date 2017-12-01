<?php
/**
 * Custom template tags for this theme
 *
 * @package    maillard
 * @copyright  Copyright (c) 2017, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if ( ! function_exists( 'maillard_the_custom_logo' ) ) :
	/**
	 * Output the custom logo if it exists.
	 */
	function maillard_the_custom_logo() {

		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		}

	}
endif;

if ( ! function_exists( 'maillard_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function maillard_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

			$posted_on = sprintf(
				/* translators: %s: link to date archives */
				esc_html_x( 'Posted on %s', 'post date', 'maillard' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				/* translators: %s: link to author archives */
				esc_html_x( 'by %s', 'post author', 'maillard' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
			edit_post_link( esc_html__( '(Edit)', 'maillard' ), '<span class="edit-link">', '</span>' );

	}
endif;

if ( ! function_exists( 'maillard_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function maillard_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'maillard' ) );

			if ( $categories_list ) {
				/* translators: %s: list of categories */
				printf( '<span class="cat-links">' . esc_html__( 'Categories: %1$s', 'maillard' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'maillard' ) );
			if ( $tags_list ) {

				/* translators: %s: tags list */
				printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'maillard' ) . '</span>', $tags_list ); // WPCS: XSS OK.

			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">' . esc_html__( 'Discussion: ', 'maillard' );
			comments_popup_link( esc_html__( 'Leave a comment', 'maillard' ), esc_html__( '1 Comment', 'maillard' ), esc_html_x( '% Comments', 'number of comments', 'maillard' ), 'comments-link' );
			echo '</span>';
		}

	}
endif;

if ( ! function_exists( 'maillard_the_post_navigation' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function maillard_the_post_navigation() {
		$args = array(
			'prev_text'                  => __( 'Previous Post: <span>%title</span>', 'maillard' ),
			'next_text'                  => __( 'Next Post: <span>%title</span>', 'maillard' ),
		);

		the_post_navigation( $args );
	}
endif;


if ( ! function_exists( 'maillard_the_posts_navigation' ) ) :
	/**
	 * Displays the navigation to next/previous set of posts, when applicable.
	 */
	function maillard_the_posts_navigation() {
		$args = array(
			'prev_text'          => esc_html__( '&larr; Older Posts', 'maillard' ),
			'next_text'          => esc_html__( 'Newer Posts &rarr;', 'maillard' ),
			'screen_reader_text' => esc_html__( 'Posts Navigation', 'maillard' ),
		);

		the_posts_navigation( $args );
	}
endif;

if ( ! function_exists( 'maillard_thumbnail' ) ) :
	/**
	 * Output the thumbnail if it exists.
	 *
	 * @param string $size Size of thumbnail to output.
	 */
	function maillard_thumbnail( $size = '' ) {

		if ( has_post_thumbnail() ) { ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( $size ); ?>
				</a>
			</div><!-- .post-thumbnail -->
		<?php
		}

	}
endif;

/**
 * Display socials icons in the header if the user has enabled this setting.
 */
function maillard_social_output_header() {

	if ( get_theme_mod( 'social_header_display' ) === true ) {
		maillard_social_output();
	}

}

/**
 * Display socials icons in the footer if the user has enabled this setting.
 */
function maillard_social_output_footer() {

	if ( get_theme_mod( 'social_footer_display' ) === true ) {
		maillard_social_output();
	}

}
