<?php
/**
 * Filters used to modify theme output.
 *
 * @package zeus
 */

if ( ! function_exists( 'zeus_content_area' ) ) {
	/**
	 * Load the relevant page template (uses WordPress hierarchy).
	 */
	function zeus_content_area() {

		/**
		 * Fires before the content (outside the loop)
		 */
		do_action( 'zeus_content_before' );

		echo '<main '. zeus_get_attr( 'content' ).' >';

			/**
			 * Content area hook
			 *
			 * @hooked zeus_loop - 20
			 */
			do_action( 'zeus_content' );

		echo '</main><!-- .content -->';

		/**
		 * Fires after the content (outside the loop)
		 */
		do_action( 'zeus_content_after' );

	}
}

if ( ! function_exists( 'zeus_loop' ) ) {
	/**
	 * The standard Wordpress loop.
	 */
	function zeus_loop() {

		if ( have_posts() ) : while ( have_posts() ) : the_post();

			/**
			 * Fires before the loop (within WordPress' loop)
			 */
			do_action( 'zeus_loop_before' );

			echo '<article ' . zeus_get_attr( 'post' ) . '>'; // WPCS: XSS OK.

				/**
				 * Loop hook
				 *
				 * @hooked zeus_featured_image - 5
				 * @hooked zeus_content_header - 10
				 * @hooked zeus_content_meta - 15
				 * @hooked zeus_post_excerpt - 20
				 * @hooked zeus_content_paging_nav - 25
				 * @hooked zeus_content_footer - 25
				 */
				do_action( 'zeus_loop' );

			echo '</article><!-- .post-'.get_the_ID().' -->';

			/**
			 * Fires after the loop (within WordPress' loop)
			 */
			do_action( 'zeus_loop_after' );

		endwhile; else :

			zeus_no_content();

		 endif;

	}
}

if ( ! function_exists( 'zeus_no_content' ) ) {
	/**
	 * Displayed when no posts are found.
	 */
	function zeus_no_content() {

		$priority = array(
			'template-parts/content-none.php',
			'zeus-framework/structure/template-parts/content-none.php',
		);

		locate_template( $priority, true );

	}
}


if ( ! function_exists( 'zeus_entry_header' ) ) {
	/**
	 * Display the post header, with a link to the single post where required.
	 */
	function zeus_entry_header() {

		/**
		 * Fires before the entry header
		 */
		do_action( 'zeus_entry_header_before' );

		echo '<header class="entry-header">';

			/**
			 * Entry header hook
			 */
			do_action( 'zeus_entry_header' );

		echo '</header><!-- .entry-header -->';

		/**
		 * Fires after the entry header
		 */
		do_action( 'zeus_entry_header_before' );
	}
}

if ( ! function_exists( 'zeus_entry_title' ) ) {
	/**
	 * Ouput the entry title.
	 */
	function zeus_entry_title() {

		if ( is_singular() ) {
			the_title( '<h1 '.zeus_get_attr( 'entry-title' ).'>', '</h1>' );
		} else {
			the_title( sprintf( '<h2 %s><a href="%s" rel="bookmark">', zeus_get_attr( 'entry-title' ), esc_url( get_permalink() ) ), '</a></h2>' );
		}
	}
}

if ( ! function_exists( 'zeus_content' ) ) {
	/**
	 * Ouput the post content.
	 */
	function zeus_content() {

		echo '<div '.zeus_get_attr( 'entry-content' ).'>'; // WPCS: XSS OK.

		the_content(
			sprintf(
				__( 'Continue reading %s', 'zeus' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);
		wp_link_pages(
			array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'zeus' ),
			'after'  => '</div>',
			)
		);

		echo '</div><!-- .entry-content -->';

	}
}

if ( ! function_exists( 'zeus_content_excerpt' ) ) {
	/**
	 * Output an excerpt of the post content.
	 */
	function zeus_content_excerpt() {

		echo '<div '.zeus_get_attr( 'entry-summary' ).'>'; // WPCS: XSS OK.

		the_excerpt();

		wp_link_pages(
			array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'zeus' ),
			'after'  => '</div>',
			)
		);

		echo '</div><!-- .entry-summary -->';

	}
}

