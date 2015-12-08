<?php
/**
 * Build the layout using the hooks.
 *
 * @package zues
 */

// Head hooks.
add_action( 'zues_header', 'zues_header', 20 );
add_action( 'zues_header', 'zues_nav_primary', 30 );

// Content hooks.
add_action( 'zues_content_sidebar_wrapper', 'zues_content_area', 10 );
add_action( 'zues_content_sidebar_wrapper', 'zues_sidebar_primary', 20 );

// Entry Header hooks.
add_action( 'zues_entry_header', 'zues_entry_title', 10 );
add_action( 'zues_entry_header', 'zues_entry_meta', 15 );

// Loop Hooks.
add_action( 'zues_loop', 'zues_featured_image', 5 );
add_action( 'zues_loop', 'zues_entry_header', 10 );
add_action( 'zues_loop', 'zues_content', 20 );
add_action( 'zues_loop', 'zues_entry_footer', 30 );
add_action( 'zues_loop_after', 'zues_display_comments', 10 );

add_action( 'zues_content_after', 'zues_content_paging_nav', 10 );
add_action( 'zues_content_after', 'zues_content_nav', 10 );

// Archive Page Hooks.
add_action( 'zues_loop_before', 'zues_archive_header', 20 );

// Search Page Hooks.
add_action( 'zues_loop_before', 'zues_search_header', 20 );


// Sidebar Hooks.
add_action( 'zues_sidebar_primary', 'zues_build_sidebar', 10 );

// Footer Hooks.
add_action( 'zues_footer', 'zues_load_footer_template', 10 );
add_action( 'zues_sub_footer', 'zues_footer_attribution', 15 );
add_action( 'zues_sub_footer', 'zues_footer_copyright', 20 );
add_action( 'zues_body_close_before', 'zues_sub_footer', 10 );
add_action( 'zues_body_close_before', 'zues_wpfooter', 100 );



/**
 * Add HTML showing where each hook is placed.
 */
function zues_comment_hooks() {

	if ( ! defined( 'ZUES_DEV' ) ) {
		return;
	}

	$hooks = array(
			'zues_head',
			'zues_body_open_before',
			'zues_body_open_after',
			'zues_header_before',
			'zues_header',
			'zues_header_after',
			'zues_content_sidebar_wrapper_before',
			'zues_content_sidebar_wrapper',
			'zues_content_sidebar_wrapper_after',
			'zues_content_before',
			'zues_loop_before',
			'zues_loop',
			'zues_loop_after',
			'zues_sidebar_before',
			'zues_sidebar',
			'zues_sidebar_after',
			'zues_footer_before',
			'zues_footer',
			'zues_footer_after',
			'zues_body_close_before',
			'zues_body_close_after',
		);

	$filter_hooks = apply_filters( 'zues_hooks_list', $hooks );

	foreach ( $hooks as $hook ) {
		add_action( $hook, function() use ( $hook ) { echo '<!--Hook Name: '.$hook."-->\n";
		} );
	}

}

add_action( 'after_setup_theme', 'zues_comment_hooks' );

define( 'ZUES_DEV', true );

/**
 * Remove sidebar from full width page template.
 */
function remove_sidebar_from_full_width() {
	// By default show excerpts on all pages except single.
	if ( is_page_template( 'page-templates/page-full-width.php' ) ) {

		remove_action( 'zues_content_sidebar_wrapper', 'zues_sidebar_primary', 20 );

	}
}
add_action( 'zues_head','remove_sidebar_from_full_width' );
