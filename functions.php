<?php
/**
 * Zeus functions and definitions
 *
 * @package maillard
 */

define( 'USE_ZEUS_CUSTOMIZER', true );

/**
 * Load zeus framework.
 */
require_once( get_template_directory() . '/zeus-framework/init.php' );

if ( ! function_exists( 'maillard_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function maillard_setup() {
		/*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Core, use a find and replace
         * to change 'maillard-pro' to the name of your theme in all the template files
        */
		load_theme_textdomain( 'maillard-pro', get_template_directory() . '/languages' );


		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_editor_style( 'editor-styles.css' );

		/*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
        */
		add_theme_support( 'title-tag' );

		$args = array(
			'flex-height' => true,
			'width' => 1170,
			'flex-height' => true,
			'height' => 250,
			'default-text-color' => '313131',
		);
		add_theme_support( 'custom-header', $args );

		/*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'homepage-featured-post', 1170, 654 ); // 970 pixels wide (and unlimited height)
		add_image_size( 'homepage-blog-thumbnail', 250, 250, true ); // 250 pixels wide by 250px high
		add_image_size( 'zeus-blog-post', 770 ); // 770 pixels wide (and unlimited height)

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
			'primary' => esc_html__( 'Primary Menu', 'maillard-pro' ),
			)
		);

		/*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
        */
		add_theme_support(
			'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters(
				'zeus_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
				)
			)
		);

	}
}
add_action( 'after_setup_theme', 'maillard_setup' );


if ( ! function_exists( 'zeus_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function zeus_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'zeus_content_width', 1170 );
	}
	add_action( 'after_setup_theme', 'zeus_content_width', 0 );
}

/**
 * Register the widget areas this theme supports
 */
function zeus_register_sidebars() {

	zeus_register_widget_area(
		array(
		'id'          => 'sidebar-primary',
		'name'        => __( 'Primary Sidebar', 'maillard-pro' ),
		'description' => __( 'Widgets added here are shown in the sidebar next to your content.', 'maillard-pro' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-1',
		'name'        => __( 'Footer One', 'maillard-pro' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'maillard-pro' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-2',
		'name'        => __( 'Footer Two', 'maillard-pro' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'maillard-pro' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-3',
		'name'        => __( 'Footer Three', 'maillard-pro' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'maillard-pro' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-4',
		'name'        => __( 'Footer Four', 'maillard-pro' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'maillard-pro' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'featured-post',
		'name'        => __( 'Featured Post', 'maillard-pro' ),
		'description' => __( '', 'maillard-pro' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'featured-categories',
		'name'        => __( 'Featured Categories', 'maillard-pro' ),
		'description' => __( '', 'maillard-pro' ),
		)
	);

}

add_action( 'widgets_init', 'zeus_register_sidebars', 5 );

/**
 * Enqueue scripts and styles.
 */
function zeus_scripts() {
	wp_enqueue_style( 'ot-zeus-style', get_stylesheet_uri() );
	wp_enqueue_style( 'maillard-socicons', '//file.myfontastic.com/n6vo44Re5QaWo8oCKShBs7/icons.css' );

	wp_enqueue_script( 'zeus-scripts', ZEUS_THEME_URI . '/assets/js/scripts.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zeus_scripts' );

/**
 * Move the navigation above the header.
 */
remove_action( 'zeus_header_after', 'zeus_nav_primary', 10 );
add_action( 'zeus_header_before', 'zeus_nav_primary', 10 );

/**
 * @TODO
 */
remove_action( 'zeus_sub_footer', 'zeus_footer_attribution', 15 );
add_action( 'zeus_sub_footer', 'maillard_social_footer', 15 );

/**
 * Load the widgets.
 */
require_once( get_stylesheet_directory() . '/inc/customizer.php' );
require_once( get_stylesheet_directory() . '/inc/customizer-output.php' );

/**
 * @TODO
 */
function maillard_social_footer() {

	$social_websites = array(
		'facebook' => 'Facebook',
		'twitter' => 'Twitter',
		'instagram' => 'Instagram',
		'youtube' => 'YouTube',
		'pinterest' => 'Pinterest',
		'rss' => 'RSS',
		'mail' => 'Contact',
		'linkedin' => 'LinkedIn',
		'googleplus' => 'Google+',
	);

	echo '<div class="maillard-social-icons">';

	foreach ( $social_websites as $id => $name ) {

		if( $url = get_theme_mod( $id.'-url' ) ) {

			echo '<a href="'. $url .'">
				<span class="socicon socicon-'.$id.'"></span>
			</a>';

		}

	}

	echo '</div>';

}

function maillard_instagram_widget_link_class() {
	return 'maillard-instagram-widget-link';
}

add_filter( 'wpiw_link_class', 'maillard_instagram_widget_link_class' );


function maillard_instagram_widget_ul_class( $classes ) {
	return $classes . ' clear';
}

add_filter( 'wpiw_list_class', 'maillard_instagram_widget_ul_class' );

/**
 * @todo
 */
function maillard_footer_attribution( ){

	$text = __( 'Copyright &copy; %1$s <a href="%2$s">%3$s</a> &middot; Powered by  the %4$s.', 'maillard-pro' );

	$date = date( 'Y' );
	$url = esc_url( home_url() );
	$name = get_bloginfo( 'name' );
	$attribution = '<a href="https://olympusthemes.com/maillard">Maillard Theme</a>';

	return sprintf( $text, $date, $url, $name, $attribution );

}
add_filter( 'zeus_footer_copyright', 'maillard_footer_attribution' );

if( ! is_single() ) {
	remove_action( 'zeus_loop', 'zeus_entry_footer', 30 );
}

/**
 * Register new layouts in Genesis.
 *
 * Modifies the global `$_zeus_layouts` variable.
 *
 */
function zeus_register_layout( $id = '', $args = array() ) {

	global $_zeus_layouts;

	if ( ! is_array( $_zeus_layouts ) )
		$_zeus_layouts = array();

	//* Don't allow empty $id, or double registrations
	if ( ! $id || isset( $_zeus_layouts[$id] ) )
		return false;

	$defaults = array(
		'label' => __( 'No Label Selected', 'zeus-framework' ),
		'img'   => ZEUS_FRAMEWORK_URI . '/assets/images/layouts/none.gif',
	);

	$args = wp_parse_args( $args, $defaults );

	$_zeus_layouts[$id] = $args;

	return $args;

}


/**
 * Unregister a layout in Genesis.
 *
 * Modifies the global $_zeus_layouts variable.
 *
 */
function zeus_unregister_layout( $id = '' ) {

	global $_zeus_layouts;

	if ( ! $id || ! isset( $_zeus_layouts[$id] ) )
		return false;

	unset( $_zeus_layouts[$id] );

	return true;

}

/**
 * Return all registered Genesis layouts.
 *
 * @since 1.4.0
 *
 * @global array $_zeus_layouts Holds all layout data.
 *
 * @param string $type Layout type to return. Leave empty to return all types.
 *
 * @return array Registered layouts.
 */
function zeus_get_layouts() {

	global $_zeus_layouts;

	//* If no layouts exists, return empty array
	if ( ! is_array( $_zeus_layouts ) ) {
		$_zeus_layouts = array();
	}

	return $_zeus_layouts;

}

$args = array(
	'label' => 'Content - Sidebar',
);
zeus_register_layout( 'content-sidebar', $args );