if ( ! function_exists( 'zeus_entry_meta' ) ) {
	/**
	 * Output the post info. Publish Date, Author and Comments link.
	 *
	 * Can be overwritten  by adding a file named entry-meta.php to /template-parts in your
	 * theme or child theme.
	 */
	function zeus_entry_meta() {

		if ( is_page() ) {
			return;
		}

		$posted_by = sprintf(
			esc_html_x( 'by %s', 'post author', 'zeus' ),
			'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s | ', 'post date', 'zeus' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_date() . '</a>'
		);

		?>

		<div class="entry-meta">
			<span <?php zeus_attr( 'entry-author' ); ?>>
				<?php echo $posted_by; // WPCS: XSS OK. ?>
			</span><!-- .entry-author -->
			|
			<time <?php zeus_attr( 'entry-published' ); ?>>
				<?php echo $posted_on; // WPCS: XSS OK. ?>
			</time><!-- .entry-published -->

			<?php comments_popup_link( esc_html__( 'Leave a comment', 'zeus' ), esc_html__( '1 Comment', 'zeus' ), esc_html__( '% Comments', 'zeus' ) ); ?>
		</div><!-- .entry-meta -->
	<?php

	}
}

if ( ! function_exists( 'zeus_content_paging_nav' ) ) {
	/**
	 * Output the links to the previous/next page for paginated posts.
	 */
	function zeus_content_paging_nav() {

		global $wp_query;

		if ( is_single() ) {
			return;
		}

		$args = array(
			'type'         => 'list',
			'next_text' => _x( 'Next', 'Next post', 'zeus' ) . ' &rarr;',
			'prev_text' => '&larr; ' . _x( 'Previous', 'Previous post', 'zeus' ),
		);

		the_posts_pagination( $args );
	}
}

if ( ! function_exists( 'zeus_content_nav' ) ) {
	/**
	 * Output the links to the previous/next posts.
	 */
	function zeus_content_nav() {

		if ( ! is_single( ) ) {
			return;
		}

		$args = array(
		'next_text' => '<span class="meta-nav">Previous:</span> %title',
		'prev_text' => '<span class="meta-nav">Next:</span> %title',
		);
		the_post_navigation( $args );
	}
}

if ( ! function_exists( 'zeus_entry_footer' ) ) {
	/**
	 * Output the posts tags and categories.
	 */
	function zeus_entry_footer() {

		/* Hide category and tag text for pages on Search. */
		if ( 'post' === get_post_type() ) :

			echo '<footer class="entry-footer">';

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'zeus' ) );

			if ( $categories_list && zeus_categorized_blog() ) : ?>

				 <span class="cat-links">
					<?php
					echo esc_html__( 'Categories: ', 'zeus' );
					echo wp_kses_post( $categories_list );
					?>
				</span><!-- .cat-links -->

			<?php endif;

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'zeus' ) );

			if ( $tags_list ) : ?>

				 <span class="tag-links">

					<?php
					echo esc_html__( 'Tags: ', 'zeus' );
					echo wp_kses_post( $tags_list );
					?>

				</span><!-- .tag-links -->

			<?php endif; // End if $tags_list.

			echo '</footer><!-- .entry-footer -->';

	endif; // End if 'post' == get_post_type().

	}
}

if ( ! function_exists( 'zeus_categorized_blog' ) ) {
	/**
	 * Check if blog has multiple categories.
	 */
	function zeus_categorized_blog() {

		if ( false === ( $all_the_cool_cats = get_transient( '_s_categories' ) ) ) {

			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
				)
			);

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( '_s_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so zeus_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so zeus_categorized_blog should return false.
			return false;
		}

	}
}

if ( ! function_exists( 'zeus_featured_image' ) ) {
	/**
	 * Output featured image if one is set.
	 */
	function zeus_featured_image() {

		if ( ! has_post_thumbnail() ) {
			return;
		}

		echo '<div class="entry-thumbnail">';
			the_post_thumbnail( 'zeus-blog-post' );
		echo '</div><!-- .entry-thumbnail -->';

	}
}

if ( ! function_exists( 'zeus_comments_link' ) ) {
	/**
	 * Output comments link.
	 */
	function zeus_comments_link() {

		if ( ! comments_open() ) {

			echo '<span class="">Comments Closed</span>';
			return;
		}

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
         <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'zeus' ), __( '1 Comment', 'zeus' ), __( '% Comments', 'zeus' ) ); ?></span><!-- .comments-link -->
        <?php }
	}
}

if ( ! function_exists( 'zeus_content_navigation' ) ) {
	/**
	 * Output links to older/newer posts, for archive pages.
	 */
	function zeus_content_navigation() {

		$args = array(
			'prev_text'          => __( '&laquo; Older posts', 'zeus' ),
			'next_text'          => __( 'Newer posts &raquo;', 'zeus' ),
		);

		echo get_the_posts_navigation( $args ); // WPCS: XSS OK.
	}
}
