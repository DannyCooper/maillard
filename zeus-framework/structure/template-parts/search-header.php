<?php
/**
 * Header for search results pages.
 *
 * @package zeus
 */

if ( ! is_search() ) {
	return;
} ?>

<header <?php zeus_attr( 'archive-header' ) ?>>
	<h1 <?php zeus_attr( 'archive-title' ) ?>>
		<?php printf( esc_html__( 'Search Results for: %s', 'zeus' ), '<span>' . get_search_query() . '</span>' ); ?>
	</h1>
</header><!-- .archive-header -->
