<?php
/**
 * Functions used to build the page-*.php templates.
 *
 * @package zues
 */

if ( ! function_exists( 'zues_archive_header' ) ) {
	/**
	 * Output the header for archive pages.
	 */
	function zues_archive_header() {

		if ( ! is_archive() ) {
			return;
		}

		?>

		<header <?php zues_attr( 'archive-header' ) ?>>
			<h1 <?php zues_attr( 'archive-title' ) ?>>
				<?php the_archive_title(); ?>
			</h1>

			<div <?php zues_attr( 'archive-description' ) ?>>
				<?php echo get_the_archive_description(); ?>
			</div>
		</header>

		<?php
	}
}

if ( ! function_exists( 'zues_search_header' ) ) {
	/**
	 * Output the header for search pages.
	 */
	function zues_search_header() {

		if ( ! is_search() ) {
			return;
		} ?>

		<header <?php zues_attr( 'archive-header' ) ?>>
			<h1 <?php zues_attr( 'archive-title' ) ?>>
				<?php printf( esc_html_e( 'Search Results for: %s', 'zues' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>
		</header>

		<?php
	}
}
